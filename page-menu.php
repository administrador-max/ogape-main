<?php
/**
 * Menu page — Ogape Tu Chef en Casa.
 *
 * Template Name: Menú Ogape
 * Template Post Type: page
 *
 * Self-contained design from the Website-handoff bundle
 * (Claude Design export, 2026-04-17, website/project/menu.html).
 * Theme chrome is hidden via assets/css/menu-page.css so the page
 * renders the standalone design as intended.
 */

get_header();

$home_url     = home_url( '/' );
$waitlist_url = ogape_get_waitlist_url();
$plans_url    = home_url( '/planes/' );
$menu_url     = home_url( '/menu/' );

$arrow_svg = '<svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$time_svg  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/></svg>';
$close_svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg>';

$categories = array(
    array( 'key' => 'all',         'label' => 'Todo' ),
    array( 'key' => 'veggie',      'label' => 'Veggie' ),
    array( 'key' => 'premium',     'label' => 'Premium' ),
    array( 'key' => 'traditional', 'label' => 'Tradicional' ),
    array( 'key' => 'regular',     'label' => 'Regular' ),
);

$cat_icons = array(
    'all'         => '<svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><rect x="2" y="2" width="7" height="7" rx="1.5"/><rect x="11" y="2" width="7" height="7" rx="1.5"/><rect x="2" y="11" width="7" height="7" rx="1.5"/><rect x="11" y="11" width="7" height="7" rx="1.5"/></svg>',
    'veggie'      => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6c2-3 10-5 12-3s0 10-3 12C8 18 2 16 4 6z"/><path d="M10 18V10"/></svg>',
    'premium'     => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2l1.9 5.8H18l-4.9 3.6 1.9 5.8L10 14l-4.9 3.2 1.9-5.8L2 7.8h6.1L10 2z"/></svg>',
    'traditional' => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2c0 0-5 5-5 9a5 5 0 0010 0c0-3-2-5-3-6 0 2-2 3-2 3s0-4 0-6z"/></svg>',
    'regular'     => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M3 10c0 4 3 7 7 7s7-3 7-7H3z"/><path d="M1 10h18"/><path d="M7 6l1-3M13 6l-1-3"/></svg>',
);

$category_labels = array(
    'veggie'      => 'veggie',
    'premium'     => 'premium',
    'traditional' => 'tradicional',
    'regular'     => 'regular',
);

$tag_class_map = array(
    'hero'  => 'tag tag--hero',
    'local' => 'tag tag--local',
    'nomad' => 'tag tag--nomad',
    'intl'  => 'tag tag--intl',
    'veg'   => 'tag tag--veg',
);

$gradient_palette = array(
    'radial-gradient(circle at 35% 40%, #F0B765 0%, transparent 55%), radial-gradient(circle at 70% 65%, #E8A045 0%, transparent 55%), linear-gradient(135deg, #9A5A08, #C88B3A)',
    'radial-gradient(circle at 30% 45%, #C88B3A 0%, transparent 48%), radial-gradient(circle at 70% 60%, #9A5A08 0%, transparent 55%), linear-gradient(135deg, #3B2A14, #6B4A1E 70%, #8B5A1C)',
    'radial-gradient(circle at 30% 35%, #F0B765, transparent 50%), radial-gradient(circle at 72% 70%, #4A7A3A, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
    'radial-gradient(circle at 35% 40%, #FFD783, transparent 55%), radial-gradient(circle at 72% 68%, #E8A045, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
    'radial-gradient(circle at 35% 40%, #C9D97A, transparent 55%), radial-gradient(circle at 70% 65%, #6B8A3A, transparent 55%), linear-gradient(135deg, #3E5A27, #6B8A3A)',
    'radial-gradient(circle at 35% 40%, #F0A8B8, transparent 55%), radial-gradient(circle at 70% 65%, #C86A7A, transparent 55%), linear-gradient(135deg, #9A3E4E, #C86A7A)',
);

$selected_week = isset( $_GET['week'] ) ? max( 1, min( 4, absint( wp_unslash( $_GET['week'] ) ) ) ) : ogape_get_active_week();
$week_records  = ogape_get_pilot_weeks();
$raw_dishes    = ogape_get_week( $selected_week );

