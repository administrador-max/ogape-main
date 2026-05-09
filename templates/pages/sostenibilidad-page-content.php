<?php
/**
 * Sustainability page content.
 *
 * @var array $args Template args.
 */

$home_url  = $args['home_url'] ?? home_url( '/' );
$plans_url = $args['plans_url'] ?? home_url( '/planes/' );
$menu_url  = $args['menu_url'] ?? home_url( '/menu/' );

$hero_principles = array(
    array(
        'title' => 'Porción exacta',
        'copy'  => 'Comprás lo que vas a cocinar.',
    ),
    array(
        'title' => 'Origen cercano',
        'copy'  => 'Priorizamos proveedores locales cuando es posible.',
    ),
    array(
        'title' => 'Empaque consciente',
        'copy'  => 'Protege, presenta y reduce residuos.',
    ),
);

$pillars = array(
    array(
        'title' => 'Porciones exactas',
        'copy'  => 'Compramos y preparamos cantidades pensadas para cada receta, no para llenar la heladera sin plan.',
    ),
    array(
        'title' => 'Menú planificado',
        'copy'  => 'Cada semana concentramos la oferta para mejorar compras, preparación, empaque e inventario.',
    ),
    array(
        'title' => 'Cocina sin acumulación',
        'copy'  => 'Recibís los ingredientes necesarios para cocinar el plato elegido, sin productos que después quedan a medias.',
    ),
);

$local_bullets = array(
    'Priorizamos proveedores de Asunción y alrededores.',
    'Elegimos ingredientes que funcionen bien en kits, frío y preparación en casa.',
    'Diseñamos el menú pensando en disponibilidad local, no solo en inspiración.',
);

$packaging_components = array(
    array(
        'title' => 'Caja kraft',
        'copy'  => 'Una base simple y cálida que acompaña la experiencia sin exagerar materiales.',
    ),
    array(
        'title' => 'Separación clara por receta',
        'copy'  => 'Ordenamos el contenido para que cocinar en casa sea más directo y haya menos confusión.',
    ),
    array(
        'title' => 'Etiquetas simples',
        'copy'  => 'Información clara para abrir, guardar y usar cada ingrediente con menos vueltas.',
    ),
    array(
        'title' => 'Materiales responsables',
        'copy'  => 'Usamos opciones compostables o reciclables cuando el producto lo permite.',
    ),
);

$delivery_bullets = array(
    'Pedidos cierran antes de la entrega.',
    'Ventanas de entrega definidas.',
    'Operación concentrada en Asunción.',
);

$roadmap_now = array(
    'Porciones exactas por receta.',
    'Menú semanal controlado.',
    'Empaque kraft y materiales responsables.',
    'Proveedores locales donde sea viable.',
    'Entregas programadas en Asunción.',
);

$roadmap_later = array(
    'Medición real de desperdicio evitado.',
    'Mejoras de empaque por feedback de clientes.',
    'Más proveedores paraguayos verificados.',
    'Optimización de rutas por volumen.',
    'Reporte simple de impacto Ogape.',
);
?>

