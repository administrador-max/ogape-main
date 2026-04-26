<?php
/**
 * Future site landing page.
 *
 * Template Name: Future Site
 * Template Post Type: page
 */

get_header();

$home_url           = home_url( '/' );
$waitlist_url       = ogape_get_waitlist_url();
$plans_url          = home_url( '/planes/' );
$about_url          = home_url( '/nosotros/' );
$menu_url           = home_url( '/menu/' );
$how_url            = home_url( '/como-funciona/' );
$gift_url           = home_url( '/tarjetas-regalo/' );
$sustainability_url = home_url( '/sostenibilidad/' );
$alliances_url      = home_url( '/alianzas/' );
$coverage_url       = home_url( '/cobertura/' );
$login_url          = home_url( '/login/' );
$faq_url            = home_url( '/faq/' );
$privacy_url        = home_url( '/privacidad/' );
$terms_url          = home_url( '/terminos/' );
$contact_url        = home_url( '/contacto/' );
$logo_url           = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$wa_url             = ogape_get_whatsapp_url();
$wa_display         = ogape_get_whatsapp_display();
$contact_email      = ogape_get_contact_email();
$orders_email       = 'pedidos@ogape.com.py';

$dishes = array(
    array(
        'class'       => 'dish dish--hero',
        'tags'        => array(
            array( 'class' => 'tag tag--hero', 'label' => 'Plato Estrella' ),
            array( 'class' => 'tag tag--local', 'label' => 'Local' ),
        ),
        'time'        => '35 min',
        'difficulty'  => 'media',
        'number'      => 'Receta N.º 01 · del río',
        'title'       => 'Surubí al Maracuyá',
        'title_en'    => 'Surubi with passion fruit butter',
        'description' => 'Surubí del Paraná en tu caja, ya porcionado y frío. Lo sellás en 6 minutos, montás la mantequilla de maracuyá con lo que incluimos, y servís con mandioca dorada. Sabe a un viernes bien pensado.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '620 kcal' ),
            array( 'label' => 'Contiene', 'value' => 'Pescado · Lácteos' ),
        ),
    ),
    array(
        'class'       => 'dish dish--beef',
        'tags'        => array(
            array( 'class' => 'tag tag--nomad', 'label' => 'Favorito' ),
        ),
        'time'        => '40 min',
        'difficulty'  => 'baja',
        'number'      => 'Receta N.º 02 · del monte',
        'title'       => 'Bife Koygua Negro',
        'title_en'    => 'Black beer countryside beef',
        'description' => 'Costilla braseada en reducción de cerveza negra — ya marinada 24 h — con cebolla asada y puré rústico.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '710 kcal' ),
        ),
    ),
    array(
        'class'       => 'dish dish--bowl',
        'tags'        => array(
            array( 'class' => 'tag tag--nomad', 'label' => 'Favorito' ),
        ),
        'time'        => '25 min',
        'difficulty'  => 'baja',
        'number'      => 'Receta N.º 03 · de la huerta',
        'title'       => 'Bowl Proteico Ogape',
        'title_en'    => 'Ogape protein bowl',
        'description' => 'Pollo grillado, arroz jazmín, hummus suave, verduras encurtidas y crocante de semillas de la casa.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '540 kcal' ),
        ),
    ),
    array(
        'class'       => 'dish dish--curry',
        'tags'        => array(
            array( 'class' => 'tag tag--intl', 'label' => 'Internacional' ),
        ),
        'time'        => '30 min',
        'difficulty'  => 'baja',
        'number'      => 'Receta N.º 04 · del mundo',
        'title'       => 'Pollo al Curry Suave',
        'title_en'    => 'Mild coconut curry chicken',
        'description' => 'Curry suave de coco con especias ya dosificadas, arroz perfumado y cilantro fresco.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '580 kcal' ),
        ),
    ),
    array(
        'class'       => 'dish dish--mila',
        'tags'        => array(
            array( 'class' => 'tag tag--nomad', 'label' => 'Favorito' ),
        ),
        'time'        => '25 min',
        'difficulty'  => 'muy baja',
        'number'      => 'Receta N.º 05 · clásico de casa',
        'title'       => 'Milanesa Signature',
        'title_en'    => 'Signature milanesa',
        'description' => 'Milanesa de corte premium, ya apanada — solo la freís — con papas rústicas y alioli casero.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '670 kcal' ),
        ),
    ),
);

