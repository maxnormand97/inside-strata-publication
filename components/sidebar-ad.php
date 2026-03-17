<?php
/**
 * Sidebar Ad Component — The Strata Review
 *
 * Renders the sticky sidebar ad on single article pages.
 * This is a named wrapper around render_ad_slot() so templates
 * have a clear, readable call — and so the sidebar slot can be
 * styled independently via .ad-slot--sidebar in style.css.
 *
 * Marketing: WP Admin → Settings → Advertisement Settings → Article Sidebar Ad
 */

if ( ! function_exists( 'render_sidebar_ad' ) ) :

function render_sidebar_ad() {
    require_once get_template_directory() . '/components/ad-slot.php';
    render_ad_slot( array( 'slot' => 'sidebar' ) );
}

endif;
