<?php
/**
 * Template Name: FutureSite
 * Template Post Type: page
 *
 * Consumer-facing landing page for ogape.com.py/future-site
 * Inspired by premium meal-kit landing structure, with original Ogape Spanish copy.
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
                    <p class="future-site-hero__eyebrow">Ogape en español</p>
                    <h1 class="future-site-hero__title">Cocinar en casa se siente mejor cuando Ogape te lo deja resuelto.</h1>
                    <p class="future-site-hero__subtitle">Descubrí kits de comida, platos listos y recetas pensadas para tu semana. Elegí en minutos, recibí ingredientes porcionados o comidas preparadas, y mantené el control de tu rutina sin sacrificar sabor.</p>

                    <div class="future-site-hero__actions">
                        <a href="#planes" class="btn btn--primary btn--lg">Ver planes y precios</a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--lg">Explorar menús</a>
                    </div>

                    <ul class="future-site-hero__trust">
                        <li>Planes flexibles sin permanencia obligatoria</li>
                        <li>Menús semanales con opciones para distintas rutinas</li>
                        <li>Entrega pensada para Asunción y expansión futura</li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <p class="future-site-hero__panel-label">Así se ve la propuesta Ogape</p>
                    <div class="future-site-stack">
                        <div class="future-site-stack__item future-site-stack__item--primary">
                            <span class="future-site-stack__kicker">Tu semana</span>
                            <strong>Elegí cómo querés comer</strong>
                            <p>Kits para cocinar, opciones listas para calentar y una estructura simple para repetir lo que te funciona.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Más control</span>
                            <strong>Menús claros, decisión rápida</strong>
                            <p>Menos tiempo pensando qué comer y más tiempo resolviendo la semana con criterio.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Cuenta Ogape</span>
                            <strong>Preferencias, direcciones y continuidad</strong>
                            <p>Todo conectado en un mismo sistema para volver a pedir con menos fricción.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="planes">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Planes Ogape</p>
                <h2 class="section__heading">Sea cual sea tu semana, Ogape te ayuda a comer mejor con menos esfuerzo.</h2>
                <p class="section__sub">Armamos una estructura simple para que puedas entrar por el nivel de compromiso, ritmo y presupuesto que mejor encaja contigo.</p>
            </div>

            <div class="future-plan-grid">
                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Flexible</span>
                    <h3>Plan Básico</h3>
                    <p>Perfecto para probar Ogape y resolver algunas comidas por semana sin cambiar toda tu rutina.</p>
                    <div class="future-plan-card__meta">1–2 personas · entrada simple</div>
                    <ul>
                        <li>Selección semanal recomendada</li>
                        <li>Opciones para cocinar o calentar</li>
                        <li>Sin permanencia obligatoria</li>
                    </ul>
                    <a href="#menus" class="future-plan-card__link">Ver menús disponibles</a>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Más elegido</span>
                    <h3>Plan Hogar</h3>
                    <p>Para familias o rutinas estables que quieren previsibilidad, conveniencia y mejor organización de la semana.</p>
                    <div class="future-plan-card__meta">2–4 personas · semanal</div>
                    <ul>
                        <li>Mayor variedad para almuerzo y cena</li>
                        <li>Base ideal para compra recurrente</li>
                        <li>Preferencias y direcciones guardadas</li>
                    </ul>
                    <a href="#meal-kits" class="future-plan-card__link">Explorar kits Ogape</a>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Premium</span>
                    <h3>Plan Signature</h3>
                    <p>La entrada ideal para experiencias más cuidadas, regalos, ocasiones especiales o propuestas con mayor valor percibido.</p>
                    <div class="future-plan-card__meta">ocasiones especiales · edición</div>
                    <ul>
                        <li>Presentación más premium</li>
                        <li>Ideal para gifting o campañas</li>
                        <li>Formato pensado para marca y detalle</li>
                    </ul>
                    <a href="#gift-cards" class="future-plan-card__link">Ver opción regalo</a>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="como-funciona">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Cómo funciona</p>
                <h2 class="section__heading">La cena puede sentirse tan simple como 1, 2, 3.</h2>
                <p class="section__sub">Ogape está pensado para ayudarte a decidir rápido, recibir con claridad y cocinar o comer con más confianza.</p>
            </div>

            <div class="future-menu-grid">
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">1. Elegí</span>
                    <div class="future-menu-card__visual">Tus comidas</div>
                    <h3>Elegí tus platos o kits</h3>
                    <p>Explorá una selección curada de recetas, platos listos y formatos pensados para distintos estilos de vida.</p>
                </article>
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">2. Recibí</span>
                    <div class="future-menu-card__visual">Tu pedido</div>
                    <h3>Recibí ingredientes o comidas listas</h3>
                    <p>Todo llega organizado para reducir la fricción de la semana y darte una experiencia más limpia y práctica.</p>
                </article>
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">3. Disfrutá</span>
                    <div class="future-menu-card__visual">Sin estrés</div>
                    <h3>Cociná o resolvé rápido</h3>
                    <p>Seguís instrucciones simples o simplemente terminás tu comida en minutos, sin caos innecesario.</p>
                </article>
            </div>

            <div class="editorial-page-card glass-card editorial-page-card--centered" style="margin-top: 2rem;">
                <div class="editorial-page-card__copy">
                    <h2 class="section__heading">Hacé que Ogape se adapte a tu gusto — con variedad real semana tras semana.</h2>
                    <p class="section__sub editorial-page-card__lead">Podés cambiar porciones, priorizar ciertos platos, combinar opciones listas con kits para cocinar y construir una rutina que se sostenga de verdad.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="meal-kits">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Meal kits y formatos</p>
                <h2 class="section__heading">Más de una manera de resolver tu comida con Ogape.</h2>
                <p class="section__sub">No todo el mundo necesita lo mismo. Por eso el sitio debe dejar claro qué formato conviene según tu energía, tiempo y nivel de compromiso.</p>
            </div>

            <div class="future-kit-grid">
                <article class="future-kit-card glass-card">
                    <div class="future-kit-card__visual">Listo rápido</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Semana ocupada</span>
                        <h3>Comidas listas</h3>
                        <p>Opciones para quienes quieren comer bien con el menor esfuerzo posible.</p>
                        <ul>
                            <li>Resolución más inmediata</li>
                            <li>Ideal para almuerzo o cena práctica</li>
                            <li>Buena puerta de entrada a la marca</li>
                        </ul>
                    </div>
                </article>

                <article class="future-kit-card glass-card future-kit-card--featured">
                    <div class="future-kit-card__visual">El corazón Ogape</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Formato central</span>
                        <h3>Kits para cocinar</h3>
                        <p>Ingredientes porcionados y estructura clara para cocinar en casa con menos desgaste mental.</p>
                        <ul>
                            <li>Más control sobre la experiencia</li>
                            <li>Valor ideal para recurrencia</li>
                            <li>Formato principal del sitio futuro</li>
                        </ul>
                    </div>
                </article>

                <article class="future-kit-card glass-card">
                    <div class="future-kit-card__visual">Edición especial</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Mayor valor</span>
                        <h3>Experiencias premium</h3>
                        <p>Ediciones especiales, propuestas para regalar y formatos con una capa más fuerte de storytelling y marca.</p>
                        <ul>
                            <li>Ideal para campañas y lanzamientos</li>
                            <li>Más espacio para diferenciación</li>
                            <li>Conexión con gifting y ocasiones especiales</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="menus">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Menús semanales</p>
                <h2 class="section__heading">Elegí entre platos y kits que sí se sienten como una oferta real, no como una página vacía.</h2>
                <p class="section__sub">La experiencia Ogape tiene que verse abundante, confiable y fácil de recorrer: suficiente variedad para entusiasmar, pero sin ruido innecesario.</p>
            </div>

            <div class="future-dish-row">
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pollo grillado</div>
                    <span class="future-dish-card__tag">Popular</span>
                    <h3>Favoritos semanales</h3>
                    <p>Platos recurrentes con alta rotación y buen desempeño para clientes que quieren algo confiable.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pasta casera</div>
                    <span class="future-dish-card__tag">Nuevo</span>
                    <h3>Nuevas incorporaciones</h3>
                    <p>Espacios para sumar novedad cada semana y mantener vivo el interés por la marca.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Bowl fresco</div>
                    <span class="future-dish-card__tag">Light</span>
                    <h3>Opciones por estilo</h3>
                    <p>Bloques para organizar el catálogo por necesidad: ligero, familiar, abundante o práctico.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Edición chef</div>
                    <span class="future-dish-card__tag">Signature</span>
                    <h3>Platos con mayor valor percibido</h3>
                    <p>Recetas y propuestas con más peso editorial para que la página también venda aspiración.</p>
                </article>
            </div>

            <div class="future-benefit-strip">
                <div class="future-benefit-pill glass-card">
                    <strong>100+</strong>
                    <span>Recetas y combinaciones como aspiración del catálogo completo</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>30 min</strong>
                    <span>Objetivo para los kits más ágiles y fáciles de adoptar</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>1 cuenta</strong>
                    <span>Todo conectado: pedidos, preferencias y continuidad</span>
                </div>
            </div>

            <div class="editorial-page-card glass-card editorial-page-card--centered" style="margin-top: 2rem;">
                <div class="editorial-page-card__copy">
                    <p class="section__label">CTA principal</p>
                    <h2 class="section__heading">Explorá el menú y armá una rutina de comida más fácil con Ogape.</h2>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem; justify-content: center;">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--primary btn--md">Ver menú</a>
                        <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--secondary btn--md">Unirme a la lista de espera</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="gift-cards">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Regalos y ocasiones especiales</p>
                    <h2 class="section__heading">Ogape también puede regalarse.</h2>
                    <p class="section__sub editorial-page-card__lead">Creamos este bloque para que el sitio no solo venda comidas, sino también conveniencia, detalle y experiencias que se pueden compartir.</p>
                    <ul class="editorial-checklist">
                        <li>Tarjetas regalo integradas a la cuenta</li>
                        <li>Formatos especiales para ocasiones importantes</li>
                        <li>Mayor espacio para branding y valor percibido</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Tarjeta regalo</span>
                            <strong>Regalá Ogape</strong>
                            <p>Una forma simple de regalar comida, conveniencia y una experiencia mejor pensada.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Uso</span>
                            <strong>Canje simple</strong>
                            <p>Saldo, catálogo y cuenta funcionando dentro del mismo ecosistema visual.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="sostenibilidad">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Por qué Ogape</p>
                    <h2 class="section__heading">Más tiempo para vos, menos estrés para resolver qué comer.</h2>
                    <p class="section__sub editorial-page-card__lead">Ogape no es solamente delivery. Es una propuesta para organizar mejor la semana, comer con más criterio y construir una relación más útil con tu comida diaria.</p>
                    <ul class="editorial-checklist">
                        <li>Menos decisiones repetitivas cada semana</li>
                        <li>Formatos diseñados para distintos estilos de vida</li>
                        <li>Una marca local con ambición de experiencia premium</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Tiempo · conveniencia · sabor<br>en una sola experiencia</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-cta-shell">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--centered">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Empezá hoy</p>
                    <h2 class="section__heading">Entrá al ecosistema Ogape de la forma que mejor encaje con tu semana.</h2>
                    <p class="section__sub editorial-page-card__lead">Explorá menús, sumate a la lista de espera o prepará tu cuenta para cuando el sistema completo esté abierto al público.</p>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem; justify-content: center;">
                        <a href="#planes" class="btn btn--primary btn--md">Ver planes</a>
                        <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="btn btn--secondary btn--md">Crear cuenta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-lower-nav">
        <div class="container">
            <div class="future-site-footer-shell glass-card">
                <div class="future-site-footer-shell__intro">
                    <p class="section__label">Mapa rápido</p>
                    <h2 class="section__heading">Todo lo que una landing real de Ogape debería dejar a un clic.</h2>
                    <p class="section__sub">Reordenamos esta página para que se sienta como una propuesta comercial de verdad: clara, orientada a producto y más lista para conversión.</p>
                </div>

                <div class="future-site-footer-grid">
                    <div class="future-site-footer-column">
                        <h3>Explorar</h3>
                        <ul>
                            <li><a href="#planes">Planes</a></li>
                            <li><a href="#como-funciona">Cómo funciona</a></li>
                            <li><a href="#menus">Menús</a></li>
                            <li><a href="#meal-kits">Kits</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Ogape</h3>
                        <ul>
                            <li><a href="#nosotros">Nosotros</a></li>
                            <li><a href="#sostenibilidad">Por qué Ogape</a></li>
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
