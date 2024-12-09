<?php

/**
 *  boo_social_icons_shortcode
 * @return bool|string
 */
function boo_social_icons_shortcode() {
	ob_start(); // Start output buffering
	?>
	<div class="footer-middle-social-share">
		<?php if ( ! empty( get_theme_mod( 'boo_social_instagram_link' ) ) ) : ?>
			<span>
				<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'boo_social_instagram_link' ) ); ?>">
					<img src="<?php echo BOO_THEME_IMG_DIR . 'instagram.svg'; ?>" alt="instagram">
				</a>
			</span>
		<?php endif; ?>
		<?php if ( ! empty( get_theme_mod( 'boo_social_facebook_link' ) ) ) : ?>
			<span>
				<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'boo_social_facebook_link' ) ); ?>">
					<img src="<?php echo BOO_THEME_IMG_DIR . 'facebook.svg'; ?>" alt="facebook">
				</a>
			</span>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean(); // Return the buffered output
}
add_shortcode( 'boo_social_icons', 'boo_social_icons_shortcode' );


function boo_store_shortcode() {
	ob_start();
	?>
	<div class="footer-top-app-store d-flex flex-column">
		<?php if ( ! empty( get_theme_mod( 'boo_footer_app_store_link_text' ) ) && ! empty( get_theme_mod( 'boo_footer_app_store_url' ) ) ) : ?>
			<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'boo_footer_app_store_url' ) ); ?>">
				<h4><?php echo esc_html__( get_theme_mod( 'boo_footer_app_store_link_text' ), 'boo-energy' ); ?></h4>
			</a>
		<?php endif; ?>

		<?php if ( ! empty( get_theme_mod( 'boo_footer_google_store_url' ) ) && ! empty( get_theme_mod( 'boo_footer_google_store_link_text' ) ) ) : ?>
			<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'boo_footer_google_store_url' ) ); ?>">
				<h4><?php echo esc_html__( get_theme_mod( 'boo_footer_google_store_link_text' ), 'boo-energy' ); ?></h4>
			</a>
		<?php endif; ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'boo_store', 'boo_store_shortcode' );
