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

    // 1. Design tokens (must load first — all other CSS depends on these)
    wp_enqueue_style(
        'ogape-tokens',
        get_stylesheet_directory_uri() . '/assets/css/tokens.css',
        array(),
        $tokens_version
    );

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

// ── REMOVE UNNECESSARY WP BLOAT ─────────────────────────────
remove_action( 'wp_head', 'wp_generator' );           // Hide WP version
remove_action( 'wp_head', 'wlwmanifest_link' );       // Remove Windows Live Writer link
remove_action( 'wp_head', 'rsd_link' );               // Remove RSD link
remove_action( 'wp_head', 'wp_shortlink_wp_head' );   // Remove shortlink
