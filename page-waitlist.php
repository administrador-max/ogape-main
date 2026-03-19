<?php
/**
 * Template Name: Waitlist
 * Template Post Type: page
 */

get_header();
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Lista de espera', 'ogape-child' ),
            'title'    => __( 'Entrá temprano y seguí el lanzamiento desde adentro.', 'ogape-child' ),
            'subtitle' => __( 'La lista de espera es la forma más simple de saber cuándo abrimos tu zona, qué platos entran al piloto y cómo avanza la primera etapa de Ogape en Asunción.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Por qué anotarte</p>
                    <h2 class="section__heading">Primero claridad, después escala.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        Queremos abrir bien. Eso significa cupos limitados, zonas priorizadas por demanda y una comunicación directa con quienes se anoten primero.
                    </p>
                    <ul class="editorial-checklist">
                        <li>Te avisamos cuando abramos tu zona.</li>
                        <li>Recibís primero novedades del piloto y del menú.</li>
                        <li>Nos ayudás a definir dónde expandir la cobertura.</li>
                    </ul>
                </div>
                <div class="editorial-page-card__form">
                    <?php get_template_part( 'templates/components/waitlist-form' ); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