$plan_options = array(
    '2p3' => array(
        'k'  => 'Para 2',
        'n'  => '3 recetas',
        'p'  => '6 porciones · ideal pareja',
        't'  => 'Para 2 · 3 recetas',
        'pr' => 'Gs 285.000',
        'pp' => 'Gs 47.500 por porción',
        'i'  => '6 porciones',
    ),
    '2p5' => array(
        'k'  => 'Para 2',
        'n'  => '5 recetas',
        'p'  => '10 porciones · toda la semana',
        't'  => 'Para 2 · 5 recetas',
        'pr' => 'Gs 445.000',
        'pp' => 'Gs 44.500 por porción',
        'i'  => '10 porciones',
    ),
    '4p3' => array(
        'k'  => 'Para 4',
        'n'  => '3 recetas',
        'p'  => '12 porciones · familia corta',
        't'  => 'Para 4 · 3 recetas',
        'pr' => 'Gs 545.000',
        'pp' => 'Gs 45.500 por porción',
        'i'  => '12 porciones',
    ),
    '4p5' => array(
        'k'  => 'Para 4',
        'n'  => '5 recetas',
        'p'  => '20 porciones · familia completa',
        't'  => 'Para 4 · 5 recetas',
        'pr' => 'Gs 870.000',
        'pp' => 'Gs 43.500 por porción',
        'i'  => '20 porciones',
    ),
);

$faq_items = array(
    array(
        'question' => '¿Tengo que suscribirme?',
        'answer'   => 'No. Pedís la semana que querés y pausás el resto. Si querés recibir todas las semanas, activás la entrega automática — y la pausás con un clic cuando te vas de viaje.',
    ),
    array(
        'question' => '¿Cuándo cierra el pedido y cuándo llega la caja?',
        'answer'   => 'Los pedidos cierran el martes a las 23:59. La caja llega el jueves, entre las 10:00 y las 19:00, a la dirección que elegiste. Si no estás, podemos dejarla en portería si lo autorizás.',
    ),
    array(
        'question' => '¿Qué pasa si algún ingrediente no me gusta?',
        'answer'   => 'Podés marcar alergias y aversiones al momento del pedido. Si una receta no encaja con tu semana, la reemplazás por otra del menú — todas vienen porcionadas para que el swap sea simple.',
    ),
    array(
        'question' => '¿Cuánto se tarda en cocinar?',
        'answer'   => 'Entre 25 y 40 minutos por receta, con una sartén, un cuchillo y una olla. Las instrucciones vienen impresas con pasos ilustrados, pensadas para una cocina de casa.',
    ),
    array(
        'question' => '¿Los ingredientes son locales?',
        'answer'   => 'Priorizamos productores del departamento Central y pescadores de Asunción. Lo que no se consigue localmente con calidad (como algunas especias del curry) se importa y lo marcamos en la ficha de la receta.',
    ),
    array(
        'question' => '¿La caja es reciclable?',
        'answer'   => 'Sí. La caja exterior es cartón reciclado, el aislante térmico es biodegradable, y las bolsas internas son compostables. Te dejamos una guía corta de qué hacer con cada parte.',
    ),
);
?>

