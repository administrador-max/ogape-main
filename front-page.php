<?php
/**
 * Ogape Homepage Template
 * Assembled from component partials in templates/components/
 *
 * Section order (per Standard-Page-Structure.docx):
 * 1. Hero
 * 2. Features
 * 3. Waitlist CTA
 *
 * Full section list to be added as components are built:
 * hero > how-it-works > features > products > testimonials > pricing > waitlist
 */
get_header(); ?>

<main id="main" class="site-main" role="main">

    <?php get_template_part( 'templates/components/hero' ); ?>
    <?php get_template_part( 'templates/components/features' ); ?>
    <?php get_template_part( 'templates/components/waitlist-form' ); ?>

</main>

<?php get_footer(); ?>
