<?php
/**
 * Template Name: Account
 * Template Post Type: page
 *
 * Mi cuenta — self-contained design from Website-handoff (3) bundle
 * (Claude Design export, 2026-04-24, website/project/mi-cuenta.html).
 * Theme chrome is hidden via assets/css/account-page.css so the page
 * renders the standalone design as intended — no theme overlay.
 */

get_header();

// ── DEMO STATE ─────────────────────────────────────────────────────
$demo_context          = function_exists( 'ogape_get_demo_account_context' ) ? ogape_get_demo_account_context() : array();
$demo_name             = $demo_context['name'] ?? 'María Benítez';
$demo_first_name       = $demo_context['first_name'] ?? 'María';
$demo_last_name        = $demo_context['last_name'] ?? 'Benítez';
$demo_initials         = $demo_context['initials'] ?? 'MB';
$demo_email            = $demo_context['email'] ?? 'maria@correo.com.py';
$demo_phone            = $demo_context['phone'] ?? '+595 981 000 000';
$demo_zone             = $demo_context['zone'] ?? 'Villa Morra';
$demo_zone_key         = $demo_context['zone_key'] ?? 'villa-morra';
$demo_address          = $demo_context['address'] ?? 'Av. Mcal. López 1234';
$demo_apt              = $demo_context['apt'] ?? '5B';
$demo_delivery_address = $demo_context['delivery_line_address'] ?? $demo_address;
$demo_window           = $demo_context['delivery_window'] ?? 'Tarde · 14:00 – 19:00';
$demo_pref             = $demo_context['preference'] ?? 'Sin preferencia cargada';
$demo_preferences      = $demo_context['preferences_label'] ?? 'Sin preferencias marcadas';
$demo_notes            = $demo_context['notes'] ?? '';
$demo_referral_code    = $demo_context['referral_code'] ?? 'MARIA-2026';
$demo_plan             = $demo_context['plan'] ?? array();
$demo_schedule         = $demo_context['schedule'] ?? array();
$demo_people           = $demo_plan['people'] ?? '2';
$demo_recipes          = $demo_plan['recipes'] ?? '3';
$demo_plan_label       = $demo_plan['label'] ?? 'Para 2 · 3 recetas';
$demo_price            = $demo_plan['price'] ?? 285000;
$demo_price_display    = $demo_plan['price_display'] ?? 'Gs 285.000';
$demo_price_plain      = number_format( (int) $demo_price, 0, ',', '.' );
$demo_iva_display      = ogape_demo_format_price( (int) round( $demo_price / 11 ) );
$delivery_label        = $demo_schedule['delivery_label'] ?? 'el próximo jueves';
$delivery_label_year   = $demo_schedule['delivery_label_with_year'] ?? $delivery_label;
$delivery_short_label  = $demo_schedule['delivery_short_label'] ?? 'Próximo jueves';
$delivery_numeric      = $demo_schedule['delivery_numeric'] ?? wp_date( 'd/m/Y' );
$next_label            = $demo_schedule['next_label'] ?? 'el jueves siguiente';
$next_label_year       = $demo_schedule['next_label_with_year'] ?? $next_label;
$resume_label          = $demo_schedule['resume_label'] ?? 'la semana siguiente';
$two_week_resume_label = $demo_schedule['two_week_resume_label'] ?? 'la siguiente entrega';
$cutoff_label          = $demo_schedule['cutoff_label'] ?? 'martes previo';
$cutoff_time           = $demo_schedule['cutoff_time'] ?? '23:59';
$logo_url = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$elegir_menu_url       = home_url( '/elegir-menu/' );

// Derive window key (am / pm / any) from the stored label for select default.
if ( false !== strpos( $demo_window, 'Mañana' ) || false !== strpos( $demo_window, 'mañana' ) ) {
    $demo_window_key = 'am';
} elseif ( false !== strpos( $demo_window, 'Tarde' ) || false !== strpos( $demo_window, 'tarde' ) ) {
    $demo_window_key = 'pm';
} else {
    $demo_window_key = 'any';
}

// ── LIVE CAJA STATE ────────────────────────────────────────────────────────
$caja_ctx    = function_exists( 'ogape_get_caja_context' ) ? ogape_get_caja_context( $demo_zone_key ) : null;
$caja_status = $caja_ctx ? $caja_ctx['status'] : 'in_transit';

// Map status string to a 0-based index: planning=0 confirmed=1 preparing=2 in_transit=3 delivered=4
$_status_order = array( 'planning', 'confirmed', 'preparing', 'in_transit', 'delivered' );
$_status_idx   = (int) array_search( $caja_status, $_status_order, true );

// Tracker step classes (is-done / is-current / '')
$step1_class = $_status_idx >= 2 ? 'is-done' : ( 1 === $_status_idx ? 'is-current' : '' );
$step2_class = $_status_idx >= 3 ? 'is-done' : ( 2 === $_status_idx ? 'is-current' : '' );
$step3_class = $_status_idx >= 4 ? 'is-done' : ( 3 === $_status_idx ? 'is-current' : '' );
$step4_class = $_status_idx >= 4 ? 'is-done' : '';

// Delivery card headline
$card_title = array(
    'planning'   => 'Caja confirmada · entrega el ' . ( $caja_ctx ? $caja_ctx['delivery_label'] : $delivery_label ),
    'confirmed'  => 'Caja confirmada · entrega el ' . ( $caja_ctx ? $caja_ctx['delivery_label'] : $delivery_label ),
    'preparing'  => 'Preparando tu caja',
    'in_transit' => 'En camino a ' . $demo_zone,
    'delivered'  => 'Entregada en ' . $demo_zone,
)[ $caja_status ] ?? 'En camino a ' . $demo_zone;

// Delivery card sub-line
$_card_date = $caja_ctx && $caja_ctx['delivery_label'] ? $caja_ctx['delivery_label'] : $delivery_label;
$card_sub   = array(
    'planning'   => 'Tu caja está programada. El cierre de pedidos es el ' . $cutoff_label . '.',
    'confirmed'  => 'Tu caja está confirmada. El cierre de pedidos es el ' . $cutoff_label . '.',
    'preparing'  => 'Estamos preparando los ingredientes. Sale el ' . $_card_date . '.',
    'in_transit' => 'Entrega estimada: ' . ucfirst( $_card_date ),
    'delivered'  => 'Entregada el ' . $_card_date . '. ¡Gracias por elegir Ogape!',
)[ $caja_status ] ?? 'Entrega estimada: ' . ucfirst( $_card_date );

// Badge
$card_badge = array(
    'planning'   => 'Planificando',
    'confirmed'  => 'Confirmada',
    'preparing'  => 'Preparando',
    'in_transit' => 'En tránsito',
    'delivered'  => 'Entregada',
)[ $caja_status ] ?? 'En proceso';

// ETA: use zone-specific eta if set, else extract time range from window label
$card_eta = $caja_ctx && $caja_ctx['eta'] ? $caja_ctx['eta'] : '';
if ( ! $card_eta && preg_match( '/\d{2}:\d{2}\s*[–\-]\s*\d{2}:\d{2}/', $demo_window, $_m ) ) {
    $card_eta = $_m[0];
}

// Week number from live caja (falls back to '01')
$card_week_number = $caja_ctx ? $caja_ctx['week_number'] : '01';

// Delivery numeric date for invoice/history (prefer live caja date)
if ( $caja_ctx && $caja_ctx['delivery_numeric'] ) {
    $delivery_numeric      = $caja_ctx['delivery_numeric'];
    $delivery_label_year   = $caja_ctx['delivery_label_year'];
    $delivery_label        = $caja_ctx['delivery_label'];
    $delivery_short_label  = $caja_ctx['delivery_label'];
}

// Notification preferences
$notif_weekly_menu = $demo_context['notif_weekly_menu'] ?? true;
$notif_whatsapp    = $demo_context['notif_whatsapp'] ?? true;
$notif_cutoff      = $demo_context['notif_cutoff'] ?? true;
$notif_promo       = $demo_context['notif_promo'] ?? false;

