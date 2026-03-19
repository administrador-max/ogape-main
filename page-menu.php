<?php
/**
 * Template Name: Menú Ogape
 * Template Post Type: page
 *
 * Page template for the pilot menu listing.
 * Reads dish data from docs/content/menu.json.
 */

get_header();

$hero_menu_image_rel   = '/assets/img/menu/surubi-al-maracuya-lg.jpg';
$feature_menu_image_rel = '/assets/img/menu/bife-koygua-negro-lg.jpg';
$hero_menu_image_uri   = file_exists( get_stylesheet_directory() . $hero_menu_image_rel ) ? get_stylesheet_directory_uri() . $hero_menu_image_rel : '';
$feature_menu_image_uri = file_exists( get_stylesheet_directory() . $feature_menu_image_rel ) ? get_stylesheet_directory_uri() . $feature_menu_image_rel : '';
$como_funciona_page    = get_page_by_path( 'como-funciona' );
$waitlist_page         = get_page_by_path( 'waitlist' );
$como_funciona_url     = $como_funciona_page ? get_permalink( $como_funciona_page ) : home_url( '/#features' );
$waitlist_url          = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/#waitlist' );
?>

<main id="primary" class="site-main site-main--menu">
  <h1 class="menu-page-title">Menú de Ogape</h1>

  <section class="section section--menu-hero">
    <div class="container">
      <?php
      get_template_part(
          'templates/components/hero-editorial',
          null,
          array(
              'eyebrow'   => __( 'Plato estrella de Ogape', 'ogape-child' ),
              'title'     => __( 'Surubí al Maracuyá', 'ogape-child' ),
              'cta_label' => __( 'Únete a la lista de espera', 'ogape-child' ),
              'cta_url'   => $waitlist_url,
              'img_src'   => $hero_menu_image_uri,
              'img_alt'   => __( 'Filete de surubí del río Paraná en mantequilla de maracuyá', 'ogape-child' ),
          )
      );
      ?>
    </div>
  </section>

  <section class="section section--menu-feature">
    <div class="container">
      <?php
      get_template_part(
          'templates/components/feature-split',
          null,
          array(
              'eyebrow'   => __( 'Del río Paraná a tu mesa', 'ogape-child' ),
              'title'     => __( 'Sabor local. Calidad de restaurante. Sin salir de casa.', 'ogape-child' ),
              'body'      => __(
                  'Ogape reúne sabores locales y platos viajeros en una selección breve, cuidada y lista para disfrutar en Asunción.',
                  'ogape-child'
              ),
              'cta_label' => __( 'Cómo funciona', 'ogape-child' ),
              'cta_url'   => $como_funciona_url,
              'img_src'   => $feature_menu_image_uri,
              'img_alt'   => __( 'Costilla de res braseada con reducción de cerveza negra', 'ogape-child' ),
              'reverse'   => false,
          )
      );
      ?>
    </div>
  </section>

  <section class="section section--menu-list" id="menu">
    <div class="container">
      <span class="section__label"><?php esc_html_e( 'Menú Piloto — Temporada 2026', 'ogape-child' ); ?></span>
      <h2 class="section__heading"><?php esc_html_e( 'Nuestros platos', 'ogape-child' ); ?></h2>
      <p class="section__sub">
        <?php
        esc_html_e(
            'Un menú pequeño, cuidado y sin compromisos. Cada plato está diseñado para viajeros con criterio y locales que saben lo que vale la pena.',
            'ogape-child'
        );
        ?>
      </p>
      <?php get_template_part( 'templates/components/menu-grid' ); ?>
    </div>
  </section>

  <section class="section section--menu-waitlist" id="waitlist">
    <div class="container menu-waitlist__container">
      <span class="section__label"><?php esc_html_e( 'Piloto en Asunción — 2026', 'ogape-child' ); ?></span>
      <?php get_template_part( 'templates/components/waitlist-form' ); ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
