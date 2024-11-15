<?php
/**
 * The main template file for Boo Energy theme with custom loop structure
 *
 * @package Boo_Energy
 */

get_header();
?>

<section class="blog-area-wrapper d-p-88">
	<div class="container">
		<div class="row">
			<div class="col-12 blog-post-items blog-padding">
				<div class="boo-postbox-wrapper blog-featured-posts">
					<?php if ( have_posts() ) : ?>
						<?php
						if ( is_home() && ! is_front_page() ) : ?>

						<?php endif; ?>

						<?php
						// Custom Loop for Non-Single Pages
						if ( ! is_single() ) :
							$post_count = 0;
							while ( have_posts() ) :
								the_post();
								$post_count++;

								if ( $post_count <= 2 ) :
									get_template_part( 'template-parts/blog/content-blog' );

								elseif ( $post_count === 3 ) : ?>
								</div>
								<section class="special-section">
									Hello Section
								</section>
								<div class="boo-postbox-wrapper">

									<?php
									get_template_part( 'template-parts/blog/content-blog' );

								else :
									get_template_part( 'template-parts/blog/content-blog' );
								endif;

							endwhile;

							// Pagination
							?>
							<div class="boo-postbox-pagination">
								<?php boo_pagination(); ?>
							</div>
						</div>
					<?php endif; ?> <?php else :
						// No Posts Found Template
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>
			</div>
		</div>
	</div>
	</div>
</section>

<?php
get_footer();