// Selected recipes for the current delivery week.
$current_week_key = '';
if ( $caja_ctx && ! empty( $caja_ctx['delivery_dt'] ) && $caja_ctx['delivery_dt'] instanceof DateTimeImmutable ) {
    $current_week_key = $caja_ctx['delivery_dt']->format( 'Ymd' );
} elseif ( isset( $demo_schedule['delivery'] ) && $demo_schedule['delivery'] instanceof DateTimeImmutable ) {
    $current_week_key = $demo_schedule['delivery']->format( 'Ymd' );
}

$selected_recipe_limit = max( 1, (int) $demo_recipes );
$selected_recipes      = function_exists( 'ogape_get_account_selected_menu_recipes' )
    ? ogape_get_account_selected_menu_recipes( get_current_user_id(), $current_week_key, $selected_recipe_limit )
    : array();

// Post-flow messages
$demo_message = '';
if ( isset( $_GET['demo'] ) ) {
    $demo_value = sanitize_text_field( wp_unslash( $_GET['demo'] ) );
    if ( 'login' === $demo_value ) {
        $demo_message = __( 'Inicio de sesión completado. Ya estás dentro del dashboard.', 'ogape-child' );
    } elseif ( 'register' === $demo_value ) {
        $demo_message = __( 'Registro completado. El dashboard está listo para revisar el recorrido completo.', 'ogape-child' );
    }
}
if ( isset( $_GET['setup'] ) ) {
    $demo_message = __( 'Configuración inicial completada. El dashboard queda listo para seguir probando.', 'ogape-child' );
}
?>

<!-- NAV -->
<header class="nav">
  <div class="wrap nav__inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__brand" aria-label="Ogape inicio">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="">
      <span>
        <span class="wordmark">Ogape</span>
        <span class="where">Tu Chef en Casa</span>
      </span>
    </a>

    <nav aria-label="Secciones">
      <ul class="nav__tabs">
        <li><a href="<?php echo esc_url( home_url( '/account/' ) ); ?>" class="is-active">Mi caja</a></li>
        <li><a href="#historial">Historial</a></li>
        <li><a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>">Menú semanal</a></li>
        <li><a href="#configuracion">Mi cuenta</a></li>
      </ul>
    </nav>

    <div class="nav__user">
      <button class="nav__notif" aria-label="Notificaciones">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        <span class="badge"></span>
      </button>
      <button class="avatar-btn" id="avatarBtn" aria-haspopup="true" aria-expanded="false">
        <span class="avatar"><?php echo esc_html( $demo_initials ); ?></span>
        <span class="name"><?php echo esc_html( $demo_first_name ); ?></span>
        <svg class="chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l4 4 4-4"/></svg>
      </button>

      <div class="user-menu" id="userMenu" role="menu">
        <div class="user-menu__head">
          <div class="uname"><?php echo esc_html( $demo_name ); ?></div>
          <div class="email"><?php echo esc_html( $demo_email ); ?></div>
        </div>
        <button class="umenu-item" role="menuitem">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          Mi perfil
        </button>
        <button class="umenu-item" role="menuitem">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
          Facturación
        </button>
        <button class="umenu-item" role="menuitem">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
          Mis estadísticas
        </button>
        <div class="umenu-sep"></div>
        <button class="umenu-item is-danger" role="menuitem">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Cerrar sesión
        </button>
      </div>
    </div>
  </div>
</header>

<?php if ( $demo_message ) : ?>
<div class="account-demo-banner"><?php echo esc_html( $demo_message ); ?></div>
<?php endif; ?>

