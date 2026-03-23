<?php
/**
 * Template Name: Forgot Password
 * Template Post Type: page
 *
 * Official Ogape forgot-password shell.
 */

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
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Este template cubre el momento de recuperación de acceso con la misma lógica visual del sitio oficial: claridad, calma y continuidad.', 'ogape-child' ); ?></p>
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
                            <p><?php esc_html_e( 'Template visual de recuperación.', 'ogape-child' ); ?></p>
                        </div>
                        <form class="account-entry-form" action="#" method="post" onsubmit="return false;">
                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" placeholder="nombre@ejemplo.com" disabled>
                            </label>
                            <button type="button" class="btn btn--primary btn--md account-entry-form__button" disabled><?php esc_html_e( 'Enviar enlace', 'ogape-child' ); ?></button>
                        </form>
                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $login_url ); ?>?fresh=1"><?php esc_html_e( 'Volver a iniciar sesión', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
