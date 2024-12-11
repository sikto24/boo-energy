<section class="footer-cta-area-wrapper d-flex align-items-center"
	style="background-image:url('/wp-content/uploads/2024/10/cta-shape.svg);">
	<div class="container">
		<div class="row footer-cta-area-row">
			<div class="col-xxl-5 col-xl-6   col-12">
				<div class="footer-cta-left">
					<?php if ( ! empty( get_theme_mod( 'boo_footer_cta_heading' ) ) ) : ?>
						<div class="footer-cta-title">
							<h1><?php echo esc_html( get_theme_mod( 'boo_footer_cta_heading' ) ); ?></h1>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( get_theme_mod( 'boo_footer_cta_desc' ) ) ) : ?>
						<div class="footer-cta-desc">
							<p><?php echo esc_html__( get_theme_mod( 'boo_footer_cta_desc' ), 'boo-energy' ); ?></p>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( get_theme_mod( 'boo_footer_cta_button_text' ) ) && ! empty( get_theme_mod( 'boo_footer_cta_button_url' ) ) ) : ?>
						<div class="footer-cta-button">
							<a href="<?php echo esc_url( get_theme_mod( 'boo_footer_cta_button_url' ) ); ?>"
								class="boo-btn"><?php echo esc_html__( get_theme_mod( 'boo_footer_cta_button_text' ), 'boo-energy' ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-xxl-7 col-xl-6   col-12">
				<div class="footer-cta-right d-flex justify-content-end align-items-center">
					<?php if ( ! empty( get_theme_mod( 'boo_footer_cta_img' ) ) ) : ?>
						<div class="footer-cta-right-img">
							<img src="<?php echo esc_url( get_theme_mod( 'boo_footer_cta_img' ) ); ?>"
								alt="<?php echo esc_html__( 'Boo Flag', 'boo-energy' ); ?>">
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>