<main class="page">
  <div class="wrap">

    <!-- GREETING -->
    <div class="page__header">
      <div class="greeting">
        <div class="greeting__text">
	          <div class="greeting__eyebrow"><span class="dot"></span><?php echo esc_html( $delivery_short_label ); ?> · Semana piloto</div>
	          <h1 class="greeting__h">Buenos días, <em><?php echo esc_html( $demo_first_name ); ?></em>.</h1>
	          <p class="greeting__sub">Tu caja está en camino. Llegá temprano a casa — el repartidor pasa por <?php echo esc_html( $demo_zone ); ?> antes del mediodía.</p>
        </div>
        <div class="greeting__actions">
          <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn btn--outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>
            Ver menú
          </a>
        </div>
      </div>
    </div>

    <div class="page__grid">

      <!-- ─── MAIN COLUMN ─── -->
      <div style="display:flex;flex-direction:column;gap:var(--space-5)">

        <!-- DELIVERY TRACKING -->
        <div class="card delivery-card">
          <div class="delivery-header">
            <div>
              <div class="card__eyebrow"><span class="dot"></span>Caja N.º <?php echo esc_html( $card_week_number ); ?></div>
              <h2 class="card__h"><?php echo esc_html( $card_title ); ?></h2>
              <p class="card__sub"><?php echo esc_html( $card_sub ); ?></p>
            </div>
            <span class="delivery-badge"><?php if ( 'in_transit' === $caja_status ) : ?><span class="pulse"></span><?php endif; ?><?php echo esc_html( $card_badge ); ?></span>
          </div>

          <div class="timeline" role="list" aria-label="Estado de entrega">
            <div class="tl-step <?php echo esc_attr( $step1_class ); ?>" role="listitem">
              <div class="tl-dot">
                <?php if ( 'is-done' === $step1_class ) : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                <?php else : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                <?php endif; ?>
              </div>
              <div class="tl-label">Pedido<br>confirmado</div>
            </div>
            <div class="tl-step <?php echo esc_attr( $step2_class ); ?>" role="listitem">
              <div class="tl-dot">
                <?php if ( 'is-done' === $step2_class ) : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                <?php else : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                <?php endif; ?>
              </div>
              <div class="tl-label">Ingredientes<br>preparados</div>
            </div>
            <div class="tl-step <?php echo esc_attr( $step3_class ); ?>" role="listitem">
              <div class="tl-dot">
                <?php if ( 'is-done' === $step3_class ) : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                <?php else : ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 4v4h-7V8Z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                <?php endif; ?>
              </div>
              <div class="tl-label">En<br>camino</div>
            </div>
            <div class="tl-step <?php echo esc_attr( $step4_class ); ?>" role="listitem">
              <div class="tl-dot">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              </div>
              <div class="tl-label">Entregada</div>
            </div>
          </div>

          <?php if ( 'in_transit' === $caja_status ) : ?>
          <div class="delivery-eta">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span class="text">
              <?php if ( $card_eta ) : ?>
                <b>Llegada estimada: <?php echo esc_html( $card_eta ); ?></b> ·
              <?php endif; ?>
              <?php echo esc_html( $demo_delivery_address ); ?> — te mandamos un WhatsApp cuando estemos a 15 min.
            </span>
          </div>
          <?php elseif ( 'delivered' !== $caja_status ) : ?>
          <div class="delivery-eta">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span class="text">Ventana de entrega: <b><?php echo esc_html( $demo_window ); ?></b> · <?php echo esc_html( $demo_delivery_address ); ?></span>
          </div>
          <?php endif; ?>

          <div class="delivery-actions">
            <a href="<?php echo esc_url( $elegir_menu_url ); ?>" class="btn btn--kraft btn--sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M3 17.25V21h3.75L17.8 9.94l-3.75-3.75L3 17.25Z"/><path d="m14.06 4.94 3.75 3.75"/><path d="M19 21H10"/></svg>
              Cambiar menú elegido
            </a>
          </div>
        </div>

        <!-- THIS WEEK'S RECIPES -->
        <div>
          <div class="section-label"><span class="dot"></span>Recetas elegidas de esta semana</div>
          <div class="recipes-grid">
            <?php foreach ( $selected_recipes as $recipe ) : ?>
              <?php
              $recipe_tags = ! empty( $recipe['tags'] ) && is_array( $recipe['tags'] ) ? $recipe['tags'] : array();
              $badge_label = '';
              $tag_label   = '';

              if ( ! empty( $recipe['isHero'] ) ) {
                  $badge_label = 'Plato estrella';
              } elseif ( ! empty( $recipe_tags[0]['label'] ) ) {
                  $badge_label = $recipe_tags[0]['label'];
              } elseif ( ! empty( $recipe['time'] ) ) {
                  $badge_label = $recipe['time'];
              }

              if ( ! empty( $recipe['isHero'] ) ) {
                  foreach ( $recipe_tags as $recipe_tag ) {
                      if ( empty( $recipe_tag['label'] ) || 'hero' === ( $recipe_tag['type'] ?? '' ) ) {
                          continue;
                      }
                      $tag_label = $recipe_tag['label'];
                      break;
                  }
              } elseif ( ! empty( $recipe_tags[1]['label'] ) ) {
                  $tag_label = $recipe_tags[1]['label'];
              } elseif ( ! empty( $recipe_tags[0]['label'] ) && $recipe_tags[0]['label'] !== $badge_label ) {
                  $tag_label = $recipe_tags[0]['label'];
              } elseif ( ! empty( $recipe['difficulty'] ) ) {
                  $tag_label = $recipe['difficulty'];
              }

              $recipe_name = $recipe['name'] ?? '';
              $photo_grad  = $recipe['photoGrad'] ?? 'linear-gradient(145deg,#d8dfe8 0%,#a6b4c6 100%)';
              ?>
              <article class="recipe-card">
                <div class="recipe-img recipe-img--placeholder" style="background: <?php echo esc_attr( $photo_grad ); ?>">
                  <?php if ( $badge_label ) : ?>
                    <span class="recipe-badge"><?php echo esc_html( $badge_label ); ?></span>
                  <?php endif; ?>
                  <button class="recipe-heart" type="button" aria-label="<?php echo esc_attr( sprintf( 'Guardar receta %s', $recipe_name ) ); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                  </button>
                  <span class="recipe-photo-note">Foto próximamente</span>
                </div>
                <div class="recipe-body">
                  <div class="name"><?php echo esc_html( $recipe_name ); ?></div>
                  <div class="meta">
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><?php echo esc_html( $recipe['time'] ?? '35 min' ); ?></span>
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg><?php echo esc_html( $demo_people . ' porciones' ); ?></span>
                  </div>
                  <?php if ( $tag_label ) : ?>
                    <span class="recipe-tag"><?php echo esc_html( $tag_label ); ?></span>
                  <?php endif; ?>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- NEXT WEEK -->
        <div id="proxima">
          <div class="section-label"><span class="dot"></span>Semana que viene</div>
          <div class="card next-week">
            <div class="next-week-inner">
              <div class="next-week-info">
                <div class="week-num">02</div>
                <h3>Caja N.º 02 · <?php echo esc_html( ucfirst( $next_label_year ) ); ?></h3>
                <p>Tu próxima entrega está programada. Cierre de pedidos: <?php echo esc_html( $cutoff_label ); ?> a las <?php echo esc_html( $cutoff_time ); ?>. Podés pausar, cambiar el tamaño o elegir recetas antes de esa hora.</p>
              </div>
              <div class="next-week-actions">
                <button class="btn btn--outline btn--sm">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                  Personalizar
                </button>
                <button class="btn btn--ghost btn--sm" id="pauseBtn">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                  Pausar semana
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- ORDER HISTORY -->
        <div id="historial">
          <div class="section-label"><span class="dot"></span>Historial de cajas</div>
          <div class="card" style="padding:var(--space-5) var(--space-6)">
            <div class="history-list">
              <div class="history-item" style="align-items:flex-start;flex-wrap:wrap;gap:var(--space-3)">
                <div class="history-num" style="padding-top:2px">02</div>
                <div class="history-info" style="flex:1;min-width:0">
                  <div class="date"><?php echo esc_html( ucfirst( $next_label_year ) ); ?></div>
                  <div class="plan">Para <?php echo esc_html( $demo_people ); ?> · <?php echo esc_html( $demo_recipes ); ?> recetas</div>
                  <div style="display:flex;align-items:center;gap:var(--space-3);flex-wrap:wrap;margin-top:.35rem">
                    <span style="display:inline-flex;align-items:center;gap:.3rem;font-size:11px;font-weight:600;padding:2px 8px;border-radius:var(--radius-pill);background:#E8F5E9;color:#2E7D32">
                      <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                      Entregada
                    </span>
                    <button class="open-factura" data-num="02" data-date="<?php echo esc_attr( $next_label_year ); ?>" data-desc="Caja N.º 02 · Para <?php echo esc_attr( $demo_people ); ?> · <?php echo esc_attr( $demo_recipes ); ?> recetas" data-amount="<?php echo esc_attr( $demo_price_plain ); ?>" style="display:inline-flex;align-items:center;gap:.4rem;font-size:12px;font-weight:600;color:var(--brand-primary-strong);background:none;border:none;padding:0;cursor:pointer;border-bottom:1px solid rgba(154,90,8,.3);white-space:nowrap">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                      Ver factura
                    </button>
                  </div>
                </div>
                <div style="text-align:right;flex-shrink:0">
                  <div class="history-price" style="white-space:nowrap"><?php echo esc_html( $demo_price_display ); ?></div>
                </div>
              </div>
              <div class="history-item" style="align-items:flex-start;flex-wrap:wrap;gap:var(--space-3)">
                <div class="history-num" style="padding-top:2px">01</div>
                <div class="history-info" style="flex:1;min-width:180px">
                  <div class="date"><?php echo esc_html( ucfirst( $delivery_label_year ) ); ?></div>
                  <div class="plan">Para <?php echo esc_html( $demo_people ); ?> · <?php echo esc_html( $demo_recipes ); ?> recetas</div>
                  <span class="history-info .status status--delivered" style="display:inline-flex;align-items:center;gap:.3rem;font-size:11px;font-weight:600;padding:2px 8px;border-radius:var(--radius-pill);margin-top:.3rem;background:#FFF8E1;color:#8A6308">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    En camino
                  </span>
                  <!-- Factura generating notice -->
                  <div class="factura-notice">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="13" height="13" style="flex:none;margin-top:1px"><path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10"/><path d="M12 6v6l4 2"/><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0-6 0"/><path d="M21 21l-1.5-1.5"/></svg>
                    <span>Tu factura se está generando. Puede tardar unos momentos en aparecer en tu historial.<br>Si no la ves dentro del día, podés <a href="#" onclick="return false" style="color:var(--brand-primary-strong);border-bottom:1px solid rgba(154,90,8,.3)">contactarnos</a>.</span>
                  </div>
                </div>
                <div style="text-align:right;flex-shrink:0">
                  <div class="history-price"><?php echo esc_html( $demo_price_display ); ?></div>
                </div>
              </div>
            </div>
            <p style="font-size:12.5px;color:var(--muted);margin-top:var(--space-4);text-align:center">Esta es tu primera caja. ¡Bienvenida a la mesa!</p>
          </div>
        </div>

      </div><!-- /main column -->

      <!-- ─── SIDEBAR ─── -->
      <aside class="sidebar" aria-label="Mi plan y cuenta">

        <!-- PLAN CARD -->
        <div class="card plan-card" aria-label="Mi suscripción">
          <div class="card__eyebrow"><span class="dot"></span>Mi plan activo</div>
          <div class="plan-title">Para <?php echo esc_html( $demo_people ); ?> · <em><?php echo esc_html( $demo_recipes ); ?> recetas</em></div>
          <div class="plan-price"><?php echo esc_html( $demo_price_display ); ?><small>/ sem</small></div>
          <div class="plan-details">
            <div class="plan-detail"><span class="k">Porciones</span><span class="v"><?php echo esc_html( $demo_people ); ?> personas</span></div>
            <div class="plan-detail"><span class="k">Recetas</span><span class="v"><?php echo esc_html( $demo_recipes ); ?> por semana</span></div>
            <div class="plan-detail"><span class="k">Entrega</span><span class="v">Jueves · tarde</span></div>
            <div class="plan-detail"><span class="k">Barrio</span><span class="v"><?php echo esc_html( $demo_zone ); ?></span></div>
          </div>
          <div class="plan-actions">
            <button class="btn btn--kraft btn--sm">Cambiar plan</button>
            <button class="btn btn--kraft btn--sm">Pausar</button>
          </div>
        </div>

        <!-- QUICK STATS -->
        <div class="card stats-card">
          <div class="card__eyebrow" style="margin-bottom:var(--space-4)"><span class="dot"></span>Mis números</div>
          <div class="stats-grid">
            <div class="stat">
              <div class="v">2</div>
              <div class="k">Cajas recibidas</div>
            </div>
            <div class="stat">
              <div class="v">3</div>
              <div class="k">Recetas esta semana</div>
            </div>
            <div class="stat">
              <div class="v">0</div>
              <div class="k">Semanas pausadas</div>
            </div>
            <div class="stat">
              <div class="v" style="font-size:22px;color:var(--brand-primary-strong)"><?php echo esc_html( $demo_zone ); ?></div>
              <div class="k">Zona de entrega</div>
            </div>
          </div>
        </div>

        <!-- REFERRAL -->
        <div class="card referral-card">
          <div class="card__eyebrow" style="color:var(--brand-accent);margin-bottom:.5rem"><span class="dot" style="background:var(--brand-accent)"></span>Invitá a un amigo</div>
          <h3 class="card__h" style="font-size:17px;margin-bottom:.4rem">Un mes, cada una cocina más rico.</h3>
          <p class="card__sub" style="font-size:12.5px">Compartí tu código y cuando tu amiga haga su primera caja, ambas reciben Gs 50.000 de descuento.</p>
          <div class="referral-code">
            <span class="code" id="refCode"><?php echo esc_html( $demo_referral_code ); ?></span>
            <button class="copy-btn" id="copyBtn">Copiar</button>
          </div>
          <p class="referral-note">El descuento se aplica automáticamente en la siguiente semana.</p>
        </div>

        <!-- ACCOUNT SETTINGS SHORTCUT -->
        <div class="card" id="configuracion" style="padding:var(--space-5)">
          <div class="card__eyebrow" style="margin-bottom:var(--space-4)"><span class="dot"></span>Mi cuenta</div>
          <div style="display:flex;flex-direction:column;gap:.25rem">
            <button id="openPerfil" class="umenu-item" style="border-radius:var(--radius-md);text-align:left;width:100%">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              Editar perfil
            </button>
            <button id="openDireccion" class="umenu-item" style="border-radius:var(--radius-md);text-align:left;width:100%">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Cambiar dirección
            </button>
            <button id="openFacturacion" class="umenu-item" style="border-radius:var(--radius-md);text-align:left;width:100%">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
              Facturación y pagos
            </button>
            <button id="openNotifs" class="umenu-item" style="border-radius:var(--radius-md);text-align:left;width:100%">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
              Preferencias de notificación
            </button>
            <div style="height:1px;background:rgba(17,24,39,.06);margin:var(--space-2) 0"></div>
            <button id="openCancelar" class="umenu-item is-danger" style="border-radius:var(--radius-md);text-align:left;width:100%">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="15" height="15"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
              Cancelar suscripción
            </button>
          </div>
        </div>

      </aside>
    </div><!-- /page__grid -->

    <!-- FOOTER -->
    <footer class="foot">
      Ogape Tu Chef en Casa · Asunción, Paraguay ·
      <a href="#">Términos</a><a href="#">Privacidad</a><a href="#">WhatsApp</a>
    </footer>

  </div><!-- /wrap -->
