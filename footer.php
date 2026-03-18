</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo-link">
                    <?php
                    $footer_logo_path = get_template_directory() . '/assets/images/logo-white.png';
                    $footer_logo_url  = get_template_directory_uri() . '/assets/images/logo-white.png';
                    if ( file_exists( $footer_logo_path ) ) : ?>
                        <img src="<?php echo esc_url( $footer_logo_url ); ?>" alt="The Strata Review logo" class="footer-logo">
                    <?php else : ?>
                        <span class="site-title footer-site-title">The Strata Review</span>
                    <?php endif; ?>
                </a>
                <p>The Strata Review delivers news, insights, and updates across the strata sector.</p>
            </div>
            <div class="footer-links-grid">
                <div class="footer-link-group">
                    <h4>Publication</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url('/latest-news') ); ?>">Latest News</a></li>
                        <li><a href="<?php echo esc_url( home_url('/industry-insights') ); ?>">Industry Insights</a></li>
                        <li><a href="<?php echo esc_url( home_url('/sponsored-posts') ); ?>">Sponsored Posts</a></li>
                        <li><a href="<?php echo esc_url( home_url('/our-brands') ); ?>">Our Brands</a></li>
                    </ul>
                </div>
                <div class="footer-link-group">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url('/about') ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( home_url('/contact') ); ?>">Contact</a></li>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-link-group">
                    <h4>Connect</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url('/newsletter') ); ?>">Newsletter</a></li>
                        <li><a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                        <li><a href="mailto:editor@stratareview.com">Email Us</a></li>
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
