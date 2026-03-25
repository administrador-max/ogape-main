<?php
/**
 * Waitlist operations layer
 *
 * Stores leads as a private CPT and adds operational tooling:
 * statuses, admin columns, notes, notifications, export, and AJAX intake.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ogape_waitlist_status_options' ) ) {
    function ogape_waitlist_status_options() {
        return array(
            'new'       => __( 'New', 'ogape-child' ),
            'reviewed'  => __( 'Reviewed', 'ogape-child' ),
            'contacted' => __( 'Contacted', 'ogape-child' ),
            'eligible'  => __( 'Eligible', 'ogape-child' ),
            'invited'   => __( 'Invited', 'ogape-child' ),
            'converted' => __( 'Converted', 'ogape-child' ),
            'not_now'   => __( 'Not now', 'ogape-child' ),
        );
    }
}

if ( ! function_exists( 'ogape_get_waitlist_team_email' ) ) {
    function ogape_get_waitlist_team_email() {
        if ( defined( 'OGAPE_WAITLIST_TEAM_EMAIL' ) && OGAPE_WAITLIST_TEAM_EMAIL ) {
            return sanitize_email( OGAPE_WAITLIST_TEAM_EMAIL );
        }

        return ogape_get_contact_email();
    }
}

if ( ! function_exists( 'ogape_waitlist_neighbourhood_options' ) ) {
    function ogape_waitlist_neighbourhood_options() {
        return array(
            'Villa Morra',
            'Las Mercedes',
            'Carmelitas',
            'Recoleta',
            'Mburucuyá',
            'Herrera',
            'Trinidad',
            'Ycuá Satí',
            'San Jorge',
            'Madame Lynch',
            'Los Laureles',
            'Manorá',
            'Ciudad Nueva',
            'Centro',
            'Otra zona de Asunción',
        );
    }
}

if ( ! function_exists( 'ogape_register_waitlist_post_type' ) ) {
    function ogape_register_waitlist_post_type() {
        register_post_type(
            'ogape_waitlist',
            array(
                'labels' => array(
                    'name'          => __( 'Waitlist Entries', 'ogape-child' ),
                    'singular_name' => __( 'Waitlist Entry', 'ogape-child' ),
                    'menu_name'     => __( 'Waitlist Entries', 'ogape-child' ),
                ),
                'public'              => false,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 26,
                'menu_icon'           => 'dashicons-email-alt',
                'supports'            => array( 'title' ),
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
                'exclude_from_search' => true,
                'show_in_rest'        => false,
            )
        );
    }
    add_action( 'init', 'ogape_register_waitlist_post_type' );
}

if ( ! function_exists( 'ogape_handle_waitlist_submission' ) ) {
    function ogape_handle_waitlist_submission() {
        check_ajax_referer( 'ogape_waitlist_submit', 'nonce' );

        $honeypot = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
        if ( '' !== $honeypot ) {
            wp_send_json_success(
                array(
                    'message' => __( 'Te anotamos. Te avisaremos cuando lleguemos a tu zona.', 'ogape-child' ),
                    'status'  => 'spam',
                )
            );
        }

        $first_name    = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
        $email         = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $phone                = isset( $_POST['phone_whatsapp'] ) ? sanitize_text_field( wp_unslash( $_POST['phone_whatsapp'] ) ) : '';
        $neighbourhood        = isset( $_POST['neighbourhood'] ) ? sanitize_text_field( wp_unslash( $_POST['neighbourhood'] ) ) : '';
        $neighbourhood_other  = isset( $_POST['neighbourhood_other'] ) ? sanitize_text_field( wp_unslash( $_POST['neighbourhood_other'] ) ) : '';
        $city                 = isset( $_POST['city'] ) ? sanitize_text_field( wp_unslash( $_POST['city'] ) ) : 'Asunción';
        $notes         = isset( $_POST['notes'] ) ? sanitize_textarea_field( wp_unslash( $_POST['notes'] ) ) : '';
        $source_page   = isset( $_POST['source_page'] ) ? sanitize_text_field( wp_unslash( $_POST['source_page'] ) ) : '';
        $referrer      = isset( $_POST['referrer'] ) ? esc_url_raw( wp_unslash( $_POST['referrer'] ) ) : '';
        $utm_source    = isset( $_POST['utm_source'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_source'] ) ) : '';
        $utm_medium    = isset( $_POST['utm_medium'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_medium'] ) ) : '';
        $utm_campaign  = isset( $_POST['utm_campaign'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_campaign'] ) ) : '';
        $allowed_neighbourhoods = ogape_waitlist_neighbourhood_options();

        if ( '' === $first_name ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Completá tu nombre para anotarte.', 'ogape-child' ),
                    'field'   => 'first_name',
                ),
                400
            );
        }

        if ( '' === $email || ! is_email( $email ) ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Ingresá un email válido.', 'ogape-child' ),
                    'field'   => 'email',
                ),
                400
            );
        }

        if ( '' === $phone ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Compartí tu teléfono o WhatsApp.', 'ogape-child' ),
                    'field'   => 'phone_whatsapp',
                ),
                400
            );
        }

        if ( '' === $neighbourhood ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Indicá tu barrio o zona.', 'ogape-child' ),
                    'field'   => 'neighbourhood',
                ),
                400
            );
        }

        if ( ! in_array( $neighbourhood, $allowed_neighbourhoods, true ) ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Seleccioná un barrio válido de Asunción.', 'ogape-child' ),
                    'field'   => 'neighbourhood',
                ),
                400
            );
        }

        if ( 'Otra zona de Asunción' === $neighbourhood ) {
            if ( '' === $neighbourhood_other ) {
                wp_send_json_error(
                    array(
                        'message' => __( 'Especificá tu barrio dentro de Asunción.', 'ogape-child' ),
                        'field'   => 'neighbourhood_other',
                    ),
                    400
                );
            }

            $neighbourhood = $neighbourhood_other;
        }

        if ( '' === $city ) {
            $city = 'Asunción';
        }

        if ( 'Asunción' !== $city ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Por ahora solo estamos lanzando en Asunción.', 'ogape-child' ),
                    'field'   => 'city',
                ),
                400
            );
        }

        $existing_entries = get_posts(
            array(
                'post_type'      => 'ogape_waitlist',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'meta_key'       => 'ogape_waitlist_email',
                'meta_value'     => $email,
            )
        );

        if ( ! empty( $existing_entries ) ) {
            wp_send_json_success(
                array(
                    'message' => __( 'Ya estabas anotado. Te avisaremos cuando lleguemos a tu zona.', 'ogape-child' ),
                    'status'  => 'duplicate',
                )
            );
        }

        $created_at = current_time( 'mysql' );
        $entry_id   = wp_insert_post(
            array(
                'post_type'   => 'ogape_waitlist',
                'post_status' => 'publish',
                'post_title'  => $first_name,
            ),
            true
        );

        if ( is_wp_error( $entry_id ) ) {
            wp_send_json_error(
                array(
                    'message' => __( 'No pudimos guardar tus datos. Intentá de nuevo.', 'ogape-child' ),
                ),
                500
            );
        }

        update_post_meta( $entry_id, 'ogape_waitlist_first_name', $first_name );
        update_post_meta( $entry_id, 'ogape_waitlist_name', $first_name );
        update_post_meta( $entry_id, 'ogape_waitlist_email', $email );
        update_post_meta( $entry_id, 'ogape_waitlist_phone_whatsapp', $phone );
        update_post_meta( $entry_id, 'ogape_waitlist_neighbourhood', $neighbourhood );
        update_post_meta( $entry_id, 'ogape_waitlist_city', $city );
        update_post_meta( $entry_id, 'ogape_waitlist_notes', $notes );
        update_post_meta( $entry_id, 'ogape_waitlist_source_page', $source_page ? $source_page : 'unknown' );
        update_post_meta( $entry_id, 'ogape_waitlist_referrer', $referrer );
        update_post_meta( $entry_id, 'ogape_waitlist_utm_source', $utm_source );
        update_post_meta( $entry_id, 'ogape_waitlist_utm_medium', $utm_medium );
        update_post_meta( $entry_id, 'ogape_waitlist_utm_campaign', $utm_campaign );
        update_post_meta( $entry_id, 'ogape_waitlist_status', 'new' );
        update_post_meta( $entry_id, 'ogape_waitlist_internal_notes', '' );
        update_post_meta( $entry_id, 'ogape_waitlist_created_at', $created_at );

        ogape_send_waitlist_notification(
            array(
                'first_name'    => $first_name,
                'email'         => $email,
                'phone'         => $phone,
                'neighbourhood' => $neighbourhood,
                'city'          => $city,
                'notes'         => $notes,
                'source_page'   => $source_page,
                'referrer'      => $referrer,
                'utm_source'    => $utm_source,
                'utm_medium'    => $utm_medium,
                'utm_campaign'  => $utm_campaign,
                'created_at'    => $created_at,
            )
        );

        ogape_send_waitlist_confirmation_email(
            array(
                'first_name' => $first_name,
                'email'      => $email,
            )
        );

        wp_send_json_success(
            array(
                'message' => __( 'Te anotamos. Te avisaremos cuando lleguemos a tu zona.', 'ogape-child' ),
                'status'  => 'created',
            )
        );
    }
    add_action( 'wp_ajax_ogape_waitlist_submit', 'ogape_handle_waitlist_submission' );
    add_action( 'wp_ajax_nopriv_ogape_waitlist_submit', 'ogape_handle_waitlist_submission' );
}

if ( ! function_exists( 'ogape_send_waitlist_confirmation_email' ) ) {
    function ogape_send_waitlist_confirmation_email( $entry ) {
        $email = sanitize_email( $entry['email'] ?? '' );

        if ( ! $email || ! is_email( $email ) ) {
            return;
        }

        $name          = sanitize_text_field( $entry['first_name'] ?? '' );
        $name          = $name ? $name : __( 'Hola', 'ogape-child' );
        $subject       = __( 'Lista confirmada · Ogape', 'ogape-child' );
        $privacy_url   = home_url( '/privacidad/' );
        $waitlist_url  = home_url( '/waitlist/' );
        $menu_url      = home_url( '/menu/' );
        $instagram_url = 'https://www.instagram.com/ogape.py';
        $facebook_url  = 'https://www.facebook.com/ogape.py';
        $whatsapp_url  = 'https://wa.me/595000000000';
        $year          = gmdate( 'Y' );

        // Keep PDF placeholder structure until referral backend is implemented.
        $referral_code = '{{REFERRAL_CODE}}';
        if ( ! empty( $entry['referral_code'] ) ) {
            $referral_code = sanitize_text_field( $entry['referral_code'] );
        }
        $referral_url = home_url( '/ref/' . rawurlencode( $referral_code ) );

        $plain_message = sprintf(
            "OGAPE\nTU CHEF EN CASA\nLISTA CONFIRMADA\n\nHola %1$s,\n\nYa sos parte de lo que viene.\n\nGracias por anotarte. Estamos preparando algo cuidado — y vas a ser de los primeros en probarlo.\n\nLo que sigue\n01 Te avisamos cuando esté listo\nEl acceso se abre por etapas. Te escribimos a %2$s cuando llegue tu turno.\n\n02 Avanzá en la lista\nInvitá a alguien usando tu enlace y subís posiciones automáticamente.\n%3$s\n\n03 Acceso anticipado\nLos primeros en entrar tienen condiciones especiales del lanzamiento piloto.\n\nINGREDIENTES FRESCOS\nCocina de calidad, en tu casa.\nIdentidad paraguaya. Presentación contemporánea. Conveniente por diseño.\n\nSeguinos mientras esperás\nInstagram · Facebook · WhatsApp\n\nCancelar suscripción · Política de privacidad: %4$s\n© %5$s Ogape Paraguay. Todos los derechos reservados.",
            $name,
            $email,
            $referral_url,
            $privacy_url,
            $year
        );

        $html_message = sprintf(
            '<!doctype html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head><body style="margin:0;padding:0;background:#f5f4ef;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial,sans-serif;color:#1f1f1f;"><table role="presentation" width="100%%" cellspacing="0" cellpadding="0" style="background:#f5f4ef;padding:24px 0;"><tr><td align="center"><table role="presentation" width="100%%" cellspacing="0" cellpadding="0" style="max-width:680px;background:#ffffff;border:1px solid #e9e6dd;border-radius:18px;overflow:hidden;"><tr><td style="padding:26px 28px;background:#191919;color:#ffffff;"><p style="margin:0;font-size:12px;letter-spacing:.12em;text-transform:uppercase;opacity:.85;">OGAPE · TU CHEF EN CASA</p><p style="margin:10px 0 0;font-size:12px;letter-spacing:.10em;text-transform:uppercase;opacity:.85;">LISTA CONFIRMADA</p><h1 style="margin:10px 0 0;font-size:34px;line-height:1.2;">Ya sos parte de lo que viene.</h1></td></tr><tr><td style="padding:28px;"><p style="margin:0 0 14px;font-size:16px;line-height:1.55;">Hola %1$s,</p><p style="margin:0 0 16px;font-size:16px;line-height:1.55;">Gracias por anotarte. Estamos preparando algo cuidado — y vas a ser de los primeros en probarlo.</p><div style="margin:20px 0;padding:16px;background:#f8f7f2;border:1px solid #ece8dc;border-radius:12px;"><p style="margin:0 0 10px;font-size:14px;font-weight:700;">Lo que sigue</p><p style="margin:0 0 10px;font-size:14px;line-height:1.7;"><strong>01 Te avisamos cuando esté listo</strong><br>El acceso se abre por etapas. Te escribimos a %2$s cuando llegue tu turno.</p><p style="margin:0 0 10px;font-size:14px;line-height:1.7;"><strong>02 Avanzá en la lista</strong><br>Invitá a alguien usando tu enlace y subís posiciones automáticamente.</p><p style="margin:0;font-size:14px;line-height:1.7;"><strong>03 Acceso anticipado</strong><br>Los primeros en entrar tienen condiciones especiales del lanzamiento piloto.</p></div><p style="margin:18px 0 8px;font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#5d5d5d;">SUMÁ GENTE, AVANZÁS VOS</p><p style="margin:0 0 8px;font-size:16px;font-weight:600;">Compartí tu lugar</p><p style="margin:0 0 14px;font-size:14px;line-height:1.6;">Cada persona que se anote con tu enlace te acerca más al acceso.</p><p style="margin:0 0 16px;padding:10px 12px;background:#f5f3ec;border:1px dashed #c8c2b2;border-radius:10px;font-size:14px;word-break:break-all;">%3$s</p><p style="margin:0 0 18px;"><a href="%3$s" style="display:inline-block;background:#1f1f1f;color:#ffffff;text-decoration:none;padding:12px 16px;border-radius:10px;font-size:14px;font-weight:600;">Copiar mi enlace</a></p><p style="margin:0 0 6px;font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#5d5d5d;">INGREDIENTES FRESCOS</p><p style="margin:0 0 16px;font-size:14px;line-height:1.6;">Cocina de calidad, en tu casa.<br>Identidad paraguaya. Presentación contemporánea. Conveniente por diseño.</p><p style="margin:0 0 10px;font-size:14px;">Seguinos mientras esperás</p><p style="margin:0 0 20px;font-size:14px;"><a href="%4$s" style="color:#1f1f1f;">Instagram</a> · <a href="%5$s" style="color:#1f1f1f;">Facebook</a> · <a href="%6$s" style="color:#1f1f1f;">WhatsApp</a></p><p style="margin:0;font-size:13px;color:#5d5d5d;line-height:1.6;">Recibiste este correo porque te anotaste en la lista de espera de Ogape con la dirección %2$s.</p></td></tr><tr><td style="padding:18px 28px;border-top:1px solid #efece3;background:#fcfbf8;"><p style="margin:0 0 8px;font-size:12px;color:#777;"><a href="%7$s" style="color:#777;">Cancelar suscripción</a> · <a href="%8$s" style="color:#777;">Política de privacidad</a></p><p style="margin:0;font-size:12px;color:#777;">© %9$s Ogape Paraguay. Todos los derechos reservados.<br>{{COMPANY_ADDRESS}}</p></td></tr></table></td></tr></table></body></html>',
            esc_html( $name ),
            esc_html( $email ),
            esc_url( $referral_url ),
            esc_url( $instagram_url ),
            esc_url( $facebook_url ),
            esc_url( $whatsapp_url ),
            esc_url( $waitlist_url ),
            esc_url( $privacy_url ),
            esc_html( $year )
        );

        $headers = array( 'Content-Type: text/html; charset=UTF-8' );

        // Confirmation mail should never break the signup flow.
        $sent = wp_mail( $email, $subject, $html_message, $headers );

        if ( ! $sent ) {
            wp_mail( $email, $subject, $plain_message );
        }
    }
}

if ( ! function_exists( 'ogape_send_waitlist_notification' ) ) {
    function ogape_send_waitlist_notification( $entry ) {
        $to = ogape_get_waitlist_team_email();

        if ( ! $to || ! is_email( $to ) ) {
            return;
        }

        $subject = sprintf(
            /* translators: %s: neighborhood */
            __( 'Nueva signup waitlist: %s', 'ogape-child' ),
            $entry['neighbourhood']
        );

        $lines = array(
            __( 'Nuevo registro en la waitlist de Ogape.', 'ogape-child' ),
            '',
            __( 'Nombre:', 'ogape-child' ) . ' ' . $entry['first_name'],
            __( 'Email:', 'ogape-child' ) . ' ' . $entry['email'],
            __( 'Teléfono / WhatsApp:', 'ogape-child' ) . ' ' . $entry['phone'],
            __( 'Barrio:', 'ogape-child' ) . ' ' . $entry['neighbourhood'],
            __( 'Ciudad:', 'ogape-child' ) . ' ' . $entry['city'],
            __( 'Fecha:', 'ogape-child' ) . ' ' . $entry['created_at'],
            __( 'Página origen:', 'ogape-child' ) . ' ' . ( $entry['source_page'] ? $entry['source_page'] : '-' ),
            __( 'Referrer:', 'ogape-child' ) . ' ' . ( $entry['referrer'] ? $entry['referrer'] : '-' ),
            __( 'UTM source:', 'ogape-child' ) . ' ' . ( $entry['utm_source'] ? $entry['utm_source'] : '-' ),
            __( 'UTM medium:', 'ogape-child' ) . ' ' . ( $entry['utm_medium'] ? $entry['utm_medium'] : '-' ),
            __( 'UTM campaign:', 'ogape-child' ) . ' ' . ( $entry['utm_campaign'] ? $entry['utm_campaign'] : '-' ),
        );

        if ( ! empty( $entry['notes'] ) ) {
            $lines[] = __( 'Notas:', 'ogape-child' ) . ' ' . $entry['notes'];
        }

        wp_mail( $to, $subject, implode( "\n", $lines ) );
    }
}

