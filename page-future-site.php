<?php
/**
 * Template Name: FutureSite
 * Template Post Type: page
 * 
 * Full-site landing page for ogape.com.py/future-site
 * Built incrementally from waitlist foundation
 */

get_header();

$waitlist_url = home_url( '/waitlist/' );
$menu_url     = home_url( '/menu/' );
?>

<main id="main" class="site-main" role="main">

    <div id="planes" aria-hidden="true"></div>

    <section class="future-site-hero" id="nosotros">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow">Sitio oficial Ogape</p>
                    <h1 class="future-site-hero__title">Comida real, hecha con cuidado, para una experiencia que se siente premium desde el primer clic.</h1>
                    <p class="future-site-hero__subtitle">Esta vista previa reúne la dirección oficial del sitio: navegación completa, sistema de cuenta, menús, kits, tarjetas regalo, sostenibilidad y alianzas. El lanzamiento visible al público sigue enfocado en la lista de espera mientras terminamos de conectar todo.</p>

                    <div class="future-site-hero__actions">
                        <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">Unirme a la lista de espera</a>
                        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>?fresh=1" class="btn btn--secondary btn--lg">Ver acceso de cuenta</a>
                    </div>

                    <ul class="future-site-hero__trust">
                        <li>Piloto enfocado en Asunción</li>
                        <li>Arquitectura oficial en construcción visible</li>
                        <li>Marca, producto y cuenta en el mismo sistema</li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <p class="future-site-hero__panel-label">Vista del ecosistema</p>
                    <div class="future-site-stack">
                        <div class="future-site-stack__item future-site-stack__item--primary">
                            <span class="future-site-stack__kicker">Ahora visible</span>
                            <strong>Lista de espera + soporte legal</strong>
                            <p>Homepage, privacidad, términos, FAQ y onboarding inicial.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Siguiente capa</span>
                            <strong>Sitio oficial</strong>
                            <p>Planes, menús, kits, sostenibilidad, alianzas y narrativa de marca.</p>
                        </div>
                        <div class="future-site-stack__item">
                            <span class="future-site-stack__kicker">Cuenta</span>
                            <strong>Login + dashboard</strong>
                            <p>Pedidos, suscripciones, direcciones, preferencias y tarjetas regalo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="planes">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Planes</p>
                <h2 class="section__heading">Tres formas claras de entrar al ecosistema Ogape.</h2>
                <p class="section__sub">Todavía estamos en vista previa, pero esta sección ya ordena cómo debería presentarse la oferta cuando el sitio oficial esté completo.</p>
            </div>

            <div class="future-plan-grid">
                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Descubrimiento</span>
                    <h3>Plan Explorador</h3>
                    <p>Para quien quiere probar Ogape sin fricción: menús curados, acceso temprano y ritmo flexible.</p>
                    <div class="future-plan-card__meta">1–2 personas · flexible</div>
                    <ul>
                        <li>Acceso temprano a lanzamientos</li>
                        <li>Selección semanal recomendada</li>
                        <li>Ideal para primera compra</li>
                    </ul>
                    <a href="#menus" class="future-plan-card__link">Ver estructura del menú</a>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Prioridad</span>
                    <h3>Plan Hogar</h3>
                    <p>La opción central para familias o rutinas estables: mejor organización, más previsibilidad y relación continua con Ogape.</p>
                    <div class="future-plan-card__meta">2–4 personas · semanal</div>
                    <ul>
                        <li>Frecuencia semanal sugerida</li>
                        <li>Preferencias y direcciones guardadas</li>
                        <li>Base para suscripción futura</li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>?fresh=1" class="future-plan-card__link">Ver acceso de cuenta</a>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Regalo / especial</span>
                    <h3>Plan Regalo</h3>
                    <p>Entrada pensada para obsequios, ocasiones especiales y compra con intención más premium.</p>
                    <div class="future-plan-card__meta">ocasiones especiales · marca</div>
                    <ul>
                        <li>Tarjetas regalo conectadas al catálogo</li>
                        <li>Experiencia lista para regalar</li>
                        <li>Puente entre marca y compra</li>
                    </ul>
                    <a href="#gift-cards" class="future-plan-card__link">Ver tarjetas regalo</a>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="meal-kits">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Kits Ogape</p>
                <h2 class="section__heading">Una base más comercial para explorar formatos de compra.</h2>
                <p class="section__sub">Acá el objetivo ya no es solo explicar beneficios, sino mostrar cómo podrían verse los bloques de producto dentro del sitio oficial.</p>
            </div>

            <div class="future-kit-grid">
                <article class="future-kit-card glass-card">
                    <div class="future-kit-card__visual">Kit rápido</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Ritmo diario</span>
                        <h3>Kit Express</h3>
                        <p>Para resolver almuerzo o cena con una experiencia más simple, limpia y predecible.</p>
                        <ul>
                            <li>Preparación más directa</li>
                            <li>Ideal para semana ocupada</li>
                            <li>Plantilla de producto ágil</li>
                        </ul>
                    </div>
                </article>

                <article class="future-kit-card glass-card future-kit-card--featured">
                    <div class="future-kit-card__visual">Kit hogar</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Centro de oferta</span>
                        <h3>Kit Hogar</h3>
                        <p>El formato que puede convertirse en columna vertebral del catálogo: más contexto, más valor percibido y más recurrencia.</p>
                        <ul>
                            <li>Mejor para familias o rutina semanal</li>
                            <li>Plantilla para suscripción futura</li>
                            <li>Conecta con cuenta y preferencias</li>
                        </ul>
                    </div>
                </article>

                <article class="future-kit-card glass-card">
                    <div class="future-kit-card__visual">Kit edición</div>
                    <div class="future-kit-card__body">
                        <span class="future-kit-card__kicker">Especial</span>
                        <h3>Kit Signature</h3>
                        <p>Para especiales, chefs invitados o lanzamientos donde la marca necesita una presentación más premium.</p>
                        <ul>
                            <li>Ideal para storytelling de producto</li>
                            <li>Mayor peso visual en catálogo</li>
                            <li>Útil para campañas o gifting</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="menus">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Menús</p>
                <h2 class="section__heading">Un catálogo pensado para elegir rápido y confiar más.</h2>
                <p class="section__sub">La vista oficial no debería sentirse como un marketplace desordenado, sino como una selección clara y cuidada.</p>
            </div>

            <div class="future-menu-grid">
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">Semanal</span>
                    <div class="future-menu-card__visual">Plato destacado</div>
                    <h3>Menú curado</h3>
                    <p>Selección breve de platos destacados con prioridad editorial y mejor experiencia de descubrimiento.</p>
                </article>
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">Categorías</span>
                    <div class="future-menu-card__visual">Colecciones</div>
                    <h3>Navegación útil</h3>
                    <p>Almuerzos, cenas, kits y opciones especiales organizadas de forma simple para decidir sin fricción.</p>
                </article>
                <article class="future-menu-card glass-card future-menu-card--image">
                    <span class="future-menu-card__kicker">Confianza</span>
                    <div class="future-menu-card__visual">Info clara</div>
                    <h3>Información clara</h3>
                    <p>Fotos reales, disponibilidad visible, notas de preparación y contexto suficiente antes de comprar.</p>
                </article>
            </div>

            <div class="future-benefit-strip">
                <div class="future-benefit-pill glass-card">
                    <strong>100%</strong>
                    <span>Plantilla pensada para contenido propietario Ogape</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>3 capas</strong>
                    <span>Descubrir · elegir · reservar</span>
                </div>
                <div class="future-benefit-pill glass-card">
                    <strong>1 sistema</strong>
                    <span>Marca, catálogo y cuenta conectados</span>
                </div>
            </div>

            <div class="future-dish-row">
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Chef selection</div>
                    <span class="future-dish-card__tag">Destacado</span>
                    <h3>Plato destacado</h3>
                    <p>Espacio para un hero dish o receta insignia con foco editorial.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Favorito</div>
                    <span class="future-dish-card__tag">Popular</span>
                    <h3>Favorito recurrente</h3>
                    <p>Bloque pensado para prueba social, repetición o producto más pedido.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Nueva edición</div>
                    <span class="future-dish-card__tag">Nuevo</span>
                    <h3>Nueva incorporación</h3>
                    <p>Espacio para novedades, temporada o lanzamiento de chef invitado.</p>
                </article>
                <article class="future-dish-card glass-card">
                    <div class="future-dish-card__visual">Colección</div>
                    <span class="future-dish-card__tag">Colección</span>
                    <h3>Serie curada</h3>
                    <p>Útil para agrupar recetas, campañas o categorías comerciales.</p>
                </article>
            </div>

            <div class="steps-grid" style="margin-top: 1.5rem;">
                <div class="step-item">
                    <span class="step-item__number">01</span>
                    <h3 class="step-item__title">Elegís</h3>
                    <p class="step-item__text">Menú semanal de cocineros verificados. Platos reales, no fotos genéricas.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">02</span>
                    <h3 class="step-item__title">Reservás</h3>
                    <p class="step-item__text">Pedís con al menos 24h de anticipación. Nosotros confirmamos cocina y ruta.</p>
                </div>

                <div class="step-item">
                    <span class="step-item__number">03</span>
                    <h3 class="step-item__title">Recibís</h3>
                    <p class="step-item__text">Entrega puntual en tu zona. Comida hecha hace horas, no días.</p>
                </div>
            </div>
        </div>
    </section>

    <?php
    /**
     * Section 4: Menu Preview
     * Teaser for full menu (links to /menu)
     */
    ?>
    <section class="editorial-page-section" id="gift-cards">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Tarjetas regalo + catálogo</p>
                    <h2 class="section__heading">Una base para menús, regalos y compra futura.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        Este bloque ya funciona como adelanto del sitio oficial: catálogo navegable, rutas de compra y un punto claro para tarjetas regalo cuando activemos la capa transaccional.
                    </p>
                    <ul class="editorial-checklist">
                        <li>Menús semanales y categorías visibles</li>
                        <li>Kits con estructura más comercial</li>
                        <li>Tarjetas regalo y cuenta conectadas al mismo sistema</li>
                    </ul>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem;">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--md">Ver menú actual</a>
                    </div>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="future-gift-preview">
                        <div class="future-gift-preview__card future-gift-preview__card--front">
                            <span class="future-gift-preview__eyebrow">Tarjeta regalo</span>
                            <strong>Ogape para regalar</strong>
                            <p>Una plantilla premium para momentos, obsequios y compras con intención.</p>
                        </div>
                        <div class="future-gift-preview__card future-gift-preview__card--back">
                            <span class="future-gift-preview__eyebrow">Cuenta</span>
                            <strong>Canje + saldo + catálogo</strong>
                            <p>Todo queda conectado al mismo sistema visual y operativo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="sostenibilidad">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Sostenibilidad</p>
                    <h2 class="section__heading">Crecer sin perder criterio operativo.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        La versión oficial del sitio necesita explicar por qué Ogape no es solo delivery: sourcing más local, operación más controlada y una experiencia más pensada para Paraguay.
                    </p>
                    <ul class="editorial-checklist">
                        <li>Producción más cuidada y menos improvisada</li>
                        <li>Selección curada en vez de catálogo caótico</li>
                        <li>Base para contenido de marca y confianza</li>
                    </ul>
                </div>
                <div class="editorial-page-card__visual">
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Bloque de narrativa<br>Sourcing · Operación · Confianza</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section" id="alianzas">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--centered">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Alianzas</p>
                    <h2 class="section__heading">Chefs, marcas y aliados estratégicos.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        Este espacio anticipa la ruta de alianzas del sitio oficial: chefs, empresas, proveedores y colaboraciones especiales, todo conectado al mismo sistema de marca y cuenta.
                    </p>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem; justify-content: center;">
                        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn btn--secondary btn--md">Ver acceso de cuenta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-cta-shell">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--centered">
                <div class="editorial-page-card__copy">
                    <p class="section__label">Próximos pasos</p>
                    <h2 class="section__heading">Seguimos construyendo la versión oficial.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        Esta vista queda enfocada en arquitectura, navegación y presentación del futuro sitio oficial. El formulario del piloto permanece en la experiencia principal de waitlist, no acá.
                    </p>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem; justify-content: center;">
                        <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--md">Ir a la waitlist</a>
                        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>?fresh=1" class="btn btn--secondary btn--md">Ver acceso de cuenta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="editorial-page-section future-site-lower-nav">
        <div class="container">
            <div class="future-site-footer-shell glass-card">
                <div class="future-site-footer-shell__intro">
                    <p class="section__label">Mapa del sitio oficial</p>
                    <h2 class="section__heading">Una base clara para navegar Ogape de punta a punta.</h2>
                    <p class="section__sub">Este bloque funciona como footer interno del preview: resume la arquitectura del sitio oficial sin alterar todavía el footer principal de producción.</p>
                </div>

                <div class="future-site-footer-grid">
                    <div class="future-site-footer-column">
                        <h3>Explorar</h3>
                        <ul>
                            <li><a href="#planes">Planes</a></li>
                            <li><a href="#menus">Menús</a></li>
                            <li><a href="#meal-kits">Kits</a></li>
                            <li><a href="#gift-cards">Tarjetas regalo</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Marca</h3>
                        <ul>
                            <li><a href="#nosotros">Nosotros</a></li>
                            <li><a href="#sostenibilidad">Sostenibilidad</a></li>
                            <li><a href="#alianzas">Alianzas</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Cuenta</h3>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/login/' ) ); ?>?fresh=1">Iniciar sesión</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/register/' ) ); ?>?fresh=1">Crear cuenta</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/account/' ) ); ?>?fresh=1">Mi cuenta</a></li>
                        </ul>
                    </div>

                    <div class="future-site-footer-column">
                        <h3>Estado actual</h3>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Homepage actual</a></li>
                            <li><a href="<?php echo esc_url( $waitlist_url ); ?>">Waitlist</a></li>
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