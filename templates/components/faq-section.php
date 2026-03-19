<?php
/**
 * FAQ Section Component
 */

$faq_groups = array(
    array(
        'title' => 'Sobre el piloto',
        'items' => array(
            array(
                'question' => '¿Qué es Ogape?',
                'answer'   => 'Ogape es una propuesta de platos frescos y cuidados, pensada para hacer más simple comer bien durante la semana.',
            ),
            array(
                'question' => '¿Dónde estará disponible el piloto?',
                'answer'   => 'El lanzamiento inicial está previsto para Asunción. Las zonas exactas se confirmarán primero a quienes estén en la lista de espera.',
            ),
            array(
                'question' => '¿Cómo funciona la lista de espera?',
                'answer'   => 'Dejás tu nombre, email y zona. Con esa información te avisamos antes que al resto cuando abramos cupos en tu área.',
            ),
        ),
    ),
    array(
        'title' => 'Platos y servicio',
        'items' => array(
            array(
                'question' => '¿Qué tipo de platos ofrecerán?',
                'answer'   => 'Una selección breve de platos piloto, con foco en recetas cuidadas, sabores locales y algunos favoritos internacionales.',
            ),
            array(
                'question' => '¿Los platos llegan listos para comer?',
                'answer'   => 'El piloto está siendo definido. Cuando confirmemos el formato exacto, lo vamos a comunicar primero a la lista de espera.',
            ),
            array(
                'question' => '¿Cuándo se anunciarán precios?',
                'answer'   => 'Los precios se anunciarán más cerca del lanzamiento, una vez cerrada la propuesta final del piloto.',
            ),
        ),
    ),
    array(
        'title' => 'Siguientes pasos',
        'items' => array(
            array(
                'question' => '¿Cómo me entero cuando lancen?',
                'answer'   => 'La forma más simple es sumarte a la lista de espera. También vamos a compartir novedades por Instagram y por nuestros canales oficiales.',
            ),
        ),
    ),
);
?>
<section class="faq-page-section" id="faq">
    <div class="container">
        <div class="faq-page-section__header">
            <p class="faq-page-section__label">Preguntas frecuentes</p>
            <h2>Lo esencial antes de que abramos el piloto.</h2>
        </div>

        <div class="faq-groups">
            <?php foreach ( $faq_groups as $group_index => $group ) : ?>
                <section class="faq-group glass-card" aria-labelledby="faq-group-<?php echo esc_attr( $group_index ); ?>">
                    <div class="faq-group__header">
                        <h3 id="faq-group-<?php echo esc_attr( $group_index ); ?>"><?php echo esc_html( $group['title'] ); ?></h3>
                    </div>

                    <div class="faq-accordion">
                        <?php foreach ( $group['items'] as $item_index => $item ) : ?>
                            <?php
                            $item_id  = 'faq-item-' . $group_index . '-' . $item_index;
                            $panel_id = $item_id . '-panel';
                            ?>
                            <article class="faq-accordion__item">
                                <h4 class="faq-accordion__heading">
                                    <button
                                        class="faq-accordion__trigger"
                                        type="button"
                                        aria-expanded="false"
                                        aria-controls="<?php echo esc_attr( $panel_id ); ?>"
                                        id="<?php echo esc_attr( $item_id ); ?>"
                                    >
                                        <span><?php echo esc_html( $item['question'] ); ?></span>
                                        <span class="faq-accordion__icon" aria-hidden="true"></span>
                                    </button>
                                </h4>

                                <div
                                    class="faq-accordion__panel"
                                    id="<?php echo esc_attr( $panel_id ); ?>"
                                    role="region"
                                    aria-labelledby="<?php echo esc_attr( $item_id ); ?>"
                                    hidden
                                >
                                    <p><?php echo esc_html( $item['answer'] ); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </div>
</section>
