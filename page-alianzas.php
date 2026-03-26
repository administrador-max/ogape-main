<?php
/**
 * Template Name: Alianzas
 * Template Post Type: page
 */

get_header();

$contact_page  = get_page_by_path( 'contacto' );
$waitlist_page = get_page_by_path( 'waitlist' );
$contact_url   = $contact_page ? get_permalink( $contact_page ) : home_url( '/contacto/' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/waitlist/' );
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Alianzas', 'ogape-child' ),
            'title'    => __( 'Ogape también puede crecer mejor con socios correctos desde el principio.', 'ogape-child' ),
            'subtitle' => __( 'Estamos abiertos a conversaciones que ayuden a fortalecer producto, abastecimiento, distribución, gifting y activaciones de marca, siempre con foco práctico y sentido operativo.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-info-grid">
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Marcas</p>
                    <h2 class="section__heading">Campañas y gifting.</h2>
                    <p class="editorial-page-card__body">Exploramos colaboraciones que hagan sentido para regalos, experiencias compartidas y presencia premium con utilidad real.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Proveedores</p>
                    <h2 class="section__heading">Abastecimiento con consistencia.</h2>
                    <p class="editorial-page-card__body">Nos interesan relaciones que mejoren calidad, continuidad y trazabilidad sin volver más frágil la operación.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Hospitality</p>
                    <h2 class="section__heading">Experiencias y activaciones.</h2>
                    <p class="editorial-page-card__body">También puede haber espacio para propuestas especiales, pilotos compartidos o formatos corporativos bien definidos.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Qué valoramos</p>
                    <h2 class="section__heading">Menos discurso, más encaje real.</h2>
                    <p class="section__sub editorial-page-card__lead">Nos sirven las alianzas que resuelven algo concreto: mejor producto, mejor operación, mejor llegada o una experiencia de marca más útil y coherente.</p>
                    <ul class="editorial-checklist">
                        <li>Objetivo comercial claro</li>
                        <li>Viabilidad operativa desde el inicio</li>
                        <li>Alineación con una marca gastronómica premium y local</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Marca + producto + operación<br>alineados desde temprano</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Próximo paso</p>
                <h2 class="section__heading">Si ves una alianza concreta, conversemos con contexto.</h2>
                <p class="section__sub editorial-page-card__lead">La mejor forma de avanzar es compartir la idea, el encaje y qué parte del sistema ayudaría a mejorar.</p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--primary btn--md">Escribir a Ogape</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--secondary btn--md">Ver lista de espera</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
