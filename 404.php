<?php
/**
 * 404 Error Page Template
 *
 * Upgraded dark-premium branded 404 with two CTAs.
 * Track A — Page Templates (TASK-50)
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <section class="error-404-section" id="error-404">
        <div class="container">
            <div class="error-404__inner">

                <span class="error-404__number" aria-hidden="true">404</span>

                <h1 class="error-404__title">Página no encontrada</h1>

                <p class="error-404__text">
                    Parece que esta página no existe. Volvamos al inicio.
                </p>

                <div class="error-404__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg">
                        Volver al inicio
                    </a>
                    <a href="#menu" class="btn btn--secondary btn--lg">
                        Ver el menú
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
