<?php
/**
 * Ogape Transactional Emails
 *
 * Email template, send functions, and trigger hooks for:
 *   - Welcome (registration)
 *   - Pause confirmation
 *   - Caja status change (bulk to all active subscribers)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── TEMPLATE ─────────────────────────────────────────────────────────────────

function ogape_email_template( $subject, $heading, $body_html, $cta_url = '', $cta_label = '' ) {
    $account_url   = home_url( '/account/' );
    $unsubscribe   = home_url( '/account/#configuracion' );
    $logo_alt_text = 'Ogape — Tu Chef en Casa';

    $cta_block = '';
    if ( $cta_url && $cta_label ) {
        $cta_block = '
        <p style="margin:28px 0 0;">
          <a href="' . esc_url( $cta_url ) . '" style="display:inline-block;background:#B45309;color:#ffffff;text-decoration:none;padding:14px 30px;border-radius:10px;font-size:14px;font-weight:600;letter-spacing:.01em;">' . esc_html( $cta_label ) . '</a>
        </p>';
    }

    $html = '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . esc_html( $subject ) . '</title>
</head>
<body style="margin:0;padding:0;background:#F9F5F0;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F9F5F0;padding:40px 16px;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" border="0" style="max-width:580px;width:100%;">

        <!-- Logo -->
        <tr>
          <td style="padding:0 0 24px;">
            <a href="' . esc_url( home_url( '/' ) ) . '" style="text-decoration:none;">
              <span style="font-size:22px;font-weight:700;color:#1a1a1a;letter-spacing:-.3px;">' . esc_html( $logo_alt_text ) . '</span>
            </a>
          </td>
        </tr>

        <!-- Card -->
        <tr>
          <td style="background:#ffffff;border-radius:16px;padding:40px;box-shadow:0 1px 4px rgba(0,0,0,.06);">

            <h1 style="margin:0 0 12px;font-size:22px;font-weight:600;color:#111827;line-height:1.35;">' . $heading . '</h1>

            ' . $body_html . $cta_block . '

          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="padding:24px 0 0;text-align:center;font-size:12px;color:#9CA3AF;line-height:1.7;">
            Ogape &middot; Tu Chef en Casa &middot; Asunción, Paraguay<br>
            <a href="' . esc_url( $account_url ) . '" style="color:#9CA3AF;text-decoration:underline;">Mi cuenta</a>
            &nbsp;&middot;&nbsp;
            <a href="' . esc_url( $unsubscribe ) . '" style="color:#9CA3AF;text-decoration:underline;">Preferencias de email</a>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>';

    return $html;
}

function ogape_send_email( $to, $subject, $heading, $body_html, $cta_url = '', $cta_label = '' ) {
    if ( ! is_email( $to ) ) {
        return false;
    }

    $html    = ogape_email_template( $subject, $heading, $body_html, $cta_url, $cta_label );
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );

    return wp_mail( $to, $subject, $html, $headers );
}

// ── WELCOME EMAIL ─────────────────────────────────────────────────────────────

function ogape_send_welcome_email( $user_id ) {
    $user = get_userdata( $user_id );
    if ( ! $user ) {
        return;
    }

    $first_name   = $user->first_name ?: $user->display_name;
    $account_url  = home_url( '/account/' );
    $menu_url     = home_url( '/menu/' );

    $subject = '¡Bienvenida a Ogape, ' . $first_name . '!';
    $heading = 'Tu cuenta está lista.';

    $body = '
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Hola <strong>' . esc_html( $first_name ) . '</strong>, bienvenida a Ogape. Tu cuenta quedó creada y ya podés ver el menú de la semana, gestionar entregas y actualizar tus preferencias desde el dashboard.
    </p>
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Cada jueves coordinamos la entrega según tu zona y horario preferido. Si necesitás cambiar algo, lo podés hacer en cualquier momento desde <a href="' . esc_url( $account_url ) . '" style="color:#B45309;text-decoration:underline;">tu cuenta</a>.
    </p>
    <hr style="border:none;border-top:1px solid #F3EDE5;margin:24px 0;">
    <p style="margin:0;font-size:13px;color:#6B7280;line-height:1.6;">
      Si no creaste esta cuenta, ignorá este mensaje.
    </p>';

    ogape_send_email( $user->user_email, $subject, $heading, $body, $account_url, 'Ver mi cuenta' );
}
add_action( 'ogape_user_registered', 'ogape_send_welcome_email' );

// ── PAUSE CONFIRMATION EMAIL ──────────────────────────────────────────────────

function ogape_send_pause_confirmed_email( $user_id, $pause_when ) {
    $user = get_userdata( $user_id );
    if ( ! $user ) {
        return;
    }

    $first_name  = $user->first_name ?: $user->display_name;
    $account_url = home_url( '/account/' );

    $semantic_labels = array(
        'next'       => 'para la próxima entrega',
        'two'        => 'para las próximas dos semanas',
        'indefinite' => 'indefinidamente',
    );
    if ( isset( $semantic_labels[ $pause_when ] ) ) {
        $pause_phrase = $semantic_labels[ $pause_when ];
    } elseif ( $pause_when && $pause_when !== 'indefinite' ) {
        $dt = DateTimeImmutable::createFromFormat( 'Y-m-d', $pause_when, wp_timezone() );
        $pause_phrase = $dt && function_exists( 'ogape_demo_format_date_label' )
            ? 'hasta el ' . ogape_demo_format_date_label( $dt )
            : 'temporalmente';
    } else {
        $pause_phrase = 'indefinidamente';
    }

    $subject = 'Tu entrega quedó pausada';
    $heading = 'Pausa confirmada.';

    $body = '
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Hola <strong>' . esc_html( $first_name ) . '</strong>, confirmamos que pausamos tu suscripción ' . esc_html( $pause_phrase ) . '. No se te cobrará ni realizará entrega durante ese período.
    </p>
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Cuando quieras reanudar, entrá a tu cuenta y activá la entrega con un clic. Tu historial, preferencias y dirección quedan guardados.
    </p>
    <hr style="border:none;border-top:1px solid #F3EDE5;margin:24px 0;">
    <p style="margin:0;font-size:13px;color:#6B7280;line-height:1.6;">
      ¿Fue un error? Podés reactivar en cualquier momento desde tu cuenta.
    </p>';

    ogape_send_email( $user->user_email, $subject, $heading, $body, $account_url, 'Ir a mi cuenta' );
}
add_action( 'ogape_plan_paused', 'ogape_send_pause_confirmed_email', 10, 2 );

// ── CAJA STATUS CHANGE EMAIL ──────────────────────────────────────────────────

function ogape_send_caja_status_email( $caja_id, $new_status, $old_status ) {
    // Only send for meaningful customer-facing transitions.
    $send_for = array( 'confirmed', 'preparing', 'in_transit', 'delivered' );
    if ( ! in_array( $new_status, $send_for, true ) ) {
        return;
    }

    $delivery_date = get_post_meta( $caja_id, '_ogape_delivery_date', true );
    $week_number   = str_pad( (string) get_post_meta( $caja_id, '_ogape_week_number', true ), 2, '0', STR_PAD_LEFT );
    $account_url   = home_url( '/account/' );
    $menu_url      = home_url( '/menu/' );

    $date_label = $delivery_date
        ? wp_date( 'l j \d\e F', strtotime( $delivery_date ), wp_timezone() )
        : 'próximo jueves';

    // Message variants by status
    $variants = array(
        'confirmed'  => array(
            'subject' => 'Tu caja N.° ' . $week_number . ' está confirmada',
            'heading' => 'Pedido confirmado.',
            'body'    => '
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> está confirmada para el <strong>' . esc_html( $date_label ) . '</strong>. Vamos a preparar los ingredientes frescos para esa fecha.
            </p>
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Podés ver las recetas de la semana en el <a href="' . esc_url( $menu_url ) . '" style="color:#B45309;text-decoration:underline;">menú semanal</a> y revisar el estado de tu entrega desde el dashboard.
            </p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver mi caja',
        ),
        'preparing'  => array(
            'subject' => 'Estamos preparando tu caja',
            'heading' => 'Tu caja está en preparación.',
            'body'    => '
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Estamos armando tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> con los ingredientes frescos de la semana. La entrega está programada para el <strong>' . esc_html( $date_label ) . '</strong>.
            </p>
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Revisá tu dirección y horario de entrega en el dashboard antes del jueves.
            </p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver estado',
        ),
        'in_transit' => array(
            'subject' => 'Tu caja está en camino 🚚',
            'heading' => '¡En camino!',
            'body'    => '
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> ya salió a entrega. Estamos en ruta — revisá el horario estimado en tu dashboard para saber cuándo pasa el repartidor.
            </p>
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Si tenés algún problema con la entrega, respondé este email o escribinos a <a href="mailto:hola@ogape.com.py" style="color:#B45309;text-decoration:underline;">hola@ogape.com.py</a>.
            </p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver horario estimado',
        ),
        'delivered'  => array(
            'subject' => 'Tu caja N.° ' . $week_number . ' fue entregada',
            'heading' => '¡Entregada! Buen provecho.',
            'body'    => '
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> llegó. Esperamos que disfrutes las recetas de esta semana.
            </p>
            <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
              Si algo no llegó bien o falta un ingrediente, escribinos a <a href="mailto:hola@ogape.com.py" style="color:#B45309;text-decoration:underline;">hola@ogape.com.py</a> y lo resolvemos de inmediato.
            </p>',
            'cta_url'   => '',
            'cta_label' => '',
        ),
    );

    $v = $variants[ $new_status ] ?? null;
    if ( ! $v ) {
        return;
    }

    // Get zone overrides so we can skip subscribers whose zone is already at a different status.
    $zone_overrides = get_post_meta( $caja_id, '_ogape_status_by_zone', true );
    if ( ! is_array( $zone_overrides ) ) $zone_overrides = array();

    // Get all active subscribers (setup_complete = 1)
    $subscribers = get_users( array(
        'meta_key'   => 'ogape_setup_complete',
        'meta_value' => '1',
        'fields'     => array( 'ID', 'user_email', 'display_name', 'first_name' ),
        'number'     => 500,
    ) );

    foreach ( $subscribers as $sub ) {
        if ( ! is_email( $sub->user_email ) ) {
            continue;
        }

        // If the subscriber's zone has a status override that differs from $new_status,
        // skip — their zone-specific email will fire via ogape_zone_status_changed instead.
        $zone_key = get_user_meta( $sub->ID, 'ogape_zone_key', true );
        if ( $zone_key && isset( $zone_overrides[ $zone_key ] ) && $zone_overrides[ $zone_key ] !== $new_status ) {
            continue;
        }

        // Respect weekly menu opt-out for non-operational transitions.
        if ( in_array( $new_status, array( 'confirmed', 'preparing' ), true ) ) {
            if ( ! ogape_notif_pref( $sub->ID, 'ogape_notif_weekly_menu', true ) ) {
                continue;
            }
        }

        $first             = $sub->first_name ?: $sub->display_name;
        $personalised_body = '<p style="margin:0 0 12px;font-size:15px;color:#374151;">Hola <strong>' . esc_html( $first ) . '</strong>,</p>' . $v['body'];

        ogape_send_email(
            $sub->user_email,
            $v['subject'],
            $v['heading'],
            $personalised_body,
            $v['cta_url'],
            $v['cta_label']
        );
    }
}
add_action( 'ogape_caja_status_changed', 'ogape_send_caja_status_email', 10, 3 );

// ── PLAN RESUMED EMAIL ────────────────────────────────────────────────────────

function ogape_send_plan_resumed_email( $user_id ) {
    $user = get_userdata( $user_id );
    if ( ! $user || ! is_email( $user->user_email ) ) {
        return;
    }

    $first_name  = $user->first_name ?: $user->display_name;
    $account_url = home_url( '/account/' );

    $subject = 'Tu plan Ogape está activo de nuevo';
    $heading = 'Tu entrega se reanuda.';
    $body    = '
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Hola <strong>' . esc_html( $first_name ) . '</strong>, tu suscripción Ogape está activa nuevamente. Volvés a recibir tu caja semanal a partir de la próxima entrega.
    </p>
    <p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">
      Entrá a tu cuenta para elegir tus recetas antes del cierre de pedidos del martes.
    </p>
    <hr style="border:none;border-top:1px solid #F3EDE5;margin:24px 0;">
    <p style="margin:0;font-size:13px;color:#6B7280;line-height:1.6;">
      ¿Querés pausar de nuevo? Podés hacerlo en cualquier momento desde tu cuenta.
    </p>';

    ogape_send_email( $user->user_email, $subject, $heading, $body, $account_url, 'Ir a mi cuenta' );
}
add_action( 'ogape_plan_resumed', 'ogape_send_plan_resumed_email' );

// ── ZONE-SPECIFIC STATUS EMAIL ────────────────────────────────────────────────

function ogape_send_zone_status_email( $caja_id, $zone_key, $new_status ) {
    $send_for = array( 'confirmed', 'preparing', 'in_transit', 'delivered' );
    if ( ! in_array( $new_status, $send_for, true ) ) {
        return;
    }

    $delivery_date = get_post_meta( $caja_id, '_ogape_delivery_date', true );
    $week_number   = str_pad( (string) get_post_meta( $caja_id, '_ogape_week_number', true ), 2, '0', STR_PAD_LEFT );
    $account_url   = home_url( '/account/' );

    $date_label = $delivery_date
        ? wp_date( 'l j \d\e F', strtotime( $delivery_date ), wp_timezone() )
        : 'próximo jueves';

    $variants = array(
        'confirmed'  => array(
            'subject'   => 'Tu caja N.° ' . $week_number . ' está confirmada',
            'heading'   => 'Pedido confirmado.',
            'body'      => '<p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> está confirmada para el <strong>' . esc_html( $date_label ) . '</strong>.</p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver mi caja',
        ),
        'preparing'  => array(
            'subject'   => 'Estamos preparando tu caja',
            'heading'   => 'Tu caja está en preparación.',
            'body'      => '<p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">Estamos armando tu caja N.° <strong>' . esc_html( $week_number ) . '</strong>. La entrega está programada para el <strong>' . esc_html( $date_label ) . '</strong>.</p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver estado',
        ),
        'in_transit' => array(
            'subject'   => 'Tu caja está en camino',
            'heading'   => '¡En camino!',
            'body'      => '<p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> ya salió a entrega. Revisá el horario estimado en tu dashboard.</p>',
            'cta_url'   => $account_url,
            'cta_label' => 'Ver horario estimado',
        ),
        'delivered'  => array(
            'subject'   => 'Tu caja N.° ' . $week_number . ' fue entregada',
            'heading'   => '¡Entregada! Buen provecho.',
            'body'      => '<p style="margin:0 0 16px;font-size:15px;color:#374151;line-height:1.65;">Tu caja N.° <strong>' . esc_html( $week_number ) . '</strong> llegó. Esperamos que disfrutes las recetas.</p>',
            'cta_url'   => '',
            'cta_label' => '',
        ),
    );

    $v = $variants[ $new_status ] ?? null;
    if ( ! $v ) return;

    $subscribers = get_users( array(
        'meta_query' => array(
            array( 'key' => 'ogape_setup_complete', 'value' => '1',        'compare' => '=' ),
            array( 'key' => 'ogape_zone_key',       'value' => $zone_key,  'compare' => '=' ),
        ),
        'fields' => array( 'ID', 'user_email', 'display_name', 'first_name' ),
        'number' => 500,
    ) );

    foreach ( $subscribers as $sub ) {
        if ( ! is_email( $sub->user_email ) ) continue;

        if ( in_array( $new_status, array( 'confirmed', 'preparing' ), true ) ) {
            if ( ! ogape_notif_pref( $sub->ID, 'ogape_notif_weekly_menu', true ) ) continue;
        }

        $first             = $sub->first_name ?: $sub->display_name;
        $personalised_body = '<p style="margin:0 0 12px;font-size:15px;color:#374151;">Hola <strong>' . esc_html( $first ) . '</strong>,</p>' . $v['body'];

        ogape_send_email(
            $sub->user_email,
            $v['subject'],
            $v['heading'],
            $personalised_body,
            $v['cta_url'],
            $v['cta_label']
        );
    }
}
add_action( 'ogape_zone_status_changed', 'ogape_send_zone_status_email', 10, 3 );