</main>

<!-- ── EDITAR PERFIL ────────────────────────────────── -->
<div class="overlay" id="perfilOverlay" role="dialog" aria-modal="true" aria-labelledby="perfilModalH">
  <div class="modal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="perfilClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div id="perfilFormWrap">
      <div class="modal__head">
        <div class="modal__eyebrow"><span class="dot"></span>Mi perfil</div>
        <h2 class="modal__h" id="perfilModalH">Editar mis datos</h2>
        <p class="modal__sub">Los cambios se aplican de inmediato en tu cuenta.</p>
      </div>
      <form id="perfilForm" novalidate>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-4)">
          <div>
            <label class="modal-lbl" for="pfNombre">Nombre</label>
            <input class="modal-input" id="pfNombre" type="text" value="<?php echo esc_attr( $demo_first_name ); ?>" autocomplete="given-name">
          </div>
          <div>
            <label class="modal-lbl" for="pfApellido">Apellido</label>
            <input class="modal-input" id="pfApellido" type="text" value="<?php echo esc_attr( $demo_last_name ); ?>" autocomplete="family-name">
          </div>
        </div>
        <div style="margin-bottom:var(--space-4)">
          <label class="modal-lbl" for="pfEmail">Email</label>
          <input class="modal-input" id="pfEmail" type="email" value="<?php echo esc_attr( $demo_email ); ?>" autocomplete="email">
        </div>
        <div style="margin-bottom:var(--space-4)">
          <label class="modal-lbl" for="pfTel">Teléfono (WhatsApp)</label>
          <input class="modal-input" id="pfTel" type="tel" value="<?php echo esc_attr( $demo_phone ); ?>" autocomplete="tel">
        </div>
        <div style="margin-bottom:var(--space-6)">
          <label class="modal-lbl" for="pfPw">Nueva contraseña <span style="font-weight:400;letter-spacing:0;text-transform:none;font-size:11px;color:var(--muted)">(dejá vacío para no cambiar)</span></label>
          <div style="position:relative">
            <input class="modal-input" id="pfPw" type="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" style="padding-right:48px">
            <button type="button" id="pfPwToggle" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);width:36px;height:36px;border:none;background:transparent;color:var(--muted);display:grid;place-items:center;border-radius:var(--radius-md);cursor:pointer">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" width="17" height="17"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
        <div class="modal__footer">
          <button type="button" class="btn btn--ghost" id="perfilCancelBtn">Cancelar</button>
          <span class="spacer"></span>
          <button type="submit" class="btn btn--primary">Guardar cambios</button>
        </div>
      </form>
    </div>
    <div class="modal-success" id="perfilSuccess">
      <div class="stamp stamp--warm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="30" height="30"><path d="M5 12l4 4L19 7"/></svg>
      </div>
      <h3>¡Perfil actualizado!</h3>
      <p></p>
      <button class="btn btn--outline" id="perfilDoneBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── CAMBIAR DIRECCIÓN ──────────────────────────── -->
<div class="overlay" id="direccionOverlay" role="dialog" aria-modal="true" aria-labelledby="dirModalH">
  <div class="modal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="dirClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div id="dirFormWrap">
      <div class="modal__head">
        <div class="modal__eyebrow"><span class="dot"></span>Dirección de entrega</div>
        <h2 class="modal__h" id="dirModalH">¿Dónde te dejamos la caja?</h2>
        <p class="modal__sub">Aplica desde tu próxima entrega. Los jueves entre 10:00 y 19:00.</p>
      </div>
      <form id="dirForm" novalidate>
        <div style="margin-bottom:var(--space-4)">
          <label class="modal-lbl" for="dirZone">Barrio</label>
          <select class="modal-input modal-select" id="dirZone">
            <optgroup label="Zonas activas">
              <option value="villa-morra"<?php selected( $demo_zone_key, 'villa-morra' ); ?>>Villa Morra</option>
              <option value="recoleta"<?php selected( $demo_zone_key, 'recoleta' ); ?>>Recoleta</option>
              <option value="las-carmelitas"<?php selected( $demo_zone_key, 'las-carmelitas' ); ?>>Las Carmelitas</option>
              <option value="mburucuya"<?php selected( $demo_zone_key, 'mburucuya' ); ?>>Mburucuyá</option>
              <option value="ykua-sati"<?php selected( $demo_zone_key, 'ykua-sati' ); ?>>Ykua Satí</option>
              <option value="centro"<?php selected( $demo_zone_key, 'centro' ); ?>>Centro</option>
            </optgroup>
            <optgroup label="Próximamente">
              <option value="san-lorenzo" data-soon="1"<?php selected( $demo_zone_key, 'san-lorenzo' ); ?>>San Lorenzo</option>
              <option value="lambare" data-soon="1"<?php selected( $demo_zone_key, 'lambare' ); ?>>Lambaré</option>
            </optgroup>
          </select>
          <div id="dirZoneAlert" style="margin-top:var(--space-3)"></div>
        </div>
        <div style="margin-bottom:var(--space-4)">
          <label class="modal-lbl" for="dirAddress">Dirección</label>
          <input class="modal-input" id="dirAddress" type="text" value="<?php echo esc_attr( $demo_address ); ?>" autocomplete="street-address">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-4)">
          <div>
            <label class="modal-lbl" for="dirApt">Depto / Piso</label>
            <input class="modal-input" id="dirApt" type="text" value="<?php echo esc_attr( $demo_apt ); ?>">
          </div>
          <div>
            <label class="modal-lbl" for="dirWindow">Horario preferido</label>
            <select class="modal-input modal-select" id="dirWindow">
              <option value="am"<?php selected( $demo_window_key, 'am' ); ?>>Mañana · 10:00 – 13:00</option>
              <option value="pm"<?php selected( $demo_window_key, 'pm' ); ?>>Tarde · 14:00 – 19:00</option>
              <option value="any"<?php selected( $demo_window_key, 'any' ); ?>>Cualquier horario</option>
            </select>
          </div>
        </div>
        <div style="margin-bottom:var(--space-6)">
          <label class="modal-lbl" for="dirNotes">Instrucciones para el repartidor</label>
          <input class="modal-input" id="dirNotes" type="text" placeholder="Timbre roto — llamar al WhatsApp al llegar" value="<?php echo esc_attr( $demo_notes ); ?>">
        </div>
        <div class="modal__footer">
          <button type="button" class="btn btn--ghost" id="dirCancelBtn">Cancelar</button>
          <span class="spacer"></span>
          <button type="submit" class="btn btn--primary">Guardar dirección</button>
        </div>
      </form>
    </div>
    <div class="modal-success" id="dirSuccess">
      <div class="stamp stamp--warm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="30" height="30"><path d="M5 12l4 4L19 7"/></svg>
      </div>
      <h3>¡Dirección actualizada!</h3>
      <p></p>
      <button class="btn btn--outline" id="dirDoneBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── FACTURACIÓN ────────────────────────────────── -->