if ( empty( $raw_dishes ) ) {
    $raw_dishes = ogape_get_pilot_menu();
}

$find_week_record = static function ( $week_number ) use ( $week_records ) {
    foreach ( $week_records as $week_record ) {
        if ( (int) ( $week_record['number'] ?? 0 ) === (int) $week_number ) {
            return $week_record;
        }
    }

    return null;
};

$format_week_range = static function ( $week_number ) {
    if ( ! defined( 'OGAPE_PILOT_START' ) || empty( OGAPE_PILOT_START ) || '0' === (string) OGAPE_PILOT_START ) {
        return 'Rotación piloto';
    }

    $start_ts = is_numeric( OGAPE_PILOT_START ) ? (int) OGAPE_PILOT_START : strtotime( (string) OGAPE_PILOT_START );
    if ( ! $start_ts ) {
        return 'Rotación piloto';
    }

    $week_start = $start_ts + ( max( 0, (int) $week_number - 1 ) * WEEK_IN_SECONDS );
    $week_end   = $week_start + ( 6 * DAY_IN_SECONDS );

    return wp_date( 'j M', $week_start ) . ' – ' . wp_date( 'j M', $week_end );
};

$normalize_time_label = static function ( $time_label ) {
    $time_label = trim( (string) $time_label );

    if ( '' === $time_label ) {
        return '35 min';
    }

    $time_label = str_replace(
        array( ' minutos', ' minuto', ' Minutos', ' Minuto' ),
        array( ' min', ' min', ' min', ' min' ),
        $time_label
    );

    return $time_label;
};

$gradient_for_slug = static function ( $slug ) use ( $gradient_palette ) {
    $index = (int) sprintf( '%u', crc32( (string) $slug ) ) % count( $gradient_palette );
    return $gradient_palette[ $index ];
};

$hero_slug = '';
foreach ( $raw_dishes as $dish_candidate ) {
    if ( 'premium' === ( $dish_candidate['category'] ?? '' ) ) {
        $hero_slug = $dish_candidate['slug'] ?? '';
        break;
    }
}

if ( '' === $hero_slug ) {
    foreach ( $raw_dishes as $dish_candidate ) {
        if ( empty( $dish_candidate['is_staple'] ) ) {
            $hero_slug = $dish_candidate['slug'] ?? '';
            break;
        }
    }
}

if ( '' === $hero_slug && ! empty( $raw_dishes[0]['slug'] ) ) {
    $hero_slug = $raw_dishes[0]['slug'];
}

if ( $hero_slug ) {
    foreach ( $raw_dishes as $idx => $dish_candidate ) {
        if ( ( $dish_candidate['slug'] ?? '' ) !== $hero_slug ) {
            continue;
        }

        if ( 0 !== $idx ) {
            unset( $raw_dishes[ $idx ] );
            array_unshift( $raw_dishes, $dish_candidate );
        }
        break;
    }
}

