<!-- Start Boo CTA  -->
<?php get_template_part( 'template-parts/boo-footer-cta' ); ?>
<!-- END Boo CTA  -->

<!-- Start Footer  -->
<footer class="footer-area-wrapper d-pt-88 m-pt-32">
	<div class="container">
		<div class="footer-top-area d-pt-32 d-pb-32 m-p-24">
			<div class="row d-pb-32 m-pb-24">
				<div class="col">
					<div class="footer-logo">
						<?php echo boo_header_logo(); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="footer-top-bottom-area-wrapper  d-flex">
						<div class="footer-top-bottom-single-area">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-1' ) ) {
									dynamic_sidebar( 'footer-1' );
								}
								?>
							</div>
						</div>
						<div class="footer-top-bottom-single-area">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-2' ) ) {
									dynamic_sidebar( 'footer-2' );
								}
								?>
							</div>
						</div>
						<div class="footer-top-bottom-single-area">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-3' ) ) {
									dynamic_sidebar( 'footer-3' );
								}
								?>
							</div>
						</div>
						<div class="footer-top-bottom-single-area">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-4' ) ) {
									dynamic_sidebar( 'footer-4' );
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-middle-area m-p-24 d-p-32">
			<div class="col">
				<div class="footer-middle-area-main d-flex">
					<div class="footer-middle-heading">
						<h6><?php echo esc_html__( 'Ladda ner', 'boo-energy' ); ?></h6>
					</div>
					<div class="footer-middle-app-store-img">
						<a href="#">
							<img src="<?php echo BOO_THEME_IMG_DIR . 'apple-store.svg'; ?>" alt="Apple Store">
						</a>
						<a href="#">
							<img src="<?php echo BOO_THEME_IMG_DIR . 'play-store.svg'; ?>" alt="Google Store">
						</a>
					</div>
					<div class="footer-middle-share-area d-flex">
						<h6><?php echo esc_html__( 'Följ oss', 'boo-energy' ); ?></h6>
						<div class="footer-middle-social-share">
							<?php if ( ! empty( get_theme_mod( 'boo_social_instagram_link' ) ) ) : ?>
								<span>
									<a target="_blank"
										href="<?php echo esc_url( get_theme_mod( 'boo_social_instagram_link' ) ); ?>">
										<img src="<?php echo BOO_THEME_IMG_DIR . 'instagram.svg'; ?>" alt="instagram">
									</a>
								</span>
							<?php endif; ?>
							<?php if ( ! empty( get_theme_mod( 'boo_social_facebook_link' ) ) ) : ?>
								<span>
									<a target="_blank"
										href="<?php echo esc_url( get_theme_mod( 'boo_social_facebook_link' ) ); ?>">
										<img src="<?php echo BOO_THEME_IMG_DIR . 'facebook.svg'; ?>" alt="facebook">
									</a>
								</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-end-area">
			<div class="col"></div>
		</div>
		<div class="footer-copy-right d-flex d-pt-32  m-p-24 d-pb-24">
			<span>&copy;
				<?php echo esc_html__( bloginfo( 'site_name' ), 'boo-energy' ) . ' ' . get_the_date( 'Y' ); ?>
			</span>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-5',
					'menu_class'     => 'copy-right-menu d-flex boo-reset-ul ',
				)
			);
			?>
		</div>
	</div>
</footer>
<!-- End Footer  -->