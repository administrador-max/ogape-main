<?php
/**
 * Template Name: Register
 * Template Post Type: page
 */

if ( is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/account/' ) );
    exit;
}

$register_error = '';
$posted         = array();

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ogape_register_nonce'] ) ) {
    $result = ogape_process_register();
    if ( is_wp_error( $result ) ) {
        $register_error  = $result->get_error_message();
        $posted['name']  = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
        $posted['email'] = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
        $posted['phone'] = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
    } else {
        wp_safe_redirect( home_url( '/account-setup/' ) );
        exit;
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
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Registro Ogape', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Crear cuenta también forma parte de la experiencia premium.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Tu cuenta conecta pedidos, preferencias, direcciones y suscripciones en un solo lugar.', 'ogape-child' ); ?></p>
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
                        </div>

                        <form class="account-entry-form" method="post" action="">
                            <?php wp_nonce_field( 'ogape_register', 'ogape_register_nonce' ); ?>

                            <?php if ( $register_error ) : ?>
                                <p class="account-entry-form__error" role="alert"><?php echo esc_html( $register_error ); ?></p>
                            <?php endif; ?>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Nombre', 'ogape-child' ); ?></span>
                                <input type="text" name="name" placeholder="Tu nombre"
                                    autocomplete="name" required
                                    value="<?php echo esc_attr( $posted['name'] ?? '' ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" name="email" placeholder="nombre@ejemplo.com"
                                    autocomplete="email" required
                                    value="<?php echo esc_attr( $posted['email'] ?? '' ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Teléfono', 'ogape-child' ); ?></span>
                                <input type="tel" name="phone" placeholder="09xx xxx xxx"
                                    autocomplete="tel"
                                    value="<?php echo esc_attr( $posted['phone'] ?? '' ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></span>
                                <input type="password" name="password" placeholder="••••••••"
                                    autocomplete="new-password" required minlength="8">
                            </label>

                            <button type="submit" class="btn btn--primary btn--md account-entry-form__button">
                                <?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Ya tengo cuenta', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