<main id="main" class="site-main sustainability-design" role="main">
    <section class="hero" data-screen-label="01 Hero · Sostenibilidad">
        <div class="wrap">
            <div class="hero__crumb">
                <a href="<?php echo esc_url( $home_url ); ?>">Inicio</a>
                <span class="sep">/</span>
                <span>Sostenibilidad</span>
            </div>

            <div class="hero__panel">
                <div class="hero__copy">
                    <span class="eyebrow">Sostenibilidad Ogape</span>
                    <h1>Cocinamos mejor cuando desperdiciamos menos.</h1>
                    <p>
                        En Ogape diseñamos cada caja para usar lo justo: porciones exactas,
                        ingredientes cercanos, empaques conscientes y una experiencia
                        pensada para viajar liviana por Asunción.
                    </p>
                    <div class="hero__actions">
                        <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--olive">
                            Ver planes y precios
                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--mist">Ver menú de la semana</a>
                    </div>
                </div>

                <div class="hero__principles" aria-label="Principios de sostenibilidad Ogape">
                    <?php foreach ( $hero_principles as $principle ) : ?>
                        <article class="principle-card">
                            <span class="principle-card__label"><?php echo esc_html( $principle['title'] ); ?></span>
                            <p><?php echo esc_html( $principle['copy'] ); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="intro" data-screen-label="02 Intro · La caja parte del plato">
        <div class="wrap">
            <div class="intro__card">
                <span class="eyebrow">La caja, parte del plato.</span>
                <h2>Menos compras de más. Más cocina con intención.</h2>
                <p>
                    Cada ingrediente llega medido para la receta. Menos sobras olvidadas,
                    menos envases innecesarios y menos improvisación. Solo lo que necesitás
                    para cocinar rico en casa.
                </p>
            </div>
        </div>
    </section>

    <section class="section pillars" data-screen-label="03 Tres pilares">
        <div class="wrap">
            <div class="section-head">
                <h2>Tres decisiones simples que cambian la experiencia.</h2>
            </div>

            <div class="pillars__grid">
                <?php foreach ( $pillars as $index => $pillar ) : ?>
                    <article class="pillar-card">
                        <span class="pillar-card__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
                        <h3><?php echo esc_html( $pillar['title'] ); ?></h3>
                        <p><?php echo esc_html( $pillar['copy'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section sourcing" data-screen-label="04 Origen cercano">
        <div class="wrap">
            <div class="feature feature--split">
                <div class="feature__copy">
                    <span class="eyebrow">Origen cercano</span>
                    <h2>Más cerca del campo, más cerca de tu mesa.</h2>
                    <p>
                        Ogape nace en Asunción y se construye con una red local: proveedores,
                        cocinas asociadas, empaques y entregas pensadas para operar cerca del
                        cliente. Cuando un ingrediente puede venir de más cerca sin
                        comprometer calidad, esa es nuestra primera opción.
                    </p>

                    <ul class="bullet-list">
                        <?php foreach ( $local_bullets as $bullet ) : ?>
                            <li><?php echo esc_html( $bullet ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <aside class="feature__aside sourcing-note" aria-label="Cómo elegimos cerca">
                    <span class="sourcing-note__eyebrow">Red local</span>
                    <h3>Operar cerca también ordena mejor la cocina.</h3>
                    <p>
                        No buscamos prometer más de lo que podemos sostener. Preferimos una
                        red cercana, con menos capas y más control, para cocinar y entregar
                        mejor de forma consistente.
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <section class="section packaging" data-screen-label="05 Empaque consciente">
        <div class="wrap">
            <div class="section-head">
                <div>
                    <span class="eyebrow">Empaque consciente</span>
                    <h2>El empaque no es decoración. Es parte de la experiencia.</h2>
                </div>
                <p>
                    La caja tiene que proteger los ingredientes, mantener ordenada la receta
                    y sentirse especial al abrirla. Por eso usamos una solución
                    simple, compostable o reciclable cuando el producto lo permite, y una
                    estética cuidada en cada entrega.
                </p>
            </div>

            <div class="packaging__grid">
                <?php foreach ( $packaging_components as $component ) : ?>
                    <article class="pack-card">
                        <h3><?php echo esc_html( $component['title'] ); ?></h3>
                        <p><?php echo esc_html( $component['copy'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section delivery" data-screen-label="06 Entregas programadas">
        <div class="wrap">
            <div class="delivery__card">
                <div class="delivery__copy">
                    <span class="eyebrow">Entregas programadas</span>
                    <h2>Menos improvisación, mejores recorridos.</h2>
                    <p>
                        Al trabajar por pedidos programados y zonas de entrega definidas,
                        podemos planificar mejor. Eso ayuda a evitar viajes innecesarios,
                        ordenar la operación y cuidar que la caja llegue bien.
                    </p>
                </div>

                <ul class="delivery__list">
                    <?php foreach ( $delivery_bullets as $bullet ) : ?>
                        <li><?php echo esc_html( $bullet ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="section roadmap" data-screen-label="07 Ahora y después">
        <div class="wrap">
            <div class="section-head">
                <h2>Lo que hacemos ahora. Lo que viene después.</h2>
            </div>

            <div class="roadmap__grid">
                <article class="roadmap-card">
                    <span class="roadmap-card__eyebrow">Ahora</span>
                    <ul>
                        <?php foreach ( $roadmap_now as $item ) : ?>
                            <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>

                <article class="roadmap-card roadmap-card--future">
                    <span class="roadmap-card__eyebrow">Después</span>
                    <ul>
                        <?php foreach ( $roadmap_later as $item ) : ?>
                            <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="quote" data-screen-label="08 Filosofía">
        <div class="wrap">
            <blockquote class="quote__card">
                <p>No buscamos parecer sostenibles. Buscamos diseñar una operación que desperdicie menos por naturaleza.</p>
                <cite>Eso significa empezar simple, medir lo que importa y mejorar cada caja con datos reales.</cite>
            </blockquote>
        </div>
    </section>

    <section class="cta" data-screen-label="09 CTA final">
        <div class="wrap">
            <div class="cta__card">
                <span class="eyebrow">Listo. Próximo paso.</span>
                <h2>Probá una forma más liviana de cocinar.</h2>
                <p>Elegí tu plan, recibí ingredientes medidos y cociná en casa sin comprar de más.</p>
                <div class="cta__actions">
                    <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--olive">
                        Ver planes y precios
                        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--mist">Ver menú de la semana</a>
                </div>
            </div>
        </div>
    </section>
</main>