if ( ! function_exists( 'ogape_waitlist_admin_columns' ) ) {
    function ogape_waitlist_admin_columns( $columns ) {
        return array(
            'cb'               => $columns['cb'],
            'title'            => __( 'Name', 'ogape-child' ),
            'email'            => __( 'Email', 'ogape-child' ),
            'phone_whatsapp'   => __( 'Phone / WhatsApp', 'ogape-child' ),
            'neighbourhood'    => __( 'Barrio', 'ogape-child' ),
            'city'             => __( 'City', 'ogape-child' ),
            'status'           => __( 'Status', 'ogape-child' ),
            'created_at'       => __( 'Created', 'ogape-child' ),
        );
    }
    add_filter( 'manage_ogape_waitlist_posts_columns', 'ogape_waitlist_admin_columns' );
}

if ( ! function_exists( 'ogape_render_waitlist_admin_column' ) ) {
    function ogape_render_waitlist_admin_column( $column, $post_id ) {
        switch ( $column ) {
            case 'email':
                echo esc_html( get_post_meta( $post_id, 'ogape_waitlist_email', true ) );
                break;
            case 'phone_whatsapp':
                echo esc_html( get_post_meta( $post_id, 'ogape_waitlist_phone_whatsapp', true ) );
                break;
            case 'neighbourhood':
                echo esc_html( get_post_meta( $post_id, 'ogape_waitlist_neighbourhood', true ) );
                break;
            case 'city':
                echo esc_html( get_post_meta( $post_id, 'ogape_waitlist_city', true ) );
                break;
            case 'status':
                $status  = get_post_meta( $post_id, 'ogape_waitlist_status', true );
                $status  = $status ? $status : 'new';
                $options = ogape_waitlist_status_options();
                echo '<span class="ogape-waitlist-status" data-status="' . esc_attr( $status ) . '">' . esc_html( $options[ $status ] ?? $status ) . '</span>';
                break;
            case 'created_at':
                echo esc_html( get_post_meta( $post_id, 'ogape_waitlist_created_at', true ) );
                break;
        }
    }
    add_action( 'manage_ogape_waitlist_posts_custom_column', 'ogape_render_waitlist_admin_column', 10, 2 );
}

