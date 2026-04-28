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
$close_svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg>';
$diff_svg  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M5 17h14M5 12h8M5 7h5"/></svg>';

/* ── Category navigation ─────────────────────────────────────────── */
$categories = array(
    array( 'key' => 'all',         'label' => 'Todo'        ),
    array( 'key' => 'veggie',      'label' => 'Veggie'      ),
    array( 'key' => 'premium',     'label' => 'Premium'     ),
    array( 'key' => 'tradicional', 'label' => 'Tradicional' ),
    array( 'key' => 'regular',     'label' => 'Regular'     ),
);

$cat_icons = array(
    'all'         => '<svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><rect x="2" y="2" width="7" height="7" rx="1.5"/><rect x="11" y="2" width="7" height="7" rx="1.5"/><rect x="2" y="11" width="7" height="7" rx="1.5"/><rect x="11" y="11" width="7" height="7" rx="1.5"/></svg>',
    'veggie'      => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6c2-3 10-5 12-3s0 10-3 12C8 18 2 16 4 6z"/><path d="M10 18V10"/></svg>',
    'premium'     => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2l1.9 5.8H18l-4.9 3.6 1.9 5.8L10 14l-4.9 3.2 1.9-5.8L2 7.8h6.1L10 2z"/></svg>',
    'tradicional' => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2c0 0-5 5-5 9a5 5 0 0010 0c0-3-2-5-3-6 0 2-2 3-2 3s0-4 0-6z"/></svg>',
    'regular'     => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M3 10c0 4 3 7 7 7s7-3 7-7H3z"/><path d="M1 10h18"/><path d="M7 6l1-3M13 6l-1-3"/></svg>',
);

