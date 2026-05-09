<?php
/**
 * Template Name: Sostenibilidad
 * Template Post Type: page
 *
 * Source design: crafted in-theme to extend the Kits / Planes visual system.
 * Design styles live in assets/css/sostenibilidad-page.css, scoped under
 * .sustainability-design. Theme nav/footer (header.php / footer.php) wrap this
 * page.
 */

get_header();

get_template_part(
    'templates/pages/sostenibilidad-page-content',
    null,
    array(
        'home_url'  => home_url( '/' ),
        'plans_url' => home_url( '/planes/' ),
        'menu_url'  => home_url( '/menu/' ),
    )
);

get_footer();
