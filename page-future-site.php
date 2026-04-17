<?php
/**
 * Future site landing page.
 *
 * Template Name: Future Site
 * Template Post Type: page
 *
 * Dedicated long-form design preview that preserves the existing waitlist
 * homepage while connecting every CTA to real site routes.
 */

get_header();

$waitlist_url = ogape_get_waitlist_url();
$plans_url    = home_url( '/planes/' );
$menu_url     = home_url( '/menu/' );
$how_url      = home_url( '/como-funciona/' );
$coverage_url = home_url( '/cobertura/' );
$about_url    = home_url( '/nosotros/' );
$faq_url      = home_url( '/faq/' );
$contact_url  = home_url( '/contacto/' );
$wa_url       = ogape_get_whatsapp_url();
$wa_display   = ogape_get_whatsapp_display();
$email        = ogape_get_contact_email();

$dishes = array(
    array(
        'eyebrow'      => 'Receta N.º 01 · del río',
        'title'        => 'Surubí al Maracuyá',
        'title_en'     => 'Surubi with passion fruit butter',
        'description'  => 'Surubí del Paraná porcionado y frío. Lo sellás en minutos, montás la mantequilla de maracuyá y lo servís con mandioca dorada.',
        'time'         => '35 min',
        'difficulty'   => 'media',
        'servings'     => '2 · 4',
        'calories'     => '620 kcal',
        'contains'     => 'Pescado · Lácteos',
        'tags'         => array(
            array( 'label' => 'Plato estrella', 'variant' => 'hero' ),
            array( 'label' => 'Local', 'variant' => 'local' ),
        ),
        'accent'       => 'river',
    ),
    array(
        'eyebrow'      => 'Receta N.º 02 · del monte',
        'title'        => 'Bife Koygua Negro',
        'title_en'     => 'Black beer countryside beef',
        'description'  => 'Costilla braseada en reducción de cerveza negra, cebolla asada y puré rústico para una caja con más cuerpo.',
        'time'         => '40 min',
        'difficulty'   => 'baja',
        'servings'     => '2 · 4',
        'calories'     => '710 kcal',
        'contains'     => 'Carne · Lácteos',
        'tags'         => array(
            array( 'label' => 'Favorito', 'variant' => 'warm' ),
        ),
        'accent'       => 'earth',
    ),
    array(
        'eyebrow'      => 'Receta N.º 03 · de la huerta',
        'title'        => 'Bowl Proteico Ogape',
        'title_en'     => 'Ogape protein bowl',
        'description'  => 'Pollo grillado, arroz jazmín, hummus suave, verduras encurtidas y crocante de semillas en un armado rápido.',
        'time'         => '25 min',
        'difficulty'   => 'baja',
        'servings'     => '2 · 4',
        'calories'     => '540 kcal',
        'contains'     => 'Sésamo',
        'tags'         => array(
            array( 'label' => 'Favorito', 'variant' => 'sage' ),
        ),
        'accent'       => 'garden',
    ),
    array(
        'eyebrow'      => 'Receta N.º 04 · del mundo',
        'title'        => 'Pollo al Curry Suave',
        'title_en'     => 'Mild coconut curry chicken',
        'description'  => 'Curry suave de coco con especias ya dosificadas, arroz perfumado y cilantro fresco para una semana más amplia.',
        'time'         => '30 min',
        'difficulty'   => 'baja',
        'servings'     => '2 · 4',
        'calories'     => '580 kcal',
        'contains'     => 'Coco',
        'tags'         => array(
            array( 'label' => 'Internacional', 'variant' => 'ink' ),
        ),
        'accent'       => 'curry',
    ),
);

$plans = array(
    '2p3' => array(
        'label'       => 'Para 2',
        'name'        => '3 recetas',
        'summary'     => '6 porciones · ideal pareja',
        'title'       => 'Para 2 · 3 recetas',
        'price'       => 'Gs 285.000',
        'price_note'  => 'Gs 47.500 por porción',
        'portions'    => '6 porciones',
    ),
    '2p5' => array(
        'label'       => 'Para 2',
        'name'        => '5 recetas',
        'summary'     => '10 porciones · toda la semana',
        'title'       => 'Para 2 · 5 recetas',
        'price'       => 'Gs 445.000',
        'price_note'  => 'Gs 44.500 por porción',
        'portions'    => '10 porciones',
    ),
    '4p3' => array(
        'label'       => 'Para 4',
        'name'        => '3 recetas',
        'summary'     => '12 porciones · familia corta',
        'title'       => 'Para 4 · 3 recetas',
        'price'       => 'Gs 545.000',
        'price_note'  => 'Gs 45.500 por porción',
        'portions'    => '12 porciones',
    ),
    '4p5' => array(
        'label'       => 'Para 4',
        'name'        => '5 recetas',
        'summary'     => '20 porciones · familia completa',
        'title'       => 'Para 4 · 5 recetas',
        'price'       => 'Gs 870.000',
        'price_note'  => 'Gs 43.500 por porción',
        'portions'    => '20 porciones',
    ),
);

