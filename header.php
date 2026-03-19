<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Saltar al contenido', 'ogape-child' ); ?></a>

<div id="page" class="site">

    <?php
    $menu_page          = get_page_by_path( 'menu' );
    $faq_page           = get_page_by_path( 'faq' );
    $how_it_works_page  = get_page_by_path( 'como-funciona' );
    $waitlist_page      = get_page_by_path( 'waitlist' );
    $how_it_works_url   = $how_it_works_page ? get_permalink( $how_it_works_page ) : home_url( '/#features' );
    $menu_url           = $menu_page ? get_permalink( $menu_page ) : home_url( '/#menu' );
    $faq_url            = $faq_page ? get_permalink( $faq_page ) : home_url( '/#faq' );
    $join_url           = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );

    $header_links = array(
        array(
            'label' => __( 'Cómo funciona', 'ogape-child' ),
            'url'   => $how_it_works_url,
        ),
        array(
            'label' => __( 'Menú', 'ogape-child' ),
            'url'   => $menu_url,
        ),
        array(
            'label' => __( 'Preguntas frecuentes', 'ogape-child' ),
            'url'   => $faq_url,
        ),
    );
    ?>

    <!-- Background canvas (decorative orbs — matches waitlist page) -->
    <div class="bg-canvas" aria-hidden="true">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <!-- Primary Navigation -->
    <header id="masthead" class="nav" role="banner">
        <div class="container">
            <div class="nav__inner">

                <!-- Logo -->
                <div class="nav__logo">
                    <?php ogape_render_logo(); ?>
                </div>

                <!-- Desktop Navigation -->
                <nav class="nav__links" aria-label="Navegación principal">
                    <ul class="nav__menu">
                        <?php foreach ( $header_links as $link ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $link['url'] ); ?>">
                                    <?php echo esc_html( $link['label'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <!-- CTA Button -->
                <div class="nav__actions">
                    <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                </div>

                <!-- Mobile Hamburger -->
                <button type="button" class="nav__hamburger" aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                </button>

            </div><!-- .nav__inner -->
        </div><!-- .container -->

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="nav__mobile-menu" aria-hidden="true">
            <nav aria-label="Navegación móvil">
                <ul class="nav__mobile-links">
                    <?php foreach ( $header_links as $link ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $link['url'] ); ?>">
                                <?php echo esc_html( $link['label'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--lg nav__mobile-cta">Unirme</a>
            </nav>
        </div>

    </header><!-- #masthead -->

    <div id="content" class="site-content">
