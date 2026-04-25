<?php
/**
 * Ogape Child Theme — Functions
 * Enqueue assets, register menus, theme support
 *
 * DO NOT add business logic here — keep functions lean.
 * Component logic belongs in templates/components/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Security: prevent direct access

require get_stylesheet_directory() . '/inc/branding.php';
require get_stylesheet_directory() . '/inc/mail.php';
require get_stylesheet_directory() . '/inc/waitlist.php';

/**
 * Theme contact helpers.
 */
function ogape_get_contact_email() {
    $email = get_theme_mod( 'ogape_contact_email', 'hola@ogape.com.py' );
    return sanitize_email( apply_filters( 'ogape_contact_email', $email ) );
}

add_filter(
    'show_admin_bar',
    static function( $show ) {
        if ( ! is_user_logged_in() ) {
            return false;
        }

        return $show;
    }
);

/**
 * Resolve the canonical waitlist URL.
 *
 * @return string
 */
function ogape_get_waitlist_url() {
    $waitlist_page = get_page_by_path( 'waitlist' );
    return $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/waitlist/' );
}

// ── ENQUEUE ASSETS ─────────────────────────────────────────
function ogape_enqueue_assets() {

    $tokens_version   = filemtime( get_stylesheet_directory() . '/assets/css/tokens.css' );
    $main_version     = filemtime( get_stylesheet_directory() . '/assets/css/main.css' );
    $patterns_version = filemtime( get_stylesheet_directory() . '/assets/css/components/patterns.css' );
    $script_version   = filemtime( get_stylesheet_directory() . '/assets/js/main.js' );

    $is_future_site   = is_page( 'future-site' );
    $is_menu_page     = is_page( 'menu' );
    $is_register_page = is_page( 'register' );
    $is_account_page  = is_page( 'account' );
    $is_handoff_design = $is_future_site || $is_menu_page || $is_register_page || $is_account_page;

    // 1. Design tokens (must load first — all other CSS depends on these)
    wp_enqueue_style(
        'ogape-tokens',
        get_stylesheet_directory_uri() . '/assets/css/tokens.css',
        array(),
        $tokens_version
    );

    // On handoff-design pages we render a self-contained design (Website-handoff
    // bundle) and skip the theme chrome stylesheets to avoid conflicts.
    if ( ! $is_handoff_design ) {
        // 2. Main stylesheet
        wp_enqueue_style(
            'ogape-main',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            array( 'ogape-tokens' ),
            $main_version
        );

        wp_enqueue_style(
            'ogape-patterns',
            get_stylesheet_directory_uri() . '/assets/css/components/patterns.css',
            array( 'ogape-main' ),
            $patterns_version
        );

        wp_enqueue_style(
            'ogape-production-polish',
            get_stylesheet_directory_uri() . '/assets/css/production-polish.css',
            array( 'ogape-patterns' ),
            filemtime( get_stylesheet_directory() . '/assets/css/production-polish.css' )
        );
    }

    if ( $is_future_site ) {
        wp_enqueue_style(
            'ogape-future-site',
            get_stylesheet_directory_uri() . '/assets/css/future-site.css',
            array( 'ogape-tokens' ),
            filemtime( get_stylesheet_directory() . '/assets/css/future-site.css' )
        );
    }

    if ( $is_menu_page ) {
        wp_enqueue_style(
            'ogape-menu-page',
            get_stylesheet_directory_uri() . '/assets/css/menu-page.css',
            array( 'ogape-tokens' ),
            filemtime( get_stylesheet_directory() . '/assets/css/menu-page.css' )
        );
    }

    if ( $is_register_page ) {
        wp_enqueue_style(
            'ogape-register',
            get_stylesheet_directory_uri() . '/assets/css/register.css',
            array( 'ogape-tokens' ),
            filemtime( get_stylesheet_directory() . '/assets/css/register.css' )
        );
    }

    if ( $is_account_page ) {
        wp_enqueue_style(
            'ogape-account-page',
            get_stylesheet_directory_uri() . '/assets/css/account-page.css',
            array( 'ogape-tokens' ),
            filemtime( get_stylesheet_directory() . '/assets/css/account-page.css' )
        );
        wp_enqueue_script(
            'ogape-account-page',
            get_stylesheet_directory_uri() . '/assets/js/account-page.js',
            array(),
            filemtime( get_stylesheet_directory() . '/assets/js/account-page.js' ),
            array(
                'in_footer' => true,
                'strategy'  => 'defer',
            )
        );
    }

    // 3. Main JavaScript (loaded in footer, deferred)
    wp_enqueue_script(
        'ogape-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        $script_version,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    wp_localize_script(
        'ogape-main',
        'ogapeTheme',
        array(
            'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'ogape_waitlist_submit' ),
            'messages' => array(
                'success'   => __( 'Te anotamos. Te avisaremos cuando lleguemos a tu zona.', 'ogape-child' ),
                'duplicate' => __( 'Ya estabas anotado. Te avisaremos cuando lleguemos a tu zona.', 'ogape-child' ),
                'error'     => __( 'No pudimos procesar tu solicitud. Intentá de nuevo.', 'ogape-child' ),
            ),
        )
    );

    // 4. Google Fonts — Inter + Cormorant Garamond
    wp_enqueue_style(
        'ogape-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&display=swap',
        array(),
        null
    );

}
add_action( 'wp_enqueue_scripts', 'ogape_enqueue_assets' );

