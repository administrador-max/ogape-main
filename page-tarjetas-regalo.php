<?php
/**
 * Template Name: Tarjetas regalo
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
            'eyebrow'  => __( 'Tarjetas regalo', 'ogape-child' ),
            'title'    => __( 'Regalar Ogape debería sentirse útil, elegante y fácil de activar.', 'ogape-child' ),
            'subtitle' => __( 'La tarjeta regalo abre una entrada más premium a la marca: sirve para ocasiones especiales, regalos corporativos o simplemente para compartir una experiencia gastronómica mejor pensada.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Qué resuelve</p>
                    <h2 class="section__heading">Una forma simple de regalar comida con criterio.</h2>
                    <p class="section__sub editorial-page-card__lead">No es solo un saldo. Es una forma de entrar a Ogape desde otro ángulo: más emocional, más compartible y con mejor presentación.</p>
                    <ul class="editorial-checklist">
                        <li>Ideal para cumpleaños, agradecimientos y ocasiones especiales</li>
                        <li>Útil para regalos corporativos o campañas puntuales</li>
                        <li>Integrable a cuenta, canje y futuras compras</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Gift card</span>
                            <strong>Regalá Ogape</strong>
                            <p>Una experiencia gastronómica lista para compartir.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Canje</span>
                            <strong>Fácil de usar</strong>
                            <p>Pensada para integrarse con cuenta, menú y continuidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt">
        <div class="container">
            <div class="editorial-info-grid editorial-info-grid--two">
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Particulares</p>
                    <h2 class="section__heading">Regalos con utilidad real.</h2>
                    <p class="editorial-page-card__body">Una alternativa más útil que un regalo genérico: ayuda a resolver comidas y transmite una experiencia cuidada.</p>
                </article>
                <article class="editorial-page-card glass-card">
                    <p class="section__label">Empresas</p>
                    <h2 class="section__heading">También puede funcionar como gifting de marca.</h2>
                    <p class="editorial-page-card__body">Hay espacio para explorar usos corporativos, activaciones y formatos de regalo con mejor presencia.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Interés temprano</p>
                <h2 class="section__heading">Si querés esta opción antes del lanzamiento completo, decínoslo.</h2>
                <p class="section__sub editorial-page-card__lead">Todavía estamos definiendo cómo se habilita esta parte del sistema. Si te interesa como cliente o alianza, conviene dejar señal ahora.</p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--secondary btn--md">Hablar con Ogape</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Entrar a la lista</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
