<?php
/**
 * Template Name: Account
 * Template Post Type: page
 */

if ( ! is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/login/' ) );
    exit;
}

$current_user = wp_get_current_user();
$setup_done   = (bool) get_user_meta( $current_user->ID, 'ogape_zone', true );
$address      = get_user_meta( $current_user->ID, 'ogape_address', true );
$zone         = get_user_meta( $current_user->ID, 'ogape_zone', true );
$preference   = get_user_meta( $current_user->ID, 'ogape_preference', true );

$notice = '';
if ( isset( $_GET['setup'] ) && 'complete' === sanitize_text_field( wp_unslash( $_GET['setup'] ) ) ) {
    $notice = __( '¡Configuración guardada con éxito!', 'ogape-child' );
} elseif ( isset( $_GET['welcome'] ) ) {
    $notice = __( 'Cuenta creada. ¡Bienvenido a Ogape!', 'ogape-child' );
}

get_header();

$setup_url  = home_url( '/account-setup/' );
$logout_url = wp_logout_url( home_url( '/login/' ) );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Mi cuenta', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title">
                        <?php
                        printf(
                            /* translators: %s: user's display name */
                            esc_html__( 'Hola, %s.', 'ogape-child' ),
                            esc_html( $current_user->display_name )
                        );
                        ?>
                    </h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Un vistazo a pedidos, direcciones, preferencias, suscripciones y tarjetas regalo.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Dashboard con foco en continuidad', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Módulos pensados para crecer', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Preparado para conectar datos reales luego', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-overview-preview">
                        <?php if ( $notice ) : ?>
                            <p class="account-entry-form__success"><?php echo esc_html( $notice ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! $setup_done ) : ?>
                            <p class="account-setup-prompt">
                                <?php esc_html_e( 'Completá tu configuración inicial para personalizar tu experiencia.', 'ogape-child' ); ?>
                                <a href="<?php echo esc_url( $setup_url ); ?>"><?php esc_html_e( 'Configurar ahora', 'ogape-child' ); ?></a>
                            </p>
                        <?php endif; ?>

                        <div class="account-overview-preview__top">
                            <span class="future-plan-card__badge"><?php esc_html_e( 'Resumen', 'ogape-child' ); ?></span>
                            <strong><?php echo esc_html( $current_user->display_name ); ?></strong>
                            <p><?php echo esc_html( $current_user->user_email ); ?></p>
                        </div>

                        <div class="account-stat-grid">
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Próxima entrega', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Pendiente de conexión', 'ogape-child' ); ?></strong>
                            </div>
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Plan activo', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Pendiente de conexión', 'ogape-child' ); ?></strong>
                            </div>
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Barrio', 'ogape-child' ); ?></span>
                                <strong><?php echo $zone ? esc_html( $zone ) : esc_html__( '—', 'ogape-child' ); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow account-dashboard-section">
        <div class="container">
            <div class="account-dashboard-shell glass-card">
                <aside class="account-dashboard-shell__sidebar">
                    <p class="section__label"><?php esc_html_e( 'Navegación de cuenta', 'ogape-child' ); ?></p>
                    <ul class="account-dashboard-shell__nav">
                        <li><a href="#"><?php esc_html_e( 'Resumen', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Pedidos', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Suscripciones', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Direcciones', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Preferencias', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Tarjetas regalo', 'ogape-child' ); ?></a></li>
                        <li><a href="<?php echo esc_url( $setup_url ); ?>"><?php esc_html_e( 'Configuración inicial', 'ogape-child' ); ?></a></li>
                        <li><a href="<?php echo esc_url( $logout_url ); ?>"><?php esc_html_e( 'Cerrar sesión', 'ogape-child' ); ?></a></li>
                    </ul>
                </aside>

                <div class="account-dashboard-shell__content">
                    <div class="account-panel-grid">
                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Pedidos recientes', 'ogape-child' ); ?></h2>
                            <p><?php esc_html_e( 'Acá vivirá el historial breve de compras, estado de entrega y acceso a detalle.', 'ogape-child' ); ?></p>
                        </div>

                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Direcciones y preferencias', 'ogape-child' ); ?></h2>
                            <?php if ( $address ) : ?>
                                <p><?php echo esc_html( $address ); ?><?php if ( $zone ) : ?>, <?php echo esc_html( $zone ); ?><?php endif; ?></p>
                                <?php if ( $preference ) : ?>
                                    <p><?php echo esc_html( $preference ); ?></p>
                                <?php endif; ?>
                                <p><a href="<?php echo esc_url( $setup_url ); ?>"><?php esc_html_e( 'Editar', 'ogape-child' ); ?></a></p>
                            <?php else : ?>
                                <p><?php esc_html_e( 'Bloque preparado para dirección principal, notas de entrega y perfil alimentario.', 'ogape-child' ); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Acciones rápidas', 'ogape-child' ); ?></h2>
                            <p><?php esc_html_e( 'Espacio para reordenar, editar dirección principal, revisar saldo regalo o retomar una compra.', 'ogape-child' ); ?></p>
                        </div>

                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Onboarding', 'ogape-child' ); ?></h2>
                            <?php if ( $setup_done ) : ?>
                                <p><?php esc_html_e( 'Configuración inicial completada.', 'ogape-child' ); ?></p>
                            <?php else : ?>
                                <p><?php esc_html_e( 'Completá la configuración inicial para personalizar pedidos y entregas.', 'ogape-child' ); ?></p>
                                <p><a href="<?php echo esc_url( $setup_url ); ?>"><?php esc_html_e( 'Configurar ahora', 'ogape-child' ); ?></a></p>
                            <?php endif; ?>
                        </div>

                        <div class="account-panel-card account-panel-card--wide">
                            <h2><?php esc_html_e( 'Base para suscripciones y gifting', 'ogape-child' ); ?></h2>
                            <p><?php esc_html_e( 'Este shell ya deja espacio para conectar plan activo, frecuencia, saldo de tarjetas regalo y continuidad de compra dentro de la misma cuenta.', 'ogape-child' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
