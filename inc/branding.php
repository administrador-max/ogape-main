<?php
/**
 * inc/branding.php
 * Central branding helpers: asset URIs, logo rendering, whatsapp URL helper.
 */

if ( ! function_exists( 'ogape_get_brand_asset_uri' ) ) {
    function ogape_get_brand_asset_uri( $name ) {
        return get_stylesheet_directory_uri() . '/assets/img/' . ltrim( $name, '/' );
    }
}

if ( ! function_exists( 'ogape_render_logo' ) ) {
    function ogape_render_logo( $args = array() ) {
        unset( $args );

        $logo_label = esc_attr__( 'Ogape', 'ogape-child' );

        if ( has_custom_logo() ) {
            $custom_logo_id = (int) get_theme_mod( 'custom_logo' );

            if ( $custom_logo_id > 0 ) {
                $logo_image = wp_get_attachment_image(
                    $custom_logo_id,
                    'full',
                    false,
                    array(
                        'class' => 'custom-logo',
                        'alt'   => $logo_label,
                    )
                );

                if ( $logo_image ) {
                    printf(
                        '<div class="site-logo-wrapper"><a href="%1$s" class="custom-logo-link" rel="home" aria-label="%2$s">%3$s</a></div>',
                        esc_url( home_url( '/' ) ),
                        $logo_label,
                        $logo_image
                    );
                    return;
                }
            }
        }

        $logo_uri     = ogape_get_brand_asset_uri( 'ogape-logo.svg' );

        printf(
            '<a class="site-logo" href="%1$s" aria-label="%2$s"><img src="%3$s" alt="%2$s" width="240" height="80"></a>',
            esc_url( home_url( '/' ) ),
            $logo_label,
            esc_url( $logo_uri )
        );
    }
}

if ( ! function_exists( 'ogape_get_whatsapp_display' ) ) {
    function ogape_get_whatsapp_display() {
        $raw = trim( (string) get_theme_mod( 'ogape_whatsapp', '' ) );

        if ( '' === $raw ) {
            $raw = '+595 0000';
        }

        return trim( preg_replace( '/\s+/', ' ', (string) $raw ) );
    }
}

if ( ! function_exists( 'ogape_get_whatsapp_url' ) ) {
    function ogape_get_whatsapp_url() {
        $raw = trim( (string) get_theme_mod( 'ogape_whatsapp', '' ) );

        if ( '' === $raw ) {
            $raw = '+595 0000';
        }

        $digits = preg_replace( '/\D+/', '', $raw );

        if ( ! $digits ) {
            return '';
        }

        return 'https://wa.me/' . $digits;
    }
}
