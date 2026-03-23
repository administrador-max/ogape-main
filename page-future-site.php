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

    <?php
    /**
     * Section 1: Hero
     * Full-width hero with primary CTA
     */
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Ogape', 'ogape-child' ),
            'title'    => __( 'Comida real, hecha con cuidado, entregada sin fricción.', 'ogape-child' ),
            'subtitle' => __( 'Conectamos quienes cocinan bien con quienes necesitan comer bien. Primero en Asunción. Después, donde nos necesiten.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section editorial-page-section--narrow" id="nosotros">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--centered">
                <div class="editorial-page-card__copy">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">
                        Unirme a la lista de espera
                    </a>
                    <p class="section__sub" style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-secondary);">
                        Lanzamiento piloto con cupos limitados.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php
    /**
     * Section 2: Features
     * Three-column feature highlights
     */
    ?>
    <section class="editorial-page-section" id="meal-kits">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Meal kits Ogape</p>
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

    <?php
    /**
     * Section 3: How It Works
     * Step-by-step process
     */
    ?>
    <section class="editorial-page-section editorial-page-section--alt" id="menus">
        <div class="container">
            <div class="section-header">
                <p class="section__label">Cómo funciona</p>
                <h2 class="section__heading">Tres pasos. Nada más.</h2>
            </div>

            <div class="steps-grid">
                
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
                    <p class="section__label">Gift Cards + catálogo</p>
                    <h2 class="section__heading">Una base para menús, regalos y compra futura.</h2>
                    <p class="section__sub editorial-page-card__lead">
                        Este bloque ya funciona como adelanto del sitio oficial: catálogo navegable, rutas de compra y un punto claro para gift cards cuando activemos la capa transaccional.
                    </p>
                    <ul class="editorial-checklist">
                        <li>Menús semanales y categorías visibles</li>
                        <li>Meal kits con estructura más comercial</li>
                        <li>Gift cards y cuenta conectados al mismo sistema</li>
                    </ul>
                    <div class="editorial-page-card__actions" style="margin-top: 1.5rem;">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary btn--md">Ver menú actual</a>
                    </div>
                </div>
                <div class="editorial-page-card__visual">
                    <!-- Placeholder for menu preview image -->
                    <div class="placeholder-visual" style="background: var(--surface-secondary); border-radius: 12px; height: 100%; min-height: 300px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); text-align: center; padding: 1.5rem;">
                        <span>Vista previa del sitio oficial<br>Catálogo · Gift Cards · Cuenta</span>
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