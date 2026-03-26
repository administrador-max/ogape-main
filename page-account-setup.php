<?php
/**
 * Template Name: Account Setup
 * Template Post Type: page
 */

if ( ! is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/login/' ) );
    exit;
}

$setup_error = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ogape_setup_nonce'] ) ) {
    $result = ogape_process_account_setup();
    if ( is_wp_error( $result ) ) {
        $setup_error = $result->get_error_message();
    } else {
        wp_safe_redirect( add_query_arg( 'setup', 'complete', home_url( '/account/' ) ) );
        exit;
    }
}

get_header();

$current_user = wp_get_current_user();
$account_url  = home_url( '/account/' );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Configuración inicial', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'La cuenta se completa mejor con un onboarding corto y útil.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Completá tu dirección y preferencias para que el dashboard tenga sentido desde el primer ingreso.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Dirección principal', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Preferencias alimentarias', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Base para recomendaciones futuras', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-setup-shell">
                        <div class="account-setup-stepper">
                            <span class="account-setup-stepper__item account-setup-stepper__item--active"><?php esc_html_e( '1. Dirección', 'ogape-child' ); ?></span>
                            <span class="account-setup-stepper__item"><?php esc_html_e( '2. Preferencias', 'ogape-child' ); ?></span>
                            <span class="account-setup-stepper__item"><?php esc_html_e( '3. Confirmación', 'ogape-child' ); ?></span>
                        </div>

                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Configurar cuenta', 'ogape-child' ); ?></h3>
                            <?php if ( $current_user->display_name ) : ?>
                                <p><?php printf( /* translators: %s: user's name */ esc_html__( 'Hola, %s. Completá estos datos para personalizar tu experiencia.', 'ogape-child' ), esc_html( $current_user->display_name ) ); ?></p>
                            <?php endif; ?>
                        </div>

                        <form class="account-entry-form account-entry-form--setup" method="post" action="">
                            <?php wp_nonce_field( 'ogape_setup', 'ogape_setup_nonce' ); ?>

                            <?php if ( $setup_error ) : ?>
                                <p class="account-entry-form__error" role="alert"><?php echo esc_html( $setup_error ); ?></p>
                            <?php endif; ?>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Barrio / zona', 'ogape-child' ); ?></span>
                                <input type="text" name="zone" placeholder="<?php esc_attr_e( 'Asunción', 'ogape-child' ); ?>"
                                    required
                                    value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'ogape_zone', true ) ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Dirección principal', 'ogape-child' ); ?></span>
                                <input type="text" name="address" placeholder="<?php esc_attr_e( 'Calle, número, referencia', 'ogape-child' ); ?>"
                                    required
                                    value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'ogape_address', true ) ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Preferencia principal', 'ogape-child' ); ?></span>
                                <input type="text" name="preference" placeholder="<?php esc_attr_e( 'Ej. cenas livianas', 'ogape-child' ); ?>"
                                    value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'ogape_preference', true ) ); ?>">
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Notas de entrega', 'ogape-child' ); ?></span>
                                <input type="text" name="notes" placeholder="<?php esc_attr_e( 'Opcional', 'ogape-child' ); ?>"
                                    value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'ogape_delivery_notes', true ) ); ?>">
                            </label>

                            <button type="submit" class="btn btn--primary btn--md account-entry-form__button">
                                <?php esc_html_e( 'Guardar y continuar', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Ver dashboard', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
