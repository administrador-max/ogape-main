<?php
/**
 * Production homepage — waitlist-first landing page.
 */
get_header();
?>

<main id="main" class="site-main" role="main">
    <section class="editorial-page-hero editorial-page-hero--waitlist">
        <div class="container">
            <div class="editorial-page-hero__media" aria-hidden="true">
                <div class="editorial-page-hero__media-overlay"></div>
                <div class="editorial-page-hero__illustration">
                    <span class="editorial-page-hero__icon">🍽️</span>
                    <span class="editorial-page-hero__badge">Hecho para Asunción</span>
                </div>
            </div>

            <div class="editorial-page-hero__content">
                <p class="editorial-page-hero__eyebrow"><?php esc_html_e( 'Lista de espera', 'ogape-child' ); ?></p>
                <h1 class="editorial-page-hero__title"><?php esc_html_e( 'Entrá temprano y seguí el lanzamiento desde adentro.', 'ogape-child' ); ?></h1>
                <p class="editorial-page-hero__subtitle"><?php esc_html_e( 'Ogape está armando una apertura cuidada en Asunción. Sumate hoy para enterarte primero cuándo abrimos tu zona, qué entra al piloto y cómo acceder antes que el resto.', 'ogape-child' ); ?></p>
                <div class="editorial-inline-actions editorial-inline-actions--hero">
                    <a href="#waitlist-form" class="btn btn--primary btn--lg"><?php esc_html_e( 'Unirme a la lista', 'ogape-child' ); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy editorial-page-card__copy--waitlist">
                    <div class="editorial-page-card__icon" aria-hidden="true">🥕</div>
                    <p class="section__label"><?php esc_html_e( 'Por qué anotarte', 'ogape-child' ); ?></p>
                    <h2 class="section__heading"><?php esc_html_e( 'Primero claridad, después escala.', 'ogape-child' ); ?></h2>
                    <p class="section__sub editorial-page-card__lead"><?php esc_html_e( 'Queremos abrir bien. Eso significa cupos limitados, zonas priorizadas por demanda y una comunicación directa con quienes se anoten primero.', 'ogape-child' ); ?></p>
                    <ul class="editorial-checklist">
                        <li><?php esc_html_e( 'Te avisamos cuando abramos tu zona.', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Recibís primero novedades del piloto y del menú.', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Nos ayudás a definir dónde expandir la cobertura.', 'ogape-child' ); ?></li>
                    </ul>
                </div>
                <div class="editorial-page-card__form editorial-page-card__form--waitlist" id="waitlist-form">
                    <?php get_template_part( 'templates/components/waitlist-form' ); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
