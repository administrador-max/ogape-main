<?php
/**
 * Template Name: Account
 * Template Post Type: page
 *
 * Official Ogape account area shell.
 */

get_header();
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
                        <div class="account-overview-preview__top">
                            <span class="future-plan-card__badge"><?php esc_html_e( 'Resumen', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( 'Hola, cliente Ogape', 'ogape-child' ); ?></strong>
                            <p><?php esc_html_e( 'Un vistazo rápido a lo que más importa dentro de la cuenta.', 'ogape-child' ); ?></p>
                        </div>
                        <div class="account-stat-grid">
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Próxima entrega', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Pendiente de conexión', 'ogape-child' ); ?></strong>
                            </div>
                            <div class="account-stat-card">
                                <span><?php esc_html_e( 'Plan activo', 'ogape-child' ); ?></span>
                                <strong><?php esc_html_e( 'Kit Hogar', 'ogape-child' ); ?></strong>
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
                            <p><?php esc_html_e( 'Bloque preparado para dirección principal, notas de entrega y perfil alimentario.', 'ogape-child' ); ?></p>
                        </div>
                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Onboarding pendiente', 'ogape-child' ); ?></h2>
                            <p><?php esc_html_e( 'Este módulo sirve para empujar la configuración inicial: dirección, preferencias, zona y señales para personalización futura.', 'ogape-child' ); ?></p>
                        </div>
                        <div class="account-panel-card">
                            <h2><?php esc_html_e( 'Acciones rápidas', 'ogape-child' ); ?></h2>
                            <p><?php esc_html_e( 'Espacio para reordenar, editar dirección principal, revisar saldo regalo o retomar una compra.', 'ogape-child' ); ?></p>
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
