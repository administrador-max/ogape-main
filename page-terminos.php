<?php
/**
 * Template Name: Términos y Condiciones
 *
 * Terms & Conditions page template for the Ogape child theme.
 * Prose container uses the_content() so Alex can paste the real legal text via WP editor.
 * Track A — Page Templates (TASK-50)
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <!-- ── HERO ─────────────────────────────────────────────── -->
    <section class="legal-hero" id="terminos-hero">
        <div class="container">
            <div class="legal-hero__content">
                <span class="nosotros-eyebrow">Documento legal</span>
                <h1 class="legal-hero__title">Términos y Condiciones</h1>
                <p class="legal-hero__meta">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            Última actualización: <time datetime="<?php echo esc_attr( get_the_modified_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'd/m/Y' ) ); ?></time>
                            <?php
                        endwhile;
                        rewind_posts();
                    endif;
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- ── CONTENIDO LEGAL ───────────────────────────────────── -->
    <section class="legal-content" id="terminos-content">
        <div class="container">
            <div class="legal-prose glass-card">
                <div class="legal-prose__body">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                    else :
                        ?>
                        <p>El contenido de los Términos y Condiciones será publicado próximamente.</p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ── VOLVER AL INICIO ──────────────────────────────────── -->
    <section class="legal-back-section">
        <div class="container">
            <div class="legal-back">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--ghost btn--md legal-back__link">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
