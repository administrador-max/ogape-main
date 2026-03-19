<?php
/**
 * Editorial Page Hero
 *
 * Usage: get_template_part( 'templates/components/editorial-page-hero', null, $args );
 * $args keys: eyebrow, title, subtitle
 */

$eyebrow  = esc_html( $args['eyebrow'] ?? '' );
$title    = esc_html( $args['title'] ?? '' );
$subtitle = esc_html( $args['subtitle'] ?? '' );
?>
<section class="editorial-page-hero">
    <div class="container">
        <div class="editorial-page-hero__content">
            <?php if ( $eyebrow ) : ?>
                <p class="editorial-page-hero__eyebrow"><?php echo $eyebrow; ?></p>
            <?php endif; ?>
            <?php if ( $title ) : ?>
                <h1 class="editorial-page-hero__title"><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $subtitle ) : ?>
                <p class="editorial-page-hero__subtitle"><?php echo $subtitle; ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