$default_plan = $plans['2p3'];

$zones = array(
    array( 'name' => 'Villa Morra', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'Recoleta', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'Las Carmelitas', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'Mburucuyá', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'Ycuá Satí', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'Centro', 'status' => 'Activa', 'active' => true ),
    array( 'name' => 'San Lorenzo', 'status' => 'Próximamente', 'active' => false ),
    array( 'name' => 'Lambaré', 'status' => 'Próximamente', 'active' => false ),
);

$faqs = array(
    array(
        'question' => '¿Tengo que suscribirme?',
        'answer'   => 'No. El foco del piloto sigue siendo una entrada flexible: podés anotarte, pedir cuando abras tu zona y pausar sin fricción.',
    ),
    array(
        'question' => '¿Cuándo cierra el pedido y cuándo llega la caja?',
        'answer'   => 'La lógica de diseño contempla cierre de pedidos el martes y entregas el jueves en Asunción, alineada con la propuesta actual del piloto.',
    ),
    array(
        'question' => '¿Qué pasa si algún ingrediente no me gusta?',
        'answer'   => 'La cuenta y el onboarding están pensados para guardar preferencias, alergias y reemplazos antes de pasar a una operación más completa.',
    ),
    array(
        'question' => '¿Cuánto se tarda en cocinar?',
        'answer'   => 'La selección está planteada para cocinarse en 25 a 40 minutos con herramientas de casa y pasos claros.',
    ),
);
?>

