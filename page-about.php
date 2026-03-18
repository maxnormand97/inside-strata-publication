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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula
                    justo at urna hendrerit, vel commodo eros fringilla. Pellentesque habitant
                    morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    Suspendisse potential venenatis ligula, nec malesuada libero tincidunt at.
                </p>
                <p>
                    Curabitur euismod nulla a lorem dignissim, vel condimentum risus sodales.
                    Maecenas suscipit felis quis nisl finibus, vel condimentum lectus ullamcorper.
                    Duis fermentum nisi non augue hendrerit, in commodo nunc vehicula. Nam
                    tincidunt sapien a ante vehicula, at efficitur felis accumsan.
                </p>
                <p>
                    Vivamus lacinia odio vitae vestibulum vestibulum. Donec in efficitur leo,
                    in commodo orci. Proin eget tortor risus. Praesent sapien massa, convallis
                    a pellentesque nec, egestas non nisi. Curabitur non nulla sit amet nisl
                    tempus convallis quis ac lectus.
                </p>
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
         WHO WE ARE (full-width + team grid)
         ========================================================= -->
    <section class="about-section about-section--full" aria-label="Who we are">
        <h2>Who We Are</h2>
        <p>
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
            curae; Proin vel ante a orci tempus eleifend ut et magna. Lorem ipsum dolor sit
            amet, consectetur adipiscing elit. Vivamus luctus urna sed urna ultricies ac
            tempor dui sagittis.
        </p>
        <p>
            In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla
            fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel
            tempor. Sit amet cursus nisl aliquam. Aliquam malesuada ex eget condimentum
            venenatis. Nunc aliquet, angue in accumsan nec, pulvinar vitae arcu.
        </p>
        <p>
            Phasellus blandit leo ut odio. Nam sed est et nunc ullamcorper commodo vitae
            in arcu. Fusce porta lorem at lectus semper eu tincidunt dolor luctus. Cum
            sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
        </p>

        <div class="about-team-grid" aria-label="Team members">

            <div class="about-team-card">
                <div class="about-team-card__avatar" aria-hidden="true"></div>
                <p class="about-team-card__name">Alexandra Morris</p>
                <p class="about-team-card__role">Editor in Chief</p>
            </div>

            <div class="about-team-card">
                <div class="about-team-card__avatar" aria-hidden="true"></div>
                <p class="about-team-card__name">James Calloway</p>
                <p class="about-team-card__role">Senior Correspondent</p>
            </div>

            <div class="about-team-card">
                <div class="about-team-card__avatar" aria-hidden="true"></div>
                <p class="about-team-card__name">Priya Nair</p>
                <p class="about-team-card__role">Policy &amp; Finance Reporter</p>
            </div>

        </div>
    </section>

    <!-- =========================================================
         CTA
         ========================================================= -->
    <section class="about-cta" aria-label="Newsletter call to action">
        <div class="about-cta__inner">
            <h2 class="about-cta__heading">Stay Informed</h2>
            <p class="about-cta__text">
                Get the latest strata news, analysis, and insights delivered straight
                to your inbox, free every week.
            </p>
            <a href="#" class="about-cta__btn">Subscribe to our newsletter</a>
        </div>
    </section>

</div><!-- .container -->

<?php get_footer(); ?>
