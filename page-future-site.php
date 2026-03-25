<?php
/**
 * Template Name: FutureSite
 * Template Post Type: page
 *
 * Consumer-facing landing page for ogape.com.py/future-site
 * Structured like a premium meal-kit homepage, with original Spanish Ogape content.
 */

get_header();

$waitlist_url = home_url( '/waitlist/' );
$menu_url     = home_url( '/menu/' );
$login_url    = home_url( '/login/' );
$register_url = home_url( '/register/' );
?>

<main id="main" class="site-main" role="main">

    <div id="planes" aria-hidden="true"></div>

    <section class="future-site-hero" id="nosotros">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow">Ogape</p>
                    <h1 class="future-site-hero__title">Comé mejor en casa con kits, platos y una experiencia hecha para simplificar tu semana.</h1>
                    <p class="future-site-hero__subtitle">Elegí entre comidas listas, kits para cocinar y formatos pensados para hogares reales. Más variedad, menos fricción y una página que se sienta como una marca de producto de verdad.</p>

                    <div class="future-site-hero__actions">
                        <a href="#como-funciona" class="btn btn--primary btn--lg">Cómo funciona</a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--lg">Ver menú</a>
                    </div>

                    <ul class="future-site-hero__trust">
                        <li>Kits y comidas pensadas para la semana real</li>
                        <li>Más fácil que planificar todo desde cero</li>
                        <li>Diseñado para crecer como experiencia Ogape completa</li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <p class="future-site-hero__panel-label">Explorá el universo Ogape</p>
                    <div class="future-site-stack">
                        <div class="future-site-stack__item future-site-stack__item--primary">
                            <span class="future-site-stack__kicker">Plato destacado</span>
                            <strong>Milanesa con papas</strong>
                            <p>Comidas pensadas para verse, elegirse y repetirse.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Kit semanal</span>
                            <strong>Pollo al horno con vegetales</strong>
                            <p>Ingredientes organizados para cocinar con menos esfuerzo.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Favorito del hogar</span>
                            <strong>Pasta cremosa con proteína</strong>
                            <p>Una oferta más abundante y comercial desde el primer scroll.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="como-funciona">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Cómo funciona</p>
                <h2 class="section__heading">Elegí. Recibí. Disfrutá.</h2>
                <p class="section__sub">La experiencia tiene que explicarse rápido y vender conveniencia desde arriba, como una homepage comercial real.</p>
            </div>

            <div class="steps-grid">
                <div class="step-item">
                    <span class="step-item__number">01</span>
                    <h3 class="step-item__title">Elegí tus platos</h3>
                    <p class="step-item__text">Explorá menús y kits organizados para decidir sin perder tiempo.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">02</span>
                    <h3 class="step-item__title">Recibí tu pedido</h3>
                    <p class="step-item__text">Todo llega más claro, mejor presentado y listo para entrar en tu rutina.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">03</span>
                    <h3 class="step-item__title">Resolvé tu semana</h3>
                    <p class="step-item__text">Cociná o terminá tu comida en minutos, con menos fricción y más control.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="menus">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Más para descubrir</p>
                <h2 class="section__heading">Una oferta que se ve más rica, más clara y más fácil de comprar.</h2>
                <p class="section__sub">La página debe sentirse viva: platos visibles, categorías claras y razones concretas para seguir bajando.</p>
            </div>

            <div class="future-dish-row">
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Burger premium</div>
                    <span class="future-dish-card__tag">Popular</span>
                    <h3>Favoritos de la semana</h3>
                    <p>Platos que generan repetición, antojo y sensación de catálogo real.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pasta casera</div>
                    <span class="future-dish-card__tag">Nuevo</span>
                    <h3>Novedades continuas</h3>
                    <p>Bloques para sostener frescura y una propuesta siempre activa.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Bowl fresco</div>
                    <span class="future-dish-card__tag">Ligero</span>
                    <h3>Opciones por estilo</h3>
                    <p>Más claridad para distintos momentos, necesidades y preferencias.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pollo grillado</div>
                    <span class="future-dish-card__tag">Hogar</span>
                    <h3>Comidas para todos los días</h3>
                    <p>La base de una relación más práctica y repetible con la marca.</p>
                </article>
            </div>

            <div class="future-benefit-strip">
                <div class="future-benefit-pill glass-card">
                    <strong>100+</strong>
                    <span>Combinaciones como aspiración de catálogo</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>15–30 min</strong>
                    <span>Formatos para cocinar o resolver rápido</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>1 cuenta</strong>
                    <span>Pedidos, preferencias y continuidad conectados</span>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="meal-kits">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Formats that fit your life — en versión Ogape</p>
                    <h2 class="section__heading">Kits para cocinar, comidas listas y opciones para distintos ritmos de vida.</h2>
                    <p class="section__sub editorial-page-card__lead">En vez de una página abstracta, esta sección tiene que vender formatos concretos y fáciles de entender.</p>
                    <ul class="editorial-checklist">
                        <li>Kits con ingredientes organizados</li>
                        <li>Opciones listas para días más pesados</li>
                        <li>Más control sobre cómo querés comer</li>
                    </ul>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem;">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--primary btn--md">Explorar formatos</a>
                        <a href="#planes" class="btn btn--secondary btn--md">Ver planes</a>
                    </div>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Meal kits</span>
                            <strong>Cociná con menos esfuerzo</strong>
                            <p>Ingredientes porcionados y pasos más claros para que cocinar se sienta accesible.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Ready meals</span>
                            <strong>Comé bien más rápido</strong>
                            <p>La parte más práctica de la propuesta, ideal para días de menos tiempo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="planes">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Planes</p>
                <h2 class="section__heading">Elegí la forma de entrar a Ogape que mejor encaje con tu semana.</h2>
                <p class="section__sub">La lógica comercial tiene que sentirse clara: empezar, consolidar o regalar una experiencia más premium.</p>
            </div>

            <div class="future-plan-grid">
                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Empezar</span>
                    <h3>Plan Básico</h3>
                    <p>La puerta de entrada perfecta para probar Ogape sin complicarte.</p>
                    <div class="future-plan-card__meta">1–2 personas · simple</div>
                    <ul>
                        <li>Selección clara</li>
                        <li>Entrada con menos fricción</li>
                        <li>Ideal para primera compra</li>
                    </ul>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="future-plan-card__link">Empezar</a>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Más elegido</span>
                    <h3>Plan Hogar</h3>
                    <p>El centro de la propuesta: más variedad, más orden y mejor continuidad semanal.</p>
                    <div class="future-plan-card__meta">2–4 personas · semanal</div>
                    <ul>
                        <li>Más valor para repetir</li>
                        <li>Mejor para la rutina del hogar</li>
                        <li>Cuenta y preferencias conectadas</li>
                    </ul>
                    <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="future-plan-card__link">Crear cuenta</a>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Premium</span>
                    <h3>Plan Signature</h3>
                    <p>Para regalos, ocasiones especiales y una experiencia más cuidada de punta a punta.</p>
                    <div class="future-plan-card__meta">especial · gifting</div>
                    <ul>
                        <li>Mayor peso de marca</li>
                        <li>Presentación más premium</li>
                        <li>Ideal para campañas o regalo</li>
                    </ul>
                    <a href="#gift-cards" class="future-plan-card__link">Ver regalo</a>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="por-que-ogape">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Por qué Ogape</p>
                    <h2 class="section__heading">No se trata solo de qué comés. Se trata de cómo se siente tu semana.</h2>
                    <p class="section__sub editorial-page-card__lead">El objetivo de esta página es vender alivio, orden, variedad y una experiencia que se vea más confiable y mejor pensada.</p>
                    <ul class="editorial-checklist">
                        <li>Menos decisiones repetitivas</li>
                        <li>Más claridad para elegir y repetir</li>
                        <li>Una experiencia paraguaya con ambición premium</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Más conveniencia<br>más variedad<br>menos estrés semanal</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="gift-cards">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Regalos</p>
                    <h2 class="section__heading">También podés regalar Ogape.</h2>
                    <p class="section__sub editorial-page-card__lead">Este bloque suma otra razón comercial para explorar la marca: conveniencia y comida como experiencia para compartir.</p>
                    <ul class="editorial-checklist">
                        <li>Tarjetas regalo integradas a cuenta</li>
                        <li>Ideal para ocasiones especiales</li>
                        <li>Otra entrada premium al ecosistema</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Gift card</span>
                            <strong>Regalá Ogape</strong>
                            <p>Una forma clara y atractiva de convertir comida en un regalo útil.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Simple</span>
                            <strong>Canje fácil</strong>
                            <p>Integrado al mismo sistema visual y comercial del sitio.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-cta-shell">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--centered">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Empezá</p>
                    <h2 class="section__heading">Explorá el menú, prepará tu cuenta y hacé que Ogape entre de verdad en tu rutina.</h2>
                    <p class="section__sub editorial-page-card__lead">La página cierra como una homepage comercial real: con una invitación clara a avanzar, no solo a leer.</p>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem; justify-content: center;">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--primary btn--md">Ver menú</a>
                        <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--secondary btn--md">Unirme a la lista de espera</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-lower-nav">
        <div class="container">
            <div class="future-site-footer-shell glass-card">
                <div class="future-site-footer-shell__intro">
                    <p class="section__label">Mapa del sitio</p>
                    <h2 class="section__heading">Ahora más cerca de una landing meal-kit real y menos de una plantilla vacía.</h2>
                    <p class="section__sub">Reordenamos la página para que se sienta más comercial, más escaneable y más visual desde el primer scroll.</p>
                </div>

                <div class="future-site-footer-grid">
                    <div class="future-site-footer-column">
                        <h3>Descubrir</h3>
                        <ul>
                            <li><a href="#como-funciona">Cómo funciona</a></li>
                            <li><a href="#menus">Menús</a></li>
                            <li><a href="#meal-kits">Formatos</a></li>
                            <li><a href="#planes">Planes</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Ogape</h3>
                        <ul>
                            <li><a href="#nosotros">La propuesta</a></li>
                            <li><a href="#por-que-ogape">Por qué Ogape</a></li>
                            <li><a href="#gift-cards">Regalos</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Cuenta</h3>
                        <ul>
                            <li><a href="<?php echo esc_url( $login_url ); ?>?fresh=1">Iniciar sesión</a></li>
                            <li><a href="<?php echo esc_url( $register_url ); ?>?fresh=1">Crear cuenta</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/account/' ) ); ?>?fresh=1">Mi cuenta</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Acciones</h3>
                        <ul>
                            <li><a href="<?php echo esc_url( $menu_url ); ?>">Ver menú</a></li>
                            <li><a href="<?php echo esc_url( $waitlist_url ); ?>">Lista de espera</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/privacidad/' ) ); ?>">Privacidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