$dishes = array_values(
    array_map(
        static function ( $dish ) use ( $selected_week, $category_labels, $gradient_for_slug, $tag_class_map, $hero_slug ) {
            $slug           = $dish['slug'] ?? '';
            $card_image     = ogape_get_menu_image_sources( $dish, 'md' );
            $modal_image    = ogape_get_menu_image_sources( $dish, 'lg' );
            $category_label = $category_labels[ $dish['category'] ?? '' ] ?? ( $dish['category'] ?? 'piloto' );
            $number_label   = ! empty( $dish['is_staple'] )
                ? 'Staple semanal · semanas 1–4'
                : ( ! empty( $dish['weeks'] ) ? 'Semana ' . $selected_week . ' · ' . $category_label : 'Pool piloto · sin semana' );
            $stats          = array(
                array(
                    'label' => 'Porciones',
                    'value' => ! empty( $dish['portions_display'] ) ? $dish['portions_display'] : '2 · 4',
                ),
                array(
                    'label' => 'Calorías',
                    'value' => ! empty( $dish['calories_display'] ) ? $dish['calories_display'] : 'Sin dato',
                ),
                array(
                    'label' => 'Contiene',
                    'value' => ! empty( $dish['allergens_display'] ) ? $dish['allergens_display'] : 'Sin dato',
                ),
            );
            $tags           = array();

            foreach ( $dish['tags'] ?? array() as $tag ) {
                $tag_type = $tag['type'] ?? '';
                $tags[]   = array(
                    'class' => $tag_class_map[ $tag_type ] ?? 'tag',
                    'label' => $tag['label'] ?? '',
                );
            }

            return array(
                'slug'             => $slug,
                'class'            => 'dish' . ( $slug === $hero_slug ? ' dish--hero' : '' ),
                'category'         => $dish['category'] ?? 'regular',
                'tags'             => $tags,
                'time'             => $dish['time_display'] ?? '',
                'difficulty'       => $dish['difficulty_label'] ?? 'media',
                'number'           => $number_label,
                'title'            => $dish['name_es'] ?? '',
                'title_en'         => $dish['name_en'] ?? '',
                'description'      => $dish['description_es'] ?? '',
                'stats'            => $stats,
                'gradient'         => $gradient_for_slug( $slug ),
                'card_image_html'  => $card_image ? ogape_render_menu_picture_html( $card_image, '(max-width: 640px) 100vw, (max-width: 1100px) 50vw, 33vw' ) : '',
                'modal_image_html' => $modal_image ? ogape_render_menu_picture_html( $modal_image, '100vw' ) : '',
            );
        },
        $raw_dishes
    )
);

$current_week = $find_week_record( $selected_week );
$weeks        = array();
foreach ( $week_records as $week_record ) {
    $week_number = (int) ( $week_record['number'] ?? 0 );
    if ( $week_number < 1 ) {
        continue;
    }

    $weeks[] = array(
        'number'  => $week_number,
        'num'     => 'Semana ' . $week_number . ( $week_number === $selected_week ? ' · activa' : '' ),
        'range'   => $format_week_range( $week_number ),
        'tagline' => $week_record['theme'] ?? ( $week_record['tagline'] ?? 'Rotación piloto' ),
        'url'     => add_query_arg( 'week', $week_number, $menu_url ),
        'active'  => $week_number === $selected_week,
    );
}

$archive_weeks = array();
foreach ( $week_records as $week_record ) {
    $week_number = (int) ( $week_record['number'] ?? 0 );
    if ( $week_number < 1 || $week_number === $selected_week ) {
        continue;
    }

    $archive_weeks[] = array(
        'week'  => 'Semana ' . $week_number,
        'date'  => $format_week_range( $week_number ),
        'title' => $week_record['theme'] ?? 'Rotación piloto',
        'items' => array_map(
            static function ( $dish ) {
                return $dish['name_es'] ?? '';
            },
            ogape_get_week( $week_number )
        ),
        'url'   => add_query_arg( 'week', $week_number, $menu_url ),
    );
}

$selected_theme = $current_week['theme'] ?? 'Rotación piloto';
$dishes_json    = wp_json_encode(
    array_map(
        static function ( $dish ) {
            return array(
                'slug'             => $dish['slug'],
                'category'         => $dish['category'],
                'time'             => $dish['time'],
                'difficulty'       => $dish['difficulty'],
                'title'            => $dish['title'],
                'title_en'         => $dish['title_en'],
                'description'      => $dish['description'],
                'stats'            => $dish['stats'],
                'tags'             => $dish['tags'],
                'gradient'         => $dish['gradient'],
                'modal_image_html' => $dish['modal_image_html'],
            );
        },
        $dishes
    )
);
?>