/**
 * Add stable body classes for special page shells.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function ogape_body_classes( $classes ) {
    if ( is_page( 'future-site' ) ) {
        $classes[] = 'ogape-future-site-page';
    }

    if ( is_page( 'menu' ) ) {
        $classes[] = 'ogape-menu-page';
    }

    if ( is_page( 'register' ) ) {
        $classes[] = 'ogape-register-page';
    }

    if ( is_page( 'account' ) ) {
        $classes[] = 'ogape-account-page';
    }

    return $classes;
}
add_filter( 'body_class', 'ogape_body_classes' );

// ── THEME SUPPORT ───────────────────────────────────────────
function ogape_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'ogape-child' ),
        'footer'  => __( 'Footer Navigation', 'ogape-child' ),
    ) );
}
add_action( 'after_setup_theme', 'ogape_theme_setup' );

/**
 * Force document language attributes to Spanish (Paraguay).
 *
 * @param string $output Current language attributes.
 * @return string
 */
function ogape_force_language_attributes( $output ) {
    $lang_attr = 'lang="es-PY"';

    if ( false !== strpos( $output, 'lang=' ) ) {
        $output = (string) preg_replace( '/lang="[^"]*"/', $lang_attr, $output, 1 );
    } else {
        $output = trim( $output . ' ' . $lang_attr );
    }

    if ( false !== strpos( $output, 'xml:lang=' ) ) {
        $output = (string) preg_replace( '/xml:lang="[^"]*"/', 'xml:lang="es-PY"', $output, 1 );
    }

    return $output;
}
add_filter( 'language_attributes', 'ogape_force_language_attributes' );

/**
 * Register lightweight theme controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function ogape_customize_register( $wp_customize ) {
    $wp_customize->add_setting(
        'ogape_whatsapp',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ogape_whatsapp',
        array(
            'label'   => __( 'WhatsApp contact (include country code)', 'ogape-child' ),
            'section' => 'title_tagline',
            'type'    => 'text',
        )
    );
}
add_action( 'customize_register', 'ogape_customize_register' );

/**
 * Build a lightweight meta description for head tags.
 *
 * Priority:
 * 1) explicit page meta/description keys if present
 * 2) excerpt
 * 3) trimmed content
 * 4) site-level fallback
 *
 * @return string
 */
