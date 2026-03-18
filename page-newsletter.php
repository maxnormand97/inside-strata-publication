<?php
/**
 * Template Name: Newsletter Page
 *
 * Assign via Page Attributes → Template dropdown in WordPress admin,
 * or WordPress will auto-select it for the page with slug "newsletter".
 *
 * @package inside-strata-theme
 */

get_header();
?>

<div class="container">

    <!-- =========================================================
         HERO
         ========================================================= -->
    <section class="ip-hero" aria-label="Newsletter page hero">
        <div class="ip-hero__inner">
            <p class="ip-hero__eyebrow">Newsletter</p>
            <h1 class="ip-hero__title">Stay Ahead of the Strata Sector</h1>
            <p class="ip-hero__subtitle">
                The Strata Review newsletter delivers the week&rsquo;s most important
                news, policy updates, and industry analysis straight to your inbox &mdash; free, every Tuesday.
            </p>
        </div>
    </section>

    <!-- =========================================================
         WHY SUBSCRIBE + BENEFITS
         ========================================================= -->
    <div class="ip-two-col nl-intro-row">

        <section aria-label="Why subscribe">
            <h2>Why Subscribe?</h2>
            <p>
                The strata sector moves fast. Our weekly newsletter gives you a concise
                briefing on the stories that matter most, curated by our editorial team
                so you don&rsquo;t have to trawl dozens of sources.
            </p>
            <p>
                Whether you&rsquo;re a strata manager, body corporate committee member,
                property professional, or industry supplier &mdash; our newsletter keeps
                you informed, credible, and ahead of your peers.
            </p>
            <p>
                Join over 18,500 strata professionals who already start their week
                with The Strata Review newsletter.
            </p>
        </section>

        <div class="ip-card nl-benefits-card">
            <h3 class="ip-card__heading">What You&rsquo;ll Get</h3>
            <ul class="ip-benefit-list">
                <li>Top strata news stories of the week</li>
                <li>Policy &amp; legislative updates</li>
                <li>Expert opinion and analysis</li>
                <li>Building technology spotlights</li>
                <li>Legal &amp; compliance briefings</li>
                <li>Industry events &amp; announcements</li>
                <li>Exclusive subscriber-only content</li>
            </ul>
        </div>

    </div><!-- /.ip-two-col.nl-intro-row -->

    <!-- =========================================================
         SUBSCRIBE FORM
         ========================================================= -->
    <section class="nl-subscribe-section" aria-label="Subscribe to the newsletter" id="subscribe">

        <div class="nl-subscribe-box">
            <h2 class="nl-subscribe-box__heading">Subscribe for Free</h2>
            <p class="nl-subscribe-box__text">
                Join 18,500+ strata professionals. Delivered every Tuesday morning. Unsubscribe at any time.
            </p>

            <?php
            /*
             * TODO (Production): Replace the placeholder form below with your email
             * marketing shortcode, for example Mailchimp for WordPress (mc4wp):
             *   echo do_shortcode('[mc4wp_form id="200"]');
             *
             * The form below is visual-only for the demo and does not process submissions.
             */
            ?>

            <form class="nl-sub-form" method="post" action="">
                <label for="nl-email" class="screen-reader-text">Email address</label>
                <input
                    type="email"
                    id="nl-email"
                    name="nl_email"
                    required
                    placeholder="Enter your email address"
                    autocomplete="email"
                >
                <button type="submit" class="nl-sub-form__btn">Subscribe &rarr;</button>
            </form>

            <p class="nl-subscribe-box__disclaimer">
                Your privacy matters. We&rsquo;ll never share your details and you can opt out at any time.
                Read our <a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy Policy</a>.
            </p>
        </div>

    </section>

    <!-- =========================================================
         RECENT EDITIONS
         ========================================================= -->
    <section class="ip-section nl-editions-section" aria-label="Recent newsletter editions">
        <h2>Recent Editions</h2>
        <p>Here&rsquo;s a sample of what subscribers received in recent weeks.</p>

        <div class="nl-editions-grid">

            <div class="nl-edition-card">
                <p class="nl-edition-card__tag">Week of 9 March 2026</p>
                <h3 class="nl-edition-card__title">New Strata Levy Reform Bill Tabled in NSW Parliament</h3>
                <p class="nl-edition-card__desc">
                    State legislators introduced sweeping new reforms affecting levy calculations
                    and dispute resolution timelines across the sector. Our team breaks down what
                    managers and owners need to know.
                </p>
            </div>

            <div class="nl-edition-card">
                <p class="nl-edition-card__tag">Week of 2 March 2026</p>
                <h3 class="nl-edition-card__title">Building Defect Tribunal Rulings: What Managers Need to Know</h3>
                <p class="nl-edition-card__desc">
                    A recent wave of NCAT rulings has reshaped liability expectations for
                    developers and owners corporations. We summarise the key decisions and
                    their practical implications.
                </p>
            </div>

            <div class="nl-edition-card">
                <p class="nl-edition-card__tag">Week of 23 February 2026</p>
                <h3 class="nl-edition-card__title">PropTech Round-Up: Five Platforms Gaining Traction in Strata</h3>
                <p class="nl-edition-card__desc">
                    Our editorial team reviewed the technology platforms attracting investment
                    and adoption across the sector, from levy payment tools to digital AGM solutions.
                </p>
            </div>

        </div>
    </section>

    <!-- =========================================================
         CTA
         ========================================================= -->
    <section class="ip-cta ip-cta--brand" aria-label="Subscribe call to action">
        <div class="ip-cta__inner">
            <h2 class="ip-cta__heading">Don&rsquo;t Miss the Next Edition</h2>
            <p class="ip-cta__text">
                Subscribe now and join over 18,500 professionals who rely on
                The Strata Review to stay ahead.
            </p>
            <a href="#subscribe" class="ip-cta__btn">Subscribe for Free &rarr;</a>
        </div>
    </section>

</div><!-- /.container -->

<?php get_footer(); ?>
