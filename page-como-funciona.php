<?php
/**
 * Template Name: Cómo funciona
 * Template Post Type: page
 */

get_header();

$menu_page     = get_page_by_path( 'menu' );
$waitlist_page = get_page_by_path( 'waitlist' );
$menu_url      = $menu_page ? get_permalink( $menu_page ) : home_url( '/menu/' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Cómo funciona', 'ogape-child' ),
            'title'    => __( 'Un piloto simple, claro y pensado para probar Ogape con confianza.', 'ogape-child' ),
            'subtitle' => __( 'Estamos lanzando una experiencia breve y cuidada para Asunción. Estos son los pasos para enterarte primero, ver el menú y sumarte cuando tu zona esté lista.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-steps">
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">01</p>
                    <h2>Te anotás</h2>
                    <p>Dejás tu contacto y tu zona para que podamos priorizar el piloto donde hay más interés.</p>
                </article>
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">02</p>
                    <h2>Te avisamos</h2>
                    <p>Cuando abrimos cupos en tu zona, te compartimos fechas, disponibilidad y el menú piloto.</p>
                </article>
                <article class="editorial-step glass-card">
                    <p class="editorial-step__number">03</p>
                    <h2>Elegís y recibís</h2>
                    <p>Seleccionás platos de una carta breve y los recibís listos para disfrutar, con estándar de restaurante y lógica de piloto.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Qué esperar</p>
                <h2 class="section__heading">Pocos platos, mucha claridad.</h2>
                <p class="section__sub editorial-page-card__lead">
                    Ogape arranca con una selección pequeña, zonas limitadas y una comunicación directa. Preferimos una apertura controlada antes que prometer más de lo que el piloto puede sostener.
                </p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--md">Ver menú</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Unirme</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
