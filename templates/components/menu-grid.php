<?php
/**
 * Menu Grid partial — loops pilot menu JSON and renders menu cards.
 * Usage: get_template_part('templates/components/menu-grid');
 * Primary runtime source: child theme assets/data/menu.json
 */

$json_candidates = array(
    'theme-primary' => get_stylesheet_directory() . '/assets/data/menu.json',
    'repo-docs'     => ABSPATH . 'docs/content/menu.json',
    'wp-content-docs' => WP_CONTENT_DIR . '/../docs/content/menu.json',
);
$json_path      = '';
$json_source    = 'none';
$json_issue     = 'missing';
$decoded        = null;
$sections       = array();
$fallback_dishes = array(
    array(
        'title'       => 'Surubí al Maracuyá',
        'slug'        => 'surubi-al-maracuya',
        'description' => 'Filete de surubí del río Paraná con mantequilla cítrica de maracuyá, mandioca dorada y vegetales tiernos.',
        'price_pyg'   => 89000,
        'show_price'  => false,
        'is_hero'     => true,
        'tags'        => array(
            array( 'label' => 'Plato Estrella', 'type' => 'hero' ),
            array( 'label' => 'Local', 'type' => 'local' ),
        ),
        'img_src'     => '',
        'img_srcset'  => '',
        'img_alt'     => 'Surubí al Maracuyá servido con mandioca dorada',
    ),
    array(
        'title'       => 'Bife Koygua Negro',
        'slug'        => 'bife-koygua-negro',
        'description' => 'Costilla de res braseada con reducción de cerveza negra, cebolla asada y puré rústico.',
        'price_pyg'   => 94000,
        'show_price'  => false,
        'tags'        => array(
            array( 'label' => 'Favorito', 'type' => 'nomad' ),
        ),
        'img_src'     => '',
        'img_srcset'  => '',
        'img_alt'     => 'Bife Koygua Negro con reducción de cerveza',
    ),
    array(
        'title'       => 'Bowl Proteico Ogape',
        'slug'        => 'bowl-proteico-ogape',
        'description' => 'Pollo grillado, arroz jazmín, hummus suave, verduras encurtidas y crocante de semillas.',
        'price_pyg'   => 72000,
        'show_price'  => false,
        'tags'        => array(
            array( 'label' => 'Favorito', 'type' => 'nomad' ),
        ),
        'img_src'     => '',
        'img_srcset'  => '',
        'img_alt'     => 'Bowl Proteico Ogape con pollo y arroz jazmín',
    ),
    array(
        'title'       => 'Pollo al Curry Suave',
        'slug'        => 'pollo-al-curry-suave',
        'description' => 'Pollo en curry suave de coco con arroz perfumado y hierbas frescas.',
        'price_pyg'   => 76000,
        'show_price'  => false,
        'tags'        => array(
            array( 'label' => 'Internacional', 'type' => 'intl' ),
        ),
        'img_src'     => '',
        'img_srcset'  => '',
        'img_alt'     => 'Pollo al curry suave con arroz perfumado',
    ),
    array(
        'title'       => 'Milanesa Signature',
        'slug'        => 'milanesa-signature',
        'description' => 'Milanesa crocante de corte premium con papas rústicas, limón y alioli casero.',
        'price_pyg'   => 81000,
        'show_price'  => false,
        'tags'        => array(
            array( 'label' => 'Favorito', 'type' => 'nomad' ),
        ),
        'img_src'     => '',
        'img_srcset'  => '',
        'img_alt'     => 'Milanesa Signature con papas rústicas',
    ),
);
$image_extensions = array( 'webp', 'jpg', 'jpeg', 'png' );

