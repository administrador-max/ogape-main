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
$login_demo_url      = add_query_arg( 'demo', 'login', $account_url );
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
                            <h3><?php esc_html_e( 'Acceso a cuenta', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'Template visual de inicio de sesión.', 'ogape-child' ); ?></p>
                        </div>

                        <form class="account-entry-form" action="<?php echo esc_url( $login_demo_url ); ?>" method="get">
                            <p class="account-entry-form__demo-note"><?php esc_html_e( 'Demo interactivo: este acceso todavía no autentica, pero ya te deja probar el recorrido.', 'ogape-child' ); ?></p>
                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" name="email" placeholder="nombre@ejemplo.com">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></span>
                                <input type="password" name="password" placeholder="••••••••">
                            </label>

                            <button type="button" class="btn btn--primary btn--md account-entry-form__button" disabled>
                                <?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $register_url ); ?>?fresh=1"><?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $forgot_password_url ); ?>?fresh=1"><?php esc_html_e( 'Olvidé mi contraseña', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $account_url ); ?>?fresh=1"><?php esc_html_e( 'Ver área de cuenta', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
?>