<div class="overlay" id="facturacionOverlay" role="dialog" aria-modal="true" aria-labelledby="factModalH">
  <div class="modal" style="max-width:560px">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="factClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div class="modal__head">
      <div class="modal__eyebrow"><span class="dot"></span>Facturación</div>
      <h2 class="modal__h" id="factModalH">Pagos y método de cobro</h2>
      <p class="modal__sub">El cobro se realiza cada jueves que sale tu caja. Nunca antes.</p>
    </div>
    <!-- Payment method -->
    <div style="display:flex;align-items:center;gap:var(--space-4);padding:var(--space-4) var(--space-5);background:#F9FAFB;border:1.5px solid rgba(17,24,39,.1);border-radius:var(--radius-xl);margin-bottom:var(--space-5)">
      <div style="width:48px;height:32px;background:linear-gradient(135deg,#1a1f71,#0070d2);border-radius:6px;display:grid;place-items:center;flex:none">
        <svg viewBox="0 0 36 24" width="30" fill="none"><rect width="36" height="24" rx="4" fill="none"/><circle cx="14" cy="12" r="7" fill="#EB001B" opacity=".9"/><circle cx="22" cy="12" r="7" fill="#F79E1B" opacity=".9"/><path d="M18 6.8a7 7 0 0 1 0 10.4A7 7 0 0 1 18 6.8Z" fill="#FF5F00"/></svg>
      </div>
      <div style="flex:1">
        <div style="font-size:14px;font-weight:600;color:var(--text-primary)">Mastercard ···· 4821</div>
        <div style="font-size:12px;color:var(--muted)">Vence 09/28 · Principal</div>
      </div>
      <span style="font-size:11px;font-weight:600;padding:3px 10px;background:#E8F5E9;color:#2E7D32;border-radius:var(--radius-pill)">Activa</span>
    </div>
    <button class="btn btn--outline btn--sm" style="margin-bottom:var(--space-6);width:100%;justify-content:center">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M12 5v14M5 12h14"/></svg>
      Agregar método de pago
    </button>
    <!-- History -->
    <p style="font-size:10.5px;letter-spacing:.18em;text-transform:uppercase;font-weight:600;color:var(--muted);margin-bottom:var(--space-3)">Historial de cobros</p>
    <div style="border:1px solid rgba(17,24,39,.08);border-radius:var(--radius-xl);overflow:hidden;margin-bottom:var(--space-6)">
      <table style="width:100%;border-collapse:collapse;font-size:13.5px">
        <thead>
          <tr style="background:#F9FAFB;border-bottom:1px solid rgba(17,24,39,.08)">
            <th style="padding:10px 16px;text-align:left;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);font-weight:600">Fecha</th>
            <th style="padding:10px 16px;text-align:left;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);font-weight:600">Descripción</th>
            <th style="padding:10px 16px;text-align:right;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);font-weight:600">Monto</th>
            <th style="padding:10px 16px;text-align:right;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);font-weight:600">Estado</th>
            <th style="padding:10px 16px;text-align:right;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);font-weight:600">Factura</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid rgba(17,24,39,.06)">
            <td style="padding:12px 16px;color:var(--text-secondary)"><?php echo esc_html( $delivery_numeric ); ?></td>
            <td style="padding:12px 16px;color:var(--text-primary);font-weight:500">Caja N.º 01 · Para <?php echo esc_html( $demo_people ); ?> · <?php echo esc_html( $demo_recipes ); ?> recetas</td>
            <td style="padding:12px 16px;text-align:right;font-family:var(--font-display);font-size:15px;font-weight:500"><?php echo esc_html( $demo_price_display ); ?></td>
            <td style="padding:12px 16px;text-align:right"><span style="font-size:11px;font-weight:600;padding:3px 9px;background:#E8F5E9;color:#2E7D32;border-radius:var(--radius-pill)">Cobrado</span></td>
            <td style="padding:12px 16px;text-align:right">
              <button class="btn btn--outline btn--sm open-factura" data-num="01" data-date="<?php echo esc_attr( $delivery_label_year ); ?>" data-desc="Caja N.º 01 · Para <?php echo esc_attr( $demo_people ); ?> · <?php echo esc_attr( $demo_recipes ); ?> recetas" data-amount="<?php echo esc_attr( $demo_price_plain ); ?>" style="font-size:12px;height:32px;padding:0 12px;gap:.35rem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Ver factura
              </button>
            </td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:var(--muted);font-style:italic" colspan="5">No hay cobros anteriores — esta es tu primera caja.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="modal__footer" style="border-top:none;padding-top:0">
      <span class="spacer"></span>
      <button class="btn btn--outline" id="factCloseBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── NOTIFICACIONES ─────────────────────────────── -->
<div class="overlay" id="notifsOverlay" role="dialog" aria-modal="true" aria-labelledby="notifsModalH">
  <div class="modal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="notifsClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div id="notifsFormWrap">
      <div class="modal__head">
        <div class="modal__eyebrow"><span class="dot"></span>Notificaciones</div>
        <h2 class="modal__h" id="notifsModalH">¿Cuándo querés que te avisemos?</h2>
        <p class="modal__sub">Solo te contactamos cuando hay algo que realmente importa.</p>
      </div>
      <form id="notifsForm">
        <div style="display:flex;flex-direction:column;gap:0;border:1px solid rgba(17,24,39,.08);border-radius:var(--radius-xl);overflow:hidden;margin-bottom:var(--space-6)">
          <div class="toggle-row">
            <div class="toggle-info">
              <div class="toggle-title">Menú semanal por email</div>
              <div class="toggle-desc">El viernes a la mañana, las recetas de la semana que viene.</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="notifWeeklyMenu" name="notif_weekly_menu"<?php checked( $notif_weekly_menu, true ); ?>>
              <span class="toggle-track"><span class="toggle-thumb"></span></span>
            </label>
            <span class="toggle-val" id="notifWeeklyMenuVal"><?php echo $notif_weekly_menu ? 'Activado' : 'Desactivado'; ?></span>
          </div>
          <div class="toggle-row" style="border-top:1px solid rgba(17,24,39,.06)">
            <div class="toggle-info">
              <div class="toggle-title">Aviso de entrega por WhatsApp</div>
              <div class="toggle-desc">Te mandamos el tracking el jueves cuando salimos.</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="notifWhatsapp" name="notif_whatsapp"<?php checked( $notif_whatsapp, true ); ?>>
              <span class="toggle-track"><span class="toggle-thumb"></span></span>
            </label>
            <span class="toggle-val" id="notifWhatsappVal"><?php echo $notif_whatsapp ? 'Activado' : 'Desactivado'; ?></span>
          </div>
          <div class="toggle-row" style="border-top:1px solid rgba(17,24,39,.06)">
            <div class="toggle-info">
              <div class="toggle-title">Recordatorio de cierre de pedidos</div>
              <div class="toggle-desc">El martes a las 20:00, antes de que cierre a las 23:59.</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="notifCutoff" name="notif_cutoff"<?php checked( $notif_cutoff, true ); ?>>
              <span class="toggle-track"><span class="toggle-thumb"></span></span>
            </label>
            <span class="toggle-val" id="notifCutoffVal"><?php echo $notif_cutoff ? 'Activado' : 'Desactivado'; ?></span>
          </div>
          <div class="toggle-row" style="border-top:1px solid rgba(17,24,39,.06)">
            <div class="toggle-info">
              <div class="toggle-title">Novedades y promociones</div>
              <div class="toggle-desc">Nuevos productores, recetas especiales, eventos.</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="notifPromo" name="notif_promo"<?php checked( $notif_promo, true ); ?>>
              <span class="toggle-track"><span class="toggle-thumb"></span></span>
            </label>
            <span class="toggle-val" id="notifPromoVal"><?php echo $notif_promo ? 'Activado' : 'Desactivado'; ?></span>
          </div>
        </div>
        <div class="modal__footer">
          <button type="button" class="btn btn--ghost" id="notifsCancelBtn">Cancelar</button>
          <span class="spacer"></span>
          <button type="submit" class="btn btn--primary">Guardar preferencias</button>
        </div>
      </form>
    </div>
    <div class="modal-success" id="notifsSuccess">
      <div class="stamp stamp--warm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="30" height="30"><path d="M5 12l4 4L19 7"/></svg>
      </div>
      <h3>Preferencias guardadas</h3>
      <p></p>
      <button class="btn btn--outline" id="notifsDoneBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── CANCELAR SUSCRIPCIÓN ───────────────────────── -->
