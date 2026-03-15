<?php

function strata_review_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ));

    add_image_size('hero-large', 1200, 600, true);
    add_image_size('card-medium', 600, 400, true);
}
add_action('after_setup_theme', 'strata_review_setup');

function strata_review_enqueue_assets() {
    wp_enqueue_style(
        'strata-review-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merriweather:wght@400;700&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'strata-review-style',
        get_stylesheet_uri(),
        array('strata-review-google-fonts'),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script(
        'strata-review-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'strata_review_enqueue_assets');

function inside_strata_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'inside_strata_excerpt_length');

function inside_strata_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'inside_strata_excerpt_more');