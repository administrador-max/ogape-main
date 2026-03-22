<?php
/**
 * Template Name: Misión y propuesta
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
            'eyebrow'  => __( 'Misión y propuesta', 'ogape-child' ),
            'title'    => __( 'Una propuesta breve para comer mejor, con criterio local y estándar alto.', 'ogape-child' ),
            'subtitle' => __( 'Ogape nace para resolver una necesidad concreta: platos confiables, claros y bien ejecutados para personas que valoran sabor, contexto y una experiencia cuidada desde Paraguay.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-info-grid editorial-info-grid--two">
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Nuestra misión</p>
                    <h2 class="section__heading">Hacer simple una buena decisión.</h2>
                    <p class="editorial-page-card__body">
                        Queremos que pedir o descubrir un plato no sea una apuesta. Ogape reduce ruido: una selección corta, una experiencia clara y una propuesta que se explica sola.
                    </p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">La propuesta</p>
                    <h2 class="section__heading">Paraguay primero, con mirada abierta.</h2>
                    <p class="editorial-page-card__body">
                        La carta mezcla referencias locales con platos viajeros que tienen sentido para el mercado paraguayo. No buscamos amplitud: buscamos criterio, consistencia y memoria.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Por qué ahora</p>
                <h2 class="section__heading">Una etapa piloto para aprender bien.</h2>
                <p class="section__sub editorial-page-card__lead">
                    Empezamos pequeño porque esa es la mejor forma de construir confianza. El piloto no es una versión incompleta: es una forma deliberada de abrir con foco, escuchar mejor y mejorar rápido.
                </p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--md">Explorar menú</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Entrar a la lista</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
