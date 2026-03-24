<?php
/**
 * Template Name: About Page
 *
 * Used automatically for the page with slug "about", or can be
 * assigned manually via the Page Attributes → Template dropdown.
 *
 * @package inside-strata-theme
 */

get_header();
?>

<div class="container">

    <!-- =========================================================
         HERO
         ========================================================= -->
    <section class="about-hero" aria-label="About page hero">
        <div class="about-hero__inner">
            <p class="about-hero__eyebrow">About Us</p>
            <h1 class="about-hero__title">About The Strata Review</h1>
            <p class="about-hero__subtitle">
                Trusted reporting on the issues that shape Australia&rsquo;s strata sector &mdash;
                from policy and finance to technology and community.
            </p>
        </div>
    </section>

    <!-- =========================================================
         MISSION + WHAT WE COVER (two-column)
         ========================================================= -->
    <section class="about-section about-section--split" aria-label="Our mission">
        <div class="about-grid">

            <!-- Left: Mission -->
            <div class="about-grid__primary">
                <h2>Our Mission</h2>
                <p>
                    We are a dedicated online publication created for the strata community&mdash;bringing
                    together the people, ideas, and conversations shaping this evolving sector.
                </p>
                <p>
                    Our mission is simple: to inform, connect, and elevate the strata industry. We deliver
                    timely news, expert insights, and practical guidance for owners, committees, strata
                    managers, developers, and service providers alike. Whether it&rsquo;s legislative changes,
                    emerging trends, or on-the-ground challenges, we aim to provide clear, relevant coverage
                    that helps our readers stay ahead.
                </p>
                <p>
                    Strata living is becoming an increasingly important part of modern life. As communities
                    grow denser and more complex, the need for reliable information and thoughtful dialogue
                    has never been greater. We exist to support that need&mdash;offering a platform where
                    industry voices are heard, best practices are shared, and important issues are explored
                    in depth.
                </p>
                <p>
                    Independent, accessible, and community-focused, our publication is committed to
                    high-quality journalism that reflects the realities of strata living and management today.
                </p>
                <p><em>We&rsquo;re not just reporting on the industry&mdash;we&rsquo;re part of its ongoing story.</em></p>
            </div>

            <!-- Right: What We Cover card -->
            <div class="about-grid__secondary">
                <div class="about-card">
                    <h3 class="about-card__heading">What We Cover</h3>
                    <ul class="about-card__list">
                        <li>Strata policy &amp; legislation</li>
                        <li>Body corporate governance</li>
                        <li>Property technology &amp; innovation</li>
                        <li>Finance &amp; insurance</li>
                        <li>Building defects &amp; maintenance</li>
                        <li>Owner &amp; resident advocacy</li>
                        <li>Industry opinion &amp; analysis</li>
                        <li>Market trends &amp; data</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================
         CTA — newsletter signup
         ========================================================= -->
    <?php
    require_once get_template_directory() . '/components/newsletter-signup.php';
    render_newsletter_signup_section( array(
        'heading' => 'Stay Informed',
        'text'    => 'Get the latest strata news, analysis, and insights delivered straight to your inbox, free every week.',
    ) );
    ?>

</div><!-- .container -->

<?php get_footer(); ?>
