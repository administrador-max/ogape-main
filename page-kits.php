<?php
/**
 * Template Name: Kits
 * Template Post Type: page
 *
 * Source design: website/project/kits.html (Website-handoff bundle, 2026-05-09).
 * Design styles live in assets/css/kits-page.css, scoped under .kits-design.
 * Theme nav/footer (header.php / footer.php) wrap this page.
 */

get_header();

get_template_part(
    'templates/pages/kits-page-content',
    null,
    array(
        'home_url'           => home_url( '/' ),
        'plans_url'          => home_url( '/planes/' ),
        'menu_url'           => home_url( '/menu/' ),
        'sustainability_url' => home_url( '/sostenibilidad/' ),
    )
);

get_footer();
