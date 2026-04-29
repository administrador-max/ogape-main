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
    $join_url          = is_front_page() ? '#waitlist-form' : ogape_get_waitlist_url();
    $login_url         = home_url( '/login/' );
    $account_url       = home_url( '/account/' );
    $logout_url        = function_exists( 'ogape_get_logout_url' ) ? ogape_get_logout_url() : home_url( '/future-site/' );
    $future_site_url   = home_url( '/future-site/' );
    $official_nav_mode = true;
    $is_logged_in      = is_user_logged_in();
    $header_account_context = $is_logged_in && function_exists( 'ogape_get_demo_account_context' )
        ? ogape_get_demo_account_context()
        : array();
    $header_first_name = $header_account_context['first_name'] ?? '';
    $header_name       = $header_account_context['name'] ?? '';
    $header_email      = $header_account_context['email'] ?? '';
    $header_initials   = $header_account_context['initials'] ?? '';
    $nav_links         = array(
        array( 'label' => 'Planes',          'url' => home_url( '/planes/' ) ),
        array( 'label' => 'Nosotros',        'url' => home_url( '/nosotros/' ) ),
        array( 'label' => 'Menús',           'url' => home_url( '/menu/' ) ),
        array( 'label' => 'Kits',            'url' => home_url( '/como-funciona/' ) ),
        array( 'label' => 'Tarjetas regalo', 'url' => home_url( '/tarjetas-regalo/' ) ),
        array( 'label' => 'Sostenibilidad',  'url' => home_url( '/sostenibilidad/' ) ),
        array( 'label' => 'Alianzas',        'url' => home_url( '/alianzas/' ) ),
    );
    ?>

    <!-- Primary Navigation -->
    <header id="masthead" class="nav" role="banner">
        <div class="container nav__inner">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__brand" aria-label="Ogape · inicio">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg' ); ?>" alt="">
                <span>
                    <span class="wordmark">Ogape</span>
                    <span class="where">Tu Chef en Casa</span>
                </span>
            </a>

            <nav aria-label="Primary">
                <ul class="nav__links">
                    <?php foreach ( $nav_links as $nav_item ) : ?>
                        <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="nav__right">
                <?php if ( $is_logged_in ) : ?>
                    <div class="nav__user">
                        <button class="avatar-btn" id="siteAvatarBtn" type="button" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar"><?php echo esc_html( $header_initials ); ?></span>
                            <span class="name"><?php echo esc_html( $header_first_name ); ?></span>
                            <svg class="chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l4 4 4-4"/></svg>
                        </button>
                        <div class="user-menu" id="siteUserMenu" role="menu">
                            <div class="user-menu__head">
                                <div class="uname"><?php echo esc_html( $header_name ); ?></div>
                                <div class="email"><?php echo esc_html( $header_email ); ?></div>
                            </div>
                            <a href="<?php echo esc_url( $account_url ); ?>" class="umenu-item" role="menuitem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                Mi caja
                            </a>
                            <div class="umenu-sep"></div>
                            <a href="<?php echo esc_url( $logout_url ); ?>" class="umenu-item is-danger" role="menuitem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Cerrar sesión
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url( $login_url ); ?>" class="nav__signin">Iniciar sesión</a>
                    <a href="<?php echo esc_url( $join_url ); ?>" class="nav__cta">Unirme</a>
                <?php endif; ?>
            </div>

            <button class="nav__hamburger" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </button>

        </div><!-- .container.nav__inner -->

        <div id="mobile-menu" class="nav__mobile-menu" aria-hidden="true">
            <ul class="nav__mobile-links">
                <?php foreach ( $nav_links as $nav_item ) : ?>
                    <li><a href="<?php echo esc_url( $nav_item['url'] ); ?>"><?php echo esc_html( $nav_item['label'] ); ?></a></li>
                <?php endforeach; ?>
                <?php if ( $is_logged_in ) : ?>
                    <li><a href="<?php echo esc_url( $account_url ); ?>">Mi caja</a></li>
                    <li><a href="<?php echo esc_url( $logout_url ); ?>">Cerrar sesión</a></li>
                <?php else : ?>
                    <li><a href="<?php echo esc_url( $login_url ); ?>">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
            <?php if ( ! $is_logged_in ) : ?>
                <a href="<?php echo esc_url( $join_url ); ?>" class="nav__cta nav__mobile-cta">Unirme</a>
            <?php endif; ?>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