function ogape_get_meta_description() {
    $site_fallback = wp_strip_all_tags( (string) get_bloginfo( 'description' ) );
    $strong_fallback = __(
        'Ogape trae kits de comida fresca con recetas de chefs directo a tu puerta en Asunción, Paraguay. Unite a la lista de espera.',
        'ogape-child'
    );

    $fallback_length = function_exists( 'mb_strlen' ) ? mb_strlen( trim( $site_fallback ) ) : strlen( trim( $site_fallback ) );
    if ( $fallback_length < 70 ) {
        $site_fallback = $strong_fallback;
    }

    if ( ! is_singular() ) {
        return wp_strip_all_tags( $site_fallback );
    }

    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return wp_strip_all_tags( $site_fallback );
    }

    $meta_keys = array(
        'ogape_meta_description',
        '_ogape_meta_description',
        '_yoast_wpseo_metadesc',
        '_aioseo_description',
    );

    foreach ( $meta_keys as $meta_key ) {
        $meta_value = get_post_meta( $post_id, $meta_key, true );
        if ( is_string( $meta_value ) && '' !== trim( $meta_value ) ) {
            return wp_strip_all_tags( $meta_value );
        }
    }

    $excerpt = get_post_field( 'post_excerpt', $post_id );
    if ( is_string( $excerpt ) && '' !== trim( $excerpt ) ) {
        return wp_strip_all_tags( $excerpt );
    }

    $content = get_post_field( 'post_content', $post_id );
    if ( is_string( $content ) && '' !== trim( $content ) ) {
        return wp_trim_words( wp_strip_all_tags( strip_shortcodes( $content ) ), 28, '…' );
    }

    return wp_strip_all_tags( $site_fallback );
}

/**
 * Resolve a default Open Graph image for sharing previews.
 *
 * @return string
 */
function ogape_get_default_og_image_url() {
    $site_icon_id = (int) get_option( 'site_icon' );
    if ( $site_icon_id > 0 ) {
        $site_icon_url = wp_get_attachment_image_url( $site_icon_id, 'full' );
        if ( $site_icon_url ) {
            return $site_icon_url;
        }
    }

    return get_stylesheet_directory_uri() . '/assets/img/og-default.jpg';
}

/**
 * Print lightweight SEO/social meta tags in <head>.
 */
function ogape_output_social_meta_tags() {
    if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
        return;
    }

    global $wp;

    $title       = wp_get_document_title();
    $description = ogape_get_meta_description();
    $request_uri = '/';

    if ( is_front_page() || is_page( 'waitlist' ) ) {
        $title       = __( 'Ogape — Tu Chef en Casa | Lista de Espera', 'ogape-child' );
        $description = __( 'Sumate a la lista de espera de Ogape y sé el primero en saber cuándo abrimos en tu barrio de Asunción.', 'ogape-child' );
    }
    if ( isset( $wp ) && isset( $wp->request ) && '' !== $wp->request ) {
        $request_uri = '/' . ltrim( trailingslashit( $wp->request ), '/' );
    }

    $url      = is_singular() ? get_permalink() : home_url( $request_uri );
    $og_type     = is_singular( 'post' ) ? 'article' : 'website';
    $og_image    = ogape_get_default_og_image_url();

    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = get_the_post_thumbnail_url( get_queried_object_id(), 'full' );
    }

    echo "\n" . '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";

    if ( $og_image ) {
        echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
    } else {
        echo '<meta name="twitter:card" content="summary">' . "\n";
    }
}
add_action( 'wp_head', 'ogape_output_social_meta_tags', 5 );

/**
 * Keep singular document titles aligned with stored post/page titles.
 *
 * Helps preserve accented characters from the WordPress title source.
 *
 * @param array $parts Document title parts.
 * @return array
 */
function ogape_document_title_parts( $parts ) {
    if ( is_singular() ) {
        $singular_title = single_post_title( '', false );
        if ( is_string( $singular_title ) && '' !== trim( $singular_title ) ) {
            $parts['title'] = $singular_title;
        }
    }

    return $parts;
}
add_filter( 'document_title_parts', 'ogape_document_title_parts' );

/**
 * Keep production focused on the waitlist funnel.
 */
