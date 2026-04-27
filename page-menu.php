<?php
/**
 * Menu page — Ogape Tu Chef en Casa.
 *
 * Template Name: Menú Ogape
 * Template Post Type: page
 *
 * Self-contained design from the Website-handoff bundle
 * (Claude Design export, 2026-04-17, website/project/menu.html).
 * Theme chrome is hidden via assets/css/menu-page.css so the page
 * renders the standalone design as intended.
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
$account_url        = home_url( '/account/' );
$privacy_url        = home_url( '/privacidad/' );
$terms_url          = home_url( '/terminos/' );
$contact_url        = home_url( '/contacto/' );
$logo_url           = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$wa_url             = function_exists( 'ogape_get_whatsapp_url' ) ? ogape_get_whatsapp_url() : '';
$wa_display         = function_exists( 'ogape_get_whatsapp_display' ) ? ogape_get_whatsapp_display() : '';
$contact_email      = ogape_get_contact_email();
$orders_email       = 'pedidos@ogape.com.py';
$is_logged_in       = is_user_logged_in();
$logout_url         = function_exists( 'ogape_get_logout_url' ) ? ogape_get_logout_url() : home_url( '/future-site/' );

$menu_account_context = $is_logged_in && function_exists( 'ogape_get_demo_account_context' )
    ? ogape_get_demo_account_context()
    : array();
$menu_first_name = $menu_account_context['first_name'] ?? '';
$menu_name       = $menu_account_context['name'] ?? '';
$menu_email      = $menu_account_context['email'] ?? '';
$menu_initials   = $menu_account_context['initials'] ?? '';

$arrow_svg = '<svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$time_svg  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/></svg>';
$plus_svg  = '<svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';

/* --------------------------------------------------------------------
 * Dish data — mirrors the handoff (menu.html) and keeps richer fields
 * (difficulty, time, stats) that aren't yet in assets/data/menu.json.
 * ------------------------------------------------------------------ */