$resolve_menu_image = static function ( $dish ) use ( $image_extensions ) {
    $slug = sanitize_title( $dish['slug'] ?? $dish['title'] ?? '' );

    if ( ! empty( $dish['img_src'] ) || empty( $slug ) ) {
        return $dish;
    }

    $base_dir = trailingslashit( get_stylesheet_directory() ) . 'assets/img/menu/';
    $base_uri = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/menu/';
    $srcset   = array();

    foreach ( $image_extensions as $extension ) {
        foreach ( array( 'sm' => '400w', 'md' => '800w', 'lg' => '1600w' ) as $size => $descriptor ) {
            $filename = $slug . '-' . $size . '.' . $extension;
            $filepath = $base_dir . $filename;

            if ( ! file_exists( $filepath ) ) {
                continue;
            }

            if ( 'lg' === $size && empty( $dish['img_src'] ) ) {
                $dish['img_src'] = $base_uri . $filename;
            }

            $srcset[] = $base_uri . $filename . ' ' . $descriptor;
        }
    }

    if ( empty( $dish['img_src'] ) && ! empty( $srcset ) ) {
        $dish['img_src'] = preg_replace( '/\s+\d+w$/', '', $srcset[ count( $srcset ) - 1 ] );
    }

    if ( ! empty( $srcset ) ) {
        $dish['img_srcset'] = implode( ', ', $srcset );
    }

    return $dish;
};

foreach ( $json_candidates as $source => $candidate_path ) {
    if ( ! file_exists( $candidate_path ) ) {
        $json_path  = $candidate_path;
        $json_issue = 'missing';
        continue;
    }

    $json_path = $candidate_path;
    $raw       = file_get_contents( $candidate_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
    $decoded   = json_decode( $raw, true );

    if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $decoded ) ) {
        $json_issue = 'invalid';
        continue;
    }

    if ( ! array_key_exists( 'mains', $decoded ) && ! array_key_exists( 'sides', $decoded ) ) {
        $json_issue = 'menu-sections-missing';
        continue;
    }

    $sections = array(
        'mains' => is_array( $decoded['mains'] ?? null ) ? $decoded['mains'] : array(),
        'sides' => is_array( $decoded['sides'] ?? null ) ? $decoded['sides'] : array(),
    );
    if ( empty( $sections['mains'] ) && empty( $sections['sides'] ) ) {
        $json_issue = 'menu-empty';
        continue;
    }

    $json_source = $source;
    $json_issue  = 'ok';
    break;
}

if ( empty( $sections['mains'] ) && empty( $sections['sides'] ) ) {
    $sections['mains'] = $fallback_dishes;
    $json_source = 'inline-fallback';
    if ( 'ok' === $json_issue ) {
        $json_issue = 'fallback-used';
    }
}

if ( empty( $sections['mains'] ) && empty( $sections['sides'] ) ) : ?>
  <!-- menu-grid issue: <?php echo esc_html( $json_issue ); ?> | path: <?php echo esc_html( $json_path ); ?> -->
  <p class="section__sub" style="text-align:center;">
    <?php esc_html_e( 'Menú próximamente. Únete a la lista de espera abajo.', 'ogape-child' ); ?>
  </p>
<?php
    return;
endif;
?>
<?php
$main_count          = count( $sections['mains'] );
$side_count          = count( $sections['sides'] );
$has_hidden_prices   = false;
$has_missing_images  = false;

