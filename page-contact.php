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
            require_once get_template_directory() . '/components/contact-form.php';
            render_contact_form();
            ?>
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
            </div>
        </aside>

    </div><!-- /.ip-two-col.contact-layout -->
</div><!-- /.container -->

<?php get_footer(); ?>
