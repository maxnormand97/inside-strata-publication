<?php
/**
 * Reusable newsletter signup component for The Strata Review theme.
 *
 * Usage:
 * include get_template_directory() . '/components/newsletter-signup.php';
 * render_newsletter_signup_section();
 */

if ( ! function_exists( 'render_newsletter_signup_section' ) ) {
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
				<form
					action="https://thestratareview.us5.list-manage.com/subscribe/post?u=1a2a1598efd23f7e3cff9a5f2&amp;id=efa4ae527a&amp;f_id=0066c6e1f0"
					method="post"
					id="mc-embedded-subscribe-form"
					name="mc-embedded-subscribe-form"
					target="_blank"
					novalidate
				>
					<label class="screen-reader-text" for="mce-EMAIL">
						<?php esc_html_e( 'Email address', 'inside-strata-theme' ); ?>
					</label>

					<input
						type="email"
						name="EMAIL"
						id="mce-EMAIL"
						placeholder="Your email address"
						required
						aria-label="<?php echo esc_attr__( 'Email address', 'inside-strata-theme' ); ?>"
					>

					<div aria-hidden="true" style="position:absolute; left:-5000px;">
						<input
							type="text"
							name="b_1a2a1598efd23f7e3cff9a5f2_efa4ae527a"
							tabindex="-1"
							value=""
						>
					</div>

					<button type="submit" name="subscribe" id="mc-embedded-subscribe">
						<?php esc_html_e( 'Subscribe', 'inside-strata-theme' ); ?>
					</button>
				</form>
			</div>
		</section>
		<?php
	}
}