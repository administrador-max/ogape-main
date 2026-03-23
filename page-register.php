<?php
/**
 * Template Name: Register
 * Template Post Type: page
 *
 * Official Ogape account registration shell.
 */

get_header();

$login_url         = home_url( '/login/' );
$account_setup_url = home_url( '/account-setup/' );
$register_demo_url = add_query_arg( 'demo', 'register', $account_setup_url );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Registro Ogape', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Crear cuenta también forma parte de la experiencia premium.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Este template prepara el alta de cliente para que cuenta, preferencias, direcciones y futuras suscripciones nazcan dentro del mismo sistema visual del sitio oficial.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Alta simple y clara', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Preparado para onboarding posterior', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Conectado a cuenta, pedidos y preferencias', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-entry-shell account-entry-shell--register">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'Template visual de registro.', 'ogape-child' ); ?></p>
                        </div>
                        <form class="account-entry-form" action="<?php echo esc_url( $register_demo_url ); ?>" method="get">
                            <p class="account-entry-form__demo-note"><?php esc_html_e( 'Demo interactivo: este registro todavía no crea cuenta real, pero ya permite probar el onboarding.', 'ogape-child' ); ?></p>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Nombre', 'ogape-child' ); ?></span><input type="text" name="name" placeholder="Tu nombre"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span><input type="email" name="email" placeholder="nombre@ejemplo.com"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Teléfono', 'ogape-child' ); ?></span><input type="text" name="phone" placeholder="09xx xxx xxx"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></span><input type="password" name="password" placeholder="••••••••"></label>
                            <button type="submit" class="btn btn--primary btn--md account-entry-form__button"><?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?></button>
                        </form>
                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $login_url ); ?>?fresh=1"><?php esc_html_e( 'Ya tengo cuenta', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $account_setup_url ); ?>?fresh=1"><?php esc_html_e( 'Ver configuración inicial', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
