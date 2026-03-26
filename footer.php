</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo-link">
                    <?php
                    $footer_logo_path = get_template_directory() . '/assets/images/logo-white.svg';
                    if ( file_exists( $footer_logo_path ) ) {
                        $footer_svg = file_get_contents( $footer_logo_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
                        $footer_svg = preg_replace( '/<\?xml[^?]*\?>\s*/i', '', $footer_svg );
                        $footer_svg = preg_replace( '/<svg\b/', '<svg class="footer-logo" role="img" aria-label="The Strata Review"', $footer_svg, 1 );
                        echo $footer_svg; // phpcs:ignore WordPress.Security.EscapeOutput
                    } else { ?>
                        <span class="site-title footer-site-title">The Strata Review</span>
                    <?php } ?>
                </a>
                <p class="footer-tagline">Trusted reporting on Australia&rsquo;s strata sector</p>
            </div>
            <div class="footer-links-grid">
                <div class="footer-link-group">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url('/about') ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( home_url('/contact') ); ?>">Contact</a></li>
                        <li><a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-link-group">
                    <h4>Connect</h4>
                    <ul>
                        <?php
                        // Set this to the publication's LinkedIn company page URL when ready.
                        // e.g. 'https://www.linkedin.com/company/the-strata-review'
                        // Leave empty to hide the link.
                        $strata_linkedin_url = '';
                        if ( ! empty( $strata_linkedin_url ) ) : ?>
                        <li><a href="<?php echo esc_url( $strata_linkedin_url ); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                        <?php endif; ?>
                        <li><a href="mailto:<?php echo esc_attr( STRATA_EMAIL_EDITORIAL ); ?>">Email Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">&copy; <?php echo esc_html(date('Y')); ?> The Strata Review. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url( home_url('/about') ); ?>">About</a>
                <a href="<?php echo esc_url( home_url('/contact') ); ?>">Contact</a>
                <a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
