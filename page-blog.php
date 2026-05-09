<?php
/**
 * Template Name: Blog
 * Template Post Type: page
 */

get_header();

get_template_part(
    'templates/pages/blog-page-content',
    null,
    array(
        'home_url'     => home_url( '/' ),
        'plans_url'    => home_url( '/planes/' ),
        'menu_url'     => home_url( '/menu/' ),
        'waitlist_url' => function_exists( 'ogape_get_waitlist_url' ) ? ogape_get_waitlist_url() : home_url( '/waitlist/' ),
    )
);

get_footer();
