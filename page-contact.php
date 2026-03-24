<?php
/**
 * Template Name: Contact Page
 *
 * Assign via Page Attributes → Template dropdown in WordPress admin,
 * or WordPress will auto-select it for the page with slug "contact".
 *
 * @package inside-strata-theme
 */

get_header();
?>

<div class="container">

    <!-- =========================================================
         HERO
         ========================================================= -->
    <section class="ip-hero" aria-label="Contact page hero">
        <div class="ip-hero__inner">
            <p class="ip-hero__eyebrow">Contact</p>
            <h1 class="ip-hero__title">Get In Touch</h1>
            <p class="ip-hero__subtitle">
                Whether you have a story tip, editorial question, advertising enquiry,
                or just want to say hello &mdash; we&rsquo;d love to hear from you.
            </p>
        </div>
    </section>

    <!-- =========================================================
         FORM + CONTACT DETAILS
         ========================================================= -->
    <div class="ip-two-col contact-layout">

        <!-- LEFT: enquiry form -->
        <section aria-label="Enquiry form">
            <h2>Send Us a Message</h2>
            <p>Fill out the form below and a member of our team will be in touch within two business days.</p>

            <?php
            /*
             * TODO (Production): Replace this placeholder form with a Contact Form 7
             * or WPForms shortcode once the plugin is installed, e.g.:
             *   echo do_shortcode('[contact-form-7 id="100" title="General Enquiry"]');
             *
             * The form below is visual-only for the demo and does not process submissions.
             */
            ?>

            <form class="contact-form" method="post" action="">
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
                    <label for="cf-subject">Enquiry Type</label>
                    <select id="cf-subject" name="cf_subject">
                        <option value="">Select a subject&hellip;</option>
                        <option value="editorial">Editorial Enquiry</option>
                        <option value="advertising">Advertising &amp; Sponsorship</option>
                        <option value="newsletter">Newsletter</option>
                        <option value="tip">Story Tip</option>
                        <option value="general">General Enquiry</option>
                    </select>
                </div>

                <div class="contact-form__field">
                    <label for="cf-message">Message <span class="contact-form__req" aria-hidden="true">*</span></label>
                    <textarea id="cf-message" name="cf_message" required rows="6" placeholder="Tell us how we can help&hellip;"></textarea>
                </div>

                <button type="submit" class="contact-form__submit">Send Message &rarr;</button>
            </form>
        </section>

        <!-- RIGHT: contact details + office -->
        <aside class="contact-sidebar" aria-label="Contact information">

            <div class="ip-card">
                <h3 class="ip-card__heading">Contact Details</h3>
                <ul class="contact-details-list">
                    <li>
                        <span class="contact-details-list__label">Editorial</span>
                        <a href="mailto:<?php echo esc_attr( STRATA_EMAIL_EDITORIAL ); ?>"><?php echo esc_html( STRATA_EMAIL_EDITORIAL ); ?></a>
                    </li>
                    <li>
                        <span class="contact-details-list__label">Advertising</span>
                        <a href="mailto:<?php echo esc_attr( STRATA_EMAIL_ADVERTISING ); ?>"><?php echo esc_html( STRATA_EMAIL_ADVERTISING ); ?></a>
                    </li>
                    <li>
                        <span class="contact-details-list__label">General</span>
                        <a href="mailto:<?php echo esc_attr( STRATA_EMAIL_GENERAL ); ?>"><?php echo esc_html( STRATA_EMAIL_GENERAL ); ?></a>
                    </li>
                </ul>
            </div>

            <div class="ip-card">
                <h3 class="ip-card__heading">Our Office</h3>
                <address class="contact-address">
                    <strong>The Strata Review</strong><br>
                    Level 10, 123 Collins Street<br>
                    Melbourne VIC 3000<br>
                    Australia
                </address>
                <p class="contact-office-hours">Monday&ndash;Friday &nbsp;&bull;&nbsp; 9am&ndash;5pm AEST</p>
            </div>

        </aside>

    </div><!-- /.ip-two-col.contact-layout -->

    <!-- =========================================================
         CTA
         ========================================================= -->
    <section class="ip-cta" aria-label="Advertising prompt">
        <div class="ip-cta__inner">
            <h2 class="ip-cta__heading">Looking to Advertise?</h2>
            <p class="ip-cta__text">
                Reach Australia&rsquo;s strata professionals with targeted advertising
                across our digital publication and newsletter.
            </p>
            <a href="<?php echo esc_url( home_url('/advertise') ); ?>" class="ip-cta__btn">View Advertising Options &rarr;</a>
        </div>
    </section>

</div><!-- /.container -->

<?php get_footer(); ?>
