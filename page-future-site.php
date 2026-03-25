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
                    <h1 class="future-site-hero__title">Comidas y kits para que comer mejor en casa sea mucho más fácil.</h1>
                    <p class="future-site-hero__subtitle">Elegí recetas, platos listos y formatos pensados para tu semana. Menos tiempo resolviendo qué comer, más tiempo disfrutando una experiencia práctica, rica y bien presentada.</p>

                    <div class="future-site-hero__actions">
                        <a href="#como-funciona" class="btn btn--primary btn--lg">Cómo funciona</a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--lg">Ver menú</a>
                    </div>

                    <ul class="future-site-hero__trust">
                        <li>Más simple que planificar toda tu semana solo</li>
                        <li>Formatos para cocinar o resolver rápido</li>
                        <li>Diseñado para crecer como experiencia Ogape completa</li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <p class="future-site-hero__panel-label">La promesa Ogape</p>
                    <div class="future-site-stack">
                        <div class="future-site-stack__item future-site-stack__item--primary">
                            <span class="future-site-stack__kicker">Elegí</span>
                            <strong>Menús que sí invitan a comprar</strong>
                            <p>Una página más abundante, más visual y más comercial para que elegir se sienta fácil.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Recibí</span>
                            <strong>Tu semana mejor resuelta</strong>
                            <p>Ingredientes porcionados, opciones listas y una estructura que reduce fricción.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Repetí</span>
                            <strong>Cuenta, preferencias y continuidad</strong>
                            <p>La experiencia futura apunta a convertir la primera compra en una rutina sostenible.</p>
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
                <h2 class="section__heading">Ogape te ayuda a comer bien sin cargar con toda la planificación.</h2>
                <p class="section__sub">Tomamos el patrón de homepage que convierte mejor: explicar rápido, mostrar valor pronto y dejar claro por qué el producto mejora la semana real de la gente.</p>
            </div>

            <div class="steps-grid">
                <div class="step-item">
                    <span class="step-item__number">01</span>
                    <h3 class="step-item__title">Elegís tus comidas</h3>
                    <p class="step-item__text">Explorás recetas, platos listos y kits organizados para decidir sin perder tiempo.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">02</span>
                    <h3 class="step-item__title">Recibís todo más claro</h3>
                    <p class="step-item__text">Tu pedido llega pensado para que la experiencia se sienta limpia, ordenada y confiable.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">03</span>
                    <h3 class="step-item__title">Cocinás o resolvés rápido</h3>
                    <p class="step-item__text">Usás lo que recibiste para comer mejor durante la semana sin improvisación constante.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="meal-kits">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Lo mejor de ambos mundos</p>
                    <h2 class="section__heading">Más conveniencia, más variedad, menos desgaste mental.</h2>
                    <p class="section__sub editorial-page-card__lead">La página necesita sentirse rica en opciones desde arriba: no una maqueta vacía, sino una propuesta clara de producto para distintos tipos de cliente.</p>
                    <ul class="editorial-checklist">
                        <li>Recetas y kits para cocinar en casa</li>
                        <li>Opciones listas para semanas más pesadas</li>
                        <li>Mayor percepción de catálogo y abundancia</li>
                    </ul>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem;">
                        <a href="#planes" class="btn btn--primary btn--md">Elegir plan</a>
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--md">Explorar platos</a>
                    </div>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Kits</span>
                            <strong>Cociná con menos esfuerzo</strong>
                            <p>Ingredientes organizados y una experiencia más predecible para la semana.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Ready meals</span>
                            <strong>Resolvé rápido</strong>
                            <p>Opciones pensadas para cuando el tiempo es corto, pero el estándar sigue alto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="menus">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Más para amar en cada semana</p>
                <h2 class="section__heading">Una página de producto real necesita variedad visible desde el primer scroll.</h2>
                <p class="section__sub">Acá es donde el sitio tiene que sentirse mucho más como una marca comercial viva: platos atractivos, categorías claras y razones concretas para seguir explorando.</p>
            </div>

            <div class="future-dish-row">
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pollo al horno</div>
                    <span class="future-dish-card__tag">Más pedido</span>
                    <h3>Favoritos semanales</h3>
                    <p>Platos recurrentes para clientes que quieren algo confiable, rico y fácil de volver a elegir.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Pasta fresca</div>
                    <span class="future-dish-card__tag">Nuevo</span>
                    <h3>Novedades que mantienen vivo el menú</h3>
                    <p>Nuevas incorporaciones para que el catálogo no se sienta repetitivo o estático.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Bowl saludable</div>
                    <span class="future-dish-card__tag">Balanceado</span>
                    <h3>Opciones para distintos estilos de vida</h3>
                    <p>Bloques que ayudan a ordenar el menú por necesidad, no solo por receta aislada.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Burger premium</div>
                    <span class="future-dish-card__tag">Signature</span>
                    <h3>Platos con mayor valor percibido</h3>
                    <p>La capa más aspiracional de la oferta, útil para marca, ticket y diferenciación.</p>
                </article>
            </div>

            <div class="future-benefit-strip">
                <div class="future-benefit-pill glass-card">
                    <strong>100+</strong>
                    <span>Combinaciones y recetas como aspiración de catálogo completo</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>15 min</strong>
                    <span>Opciones pensadas para resolver muy rápido cuando hace falta</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>1 clic más cerca</strong>
                    <span>De pasar de descubrir a repetir sin fricción</span>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="planes">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Planes y formatos</p>
                <h2 class="section__heading">Eligiendo bien el plan, Ogape se adapta mejor a tu realidad.</h2>
                <p class="section__sub">Esta sección tiene que hacer el trabajo comercial fuerte: dejar claro qué le conviene a cada tipo de cliente y por qué vale la pena entrar.</p>
            </div>

            <div class="future-plan-grid">
                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Empezar</span>
                    <h3>Plan Básico</h3>
                    <p>La mejor puerta de entrada para probar la experiencia Ogape sin complicarte ni sobrecomprar.</p>
                    <div class="future-plan-card__meta">1–2 personas · simple</div>
                    <ul>
                        <li>Menú más acotado y claro</li>
                        <li>Ideal para probar la propuesta</li>
                        <li>Buena relación entre conveniencia y costo</li>
                    </ul>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="future-plan-card__link">Empezar con Ogape</a>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Más valor</span>
                    <h3>Plan Hogar</h3>
                    <p>La propuesta central para quienes quieren convertir la experiencia en una rutina semanal estable.</p>
                    <div class="future-plan-card__meta">2–4 personas · semanal</div>
                    <ul>
                        <li>Más variedad en platos y kits</li>
                        <li>Base perfecta para recurrencia</li>
                        <li>Cuenta, preferencias y continuidad</li>
                    </ul>
                    <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="future-plan-card__link">Preparar mi cuenta</a>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Especial</span>
                    <h3>Plan Signature</h3>
                    <p>Para propuestas premium, regalos, momentos especiales y una experiencia más cuidada de punta a punta.</p>
                    <div class="future-plan-card__meta">premium · gifting</div>
                    <ul>
                        <li>Mayor peso visual y de marca</li>
                        <li>Ideal para lanzamientos o regalo</li>
                        <li>Más espacio para valor percibido</li>
                    </ul>
                    <a href="#gift-cards" class="future-plan-card__link">Ver opción regalo</a>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="por-que-ogape">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Por qué elegir Ogape</p>
                    <h2 class="section__heading">No es solo comida: es una mejor manera de resolver tu semana.</h2>
                    <p class="section__sub editorial-page-card__lead">Lo que esta página tiene que vender no es solo un plato. Tiene que vender alivio, orden, variedad y una experiencia que se sienta más pensada.</p>
                    <ul class="editorial-checklist">
                        <li>Menos decisiones repetitivas cada semana</li>
                        <li>Más claridad para elegir y volver a pedir</li>
                        <li>Una marca paraguaya con ambición de producto premium</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Más sabor · menos fricción<br>más control semanal</span>
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
                    <h2 class="section__heading">Regalar Ogape también tiene que sentirse bien armado.</h2>
                    <p class="section__sub editorial-page-card__lead">Este bloque suma otra razón comercial para entrar al sitio: no solo comprar para uno mismo, sino regalar una experiencia de conveniencia y buena comida.</p>
                    <ul class="editorial-checklist">
                        <li>Tarjetas regalo conectadas a cuenta y saldo</li>
                        <li>Formato útil para campañas y ocasiones especiales</li>
                        <li>Una entrada premium al ecosistema Ogape</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Gift card</span>
                            <strong>Regalá Ogape</strong>
                            <p>Una manera elegante de regalar comida, conveniencia y una experiencia mejor pensada.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Canje</span>
                            <strong>Simple y claro</strong>
                            <p>Todo integrado para que regalar no se sienta como un parche, sino como parte real del producto.</p>
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
                    <p class="section__label">CTA final</p>
                    <h2 class="section__heading">Explorá el menú, prepará tu cuenta y empezá a construir una semana mejor con Ogape.</h2>
                    <p class="section__sub editorial-page-card__lead">La página tiene que cerrar como una homepage real: con una llamada clara a avanzar y no con una simple maqueta de arquitectura.</p>
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
                    <h2 class="section__heading">Ahora sí con una lógica más parecida a una homepage comercial completa.</h2>
                    <p class="section__sub">Reordenamos la página para priorizar descubrimiento, producto, variedad, planes y conversión en una secuencia mucho más cercana a una landing meal-kit real.</p>
                </div>

                <div class="future-site-footer-grid">
                    <div class="future-site-footer-column">
                        <h3>Descubrir</h3>
                        <ul>
                            <li><a href="#como-funciona">Cómo funciona</a></li>
                            <li><a href="#menus">Menús</a></li>
                            <li><a href="#meal-kits">Kits</a></li>
                            <li><a href="#planes">Planes</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Marca</h3>
                        <ul>
                            <li><a href="#nosotros">Ogape</a></li>
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
