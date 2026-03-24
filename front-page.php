<?php
/**
 * Production homepage — waitlist-first landing page.
 */

$hero_slides = array(
    array(
        'label' => 'Cazuela de Tilapia',
        'image' => get_stylesheet_directory_uri() . '/assets/img/hero-drive/cazuela-de-tilapia.jpg',
    ),
    array(
        'label' => 'Ensalada de Salmón',
        'image' => get_stylesheet_directory_uri() . '/assets/img/hero-drive/ensalada-de-salmon.jpg',
    ),
    array(
        'label' => 'Linguini con Camarón',
        'image' => get_stylesheet_directory_uri() . '/assets/img/hero-drive/linguini-con-camaron.jpg',
    ),
    array(
        'label' => 'Solomillo de Cerdo',
        'image' => get_stylesheet_directory_uri() . '/assets/img/hero-drive/solomillo-de-cerdo.jpg',
    ),
);

get_header();
?>

<main id="main" class="site-main" role="main">
    <section class="editorial-page-hero editorial-page-hero--waitlist">
        <div class="container">
            <div class="editorial-page-hero__media" aria-label="Platos destacados de Ogape">
                <div class="editorial-page-hero__slides" aria-hidden="true">
                    <?php foreach ( $hero_slides as $index => $slide ) : ?>
                        <div
                            class="editorial-page-hero__slide"
                            style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>'); --slide-index: <?php echo esc_attr( $index ); ?>;"
                        ></div>
                    <?php endforeach; ?>
                </div>
                <div class="editorial-page-hero__media-overlay"></div>
                <div class="editorial-page-hero__illustration">
                    <div class="editorial-page-hero__meta">
                        <div class="editorial-page-hero__slide-labels" aria-hidden="true">
                            <?php foreach ( $hero_slides as $index => $slide ) : ?>
                                <span class="editorial-page-hero__slide-label" style="--slide-index: <?php echo esc_attr( $index ); ?>;"><?php echo esc_html( $slide['label'] ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="editorial-page-hero__content">
                <p class="editorial-page-hero__eyebrow"><?php esc_html_e( 'Lista de espera', 'ogape-child' ); ?></p>
                <h1 class="editorial-page-hero__title"><?php esc_html_e( 'Entrá temprano y seguí el lanzamiento desde adentro.', 'ogape-child' ); ?></h1>
                <?php if ( is_page_template( 'page-waitlist.php' ) ) : ?>
                    <?php // TEMP SIGN (easy revert): remove this block only. ?>
                    <p class="editorial-page-hero__eyebrow" style="margin-top: 10px; margin-bottom: 12px; color: #fff; background: rgba(0, 0, 0, 0.35); display: inline-block; padding: 6px 10px; border-radius: 999px;">
                        <?php esc_html_e( 'hello Genia', 'ogape-child' ); ?>
                    </p>
                    <?php // END TEMP SIGN. ?>
                <?php endif; ?>
                <p class="editorial-page-hero__subtitle"><?php esc_html_e( 'Ogape está armando una apertura cuidada en Asunción. Sumate hoy para enterarte primero cuándo abrimos tu zona, qué entra al piloto y cómo acceder antes que el resto.', 'ogape-child' ); ?></p>
                <div class="editorial-inline-actions editorial-inline-actions--hero">
                    <a href="#waitlist-form-section" class="btn btn--primary btn--lg"><?php esc_html_e( 'Unirme a la lista', 'ogape-child' ); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy editorial-page-card__copy--waitlist">
                    <div class="editorial-page-card__icon" aria-hidden="true">🥕</div>
                    <p class="section__label"><?php esc_html_e( 'POR QUÉ ANOTARTE', 'ogape-child' ); ?></p>
                    <h2 class="section__heading"><?php esc_html_e( 'Cociná en casa, sin pensar en qué ni cómo.', 'ogape-child' ); ?></h2>
                    <p class="section__sub editorial-page-card__lead"><?php esc_html_e( 'Ogape es tu chef en casa a través de meal kits: cajas con ingredientes frescos, porcionados y recetas simples para que cocines en tu casa sin complicaciones. Empezamos con foco —cupos limitados y zonas priorizadas— para asegurar una experiencia impecable mientras construimos la base para escalar.', 'ogape-child' ); ?></p>
                    <ul class="editorial-checklist">
                        <li><?php esc_html_e( 'Te avisamos cuando abramos tu zona.', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Recibís primero novedades del piloto, menús y lanzamientos.', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Accedés antes a nuestros meal kits y mejoras continuas.', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Nos ayudás a definir dónde expandir la cobertura.', 'ogape-child' ); ?></li>
                    </ul>
                </div>
                <div class="editorial-page-card__form editorial-page-card__form--waitlist" id="waitlist-form-section">
                    <?php get_template_part( 'templates/components/waitlist-form' ); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
