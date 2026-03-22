<?php
/**
 * FAQ Page Template
 *
 * Template Name: FAQ
 * Automatically used for the page slug "faq".
 */

get_header();

$waitlist_page = get_page_by_path( 'waitlist' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );
?>

<main id="main" class="site-main" role="main">
    <section class="faq-page-hero" id="faq-hero">
        <div class="container">
            <div class="faq-page-hero__content">
                <h1 class="faq-page-hero__title">Preguntas frecuentes</h1>
                <p class="faq-page-hero__subtitle">Respuestas claras sobre el piloto, la lista de espera y cómo estamos preparando el lanzamiento de Ogape.</p>
            </div>
        </div>
    </section>

    <section class="faq-page-section faq-page-section--intro" id="faq-intro">
        <div class="container">
            <div class="faq-page-info glass-card">
                <div class="faq-page-info__copy">
                    <p class="faq-page-section__label">Soporte para el lanzamiento</p>
                    <h2>Todo lo importante, en una sola página.</h2>
                    <p>
                        Ogape está preparando un piloto en Asunción con una selección breve de platos y cupos limitados por zona.
                        Si querés seguir el lanzamiento con confianza, acá reunimos las respuestas más útiles antes de abrir el servicio.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('templates/components/faq-section'); ?>

    <section class="faq-page-section faq-page-section--cta" id="faq-cta">
        <div class="container">
            <div class="faq-cta glass-card">
                <div class="faq-cta__content">
                    <p class="faq-page-section__label">Lista de espera</p>
                    <h2>Seguinos de cerca antes del lanzamiento.</h2>
                    <p>Anotate y te avisamos cuando confirmemos zonas, fechas y próximos pasos del piloto.</p>
                </div>

                <div class="faq-cta__actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">
                        Unirme a la lista de espera
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