<div class="overlay" id="cancelarOverlay" role="dialog" aria-modal="true" aria-labelledby="cancelModalH">
  <div class="modal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="cancelClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div id="cancelarFormWrap">
      <div class="modal__head">
        <div class="modal__eyebrow" style="color:#C62828"><span class="dot" style="background:#C62828"></span>Cancelar suscripción</div>
        <h2 class="modal__h" id="cancelModalH">¿Segura que querés irse?</h2>
        <p class="modal__sub">Antes de cancelar, recordá que podés <b style="color:var(--text-primary)">pausar indefinidamente</b> sin perder tu historial ni tus preferencias.</p>
      </div>
      <!-- Reasons -->
      <p style="font-size:11px;letter-spacing:.16em;text-transform:uppercase;font-weight:600;color:var(--muted);margin-bottom:var(--space-3)">¿Por qué cancelás?</p>
      <div style="display:flex;flex-direction:column;gap:var(--space-2);margin-bottom:var(--space-5)">
        <label class="pause-opt"><input type="radio" name="cancelReason" value="precio"><span class="pause-opt__dot"></span><div class="pause-opt__info"><div class="pause-opt__title">El precio es muy alto</div></div></label>
        <label class="pause-opt"><input type="radio" name="cancelReason" value="tiempo"><span class="pause-opt__dot"></span><div class="pause-opt__info"><div class="pause-opt__title">No tengo tiempo para cocinar</div></div></label>
        <label class="pause-opt"><input type="radio" name="cancelReason" value="recetas"><span class="pause-opt__dot"></span><div class="pause-opt__info"><div class="pause-opt__title">Las recetas no se ajustan a mis gustos</div></div></label>
        <label class="pause-opt"><input type="radio" name="cancelReason" value="zona"><span class="pause-opt__dot"></span><div class="pause-opt__info"><div class="pause-opt__title">Me mudé fuera de la zona de entrega</div></div></label>
        <label class="pause-opt"><input type="radio" name="cancelReason" value="otro"><span class="pause-opt__dot"></span><div class="pause-opt__info"><div class="pause-opt__title">Otro motivo</div></div></label>
      </div>
      <!-- Pause suggestion -->
      <div class="pause-note" style="margin-bottom:var(--space-5)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
        <p>Si el motivo es precio o tiempo, <b>pausar indefinidamente</b> conserva todo sin costo. Podés reactivar cuando quieras.</p>
      </div>
      <!-- Confirm typing -->
      <div style="margin-bottom:var(--space-6)">
        <label class="modal-lbl" for="cancelConfirmText">Para confirmar, escribí <b style="font-family:var(--font-mono);background:#FEF2F2;padding:1px 6px;border-radius:4px;color:#C62828;letter-spacing:.04em">cancelar</b> acá abajo</label>
        <input class="modal-input" id="cancelConfirmText" type="text" placeholder="cancelar" autocomplete="off" style="border-color:rgba(198,40,40,.25)">
      </div>
      <div class="modal__footer">
        <button type="button" class="btn btn--warm" id="cancelKeepBtn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Mejor me quedo
        </button>
        <span class="spacer"></span>
        <button type="button" class="btn btn--ghost" id="cancelConfirmBtn" disabled style="color:#C62828;opacity:.45">Cancelar suscripción</button>
      </div>
    </div>
    <div class="modal-success" id="cancelarSuccess">
      <div class="stamp" style="background:#FEF2F2;border:2px solid rgba(198,40,40,.2);color:#C62828;width:72px;height:72px;border-radius:50%;margin:0 auto var(--space-4);display:grid;place-items:center">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="28" height="28"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </div>
      <h3>Suscripción cancelada</h3>
      <p></p>
      <button class="btn btn--outline" id="cancelDoneBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── CAMBIAR PLAN MODAL ────────────────────────────── -->
<div class="overlay" id="planOverlay" role="dialog" aria-modal="true" aria-labelledby="planModalH">
  <div class="modal" id="planModal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="planClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>

    <!-- Form state -->
    <div id="planForm">
      <div class="modal__head">
        <div class="modal__eyebrow"><span class="dot"></span>Cambiar mi plan</div>
        <h2 class="modal__h" id="planModalH">¿Para cuántas personas?</h2>
        <p class="modal__sub">El cambio aplica desde tu próxima caja. Podés volver a cambiar cuando quieras.</p>
      </div>

      <div class="plan-opts" id="peopleOpts">
        <label class="plan-opt is-checked" data-group="mp" data-val="2">
          <input type="radio" name="mp" value="2" checked>
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Para 2</span>
          <span class="plan-opt__n">Pareja</span>
          <span class="plan-opt__p">2 porciones por receta</span>
        </label>
        <label class="plan-opt" data-group="mp" data-val="4">
          <input type="radio" name="mp" value="4">
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Para 4</span>
          <span class="plan-opt__n">Familia</span>
          <span class="plan-opt__p">4 porciones por receta</span>
        </label>
      </div>

      <p style="font-size:11px;letter-spacing:.18em;text-transform:uppercase;font-weight:600;color:var(--muted);margin-bottom:var(--space-3)">¿Cuántas recetas por semana?</p>
      <div class="plan-opts" style="grid-template-columns:repeat(4,1fr);gap:var(--space-2)" id="recipesOpts">
        <label class="plan-opt" data-group="mr" data-val="2" style="padding:var(--space-3) var(--space-3)">
          <input type="radio" name="mr" value="2">
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Cata</span>
          <span class="plan-opt__n">2</span>
          <span class="plan-opt__p">recetas</span>
        </label>
        <label class="plan-opt is-checked" data-group="mr" data-val="3" style="padding:var(--space-3) var(--space-3)">
          <input type="radio" name="mr" value="3" checked>
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Ligero</span>
          <span class="plan-opt__n">3</span>
          <span class="plan-opt__p">recetas</span>
        </label>
        <label class="plan-opt" data-group="mr" data-val="4" style="padding:var(--space-3) var(--space-3)">
          <input type="radio" name="mr" value="4">
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Intermedio</span>
          <span class="plan-opt__n">4</span>
          <span class="plan-opt__p">recetas</span>
        </label>
        <label class="plan-opt" data-group="mr" data-val="5" style="padding:var(--space-3) var(--space-3)">
          <input type="radio" name="mr" value="5">
          <span class="plan-opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
          <span class="plan-opt__k">Completa</span>
          <span class="plan-opt__n">5</span>
          <span class="plan-opt__p">recetas</span>
        </label>
      </div>

      <div class="price-preview">
        <div class="label">Tu nuevo plan<b id="planPreviewLabel"><?php echo esc_html( $demo_plan_label ); ?></b></div>
        <div class="amount" id="planPreviewPrice"><?php echo esc_html( $demo_price_display ); ?><small>/ sem</small></div>
      </div>

      <div class="modal__footer">
        <button class="btn btn--ghost" id="planCancelBtn">Cancelar</button>
        <span class="spacer"></span>
        <button class="btn btn--warm" id="planConfirmBtn">
          Confirmar cambio
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8h8m-3-3l3 3-3 3"/></svg>
        </button>
      </div>
    </div>

    <!-- Success state -->
    <div class="modal-success" id="planSuccess">
      <div class="stamp stamp--warm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="32" height="32"><path d="M5 12l4 4L19 7"/></svg>
      </div>
      <h3>¡Plan actualizado!</h3>
      <p id="planSuccessMsg">Tu próxima caja llegará con el nuevo plan.</p>
      <button class="btn btn--outline" id="planDoneBtn">Cerrar</button>
    </div>
  </div>
