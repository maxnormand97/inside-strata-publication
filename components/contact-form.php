<?php
/**
 * Contact Form Component — The Strata Review
 *
 * Renders the enquiry form with nonce and honeypot protection.
 * Submissions post to admin-post.php and are processed by
 * strata_handle_contact_form() in functions.php.
 *
 * Success/error state is communicated via query args on redirect:
 *   ?sent=1           — message sent successfully
 *   ?error=validation — missing required fields or invalid email
 *   ?error=mail       — wp_mail() returned false
 */

if ( ! function_exists( 'render_contact_form' ) ) :

function render_contact_form() {
    $sent  = isset( $_GET['sent'] ) && '1' === $_GET['sent'];
    $error = $sent ? '' : ( isset( $_GET['error'] ) ? sanitize_key( wp_unslash( $_GET['error'] ) ) : '' );
    ?>

    <?php if ( $sent ) : ?>
        <div class="contact-form__notice contact-form__notice--success" role="alert">
            <p>Thanks for your message &mdash; we&rsquo;ll be in touch within two business days.</p>
        </div>
    <?php elseif ( 'validation' === $error ) : ?>
        <div class="contact-form__notice contact-form__notice--error" role="alert">
            <p>Please check your details &mdash; a name, valid email address, and message are all required.</p>
        </div>
    <?php elseif ( 'mail' === $error ) : ?>
        <div class="contact-form__notice contact-form__notice--error" role="alert">
            <p>Sorry, there was a problem sending your message. Please email us directly at
            <a href="mailto:<?php echo esc_attr( STRATA_EMAIL_EDITORIAL ); ?>"><?php echo esc_html( STRATA_EMAIL_EDITORIAL ); ?></a>.</p>
        </div>
    <?php endif; ?>

    <?php if ( ! $sent ) : ?>
    <form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

        <?php wp_nonce_field( 'strata_contact_submit', 'strata_contact_nonce' ); ?>
        <input type="hidden" name="action" value="strata_contact">

        <?php /* Honeypot: hidden from real users via CSS — bots that fill it are silently discarded */ ?>
        <div class="contact-form__hp" aria-hidden="true">
            <label for="cf-website">Leave this field blank</label>
            <input
                type="text"
                id="cf-website"
                name="cf_website"
                value=""
                tabindex="-1"
                autocomplete="off"
            >
        </div>

        <div class="contact-form__row">
            <div class="contact-form__field">
                <label for="cf-name">Full Name <span class="contact-form__req" aria-hidden="true">*</span></label>
                <input type="text" id="cf-name" name="cf_name" required autocomplete="name" placeholder="Jane Smith">
            </div>
            <div class="contact-form__field">
                <label for="cf-email">Email Address <span class="contact-form__req" aria-hidden="true">*</span></label>
                <input type="email" id="cf-email" name="cf_email" required autocomplete="email" placeholder="jane@example.com">
            </div>
        </div>

        <div class="contact-form__field">
            <label for="cf-message">Message <span class="contact-form__req" aria-hidden="true">*</span></label>
            <textarea id="cf-message" name="cf_message" required rows="6" placeholder="Tell us how we can help&hellip;"></textarea>
        </div>

        <button type="submit" class="contact-form__submit">Send Message &rarr;</button>

    </form>
    <?php endif; ?>

    <?php
}

endif;
