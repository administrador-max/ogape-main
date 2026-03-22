<?php
/**
 * Hero Editorial partial
 * Usage: get_template_part('templates/components/hero-editorial', null, $args);
 * $args: eyebrow, title, cta_label, cta_url, img_src, img_alt
 */

$eyebrow   = esc_html( $args['eyebrow'] ?? '' );
$title     = esc_html( $args['title'] ?? '' );
$cta_label = esc_html( $args['cta_label'] ?? __( 'Ver menú', 'ogape-child' ) );
$cta_url   = esc_url( $args['cta_url'] ?? '#menu' );
$img_src   = esc_url( $args['img_src'] ?? '' );
$img_alt   = esc_attr( $args['img_alt'] ?? $title );
$classes   = 'hero-editorial' . ( $img_src ? '' : ' hero-editorial--text-only glass-card' );
?>
<div class="<?php echo esc_attr( $classes ); ?>">
  <?php if ( $img_src ) : ?>
    <img
      class="hero-editorial__img"
      src="<?php echo $img_src; ?>"
      alt="<?php echo $img_alt; ?>"
      loading="eager"
      decoding="async"
      fetchpriority="high"
    />
  <?php endif; ?>

  <div class="hero-editorial__content">
    <?php if ( $eyebrow ) : ?>
      <span class="hero-editorial__eyebrow"><?php echo $eyebrow; ?></span>
    <?php endif; ?>
    <h2 class="hero-editorial__title"><?php echo $title; ?></h2>
    <a class="hero-editorial__cta" href="<?php echo $cta_url; ?>">
      <?php echo $cta_label; ?>
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </div>
</div>
