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
                    <ul>
                        <li>Acceso temprano a lanzamientos</li>
                        <li>Selección semanal recomendada</li>
                        <li>Ideal para 1–2 personas</li>
                    </ul>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Prioridad</span>
                    <h3>Plan Hogar</h3>
                    <p>La opción central para familias o rutinas estables: mejor organización, más previsibilidad y relación continua con Ogape.</p>
                    <ul>
                        <li>Frecuencia semanal sugerida</li>
                        <li>Preferencias y direcciones guardadas</li>
                        <li>Base para suscripción futura</li>
                    </ul>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Regalo / especial</span>
                    <h3>Plan Regalo</h3>
                    <p>Entrada pensada para obsequios, ocasiones especiales y compra con intención más premium.</p>
                    <ul>
                        <li>Tarjetas regalo conectadas al catálogo</li>
                        <li>Experiencia lista para regalar</li>
                        <li>Puente entre marca y compra</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--alt" id="meal-kits">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Kits Ogape</p>
                <h2 class="section__heading">La estructura comercial empieza a tomar forma.</h2>
            </div>
            <div class="features-grid">
                
                <div class="feature-item">
                    <div class="feature-item__icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 14V24L30 30" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="feature-item__title">Sin esperas</h3>
                    <p class="feature-item__text">Pedís con anticipación. Nosotros coordinamos la entrega puntual.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-item__icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 4L6 14V34L24 44L42 34V14L24 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M24 24L24 44" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 24L42 14" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 24L6 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="feature-item__title">Hecho local</h3>
                    <p class="feature-item__text">Cocineros de tu zona, ingredientes de tu zona, economía local.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-item__icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="8" y="8" width="32" height="32" rx="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 24L22 30L32 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="feature-item__title">Sin sorpresas</h3>
                    <p class="feature-item__text">Precio final antes de confirmar. Sin cargos ocultos, sin apps intermedias.</p>
                </div>

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
                <article class="future-menu-card glass-card">
                    <span class="future-menu-card__kicker">Semanal</span>
                    <h3>Menú curado</h3>
                    <p>Selección breve de platos destacados con prioridad editorial y mejor experiencia de descubrimiento.</p>
                </article>
                <article class="future-menu-card glass-card">
                    <span class="future-menu-card__kicker">Categorías</span>
                    <h3>Navegación útil</h3>
                    <p>Almuerzos, cenas, kits y opciones especiales organizadas de forma simple para decidir sin fricción.</p>
                </article>
                <article class="future-menu-card glass-card">
                    <span class="future-menu-card__kicker">Confianza</span>
                    <h3>Información clara</h3>
                    <p>Fotos reales, disponibilidad visible, notas de preparación y contexto suficiente antes de comprar.</p>
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
                    <!-- Placeholder for menu preview image -->
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 300px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Vista previa del sitio oficial<br>Catálogo · Tarjetas regalo · Cuenta</span>
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

    <?php
    /**
     * Section 5: Waitlist CTA
     * Reuse the waitlist form component
     */
    get_template_part( 'templates/components/waitlist-form' );
    ?>

</main>

<?php get_footer(); ?>