function ogape_redirect_non_waitlist_pages() {
    global $pagenow;

    if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }

    if ( 'wp-login.php' === $pagenow ) {
        return;
    }

    if ( is_feed() || is_robots() || is_trackback() ) {
        return;
    }

    $request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
    $request_path = is_string( $request_path ) ? trim( $request_path, '/' ) : '';

    $allowed_paths = array(
        '',
        'waitlist',
        'future-site',
        'planes',
        'nosotros',
        'menu',
        'como-funciona',
        'tarjetas-regalo',
        'sostenibilidad',
        'alianzas',
        'cobertura',
        'contacto',
        'mision',
        'login',
        'register',
        'forgot-password',
        'account',
        'account-setup',
        'faq',
        'privacidad',
        'terminos',
    );

    if ( is_front_page() || is_home() || is_page( 'future-site' ) ) {
        return;
    }

    if ( in_array( $request_path, $allowed_paths, true ) ) {
        return;
    }

    if ( is_page() || is_singular() || is_archive() || is_search() || is_404() ) {
        wp_safe_redirect( ogape_get_waitlist_url(), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'ogape_redirect_non_waitlist_pages' );


/**
 * Force specific public slugs to render known page templates even if WP pages are missing.
 * Temporary bridge for production while content-layer pages are not registered.
 */
function ogape_render_virtual_theme_page() {
    if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }

    $request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
    $request_path = is_string( $request_path ) ? trim( $request_path, '/' ) : '';

    $virtual_templates = array(
        'planes'           => 'page-planes.php',
        'tarjetas-regalo'  => 'page-tarjetas-regalo.php',
        'sostenibilidad'   => 'page-sostenibilidad.php',
        'alianzas'         => 'page-alianzas.php',
    );

    if ( ! isset( $virtual_templates[ $request_path ] ) ) {
        return;
    }

    if ( is_page() || is_singular() ) {
        return;
    }

    $template = locate_template( $virtual_templates[ $request_path ] );
    if ( ! $template ) {
        return;
    }

    status_header( 200 );
    nocache_headers();
    include $template;
    exit;
}
add_action( 'template_redirect', 'ogape_render_virtual_theme_page', 0 );


/**
 * Demo account helpers for test-ready future-site account flow.
 */
function ogape_get_demo_account_key() {
    return 'ogape_demo_account';
}

function ogape_get_demo_account_state() {
    $state = isset( $_COOKIE[ ogape_get_demo_account_key() ] ) ? wp_unslash( $_COOKIE[ ogape_get_demo_account_key() ] ) : '';
    if ( ! is_string( $state ) || '' === $state ) {
        return array();
    }

    $decoded = json_decode( base64_decode( $state ), true );
    return is_array( $decoded ) ? $decoded : array();
}

function ogape_set_demo_account_state( $state ) {
    if ( ! is_array( $state ) ) {
        $state = array();
    }

    $encoded = base64_encode( wp_json_encode( $state ) );
    setcookie( ogape_get_demo_account_key(), $encoded, time() + ( 30 * DAY_IN_SECONDS ), COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true );
    $_COOKIE[ ogape_get_demo_account_key() ] = $encoded;
}

function ogape_clear_demo_account_state() {
    setcookie( ogape_get_demo_account_key(), '', time() - HOUR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true );
    unset( $_COOKIE[ ogape_get_demo_account_key() ] );
}

function ogape_demo_plan_prices() {
    return array(
        '2-2' => 195000,
        '2-3' => 285000,
        '2-4' => 370000,
        '2-5' => 445000,
        '4-2' => 360000,
        '4-3' => 530000,
        '4-4' => 685000,
        '4-5' => 820000,
    );
}

function ogape_demo_format_price( $amount ) {
    return 'Gs ' . number_format( (int) $amount, 0, ',', '.' );
}

function ogape_demo_plan_from_state( $state ) {
    $people  = isset( $state['people'] ) ? (string) absint( $state['people'] ) : '2';
    $recipes = isset( $state['recipes'] ) ? (string) absint( $state['recipes'] ) : '3';

    if ( ! in_array( $people, array( '2', '4' ), true ) ) {
        $people = '2';
    }
    if ( ! in_array( $recipes, array( '2', '3', '4', '5' ), true ) ) {
        $recipes = '3';
    }

    $prices = ogape_demo_plan_prices();
    $price  = $prices[ $people . '-' . $recipes ] ?? $prices['2-3'];

    return array(
        'people'        => $people,
        'recipes'       => $recipes,
        'label'         => sprintf( 'Para %1$s · %2$s recetas', $people, $recipes ),
        'people_label'  => sprintf( '%s personas', $people ),
        'recipes_label' => sprintf( '%s por semana', $recipes ),
        'price'         => $price,
        'price_display' => ogape_demo_format_price( $price ),
    );
}

