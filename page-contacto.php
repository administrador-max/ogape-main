<?php
/**
 * Template Name: Contacto
 * Template Post Type: page
 */

get_header();

$ogape_contact_email = ogape_get_contact_email();
$wa                  = ogape_get_whatsapp_url();
$waitlist_page       = get_page_by_path( 'waitlist' );
$waitlist_url        = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );

$methods = array(
    array(
        'eyebrow'  => __( 'WhatsApp', 'ogape-child' ),
        'title'    => __( 'Conversación rápida', 'ogape-child' ),
        'body'     => __( 'Para consultas sobre cobertura, disponibilidad inicial y próximos pasos del piloto.', 'ogape-child' ),
        'label'    => __( 'Abrir WhatsApp', 'ogape-child' ),
        'url'      => $wa,
        'external' => true,
    ),
    array(
        'eyebrow'  => __( 'Email', 'ogape-child' ),
        'title'    => __( 'Escribinos con contexto', 'ogape-child' ),
        'body'     => __( 'Ideal para consultas más detalladas, alianzas o seguimiento del lanzamiento.', 'ogape-child' ),
        'label'    => $ogape_contact_email,
        'url'      => $ogape_contact_email ? 'mailto:' . $ogape_contact_email : '',
    ),
    array(
        'eyebrow'  => __( 'Instagram', 'ogape-child' ),
        'title'    => __( 'Seguí el lanzamiento', 'ogape-child' ),
        'body'     => __( 'Ahí vamos a compartir novedades, avances del piloto y señales de apertura.', 'ogape-child' ),
        'label'    => __( '@ogapechefpy', 'ogape-child' ),
        'url'      => 'https://www.instagram.com/ogapechefpy',
        'external' => true,
    ),
    array(
        'eyebrow'  => __( 'X', 'ogape-child' ),
        'title'    => __( 'Seguí actualizaciones rápidas', 'ogape-child' ),
        'body'     => __( 'También vamos a usar X para avisos cortos, novedades y señales del lanzamiento.', 'ogape-child' ),
        'label'    => __( '@ogapechefpy', 'ogape-child' ),
        'url'      => 'https://x.com/ogapechefpy',
        'external' => true,
    ),
    array(
        'eyebrow'  => __( 'Facebook', 'ogape-child' ),
        'title'    => __( 'Seguí novedades en Facebook', 'ogape-child' ),
        'body'     => __( 'También vamos a compartir actualizaciones y señales del lanzamiento en Facebook.', 'ogape-child' ),
        'label'    => __( 'facebook.com/ogapechef1', 'ogape-child' ),
        'url'      => 'https://facebook.com/ogapechef1',
        'external' => true,
    ),
);
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Contacto', 'ogape-child' ),
            'title'    => __( 'Una forma simple de hablar con Ogape.', 'ogape-child' ),
            'subtitle' => __( 'Estamos en etapa piloto, así que preferimos canales directos, claros y fáciles de responder. Si tenés dudas sobre cobertura, lanzamiento o alianzas, este es el mejor punto de entrada.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <?php get_template_part( 'templates/components/contact-methods', null, array( 'methods' => $methods ) ); ?>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Antes del lanzamiento</p>
                <h2 class="section__heading">La vía más útil sigue siendo la lista de espera.</h2>
                <p class="section__sub editorial-page-card__lead">
                    Si lo que querés es enterarte cuando abramos tu zona o veas primero el piloto, lo mejor es dejar tu contacto. Nos ayuda a ordenar la apertura y avisarte en el momento correcto.
                </p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Ir a la lista</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
