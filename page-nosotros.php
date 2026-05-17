<?php
/**
 * Template Name: Nosotros
 *
 * "Nosotros" / About page — rich brand storytelling template.
 * Implements prototype: Website-handoff (9) / nosotros.html
 */

get_header();

$menu_page    = get_page_by_path( 'menu' );
$menu_url     = $menu_page ? get_permalink( $menu_page ) : home_url( '/menu/' );
$kits_page    = get_page_by_path( 'kits' );
$kits_url     = $kits_page ? get_permalink( $kits_page ) : home_url( '/kits/' );
$planes_page  = get_page_by_path( 'planes' );
$planes_url   = $planes_page ? get_permalink( $planes_page ) : home_url( '/planes/' );
?>

<main id="main" class="site-main" role="main">

    <!-- ── HERO ───────────────────────────────────────────────── -->
    <section class="nos-hero" id="nosotros-hero">
        <div class="container">
            <div class="nos-hero__grid">

                <!-- Text column -->
                <div>
                    <div class="nos-hero__kicker nos-rise">
                        <span class="nos-dot"></span>
                        <span class="nos-eyebrow">Nosotros · Ogape Tu Chef en Casa</span>
                    </div>
                    <h1 class="nos-hero__title nos-rise nos-rise-2">
                        Comer bien en casa,<br>
                        <em>sin complicarte la vida.</em>
                    </h1>
                    <p class="nos-hero__lede nos-rise nos-rise-3">
                        Ogape arma kits de comida prácticos, con sabores familiares, ingredientes
                        seleccionados y un proceso pensado para que las comidas de todos los días
                        sean más simples — y sigan sabiendo a casa.
                    </p>
                    <div class="nos-hero__signature nos-rise nos-rise-3">
                        <div class="nos-swatch" aria-hidden="true"></div>
                        <div>
                            <b>Cocina hecha en Asunción.</b>
                            Recetas con mesa paraguaya, porciones honestas y entregas confiables todas las semanas.
                        </div>
                    </div>
                </div>

                <!-- Photo column -->
                <figure class="nos-hero__photo nos-rise nos-rise-3">
                    <div class="nos-img-slot"
                         role="img"
                         aria-label="Cocinera porcionando ingredientes — manos, tabla, mandioca, hierbas — luz cálida"
                         style="aspect-ratio:4/5;border-radius:var(--radius-2xl);box-shadow:0 30px 70px -20px rgba(17,24,39,.35),0 10px 30px rgba(17,24,39,.14)">
                    </div>

                    <div class="nos-hero__stamp" aria-hidden="true">
                        <svg viewBox="0 0 100 100">
                            <defs><path id="nos-circ" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs>
                            <text fill="#1B1B1E" font-family="Cormorant Garamond, serif" font-size="9" letter-spacing="3">
                                <textPath href="#nos-circ" startOffset="0">CASERO · FRESCO · CUIDADO · MESA PARAGUAYA · </textPath>
                            </text>
                        </svg>
                        <span class="nos-hero__stamp-core">Ogape<br>est. '26</span>
                    </div>

                    <div class="nos-hero__tag-pin" aria-hidden="true">
                        <small>Lema de la casa</small>
                        Cocinás vos,<br>nosotros pensamos el resto.
                    </div>
                </figure>

            </div><!-- .nos-hero__grid -->
        </div>
    </section>

    <!-- ── STATS RIBBON ───────────────────────────────────────── -->
    <section class="nos-ribbon" aria-label="En números">
        <div class="container">
            <div class="nos-ribbon__grid">
                <div class="nos-ribbon__item">
                    <span class="nos-ribbon__index">i.</span>
                    <div class="nos-ribbon__value">5 recetas</div>
                    <div class="nos-ribbon__desc">curadas por nuestro Chef cada semana, pensadas para la mesa familiar.</div>
                </div>
                <div class="nos-ribbon__item">
                    <span class="nos-ribbon__index">ii.</span>
                    <div class="nos-ribbon__value">≈ 30 min</div>
                    <div class="nos-ribbon__desc">de cocción en casa — porcionado, instrucciones claras, sin adivinar.</div>
                </div>
                <div class="nos-ribbon__item">
                    <span class="nos-ribbon__index">iii.</span>
                    <div class="nos-ribbon__value">12 proveedores</div>
                    <div class="nos-ribbon__desc">paraguayos seleccionados: huerteros, pescadores y carniceros locales.</div>
                </div>
                <div class="nos-ribbon__item">
                    <span class="nos-ribbon__index">iv.</span>
                    <div class="nos-ribbon__value">100% Asunción</div>
                    <div class="nos-ribbon__desc">cocina propia, equipo local, entregas los jueves en mano.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── LA COCINA ──────────────────────────────────────────── -->
    <section class="nos-cocina" id="cocina">
        <div class="container" style="position:relative;z-index:1">
            <div class="nos-cocina__head">
                <div>
                    <span class="nos-eyebrow">02 · La cocina</span>
                    <h2>Una cocina cuidada, <em>como la de tu casa</em> &mdash; con la disciplina de una grande.</h2>
                </div>
                <p>Trabajamos en una cocina propia en Asunción. Acá pesamos, cortamos y porcionamos lo que después llega a tu caja: con orden, limpieza y la misma receta exacta cada semana.</p>
            </div>

            <div class="nos-cocina__grid">
                <!-- Media column -->
                <div class="nos-cocina__media">
                    <div class="nos-img-slot"
                         role="img"
                         aria-label="Interior de la cocina — mesón de acero, manos porcionando verduras, balanza al lado">
                    </div>
                    <span class="nos-cocina__media-label">N.º 01 · Mise en place del jueves</span>

                    <div class="nos-cocina__small-grid" aria-hidden="true">
                        <div class="nos-img-slot" role="img" aria-label="Balanza con porción de pescado"></div>
                        <div class="nos-img-slot" role="img" aria-label="Caja kraft cerrándose"></div>
                    </div>
                </div>

                <!-- Checklist column -->
                <ul class="nos-checklist">
                    <li>
                        <span class="nos-checklist__ic" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/><path d="M8 12l3 3 5-6"/>
                            </svg>
                        </span>
                        <div>
                            <h3>Higiene y trazabilidad</h3>
                            <p>Protocolos diarios de limpieza, control de temperaturas y registro de cada lote. Sabemos de dónde vino y quién lo tocó.</p>
                        </div>
                    </li>
                    <li>
                        <span class="nos-checklist__ic" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16"/><path d="M6 7v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7"/>
                                <path d="M9 7V5a3 3 0 0 1 6 0v2"/><path d="M10 11v6M14 11v6"/>
                            </svg>
                        </span>
                        <div>
                            <h3>Porciones consistentes</h3>
                            <p>Cada ingrediente se pesa en balanza antes de empacarse. No hay porciones "ojo de buen cubero": la receta de hoy es la misma que cocinaste el mes pasado.</p>
                        </div>
                    </li>
                    <li>
                        <span class="nos-checklist__ic" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3l1.8 4.2L18 9l-3.2 3 1 4.5L12 14.5 8.2 16.5 9.2 12 6 9l4.2-1.8L12 3z"/>
                            </svg>
                        </span>
                        <div>
                            <h3>Frescura en cadena</h3>
                            <p>Las verduras llegan los miércoles, el pescado y las carnes el jueves a primera hora. Empacamos en frío y entregamos el mismo día.</p>
                        </div>
                    </li>
                    <li>
                        <span class="nos-checklist__ic" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12h4l3-7 4 14 3-7h4"/>
                            </svg>
                        </span>
                        <div>
                            <h3>Preparación confiable</h3>
                            <p>Equipo entrenado, mismos puestos, misma cadencia cada semana. Lo que se promete en el menú es lo que abrís en tu casa.</p>
                        </div>
                    </li>
                </ul>
            </div><!-- .nos-cocina__grid -->
        </div>
    </section>

    <!-- ── PROVEEDORES ────────────────────────────────────────── -->
    <section class="nos-prov" id="proveedores">
        <div class="container" style="position:relative;z-index:1">
            <div class="nos-prov__intro">
                <span class="nos-eyebrow">03 · Nuestros proveedores</span>
                <h2>Ingredientes seleccionados, <em>de gente que conocemos por nombre.</em></h2>
                <p>Trabajamos con una red corta de proveedores paraguayos elegidos por su calidad — y porque podemos pasar por su finca, su puerto o su carnicería cuando hace falta. Lo que no se consigue acá con la calidad que queremos, lo marcamos en la ficha de cada receta.</p>
            </div>

            <div class="nos-prov__list">
                <div class="nos-prov__row">
                    <div class="nos-img-slot" role="img" aria-label="Huerta cerca de Itauguá"></div>
                    <div class="nos-prov__name"><small>Verduras &amp; hierbas</small>Huerta Carolina &amp; Don Aníbal</div>
                    <div class="nos-prov__desc">Lechugas, hierbas frescas y tomates de estación. Cosechan el martes para que lleguen el miércoles a la cocina.</div>
                    <div class="nos-prov__meta">
                        <span>Itauguá<b>Central</b></span>
                        <span>Semanal<b>Mié.</b></span>
                    </div>
                </div>

                <div class="nos-prov__row">
                    <div class="nos-img-slot" role="img" aria-label="Pescador del Paraná con surubí"></div>
                    <div class="nos-prov__name"><small>Pescado de río</small>Pescadores de Itá Enramada</div>
                    <div class="nos-prov__desc">Surubí, pacú y dorado del Paraná, recibidos enteros y porcionados en nuestra cocina la misma mañana.</div>
                    <div class="nos-prov__meta">
                        <span>Asunción<b>Itá Enramada</b></span>
                        <span>Semanal<b>Jue.</b></span>
                    </div>
                </div>

                <div class="nos-prov__row">
                    <div class="nos-img-slot" role="img" aria-label="Carnicero cortando lomo"></div>
                    <div class="nos-prov__name"><small>Carnes &amp; aves</small>Carnicería San Roque</div>
                    <div class="nos-prov__desc">Cortes de res y pollo de campo, madurados en cámara y porcionados al gramo según la receta de la semana.</div>
                    <div class="nos-prov__meta">
                        <span>San Lorenzo<b>Central</b></span>
                        <span>Semanal<b>Jue.</b></span>
                    </div>
                </div>

                <div class="nos-prov__row">
                    <div class="nos-img-slot" role="img" aria-label="Bolsas de almidón de mandioca"></div>
                    <div class="nos-prov__name"><small>Mandioca &amp; almidón</small>Cooperativa Yvyra'ija</div>
                    <div class="nos-prov__desc">Mandioca fresca, almidón y harina de maíz de productores cooperativos del departamento Central.</div>
                    <div class="nos-prov__meta">
                        <span>Areguá<b>Central</b></span>
                        <span>Quincenal<b>Lun.</b></span>
                    </div>
                </div>

                <div class="nos-prov__row">
                    <div class="nos-img-slot" role="img" aria-label="Frasco artesanal de miel y maracuyá"></div>
                    <div class="nos-prov__name"><small>Despensa &amp; conservas</small>Casa Marangatú</div>
                    <div class="nos-prov__desc">Miel de monte, maracuyá, ajíes encurtidos y salsas que armamos juntos en lotes chicos para el menú de cada mes.</div>
                    <div class="nos-prov__meta">
                        <span>Caacupé<b>Cordillera</b></span>
                        <span>Mensual<b>—</b></span>
                    </div>
                </div>
            </div><!-- .nos-prov__list -->

            <div class="nos-prov__note">
                <span class="nos-prov__note-icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="10" r="3"/>
                        <path d="M12 2C7 2 4 6 4 10c0 5.5 8 12 8 12s8-6.5 8-12c0-4-3-8-8-8z"/>
                    </svg>
                </span>
                <p><b>Origen siempre visible.</b> En la receta que viene dentro de la caja contamos quién cultivó, pescó o crió lo que tenés en la mano — y de dónde es. Lo que llega de afuera, también lo aclaramos.</p>
            </div>
        </div>
    </section>

    <!-- ── MENÚ + CHEF ────────────────────────────────────────── -->
    <section class="nos-menu" id="nuestro-menu">
        <div class="container">
            <div class="nos-menu__grid">

                <!-- Left: menu pillars -->
                <div>
                    <span class="nos-eyebrow">04 · Nuestro menú</span>
                    <h2>Recetas <em>curadas</em> para la mesa de todos los días.</h2>
                    <p class="nos-menu__lede">El menú lo arma nuestro Chef cada semana, pensando en familias reales: tiempos cortos, sabores conocidos, y técnicas que no piden equipamiento que no tengas. Comer bien sin volverlo un proyecto.</p>

                    <div class="nos-menu__pillars">
                        <div class="nos-menu__pillar">
                            <span class="nos-menu__pillar-num">i.</span>
                            <h3>Familiar</h3>
                            <p>Sabores que ya están en la mesa paraguaya — sin disfrazarlos.</p>
                        </div>
                        <div class="nos-menu__pillar">
                            <span class="nos-menu__pillar-num">ii.</span>
                            <h3>Práctico</h3>
                            <p>De 25 a 40 min reales, con una sartén, una olla y un cuchillo.</p>
                        </div>
                        <div class="nos-menu__pillar">
                            <span class="nos-menu__pillar-num">iii.</span>
                            <h3>De temporada</h3>
                            <p>El menú cambia según lo que está bueno esa semana en la huerta.</p>
                        </div>
                        <div class="nos-menu__pillar">
                            <span class="nos-menu__pillar-num">iv.</span>
                            <h3>Sin sobras raras</h3>
                            <p>Porciones honestas para 2 o 4. Si te sobra, te sobra rico.</p>
                        </div>
                    </div>

                    <a href="<?php echo esc_url( $menu_url ); ?>" class="nos-btn-warm">
                        Ver el menú de esta semana
                        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <!-- Right: chef card -->
                <aside class="nos-chef-card">
                    <div class="nos-chef-card__photo">
                        <div class="nos-img-slot" role="img" aria-label="Retrato del Chef en cocina, delantal, sonrisa breve"></div>
                    </div>
                    <div class="nos-chef-card__body">
                        <span class="nos-chef-card__role">El Chef</span>
                        <h3>Chef <em>Tomás Cabrera</em></h3>
                        <p class="nos-chef-card__quote">"Pienso el menú como si estuviera cocinando para mi mamá un martes a la noche: que sepa rico, que rinda, y que no la haga pelear con la cocina."</p>
                        <p class="nos-chef-card__bio">Quince años de cocina entre Asunción, Buenos Aires y Lima. En Ogape arma las cinco recetas de la semana, prueba cada plato antes de subirlo, y entrena al equipo en la cocina cada lunes.</p>
                    </div>
                </aside>

            </div><!-- .nos-menu__grid -->
        </div>
    </section>

    <!-- ── HISTORIA ───────────────────────────────────────────── -->
    <section class="nos-story" id="historia">
        <div class="container" style="position:relative;z-index:1">
            <div class="nos-story__grid">

                <!-- Photo column -->
                <div class="nos-story__photo">
                    <div class="nos-img-slot"
                         role="img"
                         aria-label="Retrato de la fundadora cocinando en su casa con sus hijos al fondo"
                         style="aspect-ratio:4/5;border-radius:var(--radius-2xl);box-shadow:0 24px 60px -20px rgba(17,24,39,.28)">
                    </div>
                    <div class="nos-story__signature">
                        <span class="nos-story__sig-mark" aria-hidden="true">L</span>
                        <div>
                            <span class="nos-story__sig-name">Lucía Bareiro</span>
                            <span class="nos-story__sig-role">Fundadora · Ogape</span>
                        </div>
                    </div>
                </div>

                <!-- Text column -->
                <div class="nos-story__text">
                    <span class="nos-eyebrow" style="margin-bottom:var(--space-3)">05 · Por qué nació Ogape</span>
                    <h2>Empezó por una pregunta <em>simple.</em></h2>

                    <p>Hace dos años Lucía volvía del trabajo un martes cualquiera, abría la heladera y se daba cuenta de lo mismo de siempre: faltaba algo, sobraba otra cosa, y la idea de planear, comprar y cocinar le pesaba más que el día entero.</p>

                    <p>Ogape nació de ahí. No como un servicio "premium" ni como una solución para gente que no cocina — sino para familias y personas ocupadas que <b>sí quieren cocinar en casa</b>, pero sin que cada comida implique tres viajes al supermercado y media hora de cabeza decidiendo qué hacer.</p>

                    <p>Lo armamos con una cocina propia, una red corta de proveedores que conocemos, y un Chef que piensa el menú con la mesa paraguaya en la cabeza. Lo demás es bastante simple: vos abrís la caja, seguís la receta, y comés algo casero. Sin estrés, sin pasos raros, sin volverlo un proyecto.</p>

                    <div class="nos-story__mission">
                        <b>Nuestra misión</b>
                        Que comer bien en casa, todas las semanas, sea lo más sencillo del día — no lo más complicado.
                    </div>
                </div>

            </div><!-- .nos-story__grid -->
        </div>
    </section>

    <!-- ── FINAL CTA ──────────────────────────────────────────── -->
    <section class="nos-final" id="nos-cta">
        <div class="container">
            <div class="nos-final__inner">
                <span class="nos-final__week-tag">
                    <span class="nos-final__pulse"></span>
                    Esta semana ya está armada · <b>Surubí al maracuyá</b> + 4 recetas más
                </span>
                <h2>Vení a probar <em>una semana</em> de Ogape.</h2>
                <p>Si te gusta, repetís. Si no, no pasa nada — no hay suscripción que destrabar. Empezá por una caja y mirá cómo se siente cocinar sin pensar tanto.</p>
                <div class="nos-final__btns">
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--primary">
                        Ver el menú de esta semana
                        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true" style="width:16px;height:16px">
                            <path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( $kits_url ); ?>" class="btn btn--secondary">
                        Conocé nuestros kits
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
