<?php
$boo_studion = get_field( 'video_url' );


$arg = array(
	'posts_per_page' => '10',
	'post_type' => 'studion',
);
$boo_studions_posts = new WP_Query( $arg );
?>

<section class="boo-studion-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-lg-6 col-12">
				<div class="boo-studio-title">
					<h2 class="typography-h2-large">
						<?php echo esc_html__( 'Boo Studion', 'boo_energy' ); ?>
					</h2>
				</div>
				<div class="boo-studio-content">
					<p>
						<?php echo esc_html__( 'Utforska vår samling av videos och få en djupare förståelse för energi, hållbarhet och smarta lösningar för framtiden.', 'boo-energy' ); ?>
					</p>
				</div>
			</div>
		</div>

		<div class="boo-studion-video-carousel-wrapper d-pt-32 m-pt-24">
			<?php while ( $boo_studions_posts->have_posts() ) :
				$boo_studions_posts->the_post();
				$boo_video_url = get_field( 'video_url' );
				?>
				<div class="single-boo-studion-carousel">
					<div class="single-boo-studion-thumbnail">
						<a class="boo-video-play-btn mfp-iframe" href="<?php echo esc_url( $boo_video_url ); ?>">
							<?php the_post_thumbnail( 'large' ); ?>
						</a>
					</div>
					<div class="single-boo-studion-title">
						<h5><?php the_title(); ?></h5>
					</div>
					<div class="single-boo-studion-desc">
						<?php the_excerpt(); ?>
					</div>
					<div class="single-boo-studion-btn">
						<?php if ( $boo_video_url ) : ?>
							<a href="<?php echo esc_url( $boo_video_url ); ?>"
								class="post-video-url boo-video-play-btn mfp-iframe"><?php echo esc_html__( 'Spela video', 'boo-energy' ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

	</div>
</section>