function ogape_demo_date_words() {
    return array(
        'days'   => array( 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ),
        'months' => array( 1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ),
    );
}

function ogape_demo_format_date_label( DateTimeImmutable $date, $include_year = false ) {
    $words = ogape_demo_date_words();
    $label = ucfirst( $words['days'][ (int) $date->format( 'w' ) ] ) . ' ' . $date->format( 'j' ) . ' de ' . $words['months'][ (int) $date->format( 'n' ) ];

    if ( $include_year ) {
        $label .= ' · ' . $date->format( 'Y' );
    }

    return $label;
}

function ogape_demo_format_short_date_label( DateTimeImmutable $date ) {
    $words = ogape_demo_date_words();
    return ucfirst( $words['days'][ (int) $date->format( 'w' ) ] ) . ' ' . $date->format( 'j' ) . ' · ' . ucfirst( $words['months'][ (int) $date->format( 'n' ) ] );
}

function ogape_demo_schedule() {
    $timezone = wp_timezone();
    $today    = new DateTimeImmutable( 'today', $timezone );
    $delivery = $today->modify( 'next thursday' );
    $cutoff   = $delivery->modify( '-2 days' )->setTime( 23, 59 );
    $next     = $delivery->modify( '+7 days' );
    $resume   = $next->modify( '+7 days' );
    $two_week_resume = $next->modify( '+14 days' );

    return array(
        'delivery'                 => $delivery,
        'cutoff'                   => $cutoff,
        'next_delivery'            => $next,
        'resume_delivery'          => $resume,
        'two_week_resume_delivery' => $two_week_resume,
        'delivery_label'           => ogape_demo_format_date_label( $delivery ),
        'delivery_label_with_year' => ogape_demo_format_date_label( $delivery, true ),
        'delivery_short_label'     => ogape_demo_format_short_date_label( $delivery ),
        'delivery_numeric'         => $delivery->format( 'd/m/Y' ),
        'cutoff_label'             => ogape_demo_format_date_label( $cutoff ),
        'next_label'               => ogape_demo_format_date_label( $next ),
        'next_label_with_year'     => ogape_demo_format_date_label( $next, true ),
        'resume_label'             => ogape_demo_format_date_label( $resume ),
        'two_week_resume_label'    => ogape_demo_format_date_label( $two_week_resume ),
        'cutoff_time'              => $cutoff->format( 'H:i' ),
    );
}

function ogape_demo_preference_labels() {
    return array(
        'sin-pescado'     => 'Sin pescado',
        'sin-carne-roja'  => 'Sin carne roja',
        'vegetariano'     => 'Vegetariano',
        'sin-gluten'      => 'Sin gluten',
        'sin-lacteos'     => 'Sin lácteos',
        'picante-ok'      => 'Me gusta picante',
        'rapido'          => 'Menos de 25 min',
    );
}

function ogape_sanitize_demo_preferences( $raw_preferences ) {
    $raw_preferences = is_array( $raw_preferences ) ? $raw_preferences : array();
    $labels          = ogape_demo_preference_labels();
    $preferences     = array();

    foreach ( $raw_preferences as $raw_preference ) {
        $key = sanitize_key( wp_unslash( $raw_preference ) );
        if ( isset( $labels[ $key ] ) ) {
            $preferences[] = $labels[ $key ];
        }
    }

    return array_values( array_unique( $preferences ) );
}