if ( ! function_exists( 'ogape_waitlist_sortable_columns' ) ) {
    function ogape_waitlist_sortable_columns( $columns ) {
        $columns['email']      = 'waitlist_email';
        $columns['city']       = 'waitlist_city';
        $columns['status']     = 'waitlist_status';
        $columns['created_at'] = 'waitlist_created_at';
        return $columns;
    }
    add_filter( 'manage_edit-ogape_waitlist_sortable_columns', 'ogape_waitlist_sortable_columns' );
}

if ( ! function_exists( 'ogape_waitlist_admin_query' ) ) {
    function ogape_waitlist_admin_query( $query ) {
        if ( ! is_admin() || ! $query->is_main_query() || 'ogape_waitlist' !== $query->get( 'post_type' ) ) {
            return;
        }

        $orderby = $query->get( 'orderby' );
        if ( 'waitlist_email' === $orderby ) {
            $query->set( 'meta_key', 'ogape_waitlist_email' );
            $query->set( 'orderby', 'meta_value' );
        } elseif ( 'waitlist_city' === $orderby ) {
            $query->set( 'meta_key', 'ogape_waitlist_city' );
            $query->set( 'orderby', 'meta_value' );
        } elseif ( 'waitlist_status' === $orderby ) {
            $query->set( 'meta_key', 'ogape_waitlist_status' );
            $query->set( 'orderby', 'meta_value' );
        } elseif ( 'waitlist_created_at' === $orderby ) {
            $query->set( 'meta_key', 'ogape_waitlist_created_at' );
            $query->set( 'orderby', 'meta_value' );
        }

        if ( ! empty( $_GET['waitlist_status'] ) ) {
            $query->set(
                'meta_query',
                array(
                    array(
                        'key'   => 'ogape_waitlist_status',
                        'value' => sanitize_text_field( wp_unslash( $_GET['waitlist_status'] ) ),
                    ),
                )
            );
        }
    }
    add_action( 'pre_get_posts', 'ogape_waitlist_admin_query' );
}

