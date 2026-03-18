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
            <?php
            $form_output = do_shortcode( '[mc4wp_form]' );
            if ( $form_output ) {
                echo $form_output;
            } else {
                echo '<p class="newsletter-form__unavailable" style="color:rgba(255,255,255,0.75);font-size:0.85rem;margin:0;">Newsletter sign-up coming soon.</p>';
            }
            ?>
        </div>
    </section>
    <?php
}

?>