function ogape_get_demo_account_context() {
    $state    = ogape_get_demo_account_state();
    $plan     = ogape_demo_plan_from_state( $state );
    $schedule = ogape_demo_schedule();

    $name       = ! empty( $state['name'] ) ? sanitize_text_field( $state['name'] ) : 'María Benítez';
    $email      = ! empty( $state['email'] ) ? sanitize_email( $state['email'] ) : 'maria@correo.com.py';
    $phone      = ! empty( $state['phone'] ) ? sanitize_text_field( $state['phone'] ) : '+595 981 000 000';
    $zone       = ! empty( $state['zone'] ) ? sanitize_text_field( $state['zone'] ) : 'Villa Morra';
    $address    = ! empty( $state['address'] ) ? sanitize_text_field( $state['address'] ) : 'Av. Mcal. López 1234';
    $apt        = ! empty( $state['apt'] ) ? sanitize_text_field( $state['apt'] ) : '5B';
    $notes      = ! empty( $state['notes'] ) ? sanitize_text_field( $state['notes'] ) : '';
    $window     = ! empty( $state['delivery_window_label'] ) ? sanitize_text_field( $state['delivery_window_label'] ) : 'Tarde · 14:00 – 19:00';
    $preference = ! empty( $state['preference'] ) ? sanitize_text_field( $state['preference'] ) : 'Sin preferencia cargada';

    $preferences = array();
    if ( ! empty( $state['preferences'] ) && is_array( $state['preferences'] ) ) {
        $preferences = array_map( 'sanitize_text_field', $state['preferences'] );
    } elseif ( ! empty( $state['preference'] ) ) {
        $preferences = array( $preference );
    }

    $parts      = preg_split( '/\s+/', trim( $name ) );
    $first_name = $parts[0] ?? 'María';
    $last_name  = count( $parts ) > 1 ? implode( ' ', array_slice( $parts, 1 ) ) : '';
    $initials   = implode(
        '',
        array_slice(
            array_map(
                static function ( $word ) {
                    return strtoupper( mb_substr( $word, 0, 1 ) );
                },
                array_filter( $parts )
            ),
            0,
            2
        )
    );

    if ( '' === $initials ) {
        $initials = 'MB';
    }

    $delivery_line_address = trim( $address . ( $apt ? ', ' . $apt : '' ) );
    $referral_seed         = sanitize_title( $first_name ?: 'cliente' );
    $referral_code         = strtoupper( remove_accents( $referral_seed ) ) . '-' . wp_date( 'Y', null, wp_timezone() );

    return array(
        'state'                 => $state,
        'name'                  => $name,
        'first_name'            => $first_name,
        'last_name'             => $last_name,
        'initials'              => $initials,
        'email'                 => $email,
        'phone'                 => $phone,
        'zone'                  => $zone,
        'zone_key'              => ! empty( $state['zone_key'] ) ? sanitize_key( $state['zone_key'] ) : sanitize_title( $zone ),
        'address'               => $address,
        'apt'                   => $apt,
        'delivery_line_address' => $delivery_line_address,
        'delivery_window'       => $window,
        'notes'                 => $notes,
        'preference'            => $preference,
        'preferences'           => $preferences,
        'preferences_label'     => $preferences ? implode( ' · ', $preferences ) : 'Sin preferencias marcadas',
        'allergies'             => ! empty( $state['allergies'] ) ? sanitize_text_field( $state['allergies'] ) : '',
        'comms'                 => ! empty( $state['comms'] ),
        'setup_complete'        => ! empty( $state['setup_complete'] ),
        'referral_code'         => $referral_code,
        'plan'                  => $plan,
        'schedule'              => $schedule,
    );
}

