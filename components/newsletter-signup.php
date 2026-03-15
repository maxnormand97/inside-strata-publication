<?php
/**
 * Reusable newsletter signup component for The Strata Review theme.
 *
 * Usage:
 * include get_template_directory() . '/components/newsletter-signup.php';
 * render_newsletter_signup_section();
 */

function render_newsletter_signup_section( $args = array() ) {
    $defaults = array(
        'heading' => 'Subscribe for updates',
        'text'    => 'Get the latest industry news, analysis, and exclusive insights delivered straight to your inbox.',
    );

    $args = wp_parse_args( $args, $defaults );
    ?>
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2><?php echo esc_html( $args['heading'] ); ?></h2>
            <p><?php echo esc_html( $args['text'] ); ?></p>
        </div>
        <div class="newsletter-form">
            <?php echo do_shortcode('[mc4wp_form]'); ?>
        </div>
    </section>
    <?php
}

?>