<main id="main" class="site-main menu-design" role="main">

    <section class="pagehead">
        <div class="wrap">
            <div class="crumb rise">
                <a href="<?php echo esc_url( $home_url ); ?>">Inicio</a>
                <span class="sep">/</span>
                <span class="here">Menús</span>
            </div>
            <div class="pagehead__grid">
                <div>
                    <span class="eyebrow rise" style="display:block;margin-bottom:var(--space-4)">
                        Menú piloto · semana <?php echo (int) $selected_week; ?> / 4
                    </span>
                    <h1 class="rise rise--2">El menú <em>de esta semana.</em></h1>
                    <p class="pagehead__lede rise rise--3">
                        Ocho platos por rotación: dos staples que vuelven todas las semanas y seis recetas
                        que cambian según el piloto. Esta página ya usa el pool real aprobado de 20 platos.
                    </p>
                </div>
                <aside class="weekmeta rise rise--3">
                    <div class="weekmeta__row">
                        <span class="k">Semana</span>
                        <span class="v">Semana <?php echo (int) $selected_week; ?></span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Rotación</span>
                        <span class="v accent"><?php echo esc_html( $selected_theme ); ?></span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Estado</span>
                        <span class="pulse-row"><span class="pulse"></span>Aceptando pedidos</span>
                    </div>
                    <div class="weekmeta__row">
                        <span class="k">Entrega</span>
                        <span class="v">jueves · 10 – 19 h</span>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <div class="menu-stage">
        <section class="weeks">
            <div class="wrap">
                <div class="weeks__scroller" role="tablist" aria-label="Seleccionar semana">
                    <?php foreach ( $weeks as $week ) : ?>
                        <button
                            class="weekchip<?php echo ! empty( $week['active'] ) ? ' is-active' : ''; ?>"
                            role="tab"
                            aria-selected="<?php echo ! empty( $week['active'] ) ? 'true' : 'false'; ?>"
                            data-week-url="<?php echo esc_url( $week['url'] ); ?>"
                            type="button">
                            <span class="wk-num"><?php echo esc_html( $week['num'] ); ?></span>
                            <span class="wk-range"><?php echo esc_html( $week['range'] ); ?></span>
                            <span class="wk-tagline"><?php echo esc_html( $week['tagline'] ); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="menucat">
            <div class="wrap">
                <div class="menucat__layout">
                    <nav class="menucat__sidebar" aria-label="Categorías de platos">
                        <?php foreach ( $categories as $cat ) :
                            $is_active = 'all' === $cat['key'];
                            ?>
                            <button
                                class="catbtn<?php echo $is_active ? ' is-active' : ''; ?>"
                                data-cat="<?php echo esc_attr( $cat['key'] ); ?>"
                                type="button"
                                aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>">
                                <span class="catbtn__circle">
                                    <?php echo $cat_icons[ $cat['key'] ]; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                                </span>
                                <span class="catbtn__label"><?php echo esc_html( $cat['label'] ); ?></span>
                            </button>
                        <?php endforeach; ?>
                    </nav>

                    <div class="menucat__main">
                        <div class="dishes" id="dishes">
                            <?php foreach ( $dishes as $idx => $dish ) : ?>
                                <article
                                    class="<?php echo esc_attr( $dish['class'] ); ?>"
                                    data-cat="<?php echo esc_attr( $dish['category'] ); ?>"
                                    data-index="<?php echo (int) $idx; ?>"
                                    role="button"
                                    tabindex="0"
                                    aria-label="<?php echo esc_attr( 'Ver detalle de ' . $dish['title'] ); ?>"
                                    style="--dish-gradient: <?php echo esc_attr( $dish['gradient'] ); ?>">
                                    <div class="dish__img">
                                        <?php if ( ! empty( $dish['card_image_html'] ) ) : ?>
                                            <?php echo $dish['card_image_html']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $dish['tags'] ) ) : ?>
                                            <div class="dish__tags">
                                                <?php foreach ( $dish['tags'] as $tag ) : ?>
                                                    <span class="<?php echo esc_attr( $tag['class'] ); ?>"><?php echo esc_html( $tag['label'] ); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="dish__meta">
                                            <span class="mleft"><?php echo $time_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $normalize_time_label( $dish['time'] ) ); ?></span>
                                            <span>Dificultad · <?php echo esc_html( $dish['difficulty'] ); ?></span>
                                        </div>
                                    </div>
                                    <div class="dish__body">
                                        <span class="dish__num"><?php echo esc_html( $dish['number'] ); ?></span>
                                        <h3 class="dish__title"><?php echo esc_html( $dish['title'] ); ?></h3>
                                        <div class="dish__title-en"><?php echo esc_html( $dish['title_en'] ); ?></div>
                                        <p class="dish__desc"><?php echo esc_html( $dish['description'] ); ?></p>
                                        <div class="dish__foot">
                                            <div class="dish__stats">
                                                <?php foreach ( $dish['stats'] as $stat ) : ?>
                                                    <div><?php echo esc_html( $stat['label'] ); ?><b><?php echo esc_html( $stat['value'] ); ?></b></div>
                                                <?php endforeach; ?>
                                            </div>
                                            <span class="dish__peek">Ver <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                        <div class="menu-empty" id="empty">Sin platos en esta categoría esta semana.</div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <div class="dish-modal" id="dishModal" role="dialog" aria-modal="true" aria-label="Detalle del plato" hidden>
        <div class="dish-modal__backdrop" id="dishModalBackdrop"></div>
        <div class="dish-modal__panel" id="dishModalPanel">
            <button class="dish-modal__close" id="dishModalClose" type="button" aria-label="Cerrar detalle">
                <?php echo $close_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
            </button>
            <div class="dish-modal__img" id="dishModalImg"></div>
            <div class="dish-modal__content">
                <div class="dish-modal__tags" id="dishModalTags"></div>
                <h2 class="dish-modal__title" id="dishModalTitle"></h2>
                <div class="dish-modal__subtitle" id="dishModalSubtitle"></div>
                <div class="dish-modal__badges" id="dishModalBadges"></div>
                <p class="dish-modal__desc" id="dishModalDesc"></p>
                <div class="dish-modal__stats" id="dishModalStats"></div>
                <div class="dish-modal__note">
                    <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    La selección de platos se realiza dentro de tu cuenta.
                </div>
            </div>
        </div>
    </div>

    <section class="archive" id="pasadas">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow" style="display:block;margin-bottom:var(--space-3)">Rotación completa</span>
                    <h2>Las otras semanas del piloto.</h2>
                </div>
                <p>El piloto trabaja sobre un pool fijo de 20 platos. Acá podés ver cómo rota el resto del menú en las demás semanas.</p>
            </div>

            <div class="archive__grid">
                <?php foreach ( $archive_weeks as $past ) : ?>
                    <article class="past">
                        <div class="past__head">
                            <span class="k"><?php echo esc_html( $past['week'] ); ?></span>
                            <span class="date"><?php echo esc_html( $past['date'] ); ?></span>
                        </div>
                        <h3><?php echo esc_html( $past['title'] ); ?></h3>
                        <ul>
                            <?php foreach ( $past['items'] as $item ) : ?>
                                <li><?php echo esc_html( $item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="past__foot">
                            <small><?php echo esc_html( count( $past['items'] ) ); ?> recetas · del piloto</small>
                            <a href="<?php echo esc_url( $past['url'] ); ?>" class="dish__link">Ver semana</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="strip">
        <div class="wrap strip__inner">
            <div>
                <h3>¿Te gusta lo que ves? <em>Empezá con esta semana.</em></h3>
                <p>El piloto rota sobre cuatro semanas y mantiene dos staples fijos. Podés explorar cada selección semanal antes de sumarte.</p>
            </div>
            <div class="strip__btns">
                <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--warm strip-btn">
                    Unirme
                    <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                </a>
                <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--ghost on-dark">Ver precios</a>
            </div>
        </div>
    </section>

</main>

<script>
(function () {
  var root = document.querySelector('.menu-design');
  if (!root) return;

  var nav = document.querySelector('.nav');
  var weeksSection = root.querySelector('.weeks');

  function syncMenuStickyOffsets() {
    if (!weeksSection) return;

    var navHeight = nav ? Math.round(nav.getBoundingClientRect().height) : 0;
    var weeksHeight = Math.round(weeksSection.getBoundingClientRect().height);

    root.style.setProperty('--menu-nav-offset', navHeight + 'px');
    root.style.setProperty('--menu-weeks-height', weeksHeight + 'px');
  }

  syncMenuStickyOffsets();
  window.addEventListener('resize', syncMenuStickyOffsets);
  window.addEventListener('load', syncMenuStickyOffsets);

  var dishes = <?php echo $dishes_json; // phpcs:ignore WordPress.Security.EscapeOutput ?>;

  var catBtns   = root.querySelectorAll('.catbtn[data-cat]');
  var dishCards = root.querySelectorAll('#dishes [data-cat]');
  var emptyMsg  = root.querySelector('#empty');

  catBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      catBtns.forEach(function (b) {
        b.classList.remove('is-active');
        b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('is-active');
      btn.setAttribute('aria-pressed', 'true');

      var cat   = btn.dataset.cat;
      var shown = 0;
      dishCards.forEach(function (card) {
        var match = (cat === 'all') || (card.dataset.cat === cat);
        card.style.display = match ? '' : 'none';
        if (match) shown++;
      });
      if (emptyMsg) emptyMsg.classList.toggle('is-shown', shown === 0);
    });
  });

  var modal         = document.getElementById('dishModal');
  var modalBackdrop = document.getElementById('dishModalBackdrop');
  var modalClose    = document.getElementById('dishModalClose');
  var modalImg      = document.getElementById('dishModalImg');
  var modalTags     = document.getElementById('dishModalTags');
  var modalTitle    = document.getElementById('dishModalTitle');
  var modalSubtitle = document.getElementById('dishModalSubtitle');
  var modalBadges   = document.getElementById('dishModalBadges');
  var modalDesc     = document.getElementById('dishModalDesc');
  var modalStats    = document.getElementById('dishModalStats');
  var lastFocused   = null;

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function openModal(idx) {
    var d = dishes[idx];
    if (!d) return;
    lastFocused = document.activeElement;

    modalImg.innerHTML = d.modal_image_html || '';
    modalImg.style.background = d.modal_image_html ? 'none' : (d.gradient || '');

    modalTags.innerHTML = '';
    (d.tags || []).forEach(function (t) {
      var s = document.createElement('span');
      s.className = t['class'];
      s.textContent = t.label;
      modalTags.appendChild(s);
    });

    modalTitle.textContent = d.title;
    modalSubtitle.textContent = d.title_en;

    modalBadges.innerHTML =
      '<span class="dish-modal__badge">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" style="width:13px;height:13px"><path d="M5 13c0-3.5 3-7 7-7s7 3.5 7 7"/></svg>' +
        escHtml(d.time || '35 min') +
      '</span>' +
      '<span class="dish-modal__badge">' +
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" style="width:13px;height:13px"><path d="M5 17h14M5 12h8M5 7h5"/></svg>' +
        'Dificultad ' + escHtml(d.difficulty || 'media') +
      '</span>';

    modalDesc.textContent = d.description;

    modalStats.innerHTML = '';
    (d.stats || []).forEach(function (s) {
      var el = document.createElement('div');
      el.className = 'dish-modal__stat';
      el.innerHTML =
        '<span class="dish-modal__stat-label">' + escHtml(s.label) + '</span>' +
        '<span class="dish-modal__stat-value">' + escHtml(s.value) + '</span>';
      modalStats.appendChild(el);
    });

    modal.removeAttribute('hidden');
    document.body.classList.add('modal-open');
    setTimeout(function () { modalClose.focus(); }, 50);
  }

  function closeModal() {
    modal.setAttribute('hidden', '');
    document.body.classList.remove('modal-open');
    if (lastFocused) lastFocused.focus();
  }

  dishCards.forEach(function (card) {
    card.addEventListener('click', function () {
      openModal(parseInt(card.dataset.index, 10));
    });
    card.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openModal(parseInt(card.dataset.index, 10));
      }
    });
  });

  if (modalClose) modalClose.addEventListener('click', closeModal);
  if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal && !modal.hasAttribute('hidden')) {
      closeModal();
    }
  });

  var weekchips = root.querySelectorAll('.weekchip[data-week-url]');
  weekchips.forEach(function (wc) {
    wc.addEventListener('click', function () {
      window.location.href = wc.dataset.weekUrl;
    });
  });
})();
</script>

<?php get_footer(); ?>
