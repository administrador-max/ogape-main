<?php
/**
 * Template Name: Login
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/account/' ) );
    exit;
}

$login_error = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ogape_login_nonce'] ) ) {
    $result = ogape_process_login();
    if ( is_wp_error( $result ) ) {
        $login_error = $result->get_error_message();
    } else {
        wp_safe_redirect( home_url( '/account/' ) );
        exit;
    }
}

get_header();

$register_url        = home_url( '/register/' );
$forgot_password_url = home_url( '/forgot-password/' );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Cuenta Ogape', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Iniciá sesión en una cuenta pensada para pedidos, preferencias y continuidad.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Desde acá podés acceder a pedidos, suscripciones, direcciones guardadas, preferencias y tarjetas regalo.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Acceso simple y claro', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Diseñado para continuidad de cliente', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Cuenta, catálogo y gifting unidos', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-entry-shell account-entry-shell--login">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Acceso a cuenta', 'ogape-child' ); ?></h3>
                        </div>

                        <form class="account-entry-form" method="post" action="">
                            <?php wp_nonce_field( 'ogape_login', 'ogape_login_nonce' ); ?>

                            <?php if ( $login_error ) : ?>
                                <p class="account-entry-form__error" role="alert"><?php echo esc_html( $login_error ); ?></p>
                            <?php endif; ?>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" name="email" placeholder="nombre@ejemplo.com"
                                    autocomplete="email" required
                                    value="<?php echo esc_attr( sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ) ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></span>
                                <input type="password" name="password" placeholder="••••••••"
                                    autocomplete="current-password" required>
                            </label>

                            <button type="submit" class="btn btn--primary btn--md account-entry-form__button">
                                <?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $forgot_password_url ); ?>"><?php esc_html_e( 'Olvidé mi contraseña', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
