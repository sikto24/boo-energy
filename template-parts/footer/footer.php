<!-- Start Boo CTA  -->
<?php if ( ! is_404() ) {
	get_template_part( 'template-parts/boo-footer-cta' );
} ?>
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
						<div class="footer-top-bottom-single-area footer-social-links-area">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-4' ) ) {
									dynamic_sidebar( 'footer-4' );
								}
								?>
							</div>
						</div>
						<div class="footer-top-bottom-single-area footer-top-bottom-single-area-end">
							<div class="footer-top-area-widget">
								<?php
								if ( is_active_sidebar( 'footer-5' ) ) {
									dynamic_sidebar( 'footer-5' );
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
					<?php echo do_shortcode( '[boo_store]' ); ?>
					<div class="footer-middle-share-area d-flex">
						<h6><?php echo esc_html__( 'Följ oss', 'boo-energy' ); ?></h6>
						<div class="footer-middle-social-share">
							<?php echo do_shortcode( '[boo_social_icons]' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-end-area">
			<div class="row">
				<div class="col-lg-5">
					<div class="footer-copy-left d-flex flex-row">

						<span>&copy;
							<?php echo esc_html__( bloginfo( 'site_name' ), 'boo-energy' ) . ' ' . get_the_date( 'Y' ); ?>
						</span>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-5',
								'menu_class' => 'copy-right-menu d-flex boo-reset-ul ',
							)
						);
						?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="footer-copy-right d-flex  flex-row">
						<span>Boo Energi ekonomisk förening: 714000-0204</span>
						<span>Boo Energi Försäljnings AB: 556492-3901</span>
						<span>Boo Energi AB: 556476-6243</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>
</footer>
<!-- End Footer  -->