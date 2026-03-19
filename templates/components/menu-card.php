<?php
/**
 * Menu Card partial
 * Usage: get_template_part('templates/components/menu-card', null, $dish);
 * $dish keys: title, title_en, slug, description, description_en, price_pyg,
 *             tags[], is_hero, img_src, img_srcset, img_alt, permalink, show_price
 */

$title      = esc_html( $args['title'] ?? '' );
$desc       = esc_html( $args['description'] ?? '' );
$price      = esc_html( $args['price_pyg'] ?? '' );
$is_hero    = ! empty( $args['is_hero'] );
$tags       = $args['tags'] ?? [];
$img_src    = esc_url( $args['img_src'] ?? '' );
$img_srcset = esc_attr( $args['img_srcset'] ?? '' );
$img_alt    = esc_attr( $args['img_alt'] ?? $title );
$permalink  = esc_url( $args['permalink'] ?? '#' );
$slug       = esc_attr( $args['slug'] ?? sanitize_title( $args['title'] ?? '' ) );
$compact    = ! empty( $args['compact'] );
$kicker     = esc_html( $args['kicker'] ?? '' );
$has_image  = ! empty( $img_src );
$classes    = 'card' . ( $compact ? ' card--compact' : '' ) . ( $has_image ? '' : ' card--no-image' );
?>
<a class="<?php echo esc_attr( $classes ); ?>"
   href="<?php echo $permalink; ?>"
   aria-labelledby="dish-<?php echo $slug; ?>-title">

  <?php if ( ! $compact ) : ?>
    <div class="card__img-wrap">
      <?php if ( $img_src ) : ?>
        <img
          src="<?php echo $img_src; ?>"
          <?php if ( $img_srcset ) : ?>srcset="<?php echo $img_srcset; ?>"<?php endif; ?>
          sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
          alt="<?php echo $img_alt; ?>"
          loading="lazy"
          decoding="async"
          width="800"
          height="600"
        />
      <?php else : ?>
        <div class="card__img-placeholder">
          <span class="card__img-placeholder-note"><?php esc_html_e( 'Imagen próximamente', 'ogape-child' ); ?></span>
          <span class="card__img-placeholder-note"><?php esc_html_e( 'Fotografia editorial en preparacion', 'ogape-child' ); ?></span>
        </div>
      <?php endif; ?>

      <?php if ( $is_hero ) : ?>
        <span class="card__hero-badge card__hero-badge--animate" aria-label="<?php esc_attr_e( 'Plato estrella', 'ogape-child' ); ?>">
          ★ <?php esc_html_e( 'Plato Estrella', 'ogape-child' ); ?>
        </span>
      <?php endif; ?>

      <div class="card__overlay" aria-hidden="true">
        <?php esc_html_e( 'Unirme a la lista →', 'ogape-child' ); ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="card__body">
    <?php if ( $kicker ) : ?>
      <span class="card__kicker"><?php echo $kicker; ?></span>
    <?php endif; ?>
    <h3 class="card__title" id="dish-<?php echo $slug; ?>-title">
      <?php echo $title; ?>
    </h3>
    <?php if ( $desc ) : ?>
      <p class="card__desc"><?php echo $desc; ?></p>
    <?php endif; ?>
    <?php if ( ! empty( $tags ) ) : ?>
      <?php get_template_part( 'templates/components/tag-row', null, array( 'tags' => $tags ) ); ?>
    <?php endif; ?>
    <?php if ( ! empty( $args['show_price'] ) && ! empty( $price ) ) : ?>
      <p class="card__price">₲ <?php echo number_format( (int) $price, 0, ',', '.' ); ?></p>
    <?php endif; ?>
  </div>

</a>
