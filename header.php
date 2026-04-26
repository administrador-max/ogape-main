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
    $logout_url        = wp_logout_url( add_query_arg( 'fresh', '1', $login_url ) );
    $future_site_url   = home_url( '/future-site/' );
    $official_nav_mode = is_page( 'future-site' ) || is_page( 'login' ) || is_page( 'register' ) || is_page( 'forgot-password' ) || is_page( 'elegir-menu' ) || is_page( 'account' );
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
                        <?php if ( $is_logged_in ) : ?>
                            <div class="nav__user">
                                <button class="nav__notif" type="button" aria-label="Notificaciones">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                                    <span class="badge"></span>
                                </button>
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
                        <?php if ( $is_logged_in ) : ?>
                            <div class="nav__user">
                                <button class="nav__notif" type="button" aria-label="Notificaciones">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                                    <span class="badge"></span>
                                </button>
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
                            <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm">Unirme</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div><!-- .nav__inner -->

            <?php if ( $official_nav_mode ) : ?>
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
                        <a href="<?php echo esc_url( $join_url ); ?>" class="btn btn--primary btn--sm nav__mobile-cta">Unirme</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