<main id="main" class="site-main future-site-design" role="main">

    <section class="hero">
        <div class="wrap hero__grid">
            <div>
                <div class="hero__kicker rise">
                    <span class="dot"></span>
                    <span class="eyebrow">Ogape Tu Chef en Casa · Semana del 20 al 26 de abril</span>
                </div>
                <h1 class="hero__title rise rise--2">
                    Cocina paraguaya,<br>
                    <em>lista para tu casa.</em>
                </h1>
                <p class="hero__lede rise rise--3">
                    Cinco recetas por semana. Ingredientes del río, del monte y de la huerta
                    — porcionados, fríos, con instrucciones simples. Vos cocinás en
                    30 minutos. Nosotros pensamos el resto.
                </p>
                <div class="hero__ctas rise rise--3">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary">
                        Unirme
                        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost">Ver el menú de la semana</a>
                </div>
                <div class="hero__meta">
                    <div><b>5 recetas</b>nuevas cada semana</div>
                    <div><b>≈30 min</b>de cocción en casa</div>
                    <div><b>Asunción</b>entrega los jueves</div>
                </div>
            </div>

            <figure class="hero__media" aria-label="Ogape Tu Chef en Casa — caja semanal con cinco recetas">
                <div class="kit-box" aria-hidden="true"></div>
                <div class="kit-items" aria-hidden="true">
                    <span class="kit-chip kit-chip--accent">Surubí</span>
                    <span class="kit-chip">Maracuyá</span>
                    <span class="kit-chip">Mandioca</span>
                    <span class="kit-chip">Curry de coco</span>
                    <span class="kit-chip">Bife koygua</span>
                    <span class="kit-chip">Alioli</span>
                    <span class="kit-chip">Hierbas</span>
                </div>
                <div class="kit-tape" aria-hidden="true"><span>Ogape</span><span>· Tu Chef en Casa ·</span></div>

                <div class="hero__stamp" aria-hidden="true">
                    <svg viewBox="0 0 100 100">
                        <defs><path id="future-site-circ" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs>
                        <text fill="#1B1B1E" font-family="Cormorant Garamond, serif" font-size="10" letter-spacing="3">
                            <textPath href="#future-site-circ" startOffset="0">MENÚ PILOTO · 5 RECETAS · ABRIL 2026 · </textPath>
                        </text>
                    </svg>
                    <span class="core">05</span>
                </div>

                <figcaption class="hero__caption">
                    <div class="num">N.º 01</div>
                    <div class="cap-r">
                        <span class="cap-eyebrow">Plato estrella esta semana</span>
                        <div class="cap-title">Surubí al Maracuyá</div>
                        <div class="cap-sub">Paraná · mantequilla de maracuyá · mandioca</div>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="how" id="como">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow sec-label">01 · Cómo funciona</span>
                    <h2>De la huerta a tu mesa, en cuatro pasos.</h2>
                </div>
                <p>Sin suscripción rígida. Pedís la semana que querés. Pausás cuando querés.</p>
            </div>
            <div class="how__grid">
                <div class="step">
                    <div class="step__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16l-1.5 10a2 2 0 0 1-2 1.7H7.5a2 2 0 0 1-2-1.7L4 7Z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg></div>
                    <span class="step__num">paso i.</span>
                    <h3>Elegís el menú</h3>
                    <p>Mirás las 5 recetas de la semana y elegís cuántas porciones querés — para 2 o 4 personas.</p>
                </div>
                <div class="step">
                    <div class="step__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9-4 9 4-9 4-9-4Z"/><path d="M3 7v10l9 4 9-4V7"/><path d="M12 11v10"/></svg></div>
                    <span class="step__num">paso ii.</span>
                    <h3>Preparamos tu caja</h3>
                    <p>Porcionamos todo — el pescado del día, la mandioca, las especias — y lo metemos en una caja refrigerada.</p>
                </div>
                <div class="step">
                    <div class="step__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 14h11V5H3v9Z"/><path d="M14 9h4l3 3v5h-7"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg></div>
                    <span class="step__num">paso iii.</span>
                    <h3>Llega a tu puerta</h3>
                    <p>Los jueves entre 10:00 y 19:00 en Asunción. Dejamos en portería si no estás.</p>
                </div>
                <div class="step">
                    <div class="step__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/><path d="M3 14h18l-1.5 4a2 2 0 0 1-2 1.3H6.5A2 2 0 0 1 4.5 18L3 14Z"/><path d="M12 6V3"/></svg></div>
                    <span class="step__num">paso iv.</span>
                    <h3>Cocinás en 30 min</h3>
                    <p>Instrucciones ilustradas, sencillas. Sabor de Paraguay, sin nada que adivinar.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="week" id="semana">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow sec-label">02 · El menú de esta semana</span>
                    <h2>Cinco recetas, elegidas despacio.</h2>
                </div>
                <p>Cada semana renovamos las cinco recetas según lo que llega del río, del monte y de la huerta.</p>
            </div>

            <div class="week__bar">
                <span class="pill"><span class="pulse"></span>Semana activa</span>
                <span class="label">Pedidos cierran: <b>martes 23:59</b></span>
                <span class="label">Entrega: <b>jueves</b></span>
                <span class="spacer"></span>
                <span class="mini">Próxima semana se anuncia el viernes ·</span>
            </div>

            <div class="dishes">
                <?php foreach ( $dishes as $dish ) : ?>
                    <article class="<?php echo esc_attr( $dish['class'] ); ?>">
                        <div class="dish__img">
                            <div class="dish__tags">
                                <?php foreach ( $dish['tags'] as $tag ) : ?>
                                    <span class="<?php echo esc_attr( $tag['class'] ); ?>"><?php echo esc_html( $tag['label'] ); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="dish__meta">
                                <span class="mleft"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/></svg><?php echo esc_html( $dish['time'] ); ?></span>
                                <span>Dificultad · <?php echo esc_html( $dish['difficulty'] ); ?></span>
                            </div>
                        </div>
                        <div class="dish__body">
                            <span class="dish__num"><?php echo esc_html( $dish['number'] ); ?></span>
                            <h3 class="dish__title"><?php echo esc_html( $dish['title'] ); ?></h3>
                            <div class="dish__title-en"><?php echo esc_html( $dish['title_en'] ); ?></div>
                            <p class="dish__desc"><?php echo esc_html( $dish['description'] ); ?></p>
                            <div class="dish__foot">
                                <div class="dish__stats">
                                    <?php foreach ( $dish['stats'] as $stat ) : ?>
                                        <div><?php echo esc_html( $stat['label'] ); ?><b><?php echo esc_html( $stat['value'] ); ?></b></div>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta
                                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="week__tail">
                <p>
                    Sumás al kit: sopa paraguaya artesanal, mandioca frita con alioli, o ensalada de temporada — preparadas para calentar.
                </p>
                <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--ghost">Ver precios y tamaños
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="plan" id="plan">
        <div class="wrap plan__grid">
            <div>
                <span class="eyebrow">03 · La caja</span>
                <h2>Una caja, <em>dos tamaños.</em></h2>
                <p class="lede">Elegís cuántas recetas por semana y para cuántas personas. Sin suscripción. Pausás o cancelás sin fricción.</p>

                <div class="sizes" role="group" aria-label="Tamaños">
                    <?php foreach ( $plan_options as $key => $plan ) : ?>
                        <button
                            class="size<?php echo '2p3' === $key ? ' is-active' : ''; ?>"
                            type="button"
                            data-size="<?php echo esc_attr( $key ); ?>"
                            data-title="<?php echo esc_attr( $plan['t'] ); ?>"
                            data-price="<?php echo esc_attr( $plan['pr'] ); ?>"
                            data-price-per="<?php echo esc_attr( $plan['pp'] ); ?>"
                            data-portions="<?php echo esc_attr( $plan['i'] ); ?>"
                            aria-pressed="<?php echo '2p3' === $key ? 'true' : 'false'; ?>"
                        >
                            <span class="k"><?php echo esc_html( $plan['k'] ); ?></span>
                            <div class="n"><?php echo esc_html( $plan['n'] ); ?></div>
                            <div class="p"><?php echo esc_html( $plan['p'] ); ?></div>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="plan__facts">
                    <div class="plan__fact"><span class="k">Sin compromiso</span><div class="v">Pausás o cancelás<br>cuando quieras</div></div>
                    <div class="plan__fact"><span class="k">Frescura</span><div class="v">Caja refrigerada,<br>entrega el mismo día</div></div>
                    <div class="plan__fact"><span class="k">Origen</span><div class="v">Productores de Central<br>y pescadores locales</div></div>
                    <div class="plan__fact"><span class="k">Tiempo en casa</span><div class="v">25 – 40 min<br>por receta</div></div>
                </div>
            </div>

            <aside class="plan__card">
                <h3 data-plan-title>Para 2 · 3 recetas</h3>
                <div class="price"><span class="amt" data-plan-price>Gs 285.000</span><span class="per" data-plan-per>/ semana · Gs 47.500 por porción</span></div>
                <ul class="includes">
                    <li data-plan-include><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Ingredientes porcionados para 3 recetas (6 porciones)</li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Receta impresa, ilustrada, con pasos claros</li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Caja refrigerada, compostable</li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Entrega jueves en Asunción, sin cargo extra</li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Pausá la semana que no estás</li>
                </ul>
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--warm plan__cta">
                    Comenzar con esta caja
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <p class="caveat">Precio indicativo del piloto. Ajustes finales al cierre del programa.</p>
            </aside>
        </div>
    </section>

    <section class="zones" id="zonas">
        <div class="wrap zones__grid">
            <div>
                <span class="eyebrow sec-label">04 · Zonas de entrega</span>
                <h2>Entregamos los jueves en <em>Asunción</em>.</h2>
                <p class="zones__copy">
                    Empezamos en el pilot con 6 barrios de Asunción. Si tu zona no está todavía,
                    dejanos tu email y te avisamos en cuanto abramos.
                </p>

                <div class="zone-list">
                    <div><span class="dot"></span>Villa Morra<small>Activa</small></div>
                    <div><span class="dot"></span>Recoleta<small>Activa</small></div>
                    <div><span class="dot"></span>Las Carmelitas<small>Activa</small></div>
                    <div><span class="dot"></span>Mburucuyá<small>Activa</small></div>
                    <div><span class="dot"></span>Ykua Satí<small>Activa</small></div>
                    <div><span class="dot"></span>Centro<small>Activa</small></div>
                    <div><span class="dot dot--soon"></span>San Lorenzo<small>Próximamente</small></div>
                    <div><span class="dot dot--soon"></span>Lambaré<small>Próximamente</small></div>
                </div>

                <div class="check-form">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="check-form__input">tu@email.com · avisame cuando abra mi barrio</a>
                    <a href="<?php echo esc_url( $coverage_url ); ?>" class="btn btn--primary">Avisarme</a>
                </div>
                <p class="check-help">Respetamos tu email. Un mensaje cuando haya novedad, nada más.</p>
            </div>

            <div class="mapcard" role="img" aria-label="Mapa simplificado de zonas de entrega en Asunción">
                <svg viewBox="0 0 400 400" aria-hidden="true">
                    <path d="M-20 260 Q 80 240 140 260 T 280 240 T 420 260 L 420 420 L -20 420 Z" fill="rgba(107,127,232,.12)"/>
                    <path d="M-20 260 Q 80 240 140 260 T 280 240 T 420 260" fill="none" stroke="rgba(107,127,232,.3)" stroke-width="1.5"/>
                    <g fill="rgba(232,160,69,.18)" stroke="rgba(232,160,69,.55)" stroke-width="1">
                        <path d="M180 140 Q 220 120 250 145 Q 260 175 230 185 Q 195 185 175 170 Z"/>
                        <path d="M130 180 Q 155 165 180 180 Q 180 210 155 215 Q 130 210 125 195 Z"/>
                        <path d="M240 180 Q 275 170 300 195 Q 295 225 265 230 Q 240 220 235 200 Z"/>
                        <path d="M95 220 Q 125 210 145 230 Q 140 255 115 255 Q 95 245 90 235 Z"/>
                        <path d="M200 210 Q 235 200 260 225 Q 255 250 225 255 Q 200 245 195 230 Z"/>
                    </g>
                </svg>
                <div class="pin" style="top:46%;left:54%"></div>
                <div class="label" style="top:8%;left:8%">Asunción</div>
                <div class="label" style="bottom:8%;right:10%">Río Paraguay</div>
                <div class="label" style="top:48%;left:60%">Villa Morra · Ogape HQ</div>
            </div>
        </div>
    </section>

    <section class="story" id="historia">
        <div class="wrap story__grid">
            <div>
                <span class="eyebrow sec-label">05 · La cocina</span>
                <h2>Paraguay, <em>sin pedir permiso.</em></h2>
                <p>
                    Ogape empieza con un pescado del Paraná y una fruta de monte. Desde ahí
                    pensamos todo lo demás — la porción, la especia, el tiempo de tu cocina.
                    No es nostalgia, ni es moderno por moda.
                </p>
                <p>
                    Trabajamos con productores del departamento Central y pescadores de Asunción.
                    Pensamos las recetas para que se cocinen bien en una cocina real,
                    con una sartén, con 30 minutos.
                </p>
            </div>
            <div class="pillars">
                <div class="pillar"><span class="n">i.</span><h3>Río &amp; monte</h3><p>Surubí del Paraná, frutas de monte — maracuyá, mburucuyá, guayaba.</p></div>
                <div class="pillar"><span class="n">ii.</span><h3>Mano corta</h3><p>Tres a cinco ingredientes por receta. Si no aporta, no entra.</p></div>
                <div class="pillar"><span class="n">iii.</span><h3>Porción honesta</h3><p>Pesamos todo en la cocina, no en el packaging. Nada de sobras raras.</p></div>
                <div class="pillar"><span class="n">iv.</span><h3>Temporada viva</h3><p>El menú cambia cada semana con lo que llega.</p></div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="wrap">
            <div class="sec-head sec-head--center">
                <span class="eyebrow sec-label">06 · Preguntas frecuentes</span>
                <h2>Lo que suelen preguntarnos.</h2>
            </div>
            <div class="faq__grid">
                <?php foreach ( $faq_items as $index => $faq ) : ?>
                    <details class="q"<?php echo 0 === $index ? ' open' : ''; ?>>
                        <summary><?php echo esc_html( $faq['question'] ); ?></summary>
                        <p><?php echo esc_html( $faq['answer'] ); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="final" id="final">
        <div class="wrap">
            <span class="eyebrow sec-label">Empezá esta semana</span>
            <h2>Tu primera caja <em>Ogape,</em> lista el jueves.</h2>
            <p>Pedidos para esta semana cierran el martes a las 23:59. Después los jueves, todos los jueves — si vos querés.</p>
            <div class="btns">
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary">Unirme
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <?php if ( $wa_url ) : ?>
                    <a href="<?php echo esc_url( $wa_url ); ?>" class="btn btn--ghost"><?php echo esc_html( 'Hablar por WhatsApp' ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer class="foot">
        <div class="wrap">
            <div class="foot__top">
                <div>
                    <div class="foot__brand">
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="">
                        <div>
                            <div class="foot__wordmark">Ogape</div>
                            <span class="foot__where">Tu Chef en Casa</span>
                        </div>
                    </div>
                    <p class="foot__copy">Recetas semanales, listas para cocinar en 30 minutos.</p>
                </div>
                <div class="foot__col">
                    <h4>El producto</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( $how_url ); ?>">Cómo funciona</a></li>
                        <li><a href="<?php echo esc_url( $menu_url ); ?>">Menú de la semana</a></li>
                        <li><a href="<?php echo esc_url( $plans_url ); ?>">Cajas &amp; precios</a></li>
                        <li><a href="<?php echo esc_url( $coverage_url ); ?>">Zonas de entrega</a></li>
                    </ul>
                </div>
                <div class="foot__col">
                    <h4>Contacto</h4>
                    <ul>
                        <?php if ( $wa_url ) : ?>
                            <li><a href="<?php echo esc_url( $wa_url ); ?>">WhatsApp <?php echo esc_html( $wa_display ); ?></a></li>
                        <?php endif; ?>
                        <?php if ( $contact_email ) : ?>
                            <li><a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></li>
                        <?php endif; ?>
                        <li><a href="mailto:<?php echo esc_attr( $orders_email ); ?>"><?php echo esc_html( $orders_email ); ?></a></li>
                    </ul>
                </div>
                <div class="foot__col">
                    <h4>Calendario</h4>
                    <ul>
                        <li><span>Pedidos cierran · martes 23:59</span></li>
                        <li><span>Entrega · jueves 10 – 19 h</span></li>
                        <li><span>Menú nuevo · todos los viernes</span></li>
                    </ul>
                </div>
            </div>
            <div class="foot__legal">
                <span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Ogape Tu Chef en Casa</span>
                <span><a href="<?php echo esc_url( $privacy_url ); ?>">Privacidad</a> · <a href="<?php echo esc_url( $terms_url ); ?>">Términos</a> · <a href="<?php echo esc_url( $contact_url ); ?>">Contacto</a></span>
            </div>
        </div>
    </footer>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var sizes = document.querySelectorAll('.future-site-design .size');
  var cardTitle = document.querySelector('.future-site-design [data-plan-title]');
  var cardPrice = document.querySelector('.future-site-design [data-plan-price]');
  var cardPer = document.querySelector('.future-site-design [data-plan-per]');
  var cardInclude = document.querySelector('.future-site-design [data-plan-include]');

  if (!sizes.length || !cardTitle || !cardPrice || !cardPer || !cardInclude) {
    return;
  }

  sizes.forEach(function (size) {
    size.addEventListener('click', function () {
      sizes.forEach(function (item) {
        item.classList.remove('is-active');
        item.setAttribute('aria-pressed', 'false');
      });

      size.classList.add('is-active');
      size.setAttribute('aria-pressed', 'true');

      cardTitle.textContent = size.dataset.title || '';
      cardPrice.textContent = size.dataset.price || '';
      cardPer.textContent = '/ semana · ' + (size.dataset.pricePer || '');
      cardInclude.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Ingredientes porcionados para 3 recetas (' + (size.dataset.portions || '') + ')';
    });
  });
});
</script>

<?php get_footer(); ?>