if ( ! function_exists( 'ogape_waitlist_admin_filters' ) ) {
    function ogape_waitlist_admin_filters() {
        global $typenow;

        if ( 'ogape_waitlist' !== $typenow ) {
            return;
        }

        $selected = isset( $_GET['waitlist_status'] ) ? sanitize_text_field( wp_unslash( $_GET['waitlist_status'] ) ) : '';
        $statuses = ogape_waitlist_status_options();

        echo '<select name="waitlist_status">';
        echo '<option value="">' . esc_html__( 'All statuses', 'ogape-child' ) . '</option>';
        foreach ( $statuses as $value => $label ) {
            printf(
                '<option value="%1$s"%2$s>%3$s</option>',
                esc_attr( $value ),
                selected( $selected, $value, false ),
                esc_html( $label )
            );
        }
        echo '</select>';
    }
    add_action( 'restrict_manage_posts', 'ogape_waitlist_admin_filters' );
}

if ( ! function_exists( 'ogape_waitlist_register_meta_boxes' ) ) {
    function ogape_waitlist_register_meta_boxes() {
        add_meta_box(
            'ogape-waitlist-details',
            __( 'Waitlist Details', 'ogape-child' ),
            'ogape_waitlist_details_meta_box',
            'ogape_waitlist',
            'normal',
            'high'
        );
    }
    add_action( 'add_meta_boxes_ogape_waitlist', 'ogape_waitlist_register_meta_boxes' );
}

