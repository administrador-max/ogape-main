<?php
/**
 * Template Name: Nosotros
 *
 * "Nosotros" / About page template for the Ogape child theme.
 * Track A — Page Templates (TASK-50)
 */

get_header();

$waitlist_page = get_page_by_path( 'waitlist' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );
?>

<main id="main" class="site-main" role="main">

    <!-- ── HERO ─────────────────────────────────────────────── -->
    <section class="nosotros-hero" id="nosotros-hero">
        <div class="container">
            <div class="nosotros-hero__content">
                <span class="nosotros-eyebrow">Sobre nosotros</span>
                <h1 class="nosotros-hero__title">Nosotros</h1>
                <p class="nosotros-hero__tagline">
                    Una propuesta breve, confiable y pensada para el ritmo real de Asunción.
                </p>
            </div>
        </div>
    </section>

    <!-- ── MISIÓN ────────────────────────────────────────────── -->
    <section class="nosotros-mission" id="nosotros-mision">
        <div class="container">
            <div class="nosotros-mission__grid">

                <!-- Texto de misión -->
                <div class="nosotros-mission__text glass-card">
                    <p class="nosotros-section-label">Nuestra misión</p>
                    <h2>Llevar la cocina profesional a cada hogar paraguayo.</h2>
                    <p>
                        Ogape nace con una idea simple: comer bien debería sentirse claro, confiable y posible incluso cuando el día no da margen para improvisar. Empezamos con un piloto breve para probar una experiencia cuidada desde el primer pedido.
                    </p>
                    <p>
                        Nuestra misión es construir una marca gastronómica paraguaya con criterio editorial: menos ruido, mejor selección y una relación más transparente entre producto, zona y disponibilidad.
                    </p>
                </div>

                <!-- Valores de marca -->
                <div class="nosotros-mission__values glass-card">
                    <p class="nosotros-section-label">Nuestros valores</p>
                    <h2>Lo que nos guía.</h2>
                    <ul class="nosotros-values-list">
                        <li class="nosotros-values-item">
                            <span class="nosotros-values-item__dot" aria-hidden="true"></span>
                            <div>
                                <strong>Frescura garantizada</strong>
                                <p>Platos y preparaciones pensados para sostener sabor, consistencia y confianza.</p>
                            </div>
                        </li>
                        <li class="nosotros-values-item">
                            <span class="nosotros-values-item__dot" aria-hidden="true"></span>
                            <div>
                                <strong>Claridad operativa</strong>
                                <p>Zonas limitadas, comunicación directa y una apertura ordenada, sin sobrepromesas.</p>
                            </div>
                        </li>
                        <li class="nosotros-values-item">
                            <span class="nosotros-values-item__dot" aria-hidden="true"></span>
                            <div>
                                <strong>Identidad local</strong>
                                <p>Paraguay es el punto de partida de la propuesta, no un detalle decorativo.</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div><!-- .nosotros-mission__grid -->
        </div>
    </section>

    <!-- ── FUNDADOR ───────────────────────────────────────────── -->
    <section class="nosotros-founder" id="nosotros-equipo">
        <div class="container">
            <div class="nosotros-founder__header">
                <p class="nosotros-section-label">El equipo</p>
                <h2>La persona detrás de Ogape.</h2>
            </div>

            <div class="nosotros-founder__card glass-card">
                <!-- Foto — slot de imagen (reemplazar con foto real) -->
                <div class="nosotros-founder__photo" role="img" aria-label="Foto del fundador — próximamente"></div>

                <!-- Información del fundador -->
                <div class="nosotros-founder__info">
                    <p class="nosotros-section-label">Equipo Ogape</p>
                    <h3 class="nosotros-founder__name">Una marca en construcción, con foco real.</h3>
                    <p class="nosotros-founder__role">Piloto 2026 · Asunción</p>
                    <p class="nosotros-founder__bio">
                        Ogape está siendo desarrollado como una propuesta gastronómica clara y contemporánea para Paraguay. Antes de crecer, preferimos validar la experiencia, aprender del piloto y construir confianza con una comunidad pequeña pero atenta.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ───────────────────────────────────────────────── -->
    <section class="nosotros-cta-section" id="nosotros-cta">
        <div class="container">
            <div class="nosotros-cta glass-card">
                <div class="nosotros-cta__content">
                    <p class="nosotros-section-label">Lista de espera</p>
                    <h2>Sé el primero en cocinar con Ogape.</h2>
                    <p>Anotate a la lista de espera y te avisamos cuando lleguemos a tu zona.</p>
                </div>
                <div class="nosotros-cta__actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary btn--lg">
                        Unirme a la lista de espera
                    </a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--secondary btn--lg">
                        Ver el inicio
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
