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
   ACF — HOMEPAGE FEATURED ARTICLES (ACF Free)
   Fields appear in the Home page editor.

   HOW TO USE:
   1. In WP Admin go to Pages and open your Home page.
   2. Use the three "Featured Article" dropdowns to choose
      which posts appear in the hero carousel.
   3. Click Update — the carousel changes immediately.
   ============================================ */
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key'    => 'group_homepage_featured',
        'title'  => 'Homepage Featured Articles',
        'fields' => array(
            array(
                'key'           => 'field_featured_article_1',
                'label'         => 'Featured Article 1',
                'name'          => 'featured_article_1',
                'type'          => 'post_object',
                'instructions'  => 'First slide in the homepage carousel.',
                'post_type'     => array( 'post' ),
                'return_format' => 'object',
                'ui'            => 1,
                'allow_null'    => 1,
            ),
            array(
                'key'           => 'field_featured_article_2',
                'label'         => 'Featured Article 2',
                'name'          => 'featured_article_2',
                'type'          => 'post_object',
                'instructions'  => 'Second slide in the homepage carousel.',
                'post_type'     => array( 'post' ),
                'return_format' => 'object',
                'ui'            => 1,
                'allow_null'    => 1,
            ),
            array(
                'key'           => 'field_featured_article_3',
                'label'         => 'Featured Article 3',
                'name'          => 'featured_article_3',
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
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
    ) );
}

/* ============================================
   ACF — SIDEBAR AD (ACF Free)
   Fields are attached to the "Ad Settings" page.

   HOW TO USE:
   1. In WP Admin go to Pages and open "Ad Settings".
   2. Scroll down to the "Article Sidebar Ad" meta box.
   3. Fill in the sidebar ad fields and toggle Ad Enabled on.
   4. Click Update — the sidebar ad updates on all articles.

   The "Ad Settings" page is a normal draft/private WordPress page
   used as a free-tier global settings store. It is never published
   to site visitors — set its status to Draft or Private.
   ============================================ */
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key'    => 'group_strata_sidebar_ad',
        'title'  => 'Article Sidebar Ad',
        'fields' => array(
            array(
                'key'          => 'field_strata_sidebar_ad_enabled',
                'label'        => 'Ad Enabled',
                'name'         => 'sidebar_ad_enabled',
                'type'         => 'true_false',
                'instructions' => 'Toggle on to show this ad on all article pages.',
                'ui'           => 1,
                'default_value'=> 0,
            ),
            array(
                'key'          => 'field_strata_sidebar_ad_title',
                'label'        => 'Ad Title / Sponsor Name',
                'name'         => 'sidebar_ad_title',
                'type'         => 'text',
            ),
            array(
                'key'           => 'field_strata_sidebar_ad_image',
                'label'         => 'Ad Image',
                'name'          => 'sidebar_ad_image',
                'type'          => 'image',
                'instructions'  => 'Recommended: 600 × 360 px.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'          => 'field_strata_sidebar_ad_url',
                'label'        => 'Ad Destination URL',
                'name'         => 'sidebar_ad_url',
                'type'         => 'url',
            ),
            array(
                'key'          => 'field_strata_sidebar_ad_description',
                'label'        => 'Ad Description (optional)',
                'name'         => 'sidebar_ad_description',
                'type'         => 'textarea',
                'rows'         => 2,
            ),
            array(
                'key'          => 'field_strata_sidebar_ad_cta_text',
                'label'        => 'Call-to-Action Text (optional)',
                'name'         => 'sidebar_ad_cta_text',
                'type'         => 'text',
                'instructions' => 'e.g. "Learn More" or "Visit Site"',
            ),
        ),
        // Location: show this meta box only on the "Ad Settings" page.
        // We look the page up by slug at registration time so this works
        // regardless of the page's numeric ID across environments.
        // Change 'ad-settings' below if you rename the page's slug.
        'location' => array(
            array(
                array(
                    'param'    => 'page_slug',
                    'operator' => '==',
                    'value'    => 'ad-settings',
                ),
            ),
        ),
    ) );
}

/* ============================================
   ACF — INLINE AD (ACF Free)
   Fields are attached to the "Ad Settings" page,
   same page as the sidebar ad.

   HOW TO USE:
   1. In WP Admin go to Pages and open "Ad Settings".
   2. Scroll down to the "Article Inline Ad" meta box.
   3. Fill in the inline ad fields and toggle Ad Enabled on.
   4. Click Update — the inline ad updates on all articles.
   ============================================ */
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key'    => 'group_strata_inline_ad',
        'title'  => 'Article Inline Ad',
        'fields' => array(
            array(
                'key'          => 'field_strata_inline_ad_enabled',
                'label'        => 'Ad Enabled',
                'name'         => 'inline_ad_enabled',
                'type'         => 'true_false',
                'instructions' => 'Toggle on to show this ad inside all article pages.',
                'ui'           => 1,
                'default_value'=> 0,
            ),
            array(
                'key'          => 'field_strata_inline_ad_title',
                'label'        => 'Ad Title / Sponsor Name',
                'name'         => 'inline_ad_title',
                'type'         => 'text',
            ),
            array(
                'key'           => 'field_strata_inline_ad_image',
                'label'         => 'Ad Image',
                'name'          => 'inline_ad_image',
                'type'          => 'image',
                'instructions'  => 'Recommended: 440 × 280 px.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'          => 'field_strata_inline_ad_url',
                'label'        => 'Ad Destination URL',
                'name'         => 'inline_ad_url',
                'type'         => 'url',
            ),
            array(
                'key'          => 'field_strata_inline_ad_description',
                'label'        => 'Ad Description (optional)',
                'name'         => 'inline_ad_description',
                'type'         => 'textarea',
                'rows'         => 2,
            ),
            array(
                'key'          => 'field_strata_inline_ad_cta_text',
                'label'        => 'Call-to-Action Text (optional)',
                'name'         => 'inline_ad_cta_text',
                'type'         => 'text',
                'instructions' => 'e.g. "Learn More" or "Visit Site"',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_slug',
                    'operator' => '==',
                    'value'    => 'ad-settings',
                ),
            ),
        ),
    ) );
}