</div>

<!-- ── PAUSAR MODAL ───────────────────────────────────── -->
<div class="overlay" id="pauseOverlay" role="dialog" aria-modal="true" aria-labelledby="pauseModalH">
  <div class="modal" id="pauseModal">
    <span class="modal__drag" aria-hidden="true"></span>
    <button class="modal__close" id="pauseClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>

    <!-- Form state -->
    <div id="pauseForm">
      <div class="modal__head">
        <div class="modal__eyebrow"><span class="dot"></span>Pausar entrega</div>
        <h2 class="modal__h" id="pauseModalH">¿Cuándo querés pausar?</h2>
        <p class="modal__sub">Sin cargo ni penalidad. Reanudás cuando quieras desde acá mismo.</p>
      </div>

      <div class="pause-opts" id="pauseOpts">
        <label class="pause-opt is-checked">
          <input type="radio" name="pauseWhen" value="next" checked>
          <span class="pause-opt__dot"></span>
          <div class="pause-opt__info">
            <div class="pause-opt__title">Próxima entrega — <?php echo esc_html( ucfirst( $next_label_year ) ); ?></div>
            <div class="pause-opt__sub">Saltamos esa semana y retomás <?php echo esc_html( $resume_label ); ?>. No se te cobra nada.</div>
          </div>
        </label>
        <label class="pause-opt">
          <input type="radio" name="pauseWhen" value="two">
          <span class="pause-opt__dot"></span>
          <div class="pause-opt__info">
            <div class="pause-opt__title">Dos semanas — <?php echo esc_html( $two_week_resume_label ); ?></div>
            <div class="pause-opt__sub">Pausamos las próximas dos semanas. Volvés <?php echo esc_html( $two_week_resume_label ); ?>.</div>
          </div>
        </label>
        <label class="pause-opt">
          <input type="radio" name="pauseWhen" value="indefinite">
          <span class="pause-opt__dot"></span>
          <div class="pause-opt__info">
            <div class="pause-opt__title">Pausar indefinidamente</div>
            <div class="pause-opt__sub">No recibís cajas hasta que vos lo reactives. Reactivás desde acá con un clic.</div>
          </div>
        </label>
      </div>

      <div class="pause-note">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
        <p>El cierre de pedidos para la caja N.º 02 es el <b>martes 29 de abril a las 23:59</b>. Podés pausar hasta ese momento.</p>
      </div>

      <div class="modal__footer">
        <button class="btn btn--ghost" id="pauseCancelBtn">Cancelar</button>
        <span class="spacer"></span>
        <button class="btn btn--primary" id="pauseConfirmBtn">
          Confirmar pausa
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="3" height="10" rx="1"/><rect x="9" y="3" width="3" height="10" rx="1"/></svg>
        </button>
      </div>
    </div>

    <!-- Success state -->
    <div class="modal-success" id="pauseSuccess">
      <div class="stamp stamp--pause">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" width="28" height="28"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
      </div>
      <h3>Entrega pausada</h3>
      <p id="pauseSuccessMsg">No recibís caja <?php echo esc_html( $next_label ); ?>. Podés reanudar en cualquier momento.</p>
      <button class="btn btn--outline" id="pauseDoneBtn">Entendido</button>
    </div>
  </div>
</div>

<!-- ── FACTURA VIEWER ─────────────────────────────── -->
<div class="factura-overlay" id="facturaOverlay" role="dialog" aria-modal="true" aria-labelledby="facturaTitle">
  <div class="factura-viewer">

    <!-- Toolbar -->
    <div class="factura-toolbar">
      <div>
        <div class="tf-title" id="facturaTitle">Factura Caja N.º 01</div>
        <div class="tf-sub"><?php echo esc_html( ucfirst( $delivery_label_year ) . ' · ' . $demo_price_display ); ?></div>
      </div>
      <div class="factura-toolbar-actions">
        <button class="btn btn--outline btn--sm" id="facturaDownloadBtn" style="gap:.4rem">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="13" height="13"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Descargar PDF
        </button>
        <button class="modal__close" id="facturaClose" aria-label="Cerrar" style="position:relative;top:auto;right:auto">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>
    </div>

    <!-- Invoice document -->
    <div class="factura-scroll">
      <div class="factura-page" id="facturaPDF">
        <div class="f-logo">Ogape</div>
        <div class="f-tagline">Tu Chef en Casa · Asunción, Paraguay</div>

        <div class="f-top">
          <div>
            <div class="f-doc-type">Factura</div>
            <div class="f-timbrado">Timbrado N.º 12345678 · Vence 31/12/2027<br>RUC: 80123456-7</div>
          </div>
          <div>
            <div class="f-num"><small>N.º</small>001-001-0000001</div>
            <div style="font-size:10.5px;color:#6B7280;text-align:right;margin-top:4px">Fecha: <?php echo esc_html( $delivery_numeric ); ?></div>
            <div style="font-size:10.5px;color:#6B7280;text-align:right">Condición: Contado</div>
          </div>
        </div>

        <div class="f-parties">
          <div>
            <div class="f-party-lbl">Emisor</div>
            <div class="f-party-name">Ogape S.A.</div>
            <div class="f-party-detail">
              RUC: 80123456-7<br>
              Av. Mcal. López 3794<br>
              Asunción, Paraguay<br>
              Tel: +595 981 000 001
            </div>
          </div>
          <div>
            <div class="f-party-lbl">Cliente</div>
            <div class="f-party-name" id="factClientName"><?php echo esc_html( $demo_name ); ?></div>
            <div class="f-party-detail">
              RUC / C.I.: 1.234.567<br>
              <?php echo esc_html( $demo_zone ); ?>, Asunción<br>
              <?php echo esc_html( $demo_delivery_address ); ?><br>
              <?php echo esc_html( $demo_email ); ?>
            </div>
          </div>
        </div>

        <table class="f-table">
          <thead>
            <tr>
              <th style="width:36px">Cant.</th>
              <th>Descripción</th>
              <th style="width:80px;text-align:center">IVA</th>
              <th style="width:100px">P. Unitario</th>
              <th style="width:100px">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align:center">1</td>
              <td>
                Kit de ingredientes semanal Ogape
                <div class="f-desc-sub">Caja N.º 01 · Para <?php echo esc_html( $demo_people ); ?> personas · <?php echo esc_html( $demo_recipes ); ?> recetas · Entrega <?php echo esc_html( $delivery_numeric ); ?></div>
              </td>
              <td style="text-align:center">10%</td>
              <td style="text-align:right"><?php echo esc_html( $demo_price_display ); ?></td>
              <td><?php echo esc_html( $demo_price_display ); ?></td>
            </tr>
          </tbody>
        </table>

        <div class="f-totals">
          <div class="f-total-row">
            <span class="k">Subtotal (IVA incl.)</span>
            <span class="v"><?php echo esc_html( $demo_price_display ); ?></span>
          </div>
          <div class="f-total-row">
            <span class="k">IVA 10%</span>
            <span class="v"><?php echo esc_html( $demo_iva_display ); ?></span>
          </div>
          <div class="f-total-row">
            <span class="k">Descuentos</span>
            <span class="v">Gs 0</span>
          </div>
          <div class="f-total-row is-grand">
            <span class="k">Total</span>
            <span class="v"><?php echo esc_html( $demo_price_display ); ?></span>
          </div>
        </div>

        <div class="f-footer">
          <div>Ogape S.A. · RUC 80123456-7 · Timbrado 12345678</div>
          <div>Esta factura es válida como comprobante fiscal en la República del Paraguay.</div>
          <div>Av. Mcal. López 3794, Asunción · ogape.com.py · hola@ogape.com.py</div>
          <div class="f-stamp">Pagado · <?php echo esc_html( $delivery_numeric ); ?></div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
