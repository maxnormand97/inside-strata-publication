<?php
/**
 * Sponsored Brand Card Component
 *
 * @param array $brand Array with keys: name, description, logo (optional), url
 */
function render_sponsored_card( $brand ) {
    if ( empty( $brand['name'] ) || empty( $brand['url'] ) ) {
        return;
    }
    ?>
    <div class="sponsored-card">
        <a href="<?php echo esc_url( $brand['url'] ); ?>" target="_blank" rel="noopener noreferrer">
            <?php if ( ! empty( $brand['logo'] ) ) : ?>
                <div class="sponsored-logo">
                    <img src="<?php echo esc_url( $brand['logo'] ); ?>" alt="<?php echo esc_attr( $brand['name'] ); ?> logo">
                </div>
            <?php endif; ?>
            <div class="sponsored-content">
                <h3 class="sponsored-name"><?php echo esc_html( $brand['name'] ); ?></h3>
                <?php if ( ! empty( $brand['description'] ) ) : ?>
                    <p class="sponsored-description"><?php echo esc_html( $brand['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <?php
}
?>