function ogape_handle_demo_account_flow() {
    if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
        return;
    }

    $request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
    $request_path = is_string( $request_path ) ? trim( $request_path, '/' ) : '';

    $handled_paths = array( 'register', 'login', 'account-setup' );
    if ( ! in_array( $request_path, $handled_paths, true ) ) {
        return;
    }

    if ( ! isset( $_POST['ogape_demo_action'], $_POST['ogape_demo_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_demo_nonce'] ) ), 'ogape_demo_account_flow' ) ) {
        return;
    }

    $action = sanitize_text_field( wp_unslash( $_POST['ogape_demo_action'] ) );
    $state  = ogape_get_demo_account_state();

    if ( 'register' === $action ) {
        $first_name = sanitize_text_field( wp_unslash( $_POST['first_name'] ?? '' ) );
        $last_name  = sanitize_text_field( wp_unslash( $_POST['last_name'] ?? '' ) );
        $email      = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
        $password   = (string) wp_unslash( $_POST['password'] ?? '' );

        if ( '' === $first_name || '' === $last_name || '' === $email || strlen( $password ) < 8 ) {
            wp_safe_redirect( add_query_arg( 'demo_error', 'missing', home_url( '/register/' ) ) );
            exit;
        }

        $people  = isset( $_POST['people'] ) ? (string) absint( wp_unslash( $_POST['people'] ) ) : '2';
        $recipes = isset( $_POST['recipes'] ) ? (string) absint( wp_unslash( $_POST['recipes'] ) ) : '3';
        $plan    = ogape_demo_plan_from_state(
            array(
                'people'  => $people,
                'recipes' => $recipes,
            )
        );

        $state['name']                  = trim( $first_name . ' ' . $last_name );
        $state['email']                 = $email;
        $state['phone']                 = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
        $state['people']                = $plan['people'];
        $state['recipes']               = $plan['recipes'];
        $state['plan']                  = $plan['label'];
        $state['price']                 = $plan['price'];
        $state['zone_key']              = sanitize_key( wp_unslash( $_POST['zone_key'] ?? '' ) );
        $state['zone']                  = sanitize_text_field( wp_unslash( $_POST['zone'] ?? '' ) );
        $state['address']               = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
        $state['apt']                   = sanitize_text_field( wp_unslash( $_POST['apt'] ?? '' ) );
        $state['delivery_window']       = sanitize_key( wp_unslash( $_POST['delivery_window'] ?? 'pm' ) );
        $state['delivery_window_label'] = sanitize_text_field( wp_unslash( $_POST['delivery_window_label'] ?? '' ) );
        $state['notes']                 = sanitize_text_field( wp_unslash( $_POST['notes'] ?? '' ) );
        $state['preferences']           = ogape_sanitize_demo_preferences( $_POST['preferences'] ?? array() );
        $state['preference']            = $state['preferences'] ? implode( ' · ', $state['preferences'] ) : '';
        $state['allergies']             = sanitize_text_field( wp_unslash( $_POST['allergies'] ?? '' ) );
        $state['comms']                 = isset( $_POST['comms'] );
        $state['setup_complete']        = false;
        $state['registered_at']         = wp_date( DATE_ATOM, null, wp_timezone() );
        ogape_set_demo_account_state( $state );
        wp_safe_redirect( add_query_arg( array( 'demo' => 'register', 'source' => 'register' ), home_url( '/account-setup/' ) ) );
        exit;
    }

    if ( 'login' === $action ) {
        $email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
        if ( $email ) {
            $state['email'] = $email;
        }
        if ( empty( $state['name'] ) ) {
            $state['name'] = __( 'Cliente de prueba', 'ogape-child' );
        }
        if ( empty( $state['plan'] ) ) {
            $state['people'] = '2';
            $state['recipes'] = '3';
            $state['plan'] = ogape_demo_plan_from_state( $state )['label'];
        }
        ogape_set_demo_account_state( $state );
        wp_safe_redirect( add_query_arg( array( 'demo' => 'login', 'source' => 'login' ), home_url( '/account/' ) ) );
        exit;
    }

    if ( 'account-setup' === $action ) {
        $state['zone']       = sanitize_text_field( wp_unslash( $_POST['zone'] ?? '' ) );
        $state['address']    = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
        $state['preference'] = sanitize_text_field( wp_unslash( $_POST['preference'] ?? '' ) );
        $state['notes']      = sanitize_text_field( wp_unslash( $_POST['notes'] ?? '' ) );
        if ( ! empty( $state['preference'] ) ) {
            $state['preferences'] = array( $state['preference'] );
        }
        $state['setup_complete'] = true;
        ogape_set_demo_account_state( $state );
        wp_safe_redirect( add_query_arg( array( 'setup' => 'complete', 'source' => 'account-setup' ), home_url( '/account/' ) ) );
        exit;
    }
}
add_action( 'template_redirect', 'ogape_handle_demo_account_flow', 1 );

// ── REMOVE UNNECESSARY WP BLOAT ─────────────────────────────
remove_action( 'wp_head', 'wp_generator' );           // Hide WP version
remove_action( 'wp_head', 'wlwmanifest_link' );       // Remove Windows Live Writer link
remove_action( 'wp_head', 'rsd_link' );               // Remove RSD link
remove_action( 'wp_head', 'wp_shortlink_wp_head' );   // Remove shortlink
