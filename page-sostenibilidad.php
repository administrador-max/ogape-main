<?php
/**
 * Template Name: Sostenibilidad
 * Template Post Type: page
 */

get_header();

$waitlist_page = get_page_by_path( 'waitlist' );
$contact_page  = get_page_by_path( 'contacto' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/waitlist/' );
$contact_url   = $contact_page ? get_permalink( $contact_page ) : home_url( '/contacto/' );
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Sostenibilidad', 'ogape-child' ),
            'title'    => __( 'Queremos crecer con menos desperdicio, mejor abastecimiento y decisiones operativas más conscientes.', 'ogape-child' ),
            'subtitle' => __( 'La sostenibilidad en Ogape no se plantea como eslogan. Se traduce en selección más corta, producción más ordenada, cobertura gradual y relaciones más claras con ingredientes, empaque y logística.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-info-grid editorial-info-grid--two">
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Producto</p>
                    <h2 class="section__heading">Menos exceso, más foco.</h2>
                    <p class="editorial-page-card__body">Un menú más breve ayuda a comprar mejor, preparar con más previsión y reducir desperdicio desde el inicio del piloto.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Operación</p>
                    <h2 class="section__heading">Cobertura responsable.</h2>
                    <p class="editorial-page-card__body">Abrimos por zonas para evitar promesas imposibles, recorridos ineficientes y una experiencia que se degrade por crecer demasiado rápido.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt">
        <div class="container">
            <div class="editorial-steps">
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">01</p>
                    <h2>Selección más inteligente</h2>
                    <p>Preferimos una oferta clara y repetible antes que una carta inflada que complique compras, stock y consistencia.</p>
                </article>
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">02</p>
                    <h2>Empaque con criterio</h2>
                    <p>Buscamos empaques que sostengan presentación y practicidad sin perder de vista costos, residuos y uso real en el hogar.</p>
                </article>
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">03</p>
                    <h2>Aprendizaje continuo</h2>
                    <p>El piloto existe también para medir mejor qué conviene producir, entregar y ajustar antes de ampliar escala.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">¿Querés conversar?</p>
                <h2 class="section__heading">Si tenés ideas, proveedores o alianzas alineadas, escribinos.</h2>
                <p class="section__sub editorial-page-card__lead">Todavía estamos definiendo mucho de esta capa operativa. Si hay una oportunidad concreta para mejorar abastecimiento, empaque o impacto, queremos verla temprano.</p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--secondary btn--md">Hablar con Ogape</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Entrar a la lista</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
