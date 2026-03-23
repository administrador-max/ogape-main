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
    $join_url    = '#waitlist-form';
    $login_url   = home_url( '/login/' );
    $nav_links   = array(
        array( 'label' => 'Our Plans',      'url' => home_url( '/plans/' ) ),
        array( 'label' => 'About Us',       'url' => home_url( '/about/' ) ),
        array( 'label' => 'Our Menus',      'url' => home_url( '/menus/' ) ),
        array( 'label' => 'Our Meal Kits',  'url' => home_url( '/meal-kits/' ) ),
        array( 'label' => 'Gift Cards',     'url' => home_url( '/gift-cards/' ) ),
        array( 'label' => 'Sustainability', 'url' => home_url( '/sustainability/' ) ),
        array( 'label' => 'Partnerships',   'url' => home_url( '/partnerships/' ) ),
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

                <nav class="nav__links" aria-label="Primary">
                    <ul class="nav__menu">
                        <?php foreach ( $nav_links as $nav_item ) : ?>
                            <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <div class="nav__actions">
                    <a href="<?php echo esc_url( $login_url ); ?>" class="nav__login-link">Log in</a>
                    <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                </div>

                <button class="nav__hamburger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                </button>

            </div><!-- .nav__inner -->

            <div id="mobile-menu" class="nav__mobile-menu" aria-hidden="true">
                <ul class="nav__mobile-links">
                    <?php foreach ( $nav_links as $nav_item ) : ?>
                        <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="<?php echo esc_url( $login_url ); ?>">Log in</a></li>
                </ul>
                <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm nav__mobile-cta">Unirme</a>
            </div>
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