if ( ! function_exists( 'ogape_waitlist_details_meta_box' ) ) {
    function ogape_waitlist_details_meta_box( $post ) {
        wp_nonce_field( 'ogape_waitlist_save_meta', 'ogape_waitlist_meta_nonce' );

        $status        = get_post_meta( $post->ID, 'ogape_waitlist_status', true );
        $status        = $status ? $status : 'new';
        $internal      = get_post_meta( $post->ID, 'ogape_waitlist_internal_notes', true );
        $public_fields = array(
            __( 'First name', 'ogape-child' )    => get_post_meta( $post->ID, 'ogape_waitlist_first_name', true ),
            __( 'Email', 'ogape-child' )         => get_post_meta( $post->ID, 'ogape_waitlist_email', true ),
            __( 'Phone / WhatsApp', 'ogape-child' ) => get_post_meta( $post->ID, 'ogape_waitlist_phone_whatsapp', true ),
            __( 'Barrio', 'ogape-child' )        => get_post_meta( $post->ID, 'ogape_waitlist_neighbourhood', true ),
            __( 'City', 'ogape-child' )          => get_post_meta( $post->ID, 'ogape_waitlist_city', true ),
            __( 'Notes', 'ogape-child' )         => get_post_meta( $post->ID, 'ogape_waitlist_notes', true ),
            __( 'Source page', 'ogape-child' )   => get_post_meta( $post->ID, 'ogape_waitlist_source_page', true ),
            __( 'Referrer', 'ogape-child' )      => get_post_meta( $post->ID, 'ogape_waitlist_referrer', true ),
            __( 'UTM source', 'ogape-child' )    => get_post_meta( $post->ID, 'ogape_waitlist_utm_source', true ),
            __( 'UTM medium', 'ogape-child' )    => get_post_meta( $post->ID, 'ogape_waitlist_utm_medium', true ),
            __( 'UTM campaign', 'ogape-child' )  => get_post_meta( $post->ID, 'ogape_waitlist_utm_campaign', true ),
            __( 'Created at', 'ogape-child' )    => get_post_meta( $post->ID, 'ogape_waitlist_created_at', true ),
        );
        ?>
        <div class="ogape-waitlist-meta">
            <table class="widefat striped" style="margin-bottom:16px;">
                <tbody>
                <?php foreach ( $public_fields as $label => $value ) : ?>
                    <tr>
                        <th style="width:180px;"><?php echo esc_html( $label ); ?></th>
                        <td><?php echo esc_html( $value ? $value : '—' ); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <label for="ogape_waitlist_status"><strong><?php esc_html_e( 'Status', 'ogape-child' ); ?></strong></label><br>
                <select id="ogape_waitlist_status" name="ogape_waitlist_status">
                    <?php foreach ( ogape_waitlist_status_options() as $value => $label ) : ?>
                        <option value="<?php echo esc_attr( $value ); ?>"<?php selected( $status, $value ); ?>><?php echo esc_html( $label ); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                <label for="ogape_waitlist_internal_notes"><strong><?php esc_html_e( 'Internal notes', 'ogape-child' ); ?></strong></label><br>
                <textarea id="ogape_waitlist_internal_notes" name="ogape_waitlist_internal_notes" rows="6" style="width:100%;"><?php echo esc_textarea( $internal ); ?></textarea>
            </p>
        </div>
        <?php
    }
}

