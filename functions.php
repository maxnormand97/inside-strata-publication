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

/* ============================================
   ACF — HOMEPAGE SETTINGS
   Requires Advanced Custom Fields (free or Pro).

   HOW TO USE:
   1. Install & activate the ACF plugin.
   2. Go to Settings › Homepage Settings in WP Admin.
   3. Use the three "Featured Article" selectors to
      pick which posts appear in the homepage carousel.
   4. Click Save — the carousel updates immediately.
   ============================================ */
if ( function_exists( 'acf_add_options_page' ) ) {

    // Register the options page under Settings menu
    acf_add_options_page( array(
        'page_title'  => 'Homepage Settings',
        'menu_title'  => 'Homepage Settings',
        'menu_slug'   => 'homepage-settings',
        'parent_slug' => 'options-general.php',
        'capability'  => 'edit_posts',
        'redirect'    => false,
    ) );

    // Register the field group programmatically so it works
    // without importing JSON — no ACF sync step required.
    acf_add_local_field_group( array(
        'key'    => 'group_homepage_featured',
        'title'  => 'Homepage Featured Articles',
        'fields' => array(
            array(
                'key'           => 'field_featured_post_1',
                'label'         => 'Featured Article 1',
                'name'          => 'featured_post_1',
                'type'          => 'post_object',
                'instructions'  => 'First slide in the homepage carousel.',
                'post_type'     => array( 'post' ),
                'return_format' => 'object',
                'ui'            => 1,
                'allow_null'    => 1,
            ),
            array(
                'key'           => 'field_featured_post_2',
                'label'         => 'Featured Article 2',
                'name'          => 'featured_post_2',
                'type'          => 'post_object',
                'instructions'  => 'Second slide in the homepage carousel.',
                'post_type'     => array( 'post' ),
                'return_format' => 'object',
                'ui'            => 1,
                'allow_null'    => 1,
            ),
            array(
                'key'           => 'field_featured_post_3',
                'label'         => 'Featured Article 3',
                'name'          => 'featured_post_3',
                'type'          => 'post_object',
                'instructions'  => 'Third slide in the homepage carousel.',
                'post_type'     => array( 'post' ),
                'return_format' => 'object',
                'ui'            => 1,
                'allow_null'    => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'homepage-settings',
                ),
            ),
        ),
    ) );
}