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
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Mi cuenta', 'ogape-child' ),
            'title'    => __( 'Tu futura área de cuenta Ogape.', 'ogape-child' ),
            'subtitle' => __( 'Este shell define la estructura para resumen de cuenta, pedidos, suscripciones, direcciones, preferencias y soporte.', 'ogape-child' ),
        )
    );
    ?>

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
                        <li><a href="#"><?php esc_html_e( 'Gift Cards', 'ogape-child' ); ?></a></li>
                    </ul>
                </aside>

                <div class="account-dashboard-shell__content">
                    <div class="account-stat-grid">
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Próxima entrega', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( 'Todavía no conectado', 'ogape-child' ); ?></strong>
                        </div>
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Plan activo', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( 'Implementación pendiente', 'ogape-child' ); ?></strong>
                        </div>
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Direcciones guardadas', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( '0 vinculadas', 'ogape-child' ); ?></strong>
                        </div>
                    </div>

                    <div class="account-panel-card">
                        <h2><?php esc_html_e( 'Panel de resumen', 'ogape-child' ); ?></h2>
                        <p><?php esc_html_e( 'Este shell en vivo nos da un destino conectado para el nuevo acceso de cuenta. Los próximos pasos son conectar autenticación real, datos de cliente y módulos de pedidos y suscripciones.', 'ogape-child' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