if ( ! function_exists( 'ogape_waitlist_save_meta' ) ) {
    function ogape_waitlist_save_meta( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $has_meta_nonce   = isset( $_POST['ogape_waitlist_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_waitlist_meta_nonce'] ) ), 'ogape_waitlist_save_meta' );
        $has_inline_nonce = isset( $_POST['_inline_edit'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_inline_edit'] ) ), 'inlineeditnonce' );

        if ( ! $has_meta_nonce && ! $has_inline_nonce ) {
            return;
        }

        if ( isset( $_POST['ogape_waitlist_status'] ) ) {
            $status  = sanitize_text_field( wp_unslash( $_POST['ogape_waitlist_status'] ) );
            $options = ogape_waitlist_status_options();
            if ( isset( $options[ $status ] ) ) {
                update_post_meta( $post_id, 'ogape_waitlist_status', $status );
            }
        }

        if ( $has_meta_nonce && isset( $_POST['ogape_waitlist_internal_notes'] ) ) {
            update_post_meta(
                $post_id,
                'ogape_waitlist_internal_notes',
                sanitize_textarea_field( wp_unslash( $_POST['ogape_waitlist_internal_notes'] ) )
            );
        }
    }
    add_action( 'save_post_ogape_waitlist', 'ogape_waitlist_save_meta' );
}