<main id="main" class="site-main future-site-page" role="main">
    <section class="future-landing-hero">
        <div class="container future-landing-shell">
            <div class="future-landing-hero__content">
                <p class="future-landing-eyebrow">Ogape · Tu Chef en Casa</p>
                <h1 class="future-landing-title">Paraguay en una caja, listo para entrar a casa con más intención.</h1>
                <p class="future-landing-lead">
                    Este es el nuevo recorrido editorial para <code>/future-site/</code>: una versión más completa de la propuesta,
                    con narrativa de marca, menú piloto, cajas, cobertura y accesos conectados al sitio real.
                </p>
                <div class="future-landing-hero__actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">Unirme a la lista</a>
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost btn--lg">Ver menú</a>
                </div>
                <ul class="future-landing-hero__links" aria-label="Rutas del sitio">
                    <li><a href="<?php echo esc_url( $plans_url ); ?>">Planes</a></li>
                    <li><a href="<?php echo esc_url( $about_url ); ?>">Nosotros</a></li>
                    <li><a href="<?php echo esc_url( $how_url ); ?>">Cómo funciona</a></li>
                    <li><a href="<?php echo esc_url( $coverage_url ); ?>">Cobertura</a></li>
                    <li><a href="<?php echo esc_url( $faq_url ); ?>">FAQ</a></li>
                </ul>
            </div>

            <div class="future-landing-hero__visual" aria-hidden="true">
                <div class="future-box">
                    <div class="future-box__lid"></div>
                    <div class="future-box__label">
                        <span>Ogape</span>
                        <strong>Tu Chef en Casa</strong>
                    </div>
                </div>
                <div class="future-chip future-chip--top">Río + monte + ciudad</div>
                <div class="future-chip future-chip--bottom">Meal kits para Asunción</div>
            </div>
        </div>
    </section>

    <section class="future-landing-section" id="como">
        <div class="container">
            <div class="future-section-head">
                <span class="future-landing-eyebrow">01 · Cómo funciona</span>
                <h2 class="future-section-title">Menos ruido, más cocina real.</h2>
                <p class="future-section-copy">
                    El sistema baja complejidad sin perder identidad: elegís la caja, recibís ingredientes porcionados y cocinás con una receta pensada para una cocina de verdad.
                </p>
            </div>

            <div class="future-steps">
                <article class="future-step-card">
                    <span class="future-step-card__index">01</span>
                    <h3>Elegís tu semana</h3>
                    <p>Entrás desde el menú o los planes actuales y definís cuántas recetas querés recibir.</p>
                    <a href="<?php echo esc_url( $plans_url ); ?>">Ir a planes</a>
                </article>
                <article class="future-step-card">
                    <span class="future-step-card__index">02</span>
                    <h3>Recibís la caja</h3>
                    <p>La cobertura se abre por zonas de Asunción y la entrega sigue una lógica simple, fría y ordenada.</p>
                    <a href="<?php echo esc_url( $coverage_url ); ?>">Ver cobertura</a>
                </article>
                <article class="future-step-card">
                    <span class="future-step-card__index">03</span>
                    <h3>Cocinás en 30 minutos</h3>
                    <p>Las recetas priorizan pasos cortos, ingredientes útiles y una porción honesta para repetir.</p>
                    <a href="<?php echo esc_url( $how_url ); ?>">Ver el flujo completo</a>
                </article>
            </div>
        </div>
    </section>

    <section class="future-landing-section future-landing-section--tinted" id="semana">
        <div class="container">
            <div class="future-section-head future-section-head--split">
                <div>
                    <span class="future-landing-eyebrow">02 · Menú piloto</span>
                    <h2 class="future-section-title">Una semana corta, pero con carácter.</h2>
                </div>
                <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost btn--md">Ver menú completo</a>
            </div>

            <div class="future-dish-grid">
                <?php foreach ( $dishes as $dish ) : ?>
                    <article class="future-dish-card future-dish-card--<?php echo esc_attr( $dish['accent'] ); ?>">
                        <div class="future-dish-card__media">
                            <div class="future-dish-card__tags">
                                <?php foreach ( $dish['tags'] as $tag ) : ?>
                                    <span class="future-tag future-tag--<?php echo esc_attr( $tag['variant'] ); ?>">
                                        <?php echo esc_html( $tag['label'] ); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <div class="future-dish-card__meta">
                                <span><?php echo esc_html( $dish['time'] ); ?></span>
                                <span>Dificultad · <?php echo esc_html( $dish['difficulty'] ); ?></span>
                            </div>
                        </div>
                        <div class="future-dish-card__body">
                            <span class="future-dish-card__eyebrow"><?php echo esc_html( $dish['eyebrow'] ); ?></span>
                            <h3><?php echo esc_html( $dish['title'] ); ?></h3>
                            <p class="future-dish-card__translation"><?php echo esc_html( $dish['title_en'] ); ?></p>
                            <p class="future-dish-card__description"><?php echo esc_html( $dish['description'] ); ?></p>
                            <dl class="future-dish-card__stats">
                                <div>
                                    <dt>Porciones</dt>
                                    <dd><?php echo esc_html( $dish['servings'] ); ?></dd>
                                </div>
                                <div>
                                    <dt>Calorías</dt>
                                    <dd><?php echo esc_html( $dish['calories'] ); ?></dd>
                                </div>
                                <div>
                                    <dt>Contiene</dt>
                                    <dd><?php echo esc_html( $dish['contains'] ); ?></dd>
                                </div>
                            </dl>
                            <a href="<?php echo esc_url( $menu_url ); ?>" class="future-inline-link">Ver detalle en menú</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="future-landing-section" id="plan">
        <div class="container future-plan-layout">
            <div class="future-plan-copy">
                <span class="future-landing-eyebrow">03 · La caja</span>
                <h2 class="future-section-title">Una caja, dos ritmos.</h2>
                <p class="future-section-copy">
                    Elegís cuántas recetas por semana y para cuántas personas. La interacción queda viva para esta página, pero el CTA principal ya desemboca en la entrada real al piloto.
                </p>

                <div class="future-plan-picker" role="list" aria-label="Tamaños de caja">
                    <?php foreach ( $plans as $plan_key => $plan ) : ?>
                        <button
                            class="future-plan-choice<?php echo '2p3' === $plan_key ? ' is-active' : ''; ?>"
                            type="button"
                            data-plan-key="<?php echo esc_attr( $plan_key ); ?>"
                            data-plan-title="<?php echo esc_attr( $plan['title'] ); ?>"
                            data-plan-price="<?php echo esc_attr( $plan['price'] ); ?>"
                            data-plan-note="<?php echo esc_attr( $plan['price_note'] ); ?>"
                            data-plan-portions="<?php echo esc_attr( $plan['portions'] ); ?>"
                            aria-pressed="<?php echo '2p3' === $plan_key ? 'true' : 'false'; ?>"
                        >
                            <span class="future-plan-choice__label"><?php echo esc_html( $plan['label'] ); ?></span>
                            <strong><?php echo esc_html( $plan['name'] ); ?></strong>
                            <small><?php echo esc_html( $plan['summary'] ); ?></small>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="future-plan-facts">
                    <div><strong>Sin compromiso</strong><span>Pausás o cancelás cuando quieras.</span></div>
                    <div><strong>Frescura</strong><span>Caja refrigerada, entrega el mismo día.</span></div>
                    <div><strong>Origen</strong><span>Productores de Central y pescadores locales.</span></div>
                    <div><strong>Tiempo</strong><span>25 a 40 minutos por receta.</span></div>
                </div>
            </div>

            <aside class="future-plan-card" aria-live="polite">
                <span class="future-plan-card__badge">Caja activa</span>
                <h3 data-plan-title><?php echo esc_html( $default_plan['title'] ); ?></h3>
                <p class="future-plan-card__price">
                    <strong data-plan-price><?php echo esc_html( $default_plan['price'] ); ?></strong>
                    <span data-plan-note>/ semana · <?php echo esc_html( $default_plan['price_note'] ); ?></span>
                </p>
                <ul class="future-plan-card__list">
                    <li><span data-plan-portions><?php echo esc_html( $default_plan['portions'] ); ?></span> de ingredientes porcionados.</li>
                    <li>Receta ilustrada con pasos claros.</li>
                    <li>Caja refrigerada y compostable.</li>
                    <li>Entrega piloto en Asunción.</li>
                    <li>Pausa simple para semanas sin uso.</li>
                </ul>
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg future-plan-card__cta">Comenzar con esta caja</a>
                <p class="future-plan-card__note">Los valores muestran la lógica editorial del piloto y llevan al flujo real de lista de espera.</p>
            </aside>
        </div>
    </section>

    <section class="future-landing-section future-landing-section--ink" id="zonas">
        <div class="container future-zones-layout">
            <div class="future-zones-copy">
                <span class="future-landing-eyebrow">04 · Zonas de entrega</span>
                <h2 class="future-section-title">Entregamos los jueves en Asunción.</h2>
                <p class="future-section-copy">
                    La propuesta editorial se apoya en una cobertura limitada para cuidar la operación. En esta versión, el bloque de zonas conecta con la página real en vez de simular un formulario nuevo.
                </p>

                <div class="future-zone-list">
                    <?php foreach ( $zones as $zone ) : ?>
                        <div class="future-zone-item">
                            <span class="future-zone-item__dot<?php echo $zone['active'] ? '' : ' future-zone-item__dot--soon'; ?>"></span>
                            <strong><?php echo esc_html( $zone['name'] ); ?></strong>
                            <small><?php echo esc_html( $zone['status'] ); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="future-zones-actions">
                    <a href="<?php echo esc_url( $coverage_url ); ?>" class="btn btn--secondary btn--md">Ver cobertura actual</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--ghost btn--md">Avisarme cuando abra mi barrio</a>
                </div>
            </div>

            <div class="future-map-card" role="img" aria-label="Mapa ilustrado de cobertura de Ogape en Asunción">
                <div class="future-map-card__river"></div>
                <div class="future-map-card__shape future-map-card__shape--one"></div>
                <div class="future-map-card__shape future-map-card__shape--two"></div>
                <div class="future-map-card__shape future-map-card__shape--three"></div>
                <div class="future-map-card__label future-map-card__label--city">Asunción</div>
                <div class="future-map-card__label future-map-card__label--hq">Villa Morra · Ogape HQ</div>
                <div class="future-map-card__pin"></div>
            </div>
        </div>
    </section>

    <section class="future-landing-section">
        <div class="container future-story-layout">
            <div class="future-story-copy">
                <span class="future-landing-eyebrow">05 · La cocina</span>
                <h2 class="future-section-title">Paraguay, sin pedir permiso.</h2>
                <p class="future-section-copy">
                    Ogape empieza con un pescado del Paraná y una fruta de monte. Desde ahí se ordena todo lo demás: la porción, la especia, el tiempo y la forma de entrar a casa.
                </p>
                <p class="future-section-copy">
                    El lenguaje visual y comercial de esta página está pensado para convivir con el resto del sitio oficial, no para reemplazarlo a la fuerza. Por eso los accesos respetan la arquitectura actual.
                </p>
                <a href="<?php echo esc_url( $about_url ); ?>" class="future-inline-link">Conocer más sobre Ogape</a>
            </div>

            <div class="future-pillars">
                <article class="future-pillar-card">
                    <span>i.</span>
                    <h3>Río y monte</h3>
                    <p>Surubí del Paraná, frutas de monte y productos pensados desde Paraguay.</p>
                </article>
                <article class="future-pillar-card">
                    <span>ii.</span>
                    <h3>Mano corta</h3>
                    <p>Tres a cinco ingredientes clave por receta. Si no aporta, no entra.</p>
                </article>
                <article class="future-pillar-card">
                    <span>iii.</span>
                    <h3>Porción honesta</h3>
                    <p>Todo se pesa para cocinar bien en una cocina real, no para inflar empaque.</p>
                </article>
                <article class="future-pillar-card">
                    <span>iv.</span>
                    <h3>Temporada viva</h3>
                    <p>El menú cambia cuando cambia lo que vale la pena cocinar.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="future-landing-section future-landing-section--tinted">
        <div class="container">
            <div class="future-section-head future-section-head--centered">
                <span class="future-landing-eyebrow">06 · Preguntas frecuentes</span>
                <h2 class="future-section-title">Lo que suelen preguntarnos.</h2>
            </div>
            <div class="future-faq-grid">
                <?php foreach ( $faqs as $index => $faq ) : ?>
                    <details class="future-faq-item"<?php echo 0 === $index ? ' open' : ''; ?>>
                        <summary><?php echo esc_html( $faq['question'] ); ?></summary>
                        <p><?php echo esc_html( $faq['answer'] ); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
            <div class="future-faq-link-row">
                <a href="<?php echo esc_url( $faq_url ); ?>" class="future-inline-link">Abrir la página completa de preguntas frecuentes</a>
            </div>
        </div>
    </section>

    <section class="future-landing-final" id="final">
        <div class="container">
            <span class="future-landing-eyebrow">Empezá esta semana</span>
            <h2 class="future-section-title">La primera caja Ogape ya tiene una versión más sólida en línea.</h2>
            <p class="future-section-copy">
                Esta página funciona como vitrina completa para <code>/future-site/</code>, pero los pasos reales siguen viviendo en las rutas activas del sitio actual.
            </p>
            <div class="future-landing-final__actions">
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">Unirme</a>
                <?php if ( $wa_url ) : ?>
                    <a href="<?php echo esc_url( $wa_url ); ?>" class="btn btn--ghost btn--lg" target="_blank" rel="noopener noreferrer">
                        WhatsApp <?php echo esc_html( $wa_display ); ?>
                    </a>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="btn btn--secondary btn--lg">
                        <?php echo esc_html( $email ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <p class="future-landing-final__note">
                También podés seguir desde <a href="<?php echo esc_url( $contact_url ); ?>">contacto</a>,
                <a href="<?php echo esc_url( $plans_url ); ?>">planes</a> o <a href="<?php echo esc_url( $menu_url ); ?>">menú</a>.
            </p>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var choices = document.querySelectorAll('.future-plan-choice');
  var title = document.querySelector('[data-plan-title]');
  var price = document.querySelector('[data-plan-price]');
  var note = document.querySelector('[data-plan-note]');
  var portions = document.querySelector('[data-plan-portions]');

  if (!choices.length || !title || !price || !note || !portions) {
    return;
  }

  choices.forEach(function (choice) {
    choice.addEventListener('click', function () {
      choices.forEach(function (item) {
        item.classList.remove('is-active');
        item.setAttribute('aria-pressed', 'false');
      });

      choice.classList.add('is-active');
      choice.setAttribute('aria-pressed', 'true');

      title.textContent = choice.dataset.planTitle || '';
      price.textContent = choice.dataset.planPrice || '';
      note.textContent = '/ semana · ' + (choice.dataset.planNote || '');
      portions.textContent = choice.dataset.planPortions || '';
    });
  });
});
</script>

<?php get_footer(); ?>