/* ============================================
   ACF — ADVERTISEMENT SLOTS (ACF Free)
   Fields are attached to the static front page
   (Home page editor). No options pages needed.

   HOW TO USE:
   1. In WP Admin go to Pages and open your Home page.
   2. Scroll down to the "Advertisement Slots" meta box.
   3. Fill in the Homepage Banner and/or Footer Promo fields.
   4. Toggle "Ad Enabled" on, then click Update.

   AD SLOTS managed here:
   • Homepage Banner  — billboard below Latest News
   • Footer Promo     — compact banner above the site footer

   Sidebar and Inline ads for article pages can be added
   to this same field group later with a second location
   rule targeting singular posts, or a dedicated page.
   ============================================ */
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key'    => 'group_strata_ad_slots',
        'title'  => 'Advertisement Slots',
        'fields' => array(

            // ── HOMEPAGE BANNER ───────────────────────────────────────
            array(
                'key'   => 'field_strata_ad_tab_homepage',
                'label' => 'Homepage Banner Ad',
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_strata_homepage_ad_enabled',
                'label'        => 'Ad Enabled',
                'name'         => 'homepage_ad_enabled',
                'type'         => 'true_false',
                'instructions' => 'Toggle on to show this ad on the homepage.',
                'ui'           => 1,
                'default_value'=> 0,
            ),
            array(
                'key'          => 'field_strata_homepage_ad_title',
                'label'        => 'Ad Title / Sponsor Name',
                'name'         => 'homepage_ad_title',
                'type'         => 'text',
                'instructions' => 'e.g. "Proudly sponsored by Acme Corp"',
            ),
            array(
                'key'           => 'field_strata_homepage_ad_image',
                'label'         => 'Ad Image',
                'name'          => 'homepage_ad_image',
                'type'          => 'image',
                'instructions'  => 'Recommended: 680 × 400 px.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'          => 'field_strata_homepage_ad_url',
                'label'        => 'Ad Destination URL',
                'name'         => 'homepage_ad_url',
                'type'         => 'url',
                'instructions' => 'Full URL including https://',
            ),
            array(
                'key'          => 'field_strata_homepage_ad_description',
                'label'        => 'Ad Description (optional)',
                'name'         => 'homepage_ad_description',
                'type'         => 'textarea',
                'rows'         => 2,
            ),
            array(
                'key'          => 'field_strata_homepage_ad_cta_text',
                'label'        => 'Call-to-Action Text (optional)',
                'name'         => 'homepage_ad_cta_text',
                'type'         => 'text',
                'instructions' => 'e.g. "Learn More" or "Visit Site"',
            ),

            // ── FOOTER PROMO ──────────────────────────────────────────
            array(
                'key'   => 'field_strata_ad_tab_footer',
                'label' => 'Footer Promo Ad',
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_strata_footer_ad_enabled',
                'label'        => 'Ad Enabled',
                'name'         => 'footer_ad_enabled',
                'type'         => 'true_false',
                'instructions' => 'Toggle on to show this ad above the site footer.',
                'ui'           => 1,
                'default_value'=> 0,
            ),
            array(
                'key'          => 'field_strata_footer_ad_title',
                'label'        => 'Ad Title / Sponsor Name',
                'name'         => 'footer_ad_title',
                'type'         => 'text',
            ),
            array(
                'key'           => 'field_strata_footer_ad_image',
                'label'         => 'Ad Image',
                'name'          => 'footer_ad_image',
                'type'          => 'image',
                'instructions'  => 'Recommended: 520 × 320 px.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ),
            array(
                'key'          => 'field_strata_footer_ad_url',
                'label'        => 'Ad Destination URL',
                'name'         => 'footer_ad_url',
                'type'         => 'url',
            ),
            array(
                'key'          => 'field_strata_footer_ad_description',
                'label'        => 'Ad Description (optional)',
                'name'         => 'footer_ad_description',
                'type'         => 'textarea',
                'rows'         => 2,
            ),
            array(
                'key'          => 'field_strata_footer_ad_cta_text',
                'label'        => 'Call-to-Action Text (optional)',
                'name'         => 'footer_ad_cta_text',
                'type'         => 'text',
            ),
        ),
        // Location: show this meta box only on the static front page.
        // In WP Admin → Settings → Reading, "Your homepage" must be
        // set to a static page for this rule to match.
        'location' => array(
            array(
                array(
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ),
            ),
        ),
    ) );
}