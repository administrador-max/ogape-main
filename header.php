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

    <?php $join_url = '#waitlist-form'; ?>

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

                <div class="nav__actions">
                    <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                </div>

            </div><!-- .nav__inner -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
