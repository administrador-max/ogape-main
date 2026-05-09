<?php
/**
 * Template Name: Planes
 * Template Post Type: page
 *
 * Source design: website/project/planes.html (Website-handoff bundle, 2026-05-09).
 * Design styles live in assets/css/planes-page.css, scoped under .planes-design.
 * Theme nav/footer (header.php / footer.php) wrap this page.
 */

get_header();

$register_url = home_url( '/register/' );
$menu_url     = home_url( '/menu/' );
?>

<main id="main" class="site-main planes-design" role="main">

    <!-- HERO -->
    <section class="hero" data-screen-label="01 Hero">
        <div class="wrap">
            <span class="eyebrow"><span class="dot"></span>Caja semanal Ogape</span>
            <h1 class="hero__title">Tu cocina semanal,<br><em>sin pensar dos veces.</em></h1>
            <p class="hero__sub">Pedís tu primera caja sin compromiso. Si te enamorás, activás la auto-renovación con un toque — pausás o cancelás cuando quieras.</p>
            <div class="hero__strip">
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Sin permanencia</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>Pausá cuando viajás</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-8 9 8v9a2 2 0 0 1-2 2h-3v-7H9v7H6a2 2 0 0 1-2-2z"/></svg>Entregamos los jueves</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>Pago seguro vía Bancard</span>
            </div>
        </div>
    </section>

    <!-- VALUE / PRICING -->
    <section class="plans-section" data-screen-label="02 Cómo se cobra">
        <div class="wrap">
            <div class="value-wrap">

                <div class="value-head">
                    <span class="meta"><span class="dot"></span>Precio transparente · Sin permanencia</span>
                    <h2>Cocina de chef <em>al precio del súper.</em></h2>
                    <p>Pagás la caja y el envío — nada más. Cada caja incluye ingredientes porcionados, recetas paso a paso y empaque refrigerado. Sin tarjeta guardada al inicio, sin auto-débito sorpresa.</p>
                </div>

                <div class="vcards">

                    <article class="vcard vcard--featured">
                        <span class="vcard__badge">Más elegida</span>
                        <div class="vcard__top">
                            <div class="vcard__title">
                                <span class="who">Pareja · 2 cenas para uno</span>
                                <h3>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    Caja para <em>2</em>
                                </h3>
                            </div>
                        </div>
                        <p class="vcard__pitch">Tres recetas por semana, dos porciones cada una — seis cenas listas en 30 minutos.</p>

                        <div class="vcard__price">
                            <div class="amount">
                                <span class="from">Desde</span>
                                <span class="num">Gs. 50.000<small>/ caja</small></span>
                            </div>
                            <div class="perp">
                                <b>Gs. 8.300</b>
                                por porción
                            </div>
                        </div>

                        <ul class="vlist">
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span><b>3 recetas</b> de la semana, elegidas por vos o por el chef.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span>Ingredientes porcionados — <b>cero desperdicio</b> de fondo de heladera.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span>Recetas paso a paso · listas en <b>30 min promedio</b>.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span>Sin permanencia · saltás, pausás o cancelás a un toque.</span>
                            </li>
                        </ul>

                        <div class="vcard__foot">
                            <span class="stat">Equivalente a <b>una salida</b> a un restaurante.</span>
                            <a href="<?php echo esc_url( add_query_arg( 'size', '2', $register_url ) ); ?>" class="vcard__cta">
                                Empezar con esta
                                <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </article>

                    <article class="vcard">
                        <div class="vcard__top">
                            <div class="vcard__title">
                                <span class="who">Familia · cenas con sobras</span>
                                <h3>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    Caja para <em>4</em>
                                </h3>
                            </div>
                        </div>
                        <p class="vcard__pitch">Tres recetas por semana, cuatro porciones cada una — alcanza para 12 platos o sobras de almuerzo.</p>

                        <div class="vcard__price">
                            <div class="amount">
                                <span class="from">Desde</span>
                                <span class="num">Gs. 90.000<small>/ caja</small></span>
                            </div>
                            <div class="perp">
                                <b>Gs. 7.500</b>
                                por porción
                            </div>
                        </div>

                        <ul class="vlist">
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span><b>3 recetas</b> de la semana · 4 porciones cada una.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span><b>Mejor precio por porción</b> — ahorrás Gs. 800 vs. caja para 2.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span>Pensado para que <b>sobre</b> y resuelvas el almuerzo del día siguiente.</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
                                <span>Misma flexibilidad — sin permanencia, sin tarjeta forzada.</span>
                            </li>
                        </ul>

                        <div class="vcard__foot">
                            <span class="stat"><b>Gs. 22.500</b> por cena para 4.</span>
                            <a href="<?php echo esc_url( add_query_arg( 'size', '4', $register_url ) ); ?>" class="vcard__cta">
                                Empezar con esta
                                <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </article>

                </div>

                <div class="includes">
                    <div class="includes__h">
                        <span>Lo que incluye cada caja</span>
                        <h3>El precio cubre <em>todo lo que pasa</em> antes de tu cocina.</h3>
                    </div>
                    <div class="includes__grid">
                        <div class="includes__item">
                            <h4 class="includes__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6"/><path d="M5 8a7 7 0 0 1 14 0v3a7 7 0 0 1-14 0z"/><path d="M9 22h6"/><path d="M12 18v4"/></svg>
                                Ingredientes locales
                            </h4>
                            <p class="includes__item-p">Producto fresco de productores del Mercado de Abasto y huertas del interior. Carnes con trazabilidad.</p>
                        </div>
                        <div class="includes__item">
                            <h4 class="includes__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 7h6M9 11h6M9 15h4"/></svg>
                                Recetas del chef
                            </h4>
                            <p class="includes__item-p">Cada receta probada en cocina antes de salir — instrucciones cortas, fotos y tiempos reales para 30 min.</p>
                        </div>
                        <div class="includes__item">
                            <h4 class="includes__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h18M5 10V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4M5 10v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8"/><path d="M9 14h6"/></svg>
                                Empaque refrigerado
                            </h4>
                            <p class="includes__item-p">Caja con gel térmico que mantiene la cadena de frío hasta 8 horas. Materiales reciclables que retiramos en la próxima entrega.</p>
                        </div>
                        <div class="includes__item">
                            <h4 class="includes__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                Soporte real
                            </h4>
                            <p class="includes__item-p">Si algo no llega bien o una receta no sale, escribís por WhatsApp y resolvemos esa misma noche.</p>
                        </div>
                    </div>
                </div>

                <div class="offer">
                    <div class="offer__copy">
                        <span class="offer__tag">Sumar a cualquier caja</span>
                        <h3 class="offer__h">Premium semanal — <em>cortes y atención prioritaria.</em></h3>
                        <p class="offer__p">Prioridad para recetas premium en rotación (camarones, salmón, tilapia, costillas BBQ), ventana de entrega preferida y soporte directo por WhatsApp.</p>
                    </div>
                    <div class="offer__price">
                        <span class="pl">Desde</span>
                        <span class="pn">+ Gs. 10.000<small>/ caja</small></span>
                    </div>
                </div>

                <div class="vcta">
                    <div class="vcta__copy">
                        <span class="l">Listo para probar</span>
                        <span class="h">Reservá tu primera caja — <em>pagás solo esa.</em></span>
                    </div>
                    <div class="vcta__btns">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="vcta__ghost">Ver el menú de esta semana</a>
                        <a href="<?php echo esc_url( $register_url ); ?>" class="vcta__primary">
                            Reservar mi primera caja
                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>

                <div class="zones" aria-label="Tarifa de envío por zona">
                    <div class="zones__h">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Envío facturado aparte — para mantener la transparencia
                    </div>
                    <div class="zones__row"><span class="k">Asunción centro · Recoleta · Las Carmelitas · Villa Morra · Mburucuyá · Ycuá Satí</span><span class="v">Gs. 8.000</span></div>
                    <div class="zones__row"><span class="k">Gran Asunción · San Lorenzo · Lambaré · Fernando de la Mora</span><span class="v">Gs. 15.000</span></div>
                    <div class="zones__row is-free"><span class="k">2 o más cajas en una misma entrega</span><span class="v">Gratis</span></div>
                </div>
                <p class="config__disclaimer">Precios indicativos — confirmamos en checkout. Sin tarjeta guardada al inicio.</p>

            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="section" id="como-funciona" data-screen-label="03 Cómo funciona">
        <div class="wrap">
            <div class="section__head">
                <span class="eyebrow"><span class="dot"></span>Cómo funciona</span>
                <h2 class="section__title">De tu plan a la mesa, <em>en cuatro pasos.</em></h2>
                <p class="section__sub">El mismo flujo simple para todos los pedidos — preorden o auto-renovación.</p>
            </div>

            <div class="how">
                <div class="how__step">
                    <span class="how__num"><i>01</i></span>
                    <h3 class="how__h">Reservás tu caja</h3>
                    <p class="how__p">Elegís tamaño (2 o 4 personas) y, si querés, sumás Premium. Pagás solo la primera caja.</p>
                </div>
                <div class="how__step">
                    <span class="how__num"><i>02</i></span>
                    <h3 class="how__h">Personalizás tu menú</h3>
                    <p class="how__p">Cada lunes publicamos las recetas de la semana. Elegís las tuyas hasta el martes 22:00.</p>
                </div>
                <div class="how__step">
                    <span class="how__num"><i>03</i></span>
                    <h3 class="how__h">Recibís el jueves</h3>
                    <p class="how__p">Tu caja llega refrigerada a tu puerta, con ingredientes porcionados y recetas paso a paso.</p>
                </div>
                <div class="how__step">
                    <span class="how__num"><i>04</i></span>
                    <h3 class="how__h">Cocinás en 30 min</h3>
                    <p class="how__p">Recetas pensadas para que cualquiera las haga rico. Sin sobras de ingredientes ni desperdicio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS BAND -->
    <section class="section" data-screen-label="05 Por qué semanal">
        <div class="wrap">
            <div class="band">
                <div class="band__inner">
                    <div>
                        <h2 class="band__title">Recurrente, <em>pero a tu manera.</em></h2>
                        <p class="band__lede">Diseñamos la auto-renovación para que se sienta tan flexible como pedir cada semana. Sin sorpresas, sin compromisos, sin trampa.</p>
                    </div>
                    <div class="band__grid">
                        <div class="band__item">
                            <h3 class="band__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="5" width="4" height="14" rx="1"/><rect x="14" y="5" width="4" height="14" rx="1"/></svg>
                                Pausá cuando quieras
                            </h3>
                            <p class="band__item-p">Vacaciones, viaje de trabajo, semana sin tiempo de cocinar — pausá un toque hasta que estés listo.</p>
                        </div>
                        <div class="band__item">
                            <h3 class="band__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/><path d="M3 21v-5h5"/></svg>
                                Saltá la semana
                            </h3>
                            <p class="band__item-p">Si una semana no te conviene, saltala. Sin cargo, hasta el martes 22:00.</p>
                        </div>
                        <div class="band__item">
                            <h3 class="band__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-9 8.4 8.5 8.5 0 0 1-7.6-4.2 8.5 8.5 0 0 1-1-4.2 8.4 8.4 0 0 1 8.4-8.4A8.4 8.4 0 0 1 21 11.5z"/><path d="M8 12h.01M12 12h.01M16 12h.01"/></svg>
                                Aviso 48h antes
                            </h3>
                            <p class="band__item-p">Te avisamos antes de cada cierre por WhatsApp. Confirmá, cambiá o saltá sin pensar.</p>
                        </div>
                        <div class="band__item">
                            <h3 class="band__item-h">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                                Cancelás en 30 segundos
                            </h3>
                            <p class="band__item-p">Desde tu cuenta, sin llamadas ni mails. Si ya pagaste una semana, te llega igual y queda ahí.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section" data-screen-label="06 FAQ">
        <div class="wrap">
            <div class="section__head">
                <span class="eyebrow"><span class="dot"></span>Preguntas frecuentes</span>
                <h2 class="section__title">Lo que <em>todos preguntan</em> antes de empezar.</h2>
                <p class="section__sub">¿Algo que no encontrás acá? Escribinos por WhatsApp y te respondemos antes del próximo cierre.</p>
            </div>

            <div class="faq">
                <details class="faq__item" open>
                    <summary>¿Puedo saltar una semana en el plan auto-renovación?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Sí, todas las que necesités. Desde tu panel de cuenta tocás <b>Saltar esta semana</b> hasta el martes 22:00 y no se factura. La semana siguiente vuelve sola, salvo que la saltes también o pauses indefinidamente.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Cómo pongo en pausa el plan si me voy de viaje?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Podés pausar tu plan por una, dos, cuatro semanas o por tiempo indefinido. La pausa se activa al instante desde tu cuenta. Cuando volvés, retomás desde donde lo dejaste — sin re-suscribirte ni perder beneficios.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Cuándo me cobran y cómo?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>En <b>Preorden</b>, te cobramos al confirmar el pedido de cada semana, antes del cierre del martes.</p>
                        <p>En <b>Auto-renovación</b> y <b>Premium</b>, cobramos automáticamente cada miércoles temprano sobre la tarjeta guardada en Bancard, antes de armar tu caja del jueves. Si saltaste o pausaste la semana, no hay cobro.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Puedo elegir las recetas o me las eligen ustedes?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Vos elegís. Cada lunes a las 9:00 publicamos las recetas de la semana y tenés hasta el martes 22:00 para personalizarlas. Si no entrás, nuestro chef arma una selección balanceada en base a tus preferencias y restricciones.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Cómo cancelo el plan?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>En 30 segundos, desde <b>Mi cuenta › Plan › Cancelar</b>. No hay llamadas, formularios ni cargos. Si cancelás después de un cobro semanal, esa caja te llega igual — el plan se desactiva a partir de la próxima.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Qué incluye la opción Premium?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Premium suma prioridad para nuestras recetas premium ya en rotación (camarones, salmón, tilapia, costillas BBQ, ravioles, tartaleta caprese), ventana de entrega preferida y soporte por WhatsApp. La calidad base de ingredientes y porciones es idéntica para todos los pedidos.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Puedo cambiar el tamaño de mi caja?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Sí — desde Mi cuenta, hasta el martes 22:00 de cada semana. El cambio se aplica desde la caja siguiente.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿Cuánto cuesta el envío?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Asunción Gs. 8.000 · Gran Asunción Gs. 15.000 · gratis si pedís 2 cajas o más en la misma entrega.</p>
                    </div>
                </details>

                <details class="faq__item">
                    <summary>¿A dónde entregan?
                        <span class="icon"><svg viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                    </summary>
                    <div class="body">
                        <p>Asunción y Gran Asunción los jueves, en ventanas de 9 a 13 o 17 a 21. Los clientes Premium eligen primero la ventana. Estamos sumando ciudades — si la tuya no aparece al registrarte, dejá tu mail y te avisamos cuando lleguemos.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="final" data-screen-label="07 Cierre">
        <div class="wrap">
            <h2 class="final__title">Esta semana <em>cocinás distinto.</em></h2>
            <p class="final__sub">Ingredientes locales, recetas del chef, sin pensar en el supermercado. Empezá con la flexibilidad que prefieras.</p>
            <div class="final__ctas">
                <a href="<?php echo esc_url( $register_url ); ?>" class="btn btn--warm">
                    Reservar mi primera caja
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost">
                    Ver el menú de esta semana
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