(function () {
  var ajaxUrl = (typeof ogapeTheme !== 'undefined') ? ogapeTheme.ajaxUrl : '/wp-admin/admin-ajax.php';
  var nonce   = '<?php echo esc_js( wp_create_nonce( 'ogape_account_actions' ) ); ?>';
  var logoutUrl = '<?php echo esc_js( function_exists( 'ogape_get_logout_url' ) ? ogape_get_logout_url() : home_url( '/future-site/' ) ); ?>';

  function post(action, data, onSuccess, onError) {
    data.action = action;
    data.nonce  = nonce;
    var fd = new FormData();
    Object.keys(data).forEach(function (k) { fd.append(k, data[k]); });
    fetch(ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.success) { onSuccess(res.data || {}); }
        else { onError((res.data && res.data.message) ? res.data.message : 'Error. Intentá de nuevo.'); }
      })
      .catch(function () { onError('Error de red. Intentá de nuevo.'); });
  }

  function setBtn(btn, loading, orig) {
    if (loading) { btn.disabled = true; btn.dataset.origText = btn.textContent; btn.textContent = 'Guardando…'; }
    else { btn.disabled = false; btn.textContent = btn.dataset.origText || btn.textContent; }
  }

  function showFormError(formEl, msg) {
    var err = formEl.querySelector('.form-ajax-error');
    if (!err) {
      err = document.createElement('p');
      err.className = 'form-ajax-error';
      err.style.cssText = 'color:#c0392b;font-size:13px;margin:.5rem 0 0;padding:.5rem .75rem;background:#fdf2f2;border-radius:6px;border:1px solid #f5c6c6';
      var foot = formEl.querySelector('.modal__footer');
      if (foot) foot.insertAdjacentElement('beforebegin', err);
      else formEl.appendChild(err);
    }
    err.textContent = msg;
    err.style.display = '';
  }

  function hideFormError(formEl) {
    var err = formEl.querySelector('.form-ajax-error');
    if (err) err.style.display = 'none';
  }

  function showSuccess(wrapId, successId) {
    var wrap = document.getElementById(wrapId);
    var succ = document.getElementById(successId);
    if (wrap) wrap.style.display = 'none';
    if (succ) succ.style.display = '';
  }

  // ── PERFIL ───────────────────────────────────────────────────────
  var perfilForm = document.getElementById('perfilForm');
  if (perfilForm) {
    perfilForm.addEventListener('submit', function (e) {
      e.preventDefault();
      hideFormError(perfilForm);
      var btn = perfilForm.querySelector('[type=submit]');
      setBtn(btn, true);
      post('ogape_update_profile', {
        first_name: document.getElementById('pfNombre').value,
        last_name:  document.getElementById('pfApellido').value,
        email:      document.getElementById('pfEmail').value,
        phone:      document.getElementById('pfTel').value,
        password:   document.getElementById('pfPw').value,
      }, function (data) {
        if (data.first_name) {
          document.querySelectorAll('.avatar-btn .name').forEach(function (el) { el.textContent = data.first_name; });
        }
        if (data.initials) {
          document.querySelectorAll('.avatar-btn .avatar').forEach(function (el) { el.textContent = data.initials; });
        }
        if (data.name) {
          document.querySelectorAll('.user-menu__head .uname').forEach(function (el) { el.textContent = data.name; });
        }
        if (data.email) {
          document.querySelectorAll('.user-menu__head .email').forEach(function (el) { el.textContent = data.email; });
        }
        showSuccess('perfilFormWrap', 'perfilSuccess');
      }, function (msg) {
        setBtn(btn, false);
        showFormError(perfilForm, msg);
      });
    });
  }

  // ── DIRECCIÓN ────────────────────────────────────────────────────
  var dirForm = document.getElementById('dirForm');
  if (dirForm) {
    dirForm.addEventListener('submit', function (e) {
      e.preventDefault();
      hideFormError(dirForm);
      var btn = dirForm.querySelector('[type=submit]');
      setBtn(btn, true);
      post('ogape_update_address', {
        zone_key: document.getElementById('dirZone').value,
        address:  document.getElementById('dirAddress').value,
        apt:      document.getElementById('dirApt').value,
        window:   document.getElementById('dirWindow').value,
        notes:    document.getElementById('dirNotes').value,
      }, function (data) {
        showSuccess('dirFormWrap', 'dirSuccess');
      }, function (msg) {
        setBtn(btn, false);
        showFormError(dirForm, msg);
      });
    });
  }

  // ── PLAN ─────────────────────────────────────────────────────────
  var planConfirmBtn = document.getElementById('planConfirmBtn');
  if (planConfirmBtn) {
    planConfirmBtn.addEventListener('click', function () {
      setBtn(planConfirmBtn, true);
      var people  = document.querySelector('#peopleOpts input[name=mp]:checked');
      var recipes = document.querySelector('#recipesOpts input[name=mr]:checked');
      post('ogape_update_plan', {
        people:  people  ? people.value  : '2',
        recipes: recipes ? recipes.value : '3',
      }, function (data) {
        var msg = document.getElementById('planSuccessMsg');
        if (msg && data.label && data.price_display) {
          msg.textContent = 'Plan actualizado: ' + data.label + ' · ' + data.price_display + ' / sem.';
        }
        document.getElementById('planForm').style.display = 'none';
        document.getElementById('planSuccess').style.display = '';
      }, function (msg) {
        setBtn(planConfirmBtn, false);
        alert(msg);
      });
    });
  }

  // ── PAUSA ─────────────────────────────────────────────────────────
  var pauseConfirmBtn = document.getElementById('pauseConfirmBtn');
  if (pauseConfirmBtn) {
    pauseConfirmBtn.addEventListener('click', function () {
      setBtn(pauseConfirmBtn, true);
      var sel = document.querySelector('#pauseOpts input[name=pauseWhen]:checked');
      post('ogape_pause_plan', {
        pause_when: sel ? sel.value : 'next',
      }, function () {
        document.getElementById('pauseForm').style.display = 'none';
        document.getElementById('pauseSuccess').style.display = '';
      }, function (msg) {
        setBtn(pauseConfirmBtn, false);
        alert(msg);
      });
    });
  }

  // ── NOTIFICACIONES ────────────────────────────────────────────────
  var notifsForm = document.getElementById('notifsForm');
  if (notifsForm) {
    // Live toggle label update
    var togglePairs = [
      ['notifWeeklyMenu', 'notifWeeklyMenuVal'],
      ['notifWhatsapp',   'notifWhatsappVal'],
      ['notifCutoff',     'notifCutoffVal'],
      ['notifPromo',      'notifPromoVal'],
    ];
    togglePairs.forEach(function (pair) {
      var inp = document.getElementById(pair[0]);
      var lbl = document.getElementById(pair[1]);
      if (inp && lbl) {
        inp.addEventListener('change', function () {
          lbl.textContent = inp.checked ? 'Activado' : 'Desactivado';
        });
      }
    });

    notifsForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = notifsForm.querySelector('[type=submit]');
      setBtn(btn, true);
      post('ogape_update_notifications', {
        notif_weekly_menu: document.getElementById('notifWeeklyMenu').checked ? '1' : '0',
        notif_whatsapp:    document.getElementById('notifWhatsapp').checked   ? '1' : '0',
        notif_cutoff:      document.getElementById('notifCutoff').checked     ? '1' : '0',
        notif_promo:       document.getElementById('notifPromo').checked      ? '1' : '0',
      }, function () {
        showSuccess('notifsFormWrap', 'notifsSuccess');
      }, function (msg) {
        setBtn(btn, false);
        alert(msg);
      });
    });
  }

  // ── CERRAR SESIÓN ─────────────────────────────────────────────────
  document.querySelectorAll('.umenu-item.is-danger').forEach(function (btn) {
    btn.addEventListener('click', function () {
      window.location.href = logoutUrl;
    });
  });
})();
</script>

<?php get_footer(); ?>
