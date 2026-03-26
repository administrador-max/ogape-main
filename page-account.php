<?php
/**
 * Template Name: Account
 * Template Post Type: page
 *
 * Official Ogape account area shell.
 */

get_header();

$demo_state   = ogape_get_demo_account_state();
$demo_name    = ! empty( $demo_state['name'] ) ? $demo_state['name'] : __( 'Cliente de prueba', 'ogape-child' );
$demo_email   = ! empty( $demo_state['email'] ) ? $demo_state['email'] : 'cliente@demo.ogape';
$demo_plan    = ! empty( $demo_state['plan'] ) ? $demo_state['plan'] : __( 'Plan Hogar', 'ogape-child' );
$demo_zone    = ! empty( $demo_state['zone'] ) ? $demo_state['zone'] : __( 'Pendiente de definir', 'ogape-child' );
$demo_address = ! empty( $demo_state['address'] ) ? $demo_state['address'] : __( 'Sin dirección cargada', 'ogape-child' );
$demo_pref    = ! empty( $demo_state['preference'] ) ? $demo_state['preference'] : __( 'Sin preferencia cargada', 'ogape-child' );
$demo_message = '';
if ( isset( $_GET['demo'] ) ) {
    $demo_value = sanitize_text_field( wp_unslash( $_GET['demo'] ) );
    if ( 'login' === $demo_value ) {
        $demo_message = __( 'Inicio de sesión de prueba completado. Ya estás dentro del dashboard.', 'ogape-child' );
    } elseif ( 'register' === $demo_value ) {
        $demo_message = __( 'Registro de prueba completado. El dashboard ya quedó listo para revisar el recorrido completo.', 'ogape-child' );
    }
}
if ( isset( $_GET['setup'] ) ) {
    $demo_message = __( 'Configuración inicial completada. El dashboard queda listo para seguir probando.', 'ogape-child' );
}
if ( isset( $_GET['fresh'] ) ) {
    $demo_message = __( 'Dashboard demo listo para prueba manual.', 'ogape-child' );
}
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Mi cuenta', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'Tu futura área de cuenta Ogape ya tiene una base visual más real.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Este shell define cómo se conectan resumen, pedidos, direcciones, preferencias, suscripciones y tarjetas regalo dentro de una experiencia más consistente con el sitio oficial.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Dashboard con foco en continuidad', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Módulos pensados para crecer', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Preparado para conectar datos reales luego', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-overview-preview">
                        <?php if ( $demo_message ) : ?>
                            <p class="account-demo-banner"><?php echo esc_html( $demo_message ); ?></p>
                        <?php endif; ?>
                        <div class="account-overview-preview__top">
                            <span class="future-plan-card__badge"><?php esc_html_e( 'Resumen', 'ogape-child' ); ?></span>
                            <strong><?php echo esc_html( sprintf( __( 'Hola, %s', 'ogape-child' ), $demo_name ) ); ?></strong>
                            <p><?php esc_html_e( 'Un vistazo rápido a lo que más importa dentro de la cuenta.', 'ogape-child' ); ?></p>
                        </div>
                        <div class="account-stat-grid">
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Próxima entrega', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Pendiente de conexión', 'ogape-child' ); ?></strong>
                            </div>
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Plan activo', 'ogape-child' ); ?></span>
                                <strong><?php echo esc_html( $demo_plan ); ?></strong>
                            </div>
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Saldo regalo', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Gs. --', 'ogape-child' ); ?></strong>
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
                        <li><a href="<?php echo esc_url( home_url( '/account-setup/' ) ); ?>?fresh=1"><?php esc_html_e( 'Configuración inicial', 'ogape-child' ); ?></a></li>
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
                            <p><?php echo esc_html( sprintf( __( 'Zona: %1$s · Dirección: %2$s', 'ogape-child' ), $demo_zone, $demo_address ) ); ?></p>
                        </div>
                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Onboarding pendiente', 'ogape-child' ); ?></h2>
                            <p><?php echo esc_html( sprintf( __( 'Preferencia principal registrada: %s', 'ogape-child' ), $demo_pref ) ); ?></p>
                        </div>
                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Acciones rápidas', 'ogape-child' ); ?></h2>
                            <p><?php echo esc_html( sprintf( __( 'Email de prueba activo: %s', 'ogape-child' ), $demo_email ) ); ?></p>
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

<?php get_footer(); ?>
