<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package boo-energy
 */

get_header();


?>

<section class="boo-post-area-wrapper single-blog-view-main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-7 col-lg-8 col-md-12 col-12 ">
				<div class="boo-postbox-wrapper">
					<div class="boo_postbox__wrapper boo-single-post blog__wrapper postbox__details">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', get_post_format() );

							?>

							<?php
							if ( get_previous_post_link() and get_next_post_link() ) :
								?>

								<div class="blog-details-border d-none">
									<div class="row align-items-center">
										<?php
										if ( get_previous_post_link() ) :
											?>
											<div class="col-lg-6 col-md-6">
												<div class="theme-navigation b-next-post text-left">
													<span><?php echo esc_html__( 'Prev Post', 'boo-energy' ); ?></span>
													<h4><?php echo get_previous_post_link( '%link ', '%title' ); ?></h4>
												</div>
											</div>
											<?php
										endif;
										?>

										<?php
										if ( get_next_post_link() ) :
											?>
											<div class="col-lg-6 col-md-6">
												<div class="theme-navigation b-next-post text-left text-md-right">
													<span><?php print esc_html__( 'Next Post', 'boo-energy' ); ?></span>
													<h4><?php print get_next_post_link( '%link ', '%title' ); ?></h4>
												</div>
											</div>
											<?php
										endif;
										?>

									</div>
								</div>

								<?php
							endif;
							?>
							<?php

							// get_template_part( 'template-parts/biography' );
						
							// If comments are open or we have at least one comment, load up the comment template.
							// if ( comments_open() || get_comments_number() ) :
							// 	comments_template();
							// endif;
						
						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Start Related Blog Posts -->
<?php
get_template_part( 'template-parts/blog/content-related-blog' );
?>
<!-- END Related Blog Posts -->

<?php
get_footer();