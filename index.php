<?php
/**
 * Ogape Child Theme — Fallback Index Template
 * WordPress requires this file. Primary templates are in templates/.
 * This file handles posts/archives that don't have a specific template.
 */
get_header(); ?>

<main id="main" class="site-main container" style="padding: var(--space-16) 0; min-height: 60vh;">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 style="color: var(--color-text-primary); font-family: var(--font-display);">
                    <?php the_title(); ?>
                </h1>
                <div class="entry-content" style="color: var(--color-text-secondary);">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p style="color: var(--color-text-secondary);">No se encontró contenido.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