/* ── Dish data ───────────────────────────────────────────────────── */
$dishes = array(
    array(
        'class'       => 'dish dish--hero',
        'category'    => 'premium',
        'tags'        => array(
            array( 'class' => 'tag tag--hero',  'label' => 'Plato Estrella' ),
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
            array( 'label' => 'Calorías',  'value' => '620 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Pescado · Lácteos' ),
        ),
    ),
    array(
        'class'       => 'dish dish--beef',
        'category'    => 'tradicional',
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
            array( 'label' => 'Calorías',  'value' => '710 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Gluten · Lácteos' ),
        ),
    ),
    array(
        'class'       => 'dish dish--bowl',
        'category'    => 'regular',
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
            array( 'label' => 'Calorías',  'value' => '540 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Sésamo' ),
        ),
    ),
    array(
        'class'       => 'dish dish--curry',
        'category'    => 'regular',
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
            array( 'label' => 'Calorías',  'value' => '580 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Coco' ),
        ),
    ),
    array(
        'class'       => 'dish dish--mila',
        'category'    => 'tradicional',
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
            array( 'label' => 'Calorías',  'value' => '670 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Gluten · Huevo' ),
        ),
    ),
    array(
        'class'       => 'dish dish--green',
        'category'    => 'veggie',
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
            array( 'label' => 'Calorías',  'value' => '490 kcal' ),
            array( 'label' => 'Contiene',  'value' => 'Lácteos · Gluten' ),
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

/* Dishes as JSON for modal JS */
$dishes_json = wp_json_encode( array_map( function ( $d ) {
    return array(
        'class'       => $d['class'],
        'category'    => $d['category'],
        'time'        => $d['time'],
        'difficulty'  => $d['difficulty'],
        'number'      => $d['number'],
        'title'       => $d['title'],
        'title_en'    => $d['title_en'],
        'description' => $d['description'],
        'stats'       => $d['stats'],
        'tags'        => $d['tags'],
    );
}, $dishes ) );
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

    <!-- MENU VIEWER -->
    <section class="menucat">
        <div class="wrap">
            <div class="menucat__layout">

                <!-- CATEGORY SIDEBAR -->
                <nav class="menucat__sidebar" aria-label="Categorías de platos">
                    <?php foreach ( $categories as $cat ) :
                        $is_active = $cat['key'] === 'all';
                        ?>
                        <button
                            class="catbtn<?php echo $is_active ? ' is-active' : ''; ?>"
                            data-cat="<?php echo esc_attr( $cat['key'] ); ?>"
                            type="button"
                            aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>">
                            <span class="catbtn__circle">
                                <?php echo $cat_icons[ $cat['key'] ]; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </span>
                            <span class="catbtn__label"><?php echo esc_html( $cat['label'] ); ?></span>
                        </button>
                    <?php endforeach; ?>
                </nav>

                <!-- DISH GRID -->
                <div class="menucat__main">
                    <div class="dishes" id="dishes">
                        <?php foreach ( $dishes as $idx => $dish ) : ?>
                            <article
                                class="<?php echo esc_attr( $dish['class'] ); ?>"
                                data-cat="<?php echo esc_attr( $dish['category'] ); ?>"
                                data-index="<?php echo (int) $idx; ?>"
                                role="button"
                                tabindex="0"
                                aria-label="<?php echo esc_attr( 'Ver detalle de ' . $dish['title'] ); ?>">
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
                                        <span class="dish__peek">Ver <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <div class="menu-empty" id="empty">Sin platos en esta categoría esta semana.</div>
                </div>

            </div>
        </div>
    </section>

    <!-- DISH DETAIL MODAL -->
    <div class="dish-modal" id="dishModal" role="dialog" aria-modal="true" aria-label="Detalle del plato" hidden>
        <div class="dish-modal__backdrop" id="dishModalBackdrop"></div>
        <div class="dish-modal__panel" id="dishModalPanel">
            <button class="dish-modal__close" id="dishModalClose" type="button" aria-label="Cerrar detalle">
                <?php echo $close_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
            </button>
            <div class="dish-modal__img" id="dishModalImg"></div>
            <div class="dish-modal__content">
                <div class="dish-modal__tags" id="dishModalTags"></div>
                <h2 class="dish-modal__title" id="dishModalTitle"></h2>
                <div class="dish-modal__subtitle" id="dishModalSubtitle"></div>
                <div class="dish-modal__badges" id="dishModalBadges"></div>
                <p class="dish-modal__desc" id="dishModalDesc"></p>
                <div class="dish-modal__stats" id="dishModalStats"></div>
                <div class="dish-modal__note">
                    <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    La selección de platos se realiza dentro de tu cuenta.
                </div>
            </div>
        </div>
    </div>

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

</main>

<script>
(function () {
  var root = document.querySelector('.menu-design');
  if (!root) return;

  /* ── Dish data ─────────────────────────────────────────────── */
  var dishes = <?php echo $dishes_json; // phpcs:ignore WordPress.Security.EscapeOutput ?>;

  /* Image gradients indexed to match $dishes array order */
  var dishGradients = [
    /* surubi   */ 'radial-gradient(circle at 35% 40%, #F0B765 0%, transparent 55%), radial-gradient(circle at 70% 65%, #E8A045 0%, transparent 55%), linear-gradient(135deg, #9A5A08, #C88B3A)',
    /* bife     */ 'radial-gradient(circle at 30% 45%, #C88B3A 0%, transparent 48%), radial-gradient(circle at 70% 60%, #9A5A08 0%, transparent 55%), linear-gradient(135deg, #3B2A14, #6B4A1E 70%, #8B5A1C)',
    /* bowl     */ 'radial-gradient(circle at 30% 35%, #F0B765, transparent 50%), radial-gradient(circle at 72% 70%, #4a7a3a, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
    /* curry    */ 'radial-gradient(circle at 35% 40%, #FFD783, transparent 55%), radial-gradient(circle at 72% 68%, #E8A045, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
    /* milanesa */ 'radial-gradient(circle at 50% 50%, #E8A045, transparent 55%), linear-gradient(135deg, #C88B3A 0%, #9A5A08 50%, #6B4A1E 100%)',
    /* gnocchi  */ 'radial-gradient(circle at 35% 40%, #c9d97a, transparent 55%), radial-gradient(circle at 70% 65%, #6b8a3a, transparent 55%), linear-gradient(135deg, #3e5a27, #6b8a3a)',
  ];

  /* ── Avatar menu ───────────────────────────────────────────── */
  var avatarBtn = root.querySelector('#menuAvatarBtn');
  var userMenu  = root.querySelector('#menuUserMenu');
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

  /* ── Category filter ───────────────────────────────────────── */
  var catBtns   = root.querySelectorAll('.catbtn[data-cat]');
  var dishCards = root.querySelectorAll('#dishes [data-cat]');
  var emptyMsg  = root.querySelector('#empty');

  catBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      catBtns.forEach(function (b) {
        b.classList.remove('is-active');
        b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('is-active');
      btn.setAttribute('aria-pressed', 'true');

      var cat   = btn.dataset.cat;
      var shown = 0;
      dishCards.forEach(function (card) {
        var match = (cat === 'all') || (card.dataset.cat === cat);
        card.style.display = match ? '' : 'none';
        if (match) shown++;
      });
      if (emptyMsg) emptyMsg.classList.toggle('is-shown', shown === 0);
    });
  });

  /* ── Modal ─────────────────────────────────────────────────── */
  var modal        = document.getElementById('dishModal');
  var modalBackdrop= document.getElementById('dishModalBackdrop');
  var modalClose   = document.getElementById('dishModalClose');
  var modalImg     = document.getElementById('dishModalImg');
  var modalTags    = document.getElementById('dishModalTags');
  var modalTitle   = document.getElementById('dishModalTitle');
  var modalSubtitle= document.getElementById('dishModalSubtitle');
  var modalBadges  = document.getElementById('dishModalBadges');
  var modalDesc    = document.getElementById('dishModalDesc');
  var modalStats   = document.getElementById('dishModalStats');
  var lastFocused  = null;

  function openModal(idx) {
    var d = dishes[idx];
    if (!d) return;
    lastFocused = document.activeElement;

    /* Image gradient */
    modalImg.style.background = dishGradients[idx] || dishGradients[0];

    /* Tags */
    modalTags.innerHTML = '';
    (d.tags || []).forEach(function (t) {
      var s = document.createElement('span');
      s.className = t['class'];
      s.textContent = t.label;
      modalTags.appendChild(s);
    });

    /* Title */
    modalTitle.textContent    = d.title;
    modalSubtitle.textContent = d.title_en;

    /* Badges: time + difficulty */
    modalBadges.innerHTML =
      '<span class="dish-modal__badge">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" style="width:13px;height:13px"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/></svg>' +
        d.time +
      '</span>' +
      '<span class="dish-modal__badge">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" style="width:13px;height:13px"><path d="M5 17h14M5 12h8M5 7h5"/></svg>' +
        'Dificultad ' + d.difficulty +
      '</span>';

    /* Description */
    modalDesc.textContent = d.description;

    /* Stats */
    modalStats.innerHTML = '';
    (d.stats || []).forEach(function (s) {
      var el = document.createElement('div');
      el.className = 'dish-modal__stat';
      el.innerHTML =
        '<span class="dish-modal__stat-label">' + escHtml(s.label) + '</span>' +
        '<span class="dish-modal__stat-value">' + escHtml(s.value) + '</span>';
      modalStats.appendChild(el);
    });

    modal.removeAttribute('hidden');
    document.body.classList.add('modal-open');
    setTimeout(function () { modalClose.focus(); }, 50);
  }

  function closeModal() {
    modal.setAttribute('hidden', '');
    document.body.classList.remove('modal-open');
    if (lastFocused) lastFocused.focus();
  }

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  /* Card clicks */
  dishCards.forEach(function (card) {
    card.addEventListener('click', function () {
      openModal(parseInt(card.dataset.index, 10));
    });
    card.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openModal(parseInt(card.dataset.index, 10));
      }
    });
  });

  /* Close triggers */
  if (modalClose)    modalClose.addEventListener('click', closeModal);
  if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.hasAttribute('hidden')) closeModal();
  });

  /* ── Week switcher (visual only — piloto) ──────────────────── */
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

})();
</script>

<?php get_footer(); ?>
