<?php
/**
 * Sidebar Ad Component — The Strata Review
 *
 * Renders the Advanced Ads sidebar placement on single article pages.
 * Marketing: Advanced Ads › Placements › article_sidebar
 */

if ( ! function_exists( 'render_sidebar_ad' ) ) :

function render_sidebar_ad() {
    if ( ! function_exists( 'the_ad_placement' ) ) {
        return;
    }
    ob_start();
    the_ad_placement( 'article_sidebar' );
    $advanced_ad_sidebar = ob_get_clean();
    if ( empty( trim( $advanced_ad_sidebar ) ) ) {
        return;
    }
    ?>
    <aside class="ad-slot ad-slot--sidebar" aria-label="Sponsored content">
        <span class="ad-slot__label">Sponsored</span>
        <?php echo $advanced_ad_sidebar; ?>
    </aside>
    <?php
}

endif;
