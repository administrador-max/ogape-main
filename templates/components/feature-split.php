<?php
/**
 * Feature Split partial — full-width image + text section
 * $args: eyebrow, title, body, cta_label, cta_url,
 *        img_src, img_alt, reverse (bool)
 */

$eyebrow   = esc_html( $args['eyebrow'] ?? '' );
$title     = esc_html( $args['title'] ?? '' );
$body      = wp_kses_post( $args['body'] ?? '' );
$cta_label = esc_html( $args['cta_label'] ?? '' );
$cta_url   = esc_url( $args['cta_url'] ?? '#' );
$img_src   = esc_url( $args['img_src'] ?? '' );
$img_alt   = esc_attr( $args['img_alt'] ?? '' );
$reverse   = ! empty( $args['reverse'] );
$classes   = 'feature-split' . ( $reverse ? ' feature-split--reverse' : '' ) . ( $img_src ? '' : ' feature-split--text-only' );
?>
<div class="<?php echo esc_attr( $classes ); ?>">

  <div class="feature-split__media">
    <?php if ( $img_src ) : ?>
      <img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>"
           loading="lazy" decoding="async" />
    <?php endif; ?>
  </div>

  <div class="feature-split__content">
    <?php if ( $eyebrow ) : ?>
      <span class="section__label"><?php echo $eyebrow; ?></span>
    <?php endif; ?>
    <h2 class="section__heading"><?php echo $title; ?></h2>
    <?php if ( $body ) : ?>
      <p class="section__sub" style="margin-bottom:0;"><?php echo $body; ?></p>
    <?php endif; ?>
    <?php if ( $cta_label ) : ?>
      <a class="hero-editorial__cta" href="<?php echo $cta_url; ?>"
         style="align-self:flex-start;">
        <?php echo $cta_label; ?>
      </a>
    <?php endif; ?>
  </div>

</div>
