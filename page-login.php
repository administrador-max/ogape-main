<?php
/**
 * Template Name: Login
 * Template Post Type: page
 *
 * Official Ogape account entry shell.
 */

get_header();

$register_url        = home_url( '/register/' );
$account_url         = home_url( '/account/' );
$forgot_password_url = home_url( '/forgot-password/' );

$redirect_to = isset( $_GET['redirect_to'] ) ? rawurldecode( sanitize_text_field( wp_unslash( $_GET['redirect_to'] ) ) ) : '';

$login_error  = '';
$login_notice = '';
if ( isset( $_GET['error'] ) ) {
    $login_error = __( 'Email o contraseña incorrectos. Revisá los datos e intentá de nuevo.', 'ogape-child' );
}
if ( isset( $_GET['reset'] ) ) {
    $login_notice = __( 'Si ese email tiene una cuenta, te mandamos el enlace de recuperación.', 'ogape-child' );
}
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Cuenta Ogape', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Iniciá sesión en una cuenta pensada para pedidos, preferencias y continuidad.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Este acceso ya forma parte del sistema visual del sitio oficial. Desde acá vamos a conectar pedidos, suscripciones, direcciones guardadas, preferencias y tarjetas regalo.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Acceso simple y claro', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Diseñado para continuidad de cliente', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Cuenta, catálogo y gifting unidos', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-entry-shell account-entry-shell--login">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Ingresá a tu cuenta', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'Email y contraseña que usaste al registrarte.', 'ogape-child' ); ?></p>
                        </div>

                        <?php if ( $login_error ) : ?>
                            <p class="account-entry-form__error" style="color:#c0392b;font-size:13.5px;margin:0 0 .75rem;padding:.6rem .9rem;background:#fdf2f2;border-radius:6px;border:1px solid #f5c6c6"><?php echo esc_html( $login_error ); ?></p>
                        <?php endif; ?>
                        <?php if ( $login_notice ) : ?>
                            <p class="account-entry-form__notice" style="font-size:13.5px;margin:0 0 .75rem;padding:.6rem .9rem;background:#f0f7ee;border-radius:6px;border:1px solid #c3dfc0"><?php echo esc_html( $login_notice ); ?></p>
                        <?php endif; ?>

                        <form class="account-entry-form" action="<?php echo esc_url( home_url( '/login/' ) ); ?>" method="post">
                            <input type="hidden" name="ogape_demo_action" value="login">
                            <input type="hidden" name="ogape_demo_nonce" value="<?php echo esc_attr( wp_create_nonce( 'ogape_demo_account_flow' ) ); ?>">
                            <?php if ( $redirect_to ) : ?>
                                <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
                            <?php endif; ?>
                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" name="email" placeholder="nombre@ejemplo.com" required autocomplete="email">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></span>
                                <input type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
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

<?php get_footer(); ?>
