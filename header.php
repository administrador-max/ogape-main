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
    $join_url          = '#waitlist-form';
    $login_url         = home_url( '/login/' );
    $account_url       = home_url( '/account/' );
    $logout_url        = home_url( '/login/' );
    $future_site_url   = home_url( '/future-site/' );
    $official_nav_mode = is_page( 'future-site' ) || is_page( 'login' ) || is_page( 'register' ) || is_page( 'forgot-password' ) || is_page( 'account-setup' ) || is_page( 'account' );
    $account_demo_mode = is_page( 'account' ) || is_page( 'account-setup' );
    $nav_links         = array(
        array( 'label' => 'Planes',          'url' => $future_site_url . '#planes' ),
        array( 'label' => 'Nosotros',        'url' => home_url( '/nosotros/' ) ),
        array( 'label' => 'Menús',           'url' => home_url( '/menu/' ) ),
        array( 'label' => 'Kits',            'url' => home_url( '/como-funciona/' ) ),
        array( 'label' => 'Tarjetas regalo', 'url' => $future_site_url . '#gift-cards' ),
        array( 'label' => 'Sostenibilidad',  'url' => home_url( '/sostenibilidad/' ) ),
        array( 'label' => 'Alianzas',        'url' => home_url( '/alianzas/' ) ),
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

                <div class="nav__logo-wrap">
                    <div class="nav__logo">
                        <?php ogape_render_logo(); ?>
                    </div>
                    <p class="nav__tagline"><?php esc_html_e( 'Comida fresca, local y bien pensada.', 'ogape-child' ); ?></p>
                </div>

                <?php if ( $official_nav_mode ) : ?>
                    <nav class="nav__links" aria-label="Primary">
                        <ul class="nav__menu">
                            <?php foreach ( $nav_links as $nav_item ) : ?>
                                <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>

                    <div class="nav__actions">
                        <?php if ( $account_demo_mode ) : ?>
                            <a href="<?php echo esc_url( $account_url ); ?>?fresh=1" class="btn btn--primary btn--sm">Cuenta</a>
                            <a href="<?php echo esc_url( $logout_url ); ?>?fresh=1" class="nav__logout-link">Cerrar sesión</a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $login_url ); ?>" class="nav__login-link">Iniciar sesión</a>
                            <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                        <?php endif; ?>
                    </div>

                    <button class="nav__hamburger" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                        <span class="hamburger__line"></span>
                        <span class="hamburger__line"></span>
                        <span class="hamburger__line"></span>
                    </button>
                <?php else : ?>
                    <div class="nav__actions">
                        <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                    </div>
                <?php endif; ?>

            </div><!-- .nav__inner -->

            <?php if ( $official_nav_mode ) : ?>
                <div id="mobile-menu" class="nav__mobile-menu" aria-hidden="true">
                    <ul class="nav__mobile-links">
                        <?php foreach ( $nav_links as $nav_item ) : ?>
                            <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                        <?php endforeach; ?>
                        <?php if ( $account_demo_mode ) : ?>
                            <li><a href="<?php echo esc_url( $account_url ); ?>?fresh=1">Cuenta</a></li>
                            <li><a href="<?php echo esc_url( $logout_url ); ?>?fresh=1">Cerrar sesión</a></li>
                        <?php else : ?>
                            <li><a href="<?php echo esc_url( $login_url ); ?>">Iniciar sesión</a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if ( ! $account_demo_mode ) : ?>
                        <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm nav__mobile-cta">Unirme</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