$dishes = array(
    array(
        'class'       => 'dish dish--hero',
        'filter'      => 'local',
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
        'filter'      => 'local',
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
        'filter'      => 'huerta',
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
        'filter'      => 'intl',
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
        'filter'      => 'local',
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
    array(
        'class'       => 'dish dish--green',
        'filter'      => 'veg huerta',
        'tags'        => array(
            array( 'class' => 'tag tag--veg', 'label' => 'Vegetariano' ),
        ),
        'time'        => '30 min',
        'difficulty'  => 'baja',
        'number'      => 'Extra · de la huerta',
        'title'       => 'Gnocchi de Mandioca',
        'title_en'    => 'Cassava gnocchi with brown butter',
        'description' => 'Ñoquis de mandioca hechos a mano con mantequilla noisette, salvia crocante y parmesano añejo.',
        'stats'       => array(
            array( 'label' => 'Porciones', 'value' => '2 · 4' ),
            array( 'label' => 'Calorías', 'value' => '490 kcal' ),
        ),
    ),
);

$sides = array(
    array(
        'num'         => 'Extra i.',
        'title'       => 'Sopa Paraguaya Artesanal',
        'description' => 'Pan de maíz paraguayo horneado con queso fresco y cebolla caramelizada. Rinde para cuatro.',
        'addon'       => '+ add-on · lista para calentar',
    ),
    array(
        'num'         => 'Extra ii.',
        'title'       => 'Mandioca Frita con Alioli',
        'description' => 'Bastones de mandioca dorados con sal marina gruesa y alioli casero de la semana.',
        'addon'       => '+ add-on · lista para calentar',
    ),
    array(
        'num'         => 'Extra iii.',
        'title'       => 'Ensalada de Temporada',
        'description' => 'Hojas frescas de temporada con vegetales encurtidos y vinagreta cítrica de la casa.',
        'addon'       => '+ add-on · listo',
    ),
);

$past_weeks = array(
    array(
        'week'  => 'Semana 16',
        'date'  => '13 – 19 abr',
        'title' => 'Cítricos & cerdo',
        'items' => array(
            'Cerdo glaseado a la naranja',
            'Risotto de hongos del Chaco',
            'Ensalada tibia de lentejas',
            'Pollo al limón y tomillo',
            'Pasta fresca al pesto de rúcula',
        ),
    ),
    array(
        'week'  => 'Semana 15',
        'date'  => '6 – 12 abr',
        'title' => 'Río alto',
        'items' => array(
            'Dorado al horno con hierbas',
            'Tallarines negros de tinta de calamar',
            'Bowl asiático de atún',
            'Guiso de garbanzos y chorizo',
            'Tarta de acelga y queso fresco',
        ),
    ),
    array(
        'week'  => 'Semana 14',
        'date'  => '30 mar – 5 abr',
        'title' => 'Otoño temprano',
        'items' => array(
            'Calabaza asada con tahini',
            'Costeletas al romero',
            'Curry verde de pollo',
            'Ñoquis de papa, mantequilla noisette',
            'Lomo a las tres pimientas',
        ),
    ),
);

$weeks = array(
    array( 'num' => 'Semana 17 · activa',  'range' => '20 – 26 abril',   'tagline' => 'Río & monte · maracuyá', 'active' => true ),
    array( 'num' => 'Semana 18 · preview', 'range' => '27 abr – 3 may',  'tagline' => 'Huerta de otoño · calabaza' ),
    array( 'num' => 'Semana 19 · preview', 'range' => '4 – 10 mayo',     'tagline' => 'Asado de domingo' ),
    array( 'num' => 'Semana 20 · preview', 'range' => '11 – 17 mayo',    'tagline' => 'Frío & guisos' ),
);

$filters = array(
    array( 'key' => 'all',     'label' => 'Todo',             'dot' => 'var(--brand-primary)', 'on' => true ),
    array( 'key' => 'local',   'label' => 'Del río & monte',  'dot' => '#1B5E20' ),
    array( 'key' => 'huerta',  'label' => 'De la huerta',     'dot' => '#6b8a3a' ),
    array( 'key' => 'intl',    'label' => 'Del mundo',        'dot' => '#0D47A1' ),
    array( 'key' => 'veg',     'label' => 'Vegetariano',      'dot' => '#BF360C' ),
);
?>

<main id="main" class="site-main menu-design" role="main">

    <!-- PAGE HEADER -->
    <section class="pagehead">
        <div class="wrap">
            <div class="crumb rise">
                <a href="<?php echo esc_url( $home_url ); ?>">Inicio</a>
                <span class="sep">/</span>
                <span class="here">Menús</span>
            </div>
            <div class="pagehead__grid">
                <div>
                    <span class="eyebrow rise" style="display:block;margin-bottom:var(--space-4)">Menú piloto · abril 2026</span>
                    <h1 class="rise rise--2">El menú <em>de esta semana.</em></h1>
                    <p class="pagehead__lede rise rise--3">
                        Cinco recetas nuevas, elegidas según lo que llega del río, del monte y de la
                        huerta. Porcionadas, frías, con instrucciones simples — cocinás vos,
                        en treinta minutos, y comés como en casa de alguien que cocina bien.
                    </p>
                </div>
                <aside class="weekmeta rise rise--3">
                    <div class="weekmeta__row">
                        <span class="k">Semana</span>
                        <span class="v">20 – 26 abril</span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Estado</span>
                        <span class="pulse-row"><span class="pulse"></span>Aceptando pedidos</span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Cierre</span>
                        <span class="v accent">martes 23:59</span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Entrega</span>
                        <span class="v">jueves · 10 – 19 h</span>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- WEEK SWITCHER -->
    <section class="weeks">
        <div class="wrap">
            <div class="weeks__scroller" role="tablist" aria-label="Seleccionar semana">
                <?php foreach ( $weeks as $week ) :
                    $is_active = ! empty( $week['active'] );
                    ?>
                    <button class="weekchip<?php echo $is_active ? ' is-active' : ''; ?>" role="tab" aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>" type="button">
                        <span class="wk-num"><?php echo esc_html( $week['num'] ); ?></span>
                        <span class="wk-range"><?php echo esc_html( $week['range'] ); ?></span>
                        <span class="wk-tagline"><?php echo esc_html( $week['tagline'] ); ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FILTER BAR -->
    <section class="filter">
        <div class="wrap">
            <div class="filter__row" role="group" aria-label="Filtrar por origen">
                <span class="filter__label">Filtrar</span>
                <?php foreach ( $filters as $filter ) :
                    $on = ! empty( $filter['on'] );
                    ?>
                    <button class="chip<?php echo $on ? ' is-on' : ''; ?>" type="button" data-filter="<?php echo esc_attr( $filter['key'] ); ?>">
                        <span class="dot" style="background:<?php echo esc_attr( $filter['dot'] ); ?>"></span><?php echo esc_html( $filter['label'] ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- MENU GRID -->
    <section class="menu">
        <div class="wrap">
            <div class="dishes" id="dishes">
                <?php foreach ( $dishes as $dish ) : ?>
                    <article class="<?php echo esc_attr( $dish['class'] ); ?>" data-filter="<?php echo esc_attr( $dish['filter'] ); ?>">
                        <div class="dish__img">
                            <?php if ( ! empty( $dish['tags'] ) ) : ?>
                                <div class="dish__tags">
                                    <?php foreach ( $dish['tags'] as $tag ) : ?>
                                        <span class="<?php echo esc_attr( $tag['class'] ); ?>"><?php echo esc_html( $tag['label'] ); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div class="dish__meta">
                                <span class="mleft"><?php echo $time_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $dish['time'] ); ?></span>
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
                                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="dish__link">Ver receta
                                    <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="menu-empty" id="empty">Sin platos con ese filtro esta semana. Probá con otro origen.</div>
        </div>
    </section>

    <!-- SIDES / ADDONS -->
    <section class="sides" id="sumas">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow" style="display:block;margin-bottom:var(--space-3)">Para sumar a tu caja</span>
                    <h2>Guarniciones y extras de la semana.</h2>
                </div>
                <p>Todos vienen listos para calentar. Se agregan a cualquier tamaño de caja, sin cambiar tu suscripción.</p>
            </div>

            <div class="sides__grid">
                <?php foreach ( $sides as $side ) : ?>
                    <article class="side">
                        <span class="side__num"><?php echo esc_html( $side['num'] ); ?></span>
                        <h3><?php echo esc_html( $side['title'] ); ?></h3>
                        <p><?php echo esc_html( $side['description'] ); ?></p>
                        <div class="side__foot">
                            <span class="addon"><?php echo esc_html( $side['addon'] ); ?></span>
                            <button class="addbtn" type="button">Sumar
                                <?php echo $plus_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ARCHIVE -->
    <section class="archive" id="pasadas">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow" style="display:block;margin-bottom:var(--space-3)">Semanas anteriores</span>
                    <h2>Lo que estuvo en la caja.</h2>
                </div>
                <p>Nuestro menú cambia cada viernes. Algunos platos vuelven, otros no — depende del río, del monte y de lo que encontremos.</p>
            </div>

            <div class="archive__grid">
                <?php foreach ( $past_weeks as $past ) : ?>
                    <article class="past">
                        <div class="past__head">
                            <span class="k"><?php echo esc_html( $past['week'] ); ?></span>
                            <span class="date"><?php echo esc_html( $past['date'] ); ?></span>
                        </div>
                        <h3><?php echo esc_html( $past['title'] ); ?></h3>
                        <ul>
                            <?php foreach ( $past['items'] as $item ) : ?>
                                <li><?php echo esc_html( $item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="past__foot">
                            <small><?php echo esc_html( count( $past['items'] ) ); ?> recetas · archivadas</small>
                            <a href="<?php echo esc_url( $waitlist_url ); ?>" class="dish__link">Ver semana</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA STRIP -->
    <section class="strip">
        <div class="wrap strip__inner">
            <div>
                <h3>¿Te gusta lo que ves? <em>Empezá con esta semana.</em></h3>
                <p>Pedidos para la caja del 20 al 26 de abril cierran el martes a las 23:59. Después, los jueves — si vos querés.</p>
            </div>
            <div class="strip__btns">
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--warm strip-btn">
                    Unirme
                    <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                </a>
                <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--ghost on-dark">Ver precios</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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
(function () {
  var root = document.querySelector('.menu-design');
  if (!root) return;

  var avatarBtn = root.querySelector('#menuAvatarBtn');
  var userMenu = root.querySelector('#menuUserMenu');
  if (avatarBtn && userMenu) {
    avatarBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = userMenu.classList.toggle('is-open');
      avatarBtn.classList.toggle('is-open', open);
      avatarBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    document.addEventListener('click', function () {
      userMenu.classList.remove('is-open');
      avatarBtn.classList.remove('is-open');
      avatarBtn.setAttribute('aria-expanded', 'false');
    });
  }

  // FILTER CHIPS
  var chips  = root.querySelectorAll('.chip[data-filter]');
  var dishes = root.querySelectorAll('#dishes .dish');
  var empty  = root.querySelector('#empty');
  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      chips.forEach(function (c) { c.classList.remove('is-on'); });
      chip.classList.add('is-on');
      var f = chip.dataset.filter;
      var shown = 0;
      dishes.forEach(function (d) {
        var tags = (d.dataset.filter || '').split(/\s+/);
        var match = (f === 'all') || tags.indexOf(f) !== -1;
        d.style.display = match ? '' : 'none';
        if (match) shown++;
      });
      if (empty) empty.classList.toggle('is-shown', shown === 0);
    });
  });

  // WEEK SWITCHER (visual only — piloto)
  var weekchips = root.querySelectorAll('.weekchip');
  weekchips.forEach(function (wc) {
    wc.addEventListener('click', function () {
      weekchips.forEach(function (w) {
        w.classList.remove('is-active');
        w.setAttribute('aria-selected', 'false');
      });
      wc.classList.add('is-active');
      wc.setAttribute('aria-selected', 'true');
    });
  });

  // ADD-ON feedback (piloto)
  root.querySelectorAll('.addbtn').forEach(function (b) {
    b.addEventListener('click', function () {
      var orig = b.innerHTML;
      b.innerHTML = 'Sumado \u2713';
      b.style.background = 'var(--brand-primary)';
      b.style.color = '#1B1B1E';
      b.style.borderColor = 'var(--brand-primary)';
      setTimeout(function () {
        b.innerHTML = orig;
        b.style.background = '';
        b.style.color = '';
        b.style.borderColor = '';
      }, 1800);
    });
  });
})();
</script>

<?php get_footer(); ?>