if ( ! function_exists( 'ogape_waitlist_quick_edit_box' ) ) {
    function ogape_waitlist_quick_edit_box( $column_name, $post_type ) {
        if ( 'ogape_waitlist' !== $post_type || 'status' !== $column_name ) {
            return;
        }
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label>
                    <span class="title"><?php esc_html_e( 'Status', 'ogape-child' ); ?></span>
                    <select name="ogape_waitlist_status">
                        <?php foreach ( ogape_waitlist_status_options() as $value => $label ) : ?>
                            <option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
        </fieldset>
        <?php
    }
    add_action( 'quick_edit_custom_box', 'ogape_waitlist_quick_edit_box', 10, 2 );
}

if ( ! function_exists( 'ogape_waitlist_admin_footer_script' ) ) {
    function ogape_waitlist_admin_footer_script() {
        global $typenow;

        if ( 'ogape_waitlist' !== $typenow ) {
            return;
        }
        ?>
        <script>
          (function () {
            var $ = window.jQuery;
            if (!$) return;

            var inlineEdit = inlineEditPost.edit;
            inlineEditPost.edit = function (id) {
              inlineEdit.apply(this, arguments);

              var postId = 0;
              if (typeof id === 'object') {
                postId = parseInt(this.getId(id), 10);
              }

              if (!postId) return;

              var editRow = document.getElementById('edit-' + postId);
              var statusEl = document.querySelector('#post-' + postId + ' .ogape-waitlist-status');
              if (!editRow || !statusEl) return;

              var select = editRow.querySelector('select[name="ogape_waitlist_status"]');
              if (select) {
                select.value = statusEl.getAttribute('data-status') || 'new';
              }
            };
          })();
        </script>
        <?php
    }
    add_action( 'admin_footer-edit.php', 'ogape_waitlist_admin_footer_script' );
}

