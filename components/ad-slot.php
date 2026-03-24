<?php
/**
 * Ad Slot Component — The Strata Review
 *
 * ACF Free architecture — no options pages.
 *
 * Storage locations per slot:
 *   homepage  — static front page (Home page editor)
 *   footer    — static front page (Home page editor)
 *   sidebar   — "Ad Settings" page (slug: ad-settings)
 *   inline    — "Ad Settings" page (slug: ad-settings)
 *
 * Field naming convention: {slot}_ad_{field}
 *   e.g. sidebar_ad_enabled, sidebar_ad_title, sidebar_ad_image
 */

if ( ! function_exists( 'render_ad_slot' ) ) :

function render_ad_slot( $args = array() ) {
    $slot  = isset( $args['slot'] )  ? sanitize_key( $args['slot'] ) : '';
    $class = isset( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '';

    // Graceful no-op if ACF is not active or no slot was specified.
    if ( ! function_exists( 'get_field' ) || empty( $slot ) ) {
        return;
    }

    // Resolve the correct post ID source for each slot.
    // homepage + footer: static front page.
    // sidebar + inline:  the "Ad Settings" page (ACF Free stand-in for
    //                    a global settings page, located by slug).
    if ( in_array( $slot, array( 'homepage', 'footer' ), true ) ) {
        $source = (int) get_option( 'page_on_front' );
    } else {
        static $ad_settings_id = null;
        if ( null === $ad_settings_id ) {
            $ad_settings_page = get_page_by_path( 'ad-settings' );
            $ad_settings_id   = $ad_settings_page ? (int) $ad_settings_page->ID : 0;
        }
        $source = $ad_settings_id;
    }

    if ( ! $source ) {
        return;
    }

    $enabled     = get_field( $slot . '_ad_enabled',     $source );
    $title       = get_field( $slot . '_ad_title',       $source );
    $image       = get_field( $slot . '_ad_image',       $source );
    $url         = get_field( $slot . '_ad_url',         $source );
    $description = get_field( $slot . '_ad_description', $source );
    $cta_text    = get_field( $slot . '_ad_cta_text',    $source );

    // Respect the enabled toggle; also skip if there is nothing to display.
    if ( ! $enabled || ( ! $title && empty( $image ) ) ) {
        return;
    }

    $url_attr  = $url ? esc_url( $url ) : '';
    $has_image = ! empty( $image['url'] );
    $img_alt   = $has_image && ! empty( $image['alt'] ) ? $image['alt'] : $title;
    ?>


    <aside
        class="ad-slot ad-slot--<?php echo esc_attr( $slot ); ?><?php echo $class; ?>"
        aria-label="Sponsored content"
    >
        <span class="ad-slot__label">Sponsored</span>

        <?php if ( $url_attr ) : ?>
        <a
            href="<?php echo esc_url( $url ); ?>"
            class="ad-slot__inner js-ad-link"
            target="_blank"
            rel="noopener nofollow sponsored"
            aria-label="<?php echo esc_attr( $title ); ?> — sponsored link, opens in new tab"
            data-ad-slot="<?php echo esc_attr( $slot ); ?>"
            data-ad-title="<?php echo esc_attr( $title ); ?>"
            data-ad-url="<?php echo esc_url( $url ); ?>"
        >
        <?php else : ?>
        <div class="ad-slot__inner">
        <?php endif; ?>

            <?php if ( $has_image ) : ?>
            <div class="ad-slot__image-wrap">
                <?php if ( ! empty( $image['id'] ) ) : ?>
                    <?php echo wp_get_attachment_image( (int) $image['id'], 'card-medium', false, array(
                        'alt'     => $img_alt,
                        'loading' => 'lazy',
                        'class'   => 'ad-slot__image',
                    ) ); ?>
                <?php else : ?>
                <img
                    src="<?php echo esc_url( $image['url'] ); ?>"
                    alt="<?php echo esc_attr( $img_alt ); ?>"
                    loading="lazy"
                    class="ad-slot__image"
                >
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="ad-slot__content">
                <?php if ( $title ) : ?>
                <p class="ad-slot__title"><?php echo esc_html( $title ); ?></p>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                <p class="ad-slot__description"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>

                <?php if ( $cta_text ) : ?>
                <span class="ad-slot__cta"><?php echo esc_html( $cta_text ); ?> &rarr;</span>
                <?php endif; ?>
            </div>

        <?php if ( $url_attr ) : ?></a><?php else : ?></div><?php endif; ?>

    </aside>
    <?php
}

endif;
