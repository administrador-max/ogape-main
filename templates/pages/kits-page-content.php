<?php
/**
 * Kits page content.
 *
 * Shared by /kits/ and the legacy /como-funciona/ route.
 *
 * @var array $args Template args.
 */

$home_url           = $args['home_url'] ?? home_url( '/' );
$plans_url          = $args['plans_url'] ?? home_url( '/planes/' );
$menu_url           = $args['menu_url'] ?? home_url( '/menu/' );
$sustainability_url = $args['sustainability_url'] ?? home_url( '/sostenibilidad/' );
?>

<main id="main" class="site-main kits-design" role="main">
    <section class="hero" data-screen-label="01 Hero · Qué tiene una caja">
        <div class="wrap">
            <div class="hero__crumb">
                <a href="<?php echo esc_url( $home_url ); ?>">Inicio</a>
                <span class="sep">/</span>
                <span>Kits</span>
            </div>
            <div class="hero__grid">
                <div>
                    <span class="eyebrow hero__eyebrow rise">El kit semanal</span>
                    <h1 class="hero__title rise rise--2">
                        <span class="q">¿</span>Qué tiene<br>
                        una caja <em>Ogape?</em>
                    </h1>
                    <p class="hero__lede rise rise--3">
                        Ingredientes frescos, ya porcionados, llegan a tu puerta el jueves. Vos abrís la caja,
                        seguís la guía de un chef paso a paso, y comés en treinta minutos.
                        <strong>Sin pensar el menú. Sin sobras raras.</strong>
                    </p>
                    <div class="hero__reassure rise rise--3" role="note">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                        <span>Antes de elegir tu semana, te mostramos cualquier <b>básico que necesitás tener en casa.</b></span>
                    </div>
                    <div class="hero__ctas rise rise--3">
                        <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--primary">Ver planes y precios
                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost">Ver el menú de esta semana</a>
                    </div>
                    <div class="hero__meta">
                        <div><b>5 recetas</b>nuevas por semana</div>
                        <div><b>≈30 min</b>de cocción en casa</div>
                        <div><b>0 sobras</b>todo viene pesado</div>
                    </div>
                </div>

                <figure class="openbox" aria-label="Caja Ogape abierta con ingredientes saliendo">
                    <div class="openbox__flap openbox__flap--back" aria-hidden="true"></div>
                    <div class="openbox__body" aria-hidden="true"></div>
                    <div class="openbox__flap openbox__flap--l" aria-hidden="true"></div>
                    <div class="openbox__flap openbox__flap--r" aria-hidden="true"></div>

                    <div class="openbox__items" aria-hidden="true">
                        <span class="chip chip--accent">Surubí 320 g</span>
                        <span class="chip chip--rose">Maracuyá ×2</span>
                        <span class="chip chip--green">Cilantro fresco</span>
                        <span class="chip">Mandioca 400 g</span>
                        <span class="chip chip--ink">Receta · N.º 01</span>
                        <span class="chip">Mantequilla 60 g</span>
                        <span class="chip chip--green">Hierbas del monte</span>
                        <span class="chip">Limón sutil</span>
                    </div>

                    <div class="openbox__dots" aria-hidden="true">
                        <span class="d1"></span>
                        <span class="d2"></span>
                        <span class="d3"></span>
                        <span class="d4"></span>
                    </div>

                    <div class="openbox__stamp" aria-hidden="true">
                        <svg viewBox="0 0 100 100">
                            <defs><path id="kits-stamp-circle" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs>
                            <text fill="#1B1B1E" font-family="Cormorant Garamond, serif" font-size="9.5" letter-spacing="3">
                                <textPath href="#kits-stamp-circle" startOffset="0">CAJA SEMANAL · 5 RECETAS · INGREDIENTES PORCIONADOS · </textPath>
                            </text>
                        </svg>
                        <span class="core">Kit</span>
                    </div>

                    <figcaption class="openbox__caption">
                        <div class="num">N.º 17</div>
                        <div>
                            <span class="lab">Caja semana</span>
                            <span class="ttl">Del río, del monte<br>y de la huerta</span>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="split" id="comparativa" data-screen-label="02 Lo que viene en tu caja">
        <div class="wrap">
            <div class="split__head">
                <h2><em>Lo que viene</em> en tu caja Ogape.</h2>
                <p class="lab">Te mandamos lo perecedero, lo dosificado y lo difícil de planear. Lo demás ya vive en tu alacena.</p>
            </div>

            <div class="split__grid">
                <article class="split-col split-col--box" aria-labelledby="split-box">
                    <div class="split-col__hdr">
                        <div class="badge" aria-hidden="true">i.</div>
                        <div>
                            <span class="meta">En tu caja Ogape · semanal</span>
                            <h3 id="split-box">Todo lo <em>fresco, medido</em> y específico de cada receta.</h3>
                        </div>
                    </div>

                    <ul class="split-feat">
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M5 14c2-5 5-8 9-8s5 4 5 4-1 6-5 8-9-4-9-4Z"/><path d="M9 12c1.5-2 3.5-3 5.5-3"/></svg>
                            </span>
                            <div><b>Proteínas frescas</b><span class="sub">surubí, costilla, pollo — porcionados al gramo</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c-3 4-3 9 0 12 3-3 3-8 0-12Z"/><path d="M12 15v6"/></svg>
                            </span>
                            <div><b>Verduras y hierbas</b><span class="sub">mandioca, cilantro, hierbas del monte — lavadas</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3h8l-1 5h-6Z"/><path d="M9 8c-2 1-3 3-3 6v6h12v-6c0-3-1-5-3-6"/></svg>
                            </span>
                            <div><b>Salsas, bases y marinadas</b><span class="sub">aliolis, mantequillas saborizadas, reducciones</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h12l-2 7H8Z"/><path d="M9 11v6a3 3 0 0 0 6 0v-6"/></svg>
                            </span>
                            <div><b>Especias y condimentos especiales</b><span class="sub">un sobre dosificado por receta · cero merma</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9 12c1.5 1.5 4.5 1.5 6 0M9 9h.01M15 9h.01"/></svg>
                            </span>
                            <div><b>Porciones medidas para 2 o 4</b><span class="sub">pesado en cocina, no en el packaging</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h13a3 3 0 0 1 3 3v13H7a3 3 0 0 1-3-3V4Z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg>
                            </span>
                            <div><b>Recetas paso a paso</b><span class="sub">una ficha ilustrada por plato, con tiempos</span></div>
                        </li>
                        <li>
                            <span class="ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8h16v12H4Z"/><path d="M8 8V5h8v3M8 12h8M8 16h5"/></svg>
                            </span>
                            <div><b>Empaque frío cuando hace falta</b><span class="sub">cadena de frío a 4 °C, aislante de papel</span></div>
                        </li>
                    </ul>

                    <p class="split-col__foot">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>
                        <span>La caja resuelve <b>lo difícil de planear, lo difícil de medir y lo perecedero</b> — todo lo específico de la receta llega listo.</span>
                    </p>
                </article>

                <aside class="split-col split-col--home" aria-labelledby="split-home">
                    <div class="split-col__hdr">
                        <div class="badge" aria-hidden="true">ii.</div>
                        <div>
                            <span class="meta">Nota · en tu cocina</span>
                            <h3 id="split-home">Lo que ya tenés en casa.</h3>
                        </div>
                    </div>

                    <p class="split-note">Solo los básicos de siempre — nada que tengas que ir a comprar especialmente.</p>

                    <ul class="split-home-list">
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
                            <span>Sal, pimienta y aceite</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
                            <span>Cuchillo, tabla, sartén y olla</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
                            <span>Hornalla u horno</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
                            <span>Algún básico de alacena según la receta</span>
                        </li>
                    </ul>

                    <p class="split-col__foot">Antes de elegir tu semana, te mostramos cualquier básico que necesitás tener en casa.</p>
                </aside>
            </div>
        </div>
    </section>

    <section class="inv" data-screen-label="03 Qué viene en la caja">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow hero__eyebrow">03 · Lo que viene en la caja</span>
                    <h2>Proteínas frescas, verduras, hierbas y bases de <em>chef</em> — ya pesadas.</h2>
                </div>
                <p>Cada caja viene pesada en la cocina, no en el packaging. Vos abrís, leés la receta y empezás.</p>
            </div>

            <div class="inv__grid">
                <article class="inv-card inv--hero inv--lg">
                    <span class="num">i.</span>
                    <h3>Proteínas frescas del día</h3>
                    <p>Pescado del Paraná, costilla y pollo de productores de Central, mariscos de temporada. Cortados al gramo, refrigerados y etiquetados con el número de la receta.</p>
                    <div class="ill" aria-hidden="true">
                        <div class="row">
                            <span class="ing">Pollo<br>de campo</span>
                            <span class="ing ing--accent ing--big">Surubí<br>320 g</span>
                            <span class="ing ing--rose">Maracuyá</span>
                            <span class="ing">Costilla<br>marinada</span>
                            <span class="ing ing--green ing--big">Verduras<br>de huerta</span>
                            <span class="ing ing--ink">Especias</span>
                            <span class="ing">Limón<br>sutil</span>
                        </div>
                    </div>
                </article>

                <article class="inv-card inv--md">
                    <span class="num">ii.</span>
                    <h3>Receta ilustrada</h3>
                    <p>Una ficha impresa por receta. Foto, tiempos, técnicas y los pasos que un chef te diría al lado de la sartén.</p>
                    <div class="vis">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h13a3 3 0 0 1 3 3v13H7a3 3 0 0 1-3-3V4Z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg>
                        5 fichas · 1 por receta
                    </div>
                </article>

                <article class="inv-card inv--md">
                    <span class="num">iii.</span>
                    <h3>Cadena de frío real</h3>
                    <p>Caja aislada con sellos de hielo seco vegetal. Tu pescado y tus carnes llegan a 4 °C, incluso en tarde de calor.</p>
                    <div class="vis">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M5 7l14 10M5 17 19 7"/><circle cx="12" cy="12" r="9"/></svg>
                        4 °C · 8 h fuera de heladera
                    </div>
                </article>

                <article class="inv-card inv--sm">
                    <span class="num">iv.</span>
                    <h3>Salsas &amp; bases</h3>
                    <p>Aliolis, mantequillas saborizadas, marinados y reducciones — montados en nuestra cocina, listos para terminar el plato.</p>
                    <div class="vis">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3h8l-1 5h-6Z"/><path d="M9 8c-2 1-3 3-3 6v6h12v-6c0-3-1-5-3-6"/></svg>
                        Frasco etiquetado · 1 por receta
                    </div>
                </article>

                <article class="inv-card inv--sm">
                    <span class="num">v.</span>
                    <h3>Hierbas y especias</h3>
                    <p>Cilantro fresco, hierbas del monte, mezclas de especias dosificadas — un sobre por receta, sin sobras de bolsas a medio usar.</p>
                    <div class="vis">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c-3 4-3 9 0 12 3-3 3-8 0-12Z"/><path d="M12 15v6"/></svg>
                        Sobres dosificados · cero merma
                    </div>
                </article>

                <article class="inv-card inv--sm">
                    <span class="num">vi.</span>
                    <h3>Embalaje compostable</h3>
                    <p>Cartón reciclado, aislante de papel, bolsas de almidón. Te dejamos la guía de qué hacer con cada parte.</p>
                    <div class="vis">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v6M9 6l3-3 3 3"/><path d="M5 12c0 5 3 8 7 8s7-3 7-8"/></svg>
                        100 % compostable
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="pantry" data-screen-label="04 Tu cocina, tu dominio">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow hero__eyebrow">04 · Tu cocina, tu dominio</span>
                    <h2>Lo que ya <em>tenés en casa</em> — y te rinde para más recetas.</h2>
                </div>
                <p>No mandamos sal ni aceite. Vos ponés lo básico de la alacena; nosotros, lo difícil de medir y lo perecedero. La caja pesa menos y vos cocinás más allá del kit.</p>
            </div>

            <div class="pantry__layout">
                <div class="pantry__cols">
                    <div class="pcol">
                        <h4>Siempre a mano</h4>
                        <ul>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c-1.5 4-1.5 6 0 8s1.5 5 0 9"/><circle cx="12" cy="12" r="9"/></svg>
                                </span>
                                <div><b>Aceite de oliva &amp; girasol</b><span class="sub">para sellar y rematar</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 9h14l-1 11H6Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg>
                                </span>
                                <div><b>Sal &amp; pimienta</b><span class="sub">gruesa y fina</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3.5"/><path d="M12 5v2M12 17v2M5 12h2M17 12h2M7 7l1.5 1.5M15.5 15.5 17 17M7 17l1.5-1.5M15.5 8.5 17 7"/></svg>
                                </span>
                                <div><b>Ajo, cebolla, limón</b><span class="sub">los tres clásicos</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8h16l-1 12H5Z"/><path d="M8 8c0-3 2-5 4-5s4 2 4 5"/></svg>
                                </span>
                                <div><b>Manteca o mantequilla</b><span class="sub">100 g basta para la semana</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h12v16H6Z"/><path d="M9 8h6M9 12h6M9 16h4"/></svg>
                                </span>
                                <div><b>Huevos</b><span class="sub">media docena</span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="pcol">
                        <h4>Útil pero opcional</h4>
                        <ul>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 14c0-3 3-7 7-7s7 4 7 7"/><path d="M3 15h18l-1 5H4Z"/></svg>
                                </span>
                                <div><b>Sartén grande &amp; olla</b><span class="sub">una de cada</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h12l4 14H8Z"/><path d="M8 6V4h6v2"/></svg>
                                </span>
                                <div><b>Cuchillo afilado</b><span class="sub">uno bueno cambia todo</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8"/><path d="M9 12c2 2 4 2 6 0"/><circle cx="9" cy="10" r=".8"/><circle cx="15" cy="10" r=".8"/></svg>
                                </span>
                                <div><b>Tabla de madera</b><span class="sub">o plástico, da igual</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3v8M15 3v8"/><path d="M5 11h14l-2 9H7Z"/></svg>
                                </span>
                                <div><b>Batidor de mano</b><span class="sub">para la mantequilla saborizada</span></div>
                            </li>
                            <li>
                                <span class="ico" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18M6 12c0 4 2 8 6 8s6-4 6-8"/><path d="M6 12c0-4 2-8 6-8s6 4 6 8"/></svg>
                                </span>
                                <div><b>Bols medianos</b><span class="sub">dos basta</span></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <figure class="tools-card" aria-label="Herramientas de cocina ilustradas">
                    <svg viewBox="0 0 400 400" fill="none" preserveAspectRatio="xMidYMid meet">
                        <g transform="translate(70 80)" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" fill="none">
                            <line x1="40" y1="0" x2="40" y2="120"/>
                            <ellipse cx="40" cy="160" rx="22" ry="42" stroke-opacity=".9"/>
                            <ellipse cx="40" cy="160" rx="14" ry="42" stroke-opacity=".7"/>
                            <ellipse cx="40" cy="160" rx="22" ry="22" stroke-opacity=".5" transform="rotate(60 40 160)"/>
                            <ellipse cx="40" cy="160" rx="22" ry="22" stroke-opacity=".5" transform="rotate(-60 40 160)"/>
                            <circle cx="40" cy="-2" r="6" fill="currentColor" stroke="none" opacity=".85"/>
                        </g>
                        <g transform="translate(180 130)" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" fill="none">
                            <path d="M0 30 H140 L130 130 H10 Z"/>
                            <line x1="-10" y1="30" x2="150" y2="30" stroke-width="3"/>
                            <path d="M40 20 Q70 -10 100 20"/>
                            <circle cx="70" cy="0" r="5" fill="currentColor" stroke="none" opacity=".85"/>
                            <path d="M50 -28 q5 -8 0 -16 q-5 -8 0 -16" stroke-opacity=".4"/>
                            <path d="M70 -32 q5 -8 0 -16 q-5 -8 0 -16" stroke-opacity=".4"/>
                            <path d="M90 -28 q5 -8 0 -16 q-5 -8 0 -16" stroke-opacity=".4"/>
                        </g>
                        <g transform="translate(310 200)" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" fill="none">
                            <path d="M0 14 L25 0 L60 0 L60 32 L35 46 L0 46 Z" stroke-opacity=".95"/>
                            <line x1="25" y1="0" x2="25" y2="32"/>
                            <line x1="25" y1="32" x2="60" y2="32"/>
                            <line x1="0" y1="14" x2="25" y2="14"/>
                            <line x1="0" y1="14" x2="0" y2="46"/>
                            <line x1="35" y1="46" x2="35" y2="14"/>
                            <line x1="25" y1="14" x2="60" y2="14" stroke-opacity=".4"/>
                        </g>
                        <g transform="translate(140 290)" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" fill="none">
                            <ellipse cx="32" cy="22" rx="28" ry="18"/>
                            <line x1="58" y1="28" x2="170" y2="50"/>
                        </g>
                    </svg>
                    <figcaption class="label">
                        <div>
                            <span class="lab">Tu cocina</span>
                            <span class="name">tu dominio.</span>
                        </div>
                        <span class="small">N.º vi</span>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="value" data-screen-label="05 Por qué funciona">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow hero__eyebrow">05 · Por qué vale la pena</span>
                    <h2>Una caja que <em>respeta</em> tu tiempo, tu plata y tu apetito.</h2>
                </div>
                <p>No es una suscripción de comida congelada. Es la mise en place de un restaurante, dejada en tu portería el jueves.</p>
            </div>

            <div class="value__grid">
                <article class="v-card">
                    <span class="n">i.</span>
                    <h3>Menos planificación</h3>
                    <p>Lunes a viernes resueltos. No más mirar la heladera a las 19:00 preguntando qué cocinar. La semana ya viene pensada por un chef.</p>
                    <p class="quote">El menú ya está elegido — vos solo cocinás.</p>
                </article>

                <article class="v-card">
                    <span class="n">ii.</span>
                    <h3>Cero desperdicio</h3>
                    <p>Te llega lo justo. La cebolla viene a la mitad si la receta pide media cebolla. El cilantro, en gramos. Lo que no entra a tu plato, no entra a tu basura.</p>
                    <p class="quote">Lo medimos en la cocina, no en el packaging.</p>
                </article>

                <article class="v-card">
                    <span class="n">iii.</span>
                    <h3>Variedad real cada semana</h3>
                    <p>Cinco recetas nuevas, del río, del monte, de la huerta y del mundo. Salimos del bucle de "milanesa o pasta" sin pensarlo dos veces.</p>
                    <p class="quote">Cocinás distinto sin cambiar tu rutina.</p>
                </article>

                <article class="v-card">
                    <span class="n">iv.</span>
                    <h3>La guía de un chef</h3>
                    <p>Salsas, marinados y especias se montan en nuestra cocina. Vos hacés la parte rica: sellás, doblás, servís. La ficha te lleva paso a paso, sin jerga.</p>
                    <p class="quote">El secreto del restaurante, hecho en tu sartén.</p>
                </article>

                <article class="v-card">
                    <span class="n">v.</span>
                    <h3>Sin sobras raras</h3>
                    <p>Nada de medio paquete de panceta abandonado en el cajón. Lo que no se usa en la receta, no entra a la caja — ni a tu casa.</p>
                    <p class="quote">Cero ingredientes en busca de un destino.</p>
                </article>

                <article class="v-card">
                    <span class="n">vi.</span>
                    <h3>Frescura local</h3>
                    <p>Productores del departamento Central, pescadores del Paraná, hierbas de huerta a 60 km. Pescado del jueves — no del congelador del miércoles pasado.</p>
                    <p class="quote">Sabe a Paraguay porque vive en Paraguay.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="sust" id="sostenibilidad" data-screen-label="06 Sostenibilidad">
        <div class="wrap">
            <div class="sust__card">
                <div class="sust__grid">
                    <div>
                        <span class="eyebrow">06 · Pensada para gastar menos</span>
                        <h2>La caja, <em>parte del plato.</em></h2>
                        <p>Porcionamos para que sobre menos, compramos más cerca cuando podemos, y diseñamos cada caja para viajar liviana. Lo cuidamos por vos, sin pedirte nada extra.</p>
                        <a href="<?php echo esc_url( $sustainability_url ); ?>" class="sust__cta">
                            Leer más sobre sostenibilidad
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                    <div class="sust__stats">
                        <div>
                            <span class="k">Porción exacta</span>
                            <span class="v"><em>-72 %</em></span>
                            <span class="k">desperdicio</span>
                        </div>
                        <div>
                            <span class="k">Origen</span>
                            <span class="v"><em>60 km</em></span>
                            <span class="k">radio promedio</span>
                        </div>
                        <div>
                            <span class="k">Embalaje</span>
                            <span class="v"><em>100 %</em></span>
                            <span class="k">compostable</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="final" id="kits-final">
        <div class="wrap">
            <span class="eyebrow">Listo. Próximo paso.</span>
            <h2>Elegí tu plan o mirá el <em>menú</em> de esta semana.</h2>
            <p>Pedidos cierran el martes a las 23:59 · entrega el jueves en Asunción.<br>Sin contrato, pausás cuando querés.</p>
            <div class="btns">
                <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--primary">Ver planes y precios
                    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost">Ver el menú de la semana</a>
            </div>
        </div>
    </section>
</main>
