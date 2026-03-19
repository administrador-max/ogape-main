<?php
/**
 * Template Name: Cobertura
 * Template Post Type: page
 */

get_header();

$waitlist_page = get_page_by_path( 'waitlist' );
$contact_page  = get_page_by_path( 'contacto' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );
$contact_url   = $contact_page ? get_permalink( $contact_page ) : home_url( '/contacto/' );
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Cobertura', 'ogape-child' ),
            'title'    => __( 'Empezamos en Asunción, con una apertura gradual por zonas.', 'ogape-child' ),
            'subtitle' => __( 'El piloto no abre toda la ciudad de una vez. Priorizamos barrios donde podamos sostener calidad, tiempos y una experiencia consistente desde el primer día.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-info-grid">
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Piloto inicial</p>
                    <h2 class="section__heading">Asunción primero.</h2>
                    <p class="editorial-page-card__body">La primera etapa se concentra en Asunción y zonas cercanas con suficiente densidad para operar bien desde el inicio.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Cupos limitados</p>
                    <h2 class="section__heading">Apertura por demanda.</h2>
                    <p class="editorial-page-card__body">La lista de espera nos ayuda a detectar qué barrios deberíamos abrir antes y dónde conviene ampliar cobertura después.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Próximos pasos</p>
                    <h2 class="section__heading">Expansión gradual.</h2>
                    <p class="editorial-page-card__body">Una vez validado el piloto, iremos sumando nuevas zonas con el mismo criterio: calidad, consistencia y tiempos realistas.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">¿Tu zona todavía no aparece?</p>
                <h2 class="section__heading">Igual conviene anotarte.</h2>
                <p class="section__sub editorial-page-card__lead">
                    Si todavía no llegamos a tu barrio, la mejor señal para priorizarlo es dejar tu contacto. También podés escribirnos si querés confirmar una ubicación puntual.
                </p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Entrar a la lista</a>
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--secondary btn--md">Hablar con Ogape</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