if ( ! function_exists( 'ogape_waitlist_export_submenu' ) ) {
    function ogape_waitlist_export_submenu() {
        add_submenu_page(
            'edit.php?post_type=ogape_waitlist',
            __( 'Export CSV', 'ogape-child' ),
            __( 'Export CSV', 'ogape-child' ),
            'edit_posts',
            'ogape-waitlist-export',
            'ogape_waitlist_export_page'
        );
    }
    add_action( 'admin_menu', 'ogape_waitlist_export_submenu' );
}

if ( ! function_exists( 'ogape_waitlist_export_page' ) ) {
    function ogape_waitlist_export_page() {
        $export_url = wp_nonce_url(
            admin_url( 'admin-post.php?action=ogape_waitlist_export_csv' ),
            'ogape_waitlist_export_csv'
        );
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Export waitlist CSV', 'ogape-child' ); ?></h1>
            <p><?php esc_html_e( 'Download all waitlist entries with operational and attribution fields.', 'ogape-child' ); ?></p>
            <p><a href="<?php echo esc_url( $export_url ); ?>" class="button button-primary"><?php esc_html_e( 'Download CSV', 'ogape-child' ); ?></a></p>
        </div>
        <?php
    }
}

if ( ! function_exists( 'ogape_waitlist_export_csv' ) ) {
    function ogape_waitlist_export_csv() {
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( esc_html__( 'You do not have permission to export waitlist data.', 'ogape-child' ) );
        }

        check_admin_referer( 'ogape_waitlist_export_csv' );

        $entries = get_posts(
            array(
                'post_type'      => 'ogape_waitlist',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            )
        );

        nocache_headers();
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=ogape-waitlist-export.csv' );

        $output = fopen( 'php://output', 'w' );

        fputcsv(
            $output,
            array(
                'first_name',
                'email',
                'phone_whatsapp',
                'neighbourhood',
                'city',
                'notes',
                'source_page',
                'referrer',
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'status',
                'internal_notes',
                'created_at',
            )
        );

        foreach ( $entries as $entry ) {
            fputcsv(
                $output,
                array(
                    get_post_meta( $entry->ID, 'ogape_waitlist_first_name', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_email', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_phone_whatsapp', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_neighbourhood', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_city', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_notes', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_source_page', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_referrer', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_utm_source', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_utm_medium', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_utm_campaign', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_status', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_internal_notes', true ),
                    get_post_meta( $entry->ID, 'ogape_waitlist_created_at', true ),
                )
            );
        }

        fclose( $output );
        exit;
    }
    add_action( 'admin_post_ogape_waitlist_export_csv', 'ogape_waitlist_export_csv' );
}
