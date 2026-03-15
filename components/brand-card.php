<?php
/**
 * Brand Card component for Our Brands section.
 *
 * @param array $brand [name, description, bg_image, url, logo (optional)]
 */
function render_brand_card( $brand ) {
    if ( empty( $brand['name'] ) || empty( $brand['url'] ) ) {
        return;
    }

    $bg_image = ! empty( $brand['bg_image'] ) ? 'background-image: linear-gradient(rgba(0,0,0,0.34), rgba(0,0,0,0.34)), url(' . esc_url( $brand['bg_image'] ) . ');' : 'background-color: #121212;';
    $logo_html = '';
    if ( ! empty( $brand['logo'] ) ) {
        $logo_html = '<div class="brand-card-logo"><img src="' . esc_url( $brand['logo'] ) . '" alt="' . esc_attr( $brand['name'] ) . ' logo"></div>';
    }
    ?>
    <article class="brand-card" style="<?php echo esc_attr( $bg_image ); ?>">
        <a class="brand-card-link" href="<?php echo esc_url( $brand['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Visit <?php echo esc_attr( $brand['name'] ); ?>">
            <div class="brand-card-overlay"></div>
            <div class="brand-card-inner">
                <?php echo $logo_html; ?>
                <h3 class="brand-card-title"><?php echo esc_html( $brand['name'] ); ?></h3>
                <?php if ( ! empty( $brand['description'] ) ) : ?>
                    <p class="brand-card-description"><?php echo esc_html( $brand['description'] ); ?></p>
                <?php endif; ?>
                <span class="brand-card-cta">Visit brand</span>
            </div>
        </a>
    </article>
    <?php
}
?>