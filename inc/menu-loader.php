<?php
/**
 * Pilot menu loader helpers.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ogape_get_pilot_menu_path' ) ) {
    function ogape_get_pilot_menu_path() {
        return get_stylesheet_directory() . '/assets/data/menu.json';
    }
}

if ( ! function_exists( 'ogape_get_pilot_menu_fallback' ) ) {
    function ogape_get_pilot_menu_fallback() {
        return array(
            array(
                'dish_id'           => 'T-003',
                'slug'              => 'sopa-paraguaya',
                'name_es'           => 'Sopa Paraguaya',
                'name_en'           => 'Sopa Paraguaya',
                'category'          => 'traditional',
                'is_staple'         => true,
                'weeks'             => array( 1, 2, 3, 4 ),
                'status'            => 'approved',
                'tags'              => array(
                    array(
                        'label' => 'Tradicional',
                        'type'  => 'local',
                    ),
                    array(
                        'label' => 'Staple',
                        'type'  => 'nomad',
                    ),
                ),
                'show_price'        => false,
                'description_es'    => '',
                'description_en'    => '',
                'time_display'      => '',
                'difficulty_label'  => 'media',
                'calories_display'  => '550 kcal por porción',
                'allergens_display' => 'Lácteos (leche)',
                'portions_display'  => '2 · 4',
                'recipe'            => array(
                    'es_path' => '02 Recipe Library/traditional/sopa paraguaya/sopa paraguaya.docx',
                    'en_path' => '02 Recipe Library/traditional/sopa paraguaya/sopa paraguaya (english).docx',
                ),
                'img'               => array(
                    'src'         => 'assets/img/menu/sopa-paraguaya-md.jpg',
                    'srcset'      => 'assets/img/menu/sopa-paraguaya-sm.jpg 400w, assets/img/menu/sopa-paraguaya-md.jpg 800w, assets/img/menu/sopa-paraguaya-lg.jpg 1600w',
                    'webp_srcset' => 'assets/img/menu/sopa-paraguaya-sm.webp 400w, assets/img/menu/sopa-paraguaya-md.webp 800w, assets/img/menu/sopa-paraguaya-lg.webp 1600w',
                    'alt_es'      => 'Sopa Paraguaya de Ogape lista para cocinar en casa',
                    'alt_en'      => 'Sopa Paraguaya from Ogape ready to cook at home',
                    'seed_source' => '02 Recipe Library/traditional/sopa paraguaya/IMG_8277.jpg',
                ),
            ),
            array(
                'dish_id'           => 'R-014',
                'slug'              => 'frittata-de-zucchini',
                'name_es'           => 'Frittata de Zucchini',
                'name_en'           => 'Zucchini Frittata',
                'category'          => 'veggie',
                'is_staple'         => true,
                'weeks'             => array( 1, 2, 3, 4 ),
                'status'            => 'approved',
                'tags'              => array(
                    array(
                        'label' => 'Vegetariano',
                        'type'  => 'veg',
                    ),
                    array(
                        'label' => 'Staple',
                        'type'  => 'nomad',
                    ),
                ),
                'show_price'        => false,
                'description_es'    => '',
                'description_en'    => '',
                'time_display'      => '40 minutos',
                'difficulty_label'  => 'media',
                'calories_display'  => '250 kcal por porción',
                'allergens_display' => 'Lácteos (queso, yogurt), Huevos',
                'portions_display'  => '2 · 4',
                'recipe'            => array(
                    'es_path' => '02 Recipe Library/regular/frittata de zucchini/frittata de zucchini.docx',
                    'en_path' => '02 Recipe Library/regular/frittata de zucchini/frittata de zucchini (english).docx',
                ),
                'img'               => array(
                    'src'         => 'assets/img/menu/frittata-de-zucchini-md.jpg',
                    'srcset'      => 'assets/img/menu/frittata-de-zucchini-sm.jpg 400w, assets/img/menu/frittata-de-zucchini-md.jpg 800w, assets/img/menu/frittata-de-zucchini-lg.jpg 1600w',
                    'webp_srcset' => 'assets/img/menu/frittata-de-zucchini-sm.webp 400w, assets/img/menu/frittata-de-zucchini-md.webp 800w, assets/img/menu/frittata-de-zucchini-lg.webp 1600w',
                    'alt_es'      => 'Frittata de Zucchini de Ogape lista para cocinar en casa',
                    'alt_en'      => 'Zucchini Frittata from Ogape ready to cook at home',
                    'seed_source' => '02 Recipe Library/regular/frittata de zucchini/IMG_8178.jpg',
                ),
            ),
        );
    }
}

if ( ! function_exists( 'ogape_get_pilot_menu_data' ) ) {
    function ogape_get_pilot_menu_data() {
        $cached = wp_cache_get( 'pilot_menu_data', 'ogape-menu' );
        if ( false !== $cached ) {
            return $cached;
        }

        $fallback = array(
            'meta'   => array(
                'source_manifest'  => '',
                'generated_on'     => '',
                'pricing_visible'  => false,
            ),
            'weeks'  => array(),
            'dishes' => ogape_get_pilot_menu_fallback(),
            'sides'  => array(),
        );
        $path     = ogape_get_pilot_menu_path();

        if ( ! file_exists( $path ) ) {
            wp_cache_set( 'pilot_menu_data', $fallback, 'ogape-menu', 5 * MINUTE_IN_SECONDS );
            return $fallback;
        }

        $raw  = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
        $data = json_decode( $raw, true );

        if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $data ) ) {
            wp_cache_set( 'pilot_menu_data', $fallback, 'ogape-menu', 5 * MINUTE_IN_SECONDS );
            return $fallback;
        }

        $data['meta']   = is_array( $data['meta'] ?? null ) ? $data['meta'] : $fallback['meta'];
        $data['weeks']  = is_array( $data['weeks'] ?? null ) ? $data['weeks'] : array();
        $data['dishes'] = is_array( $data['dishes'] ?? null ) ? $data['dishes'] : array();
        $data['sides']  = is_array( $data['sides'] ?? null ) ? $data['sides'] : array();

        if ( empty( $data['dishes'] ) ) {
            $data['dishes'] = $fallback['dishes'];
        }

        wp_cache_set( 'pilot_menu_data', $data, 'ogape-menu', 5 * MINUTE_IN_SECONDS );
        return $data;
    }
}

if ( ! function_exists( 'ogape_get_pilot_menu' ) ) {
    function ogape_get_pilot_menu() {
        $data = ogape_get_pilot_menu_data();
        return is_array( $data['dishes'] ?? null ) ? $data['dishes'] : ogape_get_pilot_menu_fallback();
    }
}

if ( ! function_exists( 'ogape_get_pilot_weeks' ) ) {
    function ogape_get_pilot_weeks() {
        $data  = ogape_get_pilot_menu_data();
        $weeks = is_array( $data['weeks'] ?? null ) ? $data['weeks'] : array();

        if ( $weeks ) {
            return $weeks;
        }

        return array(
            array(
                'number' => 1,
                'label'  => 'Semana 1',
                'range'  => 'Rotacion piloto',
                'theme'  => 'Cítricos y río',
                'tagline'=> 'Staples del piloto',
                'dishes' => array( 'sopa-paraguaya', 'frittata-de-zucchini' ),
            ),
        );
    }
}

if ( ! function_exists( 'ogape_get_week' ) ) {
    function ogape_get_week( $number ) {
        $number = absint( $number );
        if ( $number < 1 ) {
            return array();
        }

        $dishes     = ogape_get_pilot_menu();
        $dish_index = array();
        foreach ( $dishes as $dish ) {
            if ( empty( $dish['slug'] ) ) {
                continue;
            }
            $dish_index[ $dish['slug'] ] = $dish;
        }

        foreach ( ogape_get_pilot_weeks() as $week ) {
            if ( (int) ( $week['number'] ?? 0 ) !== $number ) {
                continue;
            }

            $ordered = array();
            foreach ( $week['dishes'] ?? array() as $slug ) {
                if ( isset( $dish_index[ $slug ] ) ) {
                    $ordered[] = $dish_index[ $slug ];
                }
            }

            return $ordered;
        }

        return array_values(
            array_filter(
                $dishes,
                static function( $dish ) use ( $number ) {
                    return in_array( $number, $dish['weeks'] ?? array(), true );
                }
            )
        );
    }
}

if ( ! function_exists( 'ogape_get_active_week' ) ) {
    function ogape_get_active_week() {
        $start = defined( 'OGAPE_PILOT_START' ) ? OGAPE_PILOT_START : 0;

        if ( empty( $start ) || '0' === (string) $start ) {
            return 1;
        }

        if ( is_numeric( $start ) && (int) $start >= 1 && (int) $start <= 4 ) {
            return (int) $start;
        }

        $timestamp = is_numeric( $start ) ? (int) $start : strtotime( (string) $start );
        if ( ! $timestamp ) {
            return 1;
        }

        $now         = current_time( 'timestamp' );
        $week_offset = (int) floor( max( 0, $now - $timestamp ) / WEEK_IN_SECONDS );
        return max( 1, min( 4, 1 + $week_offset ) );
    }
}

if ( ! function_exists( 'ogape_get_menu_image_sources' ) ) {
    function ogape_get_menu_image_sources( $dish, $preferred_size = 'md' ) {
        $slug = sanitize_title( $dish['slug'] ?? '' );
        if ( '' === $slug ) {
            return null;
        }

        $img      = is_array( $dish['img'] ?? null ) ? $dish['img'] : array();
        $base_dir = trailingslashit( get_stylesheet_directory() ) . 'assets/img/menu/';
        $base_uri = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/menu/';
        $alt      = sanitize_text_field( $img['alt_es'] ?? ( $dish['name_es'] ?? $slug ) );
        $sizes    = array( 'sm' => '400w', 'md' => '800w', 'lg' => '1600w' );
        $jpg_set  = array();
        $webp_set = array();
        $src      = '';

        foreach ( $sizes as $size => $descriptor ) {
            $jpg = $slug . '-' . $size . '.jpg';
            if ( file_exists( $base_dir . $jpg ) ) {
                $jpg_set[] = $base_uri . $jpg . ' ' . $descriptor;
                if ( $preferred_size === $size ) {
                    $src = $base_uri . $jpg;
                }
            }

            $webp = $slug . '-' . $size . '.webp';
            if ( file_exists( $base_dir . $webp ) ) {
                $webp_set[] = $base_uri . $webp . ' ' . $descriptor;
            }
        }

        if ( '' === $src && ! empty( $jpg_set ) ) {
            $src = preg_replace( '/\s+\d+w$/', '', $jpg_set[ count( $jpg_set ) - 1 ] );
        }

        if ( '' === $src ) {
            return null;
        }

        return array(
            'src'         => $src,
            'srcset'      => implode( ', ', $jpg_set ),
            'webp_srcset' => implode( ', ', $webp_set ),
            'alt'         => $alt,
        );
    }
}

if ( ! function_exists( 'ogape_render_menu_picture_html' ) ) {
    function ogape_render_menu_picture_html( $image, $sizes = '100vw' ) {
        if ( empty( $image['src'] ) ) {
            return '';
        }

        ob_start();
        ?>
        <picture class="menu-picture">
            <?php if ( ! empty( $image['webp_srcset'] ) ) : ?>
                <source type="image/webp" srcset="<?php echo esc_attr( $image['webp_srcset'] ); ?>" sizes="<?php echo esc_attr( $sizes ); ?>">
            <?php endif; ?>
            <img
                src="<?php echo esc_url( $image['src'] ); ?>"
                <?php if ( ! empty( $image['srcset'] ) ) : ?>srcset="<?php echo esc_attr( $image['srcset'] ); ?>"<?php endif; ?>
                sizes="<?php echo esc_attr( $sizes ); ?>"
                alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
                loading="lazy"
                decoding="async"
            >
        </picture>
        <?php
        return trim( ob_get_clean() );
    }
}

if ( ! function_exists( 'ogape_get_menu_recipe_gradients' ) ) {
    function ogape_get_menu_recipe_gradients() {
        return array(
            'radial-gradient(circle at 35% 40%, #F0B765 0%, transparent 55%), radial-gradient(circle at 70% 65%, #E8A045 0%, transparent 55%), linear-gradient(135deg, #9A5A08, #C88B3A)',
            'radial-gradient(circle at 30% 45%, #C88B3A 0%, transparent 48%), radial-gradient(circle at 70% 60%, #9A5A08 0%, transparent 55%), linear-gradient(135deg, #3B2A14, #6B4A1E 70%, #8B5A1C)',
            'radial-gradient(circle at 30% 35%, #F0B765, transparent 50%), radial-gradient(circle at 72% 70%, #4A7A3A, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
            'radial-gradient(circle at 35% 40%, #FFD783, transparent 55%), radial-gradient(circle at 72% 68%, #E8A045, transparent 55%), linear-gradient(135deg, #C88B3A, #9A5A08)',
            'radial-gradient(circle at 35% 40%, #C9D97A, transparent 55%), radial-gradient(circle at 70% 65%, #6B8A3A, transparent 55%), linear-gradient(135deg, #3E5A27, #6B8A3A)',
            'radial-gradient(circle at 35% 40%, #F0A8B8, transparent 55%), radial-gradient(circle at 70% 65%, #C86A7A, transparent 55%), linear-gradient(135deg, #9A3E4E, #C86A7A)',
        );
    }
}

if ( ! function_exists( 'ogape_get_menu_recipe_gradient' ) ) {
    function ogape_get_menu_recipe_gradient( $slug ) {
        $gradients = ogape_get_menu_recipe_gradients();
        $index     = (int) sprintf( '%u', crc32( (string) $slug ) ) % count( $gradients );

        return $gradients[ $index ];
    }
}

if ( ! function_exists( 'ogape_normalize_menu_time_display' ) ) {
    function ogape_normalize_menu_time_display( $time_label ) {
        $time_label = trim( (string) $time_label );

        if ( '' === $time_label ) {
            return '35 min';
        }

        return str_replace(
            array( ' minutos', ' minuto', ' Minutos', ' Minuto' ),
            array( ' min', ' min', ' min', ' min' ),
            $time_label
        );
    }
}

if ( ! function_exists( 'ogape_format_menu_difficulty_display' ) ) {
    function ogape_format_menu_difficulty_display( $difficulty_label ) {
        $difficulty = sanitize_text_field( $difficulty_label );

        if ( '' === $difficulty ) {
            return 'Media';
        }

        $difficulty_map = array(
            'baja'  => 'Fácil',
            'media' => 'Media',
            'alta'  => 'Alta',
            'facil' => 'Fácil',
        );

        $normalized = sanitize_key( remove_accents( $difficulty ) );

        return $difficulty_map[ $normalized ] ?? ucfirst( strtolower( $difficulty ) );
    }
}

if ( ! function_exists( 'ogape_get_week_menu_recipes' ) ) {
    function ogape_get_week_menu_recipes( $week_number = 0 ) {
        $week_number = absint( $week_number );
        $raw_dishes  = $week_number ? ogape_get_week( $week_number ) : ogape_get_week( ogape_get_active_week() );

        if ( empty( $raw_dishes ) ) {
            $raw_dishes = ogape_get_pilot_menu();
        }

        $raw_dishes = array_values( $raw_dishes );
        $hero_slug  = '';

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
            foreach ( $raw_dishes as $index => $dish_candidate ) {
                if ( ( $dish_candidate['slug'] ?? '' ) !== $hero_slug ) {
                    continue;
                }

                if ( 0 !== $index ) {
                    $hero_dish = $dish_candidate;
                    array_splice( $raw_dishes, $index, 1 );
                    array_unshift( $raw_dishes, $hero_dish );
                }
                break;
            }
        }

        $recipes = array();
        foreach ( $raw_dishes as $dish ) {
            $dish_id = sanitize_key( $dish['slug'] ?? '' );
            if ( '' === $dish_id ) {
                continue;
            }

            $tags = array();
            foreach ( $dish['tags'] ?? array() as $tag ) {
                if ( ! is_array( $tag ) ) {
                    continue;
                }

                $label = sanitize_text_field( $tag['label'] ?? '' );
                $type  = sanitize_key( $tag['type'] ?? '' );
                if ( '' === $label || '' === $type ) {
                    continue;
                }

                $tags[] = array(
                    'label' => $label,
                    'type'  => $type,
                );
            }

            $recipes[] = array(
                'id'         => $dish_id,
                'name'       => sanitize_text_field( $dish['name_es'] ?? '' ),
                'desc'       => sanitize_textarea_field( $dish['description_es'] ?? '' ),
                'tags'       => $tags,
                'time'       => ogape_normalize_menu_time_display( $dish['time_display'] ?? '' ),
                'difficulty' => ogape_format_menu_difficulty_display( $dish['difficulty_label'] ?? '' ),
                'allergens'  => sanitize_text_field( $dish['allergens_display'] ?? 'Sin dato' ),
                'isHero'     => $dish_id === sanitize_key( $hero_slug ),
                'photoGrad'  => ogape_get_menu_recipe_gradient( $dish_id ),
            );
        }

        return $recipes;
    }
}