foreach ( $sections as $section_key => $section_dishes ) {
    foreach ( $section_dishes as $index => $dish ) {
        $dish               = $resolve_menu_image( $dish );
        $dish['show_price'] = ! empty( $dish['show_price'] );
        $dish['permalink']  = '#waitlist';

        if ( 'mains' === $section_key && empty( $dish['img_src'] ) ) {
            $has_missing_images = true;
        }

        if ( empty( $dish['show_price'] ) && ! empty( $dish['price_pyg'] ) ) {
            $has_hidden_prices = true;
        }

        $sections[ $section_key ][ $index ] = $dish;
    }
}
?>
<div class="menu-layout">
  <aside class="menu-status" aria-label="<?php esc_attr_e( 'Estado del menú piloto', 'ogape-child' ); ?>">
    <p class="menu-status__eyebrow"><?php esc_html_e( 'Estado del menú piloto', 'ogape-child' ); ?></p>
    <h3 class="menu-status__title"><?php esc_html_e( 'La carta ya está definida; la presentación editorial todavía está cerrándose.', 'ogape-child' ); ?></h3>
    <p class="menu-status__body">
      <?php
      esc_html_e(
          'Mostramos los platos y acompañamientos confirmados para el piloto. Las fotos finales y los precios públicos se publicarán cuando el lanzamiento quede cerrado.',
          'ogape-child'
      );
      ?>
    </p>
    <div class="menu-status__meta" role="list">
      <span class="menu-status__pill" role="listitem"><?php echo esc_html( sprintf( _n( '%d plato principal', '%d platos principales', $main_count, 'ogape-child' ), $main_count ) ); ?></span>
      <?php if ( $side_count > 0 ) : ?>
        <span class="menu-status__pill" role="listitem"><?php echo esc_html( sprintf( _n( '%d acompañamiento', '%d acompañamientos', $side_count, 'ogape-child' ), $side_count ) ); ?></span>
      <?php endif; ?>
      <?php if ( $has_missing_images ) : ?>
        <span class="menu-status__pill" role="listitem"><?php esc_html_e( 'Fotografía pendiente', 'ogape-child' ); ?></span>
      <?php endif; ?>
      <?php if ( $has_hidden_prices ) : ?>
        <span class="menu-status__pill" role="listitem"><?php esc_html_e( 'Precios aún no publicados', 'ogape-child' ); ?></span>
      <?php endif; ?>
    </div>
    <p class="menu-status__footnote">
      <?php esc_html_e( 'La carta piloto ya está confirmada. La fotografía editorial y los precios públicos aparecerán cuando quede cerrado el lanzamiento.', 'ogape-child' ); ?>
    </p>
  </aside>

  <?php if ( ! empty( $sections['mains'] ) ) : ?>
    <section class="menu-section" aria-labelledby="menu-mains-title">
      <div class="menu-section__head">
        <span class="menu-section__eyebrow"><?php esc_html_e( 'Principales', 'ogape-child' ); ?></span>
        <h3 class="menu-section__title" id="menu-mains-title"><?php esc_html_e( 'Platos del piloto', 'ogape-child' ); ?></h3>
        <p class="menu-section__sub">
          <?php
          esc_html_e(
              'Estos son los platos que ya forman parte de la oferta base. Aunque todavía falten fotos editoriales, la selección y su orden de prioridad ya están definidos.',
              'ogape-child'
          );
          ?>
        </p>
      </div>

      <div class="card-grid" role="list">
        <?php foreach ( $sections['mains'] as $dish ) : ?>
          <div role="listitem">
            <?php get_template_part( 'templates/components/menu-card', null, $dish ); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( ! empty( $sections['sides'] ) ) : ?>
    <section class="menu-section" aria-labelledby="menu-sides-title">
      <div class="menu-section__head">
        <span class="menu-section__eyebrow"><?php esc_html_e( 'Acompañamientos', 'ogape-child' ); ?></span>
        <h3 class="menu-section__title" id="menu-sides-title"><?php esc_html_e( 'Complementos confirmados', 'ogape-child' ); ?></h3>
        <p class="menu-section__sub">
          <?php
          esc_html_e(
              'Los acompañamientos ya existen en la data del menú, pero antes no se estaban mostrando. Ahora quedan visibles como parte real de la carta y no como contenido pendiente.',
              'ogape-child'
          );
          ?>
        </p>
      </div>

      <div class="card-grid card-grid--compact" role="list">
        <?php foreach ( $sections['sides'] as $dish ) : ?>
          <?php $dish['compact'] = true; ?>
          <?php $dish['kicker'] = __( 'Acompañamiento', 'ogape-child' ); ?>
          <div role="listitem">
            <?php get_template_part( 'templates/components/menu-card', null, $dish ); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>
</div>
