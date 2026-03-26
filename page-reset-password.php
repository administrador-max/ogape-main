<?php
/**
 * Template Name: Reset Password
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/account/' ) );
    exit;
}

$raw_key   = isset( $_GET['key'] )   ? wp_unslash( $_GET['key'] )   : '';
$raw_login = isset( $_GET['login'] ) ? wp_unslash( $_GET['login'] ) : '';

// Preserve key/login across the POST round-trip via hidden fields.
if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $raw_key   = isset( $_POST['reset_key'] )   ? wp_unslash( $_POST['reset_key'] )   : $raw_key;
    $raw_login = isset( $_POST['reset_login'] ) ? wp_unslash( $_POST['reset_login'] ) : $raw_login;
}

$user        = ogape_check_reset_key( $raw_key, $raw_login );
$key_invalid = is_wp_error( $user );
$reset_error = '';
$reset_done  = false;

if ( ! $key_invalid && 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ogape_reset_nonce'] ) ) {
    $result = ogape_process_reset_password( $user );
    if ( is_wp_error( $result ) ) {
        $reset_error = $result->get_error_message();
    } else {
        $reset_done = true;
    }
}

get_header();

$login_url         = home_url( '/login/' );
$forgot_password_url = home_url( '/forgot-password/' );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Recuperar acceso', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Creá una nueva contraseña para tu cuenta Ogape.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Elegí una contraseña segura. A partir de ahora la usarás para ingresar a tu cuenta.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Mínimo 8 caracteres', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Confirmación para evitar errores', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Acceso inmediato tras el cambio', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-entry-shell">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Nueva contraseña', 'ogape-child' ); ?></h3>
                        </div>

                        <?php if ( $reset_done ) : ?>
                            <p class="account-entry-form__success">
                                <?php esc_html_e( '¡Contraseña actualizada! Ya podés iniciar sesión con tu nueva contraseña.', 'ogape-child' ); ?>
                            </p>
                            <div class="account-entry-shell__actions">
                                <a href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?></a>
                            </div>

                        <?php elseif ( $key_invalid ) : ?>
                            <p class="account-entry-form__error">
                                <?php echo esc_html( $user->get_error_message() ); ?>
                            </p>
                            <div class="account-entry-shell__actions">
                                <a href="<?php echo esc_url( $forgot_password_url ); ?>"><?php esc_html_e( 'Solicitar nuevo enlace', 'ogape-child' ); ?></a>
                            </div>

                        <?php else : ?>
                            <form class="account-entry-form" method="post" action="">
                                <?php wp_nonce_field( 'ogape_reset', 'ogape_reset_nonce' ); ?>
                                <input type="hidden" name="reset_key"   value="<?php echo esc_attr( $raw_key ); ?>">
                                <input type="hidden" name="reset_login" value="<?php echo esc_attr( $raw_login ); ?>">

                                <?php if ( $reset_error ) : ?>
                                    <p class="account-entry-form__error" role="alert"><?php echo esc_html( $reset_error ); ?></p>
                                <?php endif; ?>

                                <label class="account-entry-form__field">
                                    <span><?php esc_html_e( 'Nueva contraseña', 'ogape-child' ); ?></span>
                                    <input type="password" name="password" placeholder="••••••••"
                                        autocomplete="new-password" required minlength="8">
                                </label>

                                <label class="account-entry-form__field">
                                    <span><?php esc_html_e( 'Confirmá la contraseña', 'ogape-child' ); ?></span>
                                    <input type="password" name="password_confirm" placeholder="••••••••"
                                        autocomplete="new-password" required minlength="8">
                                </label>

                                <button type="submit" class="btn btn--primary btn--md account-entry-form__button">
                                    <?php esc_html_e( 'Guardar contraseña', 'ogape-child' ); ?>
                                </button>
                            </form>

                            <div class="account-entry-shell__actions">
                                <a href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Volver a iniciar sesión', 'ogape-child' ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
