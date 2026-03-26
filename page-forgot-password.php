<?php
/**
 * Template Name: Forgot Password
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/account/' ) );
    exit;
}

$forgot_error   = '';
$forgot_success = false;

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ogape_forgot_nonce'] ) ) {
    $result = ogape_process_forgot_password();
    if ( is_wp_error( $result ) ) {
        $forgot_error = $result->get_error_message();
    } else {
        $forgot_success = true;
    }
}

get_header();

$login_url = home_url( '/login/' );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Recuperar acceso', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Recuperar tu cuenta también debe sentirse simple y confiable.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Ingresá tu email y te enviamos un enlace para crear una nueva contraseña.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Recuperación sin fricción', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Explicación breve y clara', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Puente de vuelta a tu cuenta', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-entry-shell">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Recuperar contraseña', 'ogape-child' ); ?></h3>
                        </div>

                        <?php if ( $forgot_success ) : ?>
                            <p class="account-entry-form__success">
                                <?php esc_html_e( 'Si ese email tiene una cuenta, vas a recibir un enlace para restablecer tu contraseña en los próximos minutos.', 'ogape-child' ); ?>
                            </p>
                        <?php else : ?>
                            <form class="account-entry-form" method="post" action="">
                                <?php wp_nonce_field( 'ogape_forgot', 'ogape_forgot_nonce' ); ?>

                                <?php if ( $forgot_error ) : ?>
                                    <p class="account-entry-form__error" role="alert"><?php echo esc_html( $forgot_error ); ?></p>
                                <?php endif; ?>

                                <label class="account-entry-form__field">
                                    <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                    <input type="email" name="email" placeholder="nombre@ejemplo.com"
                                        autocomplete="email" required>
                                </label>

                                <button type="submit" class="btn btn--primary btn--md account-entry-form__button">
                                    <?php esc_html_e( 'Enviar enlace', 'ogape-child' ); ?>
                                </button>
                            </form>
                        <?php endif; ?>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Volver a iniciar sesión', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
