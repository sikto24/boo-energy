<?php
/**
 * The main template file for Boo Energy theme with custom loop structure
 *
 * @package Boo_Energy
 */

get_header();
global $wp_query;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => get_option( 'posts_per_page' ),
);
$max_pages = $wp_query->max_num_pages;
$categories = get_categories();
$custom_query = new WP_Query( $args );
?>

<section class="blog-area-wrapper m-p-32 d-p-120">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="post-filter-wrapper d-pb-32 m-pb-24">
					<ul>
						<li><a href="#" data-slug="all"><?php echo esc_html__( 'Allt om el', 'boo-energy' ); ?></a></li>
						<?php foreach ( $categories as $category ) : ?>
							<li><a href="#"
									data-slug="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-12 blog-post-items blog-padding">
				<div id="blog-postbox-main" class="boo-postbox-wrapper blog-featured-posts">
					<?php if ( $custom_query->have_posts() ) : ?>
						<?php
						if ( is_home() && ! is_front_page() ) : ?>

						<?php endif; ?>

						<?php
						// Custom Loop for Non-Single Pages
						if ( ! is_single() ) :
							$post_count = 0;
							while ( $custom_query->have_posts() ) :
								$custom_query->the_post();
								$post_count++;

								if ( $post_count <= 5 ) :
									get_template_part( 'template-parts/blog/content-blog' );

								elseif ( $post_count === 6 ) : ?>
								</div>
								<div class="boo-postbox-pagination load-more-btn-posts-frist text-center d-pt-32">
									<a href="#" id="load-more-post-cat" class="boo-btn link-large"
										data-max-pages="<?php echo $max_pages; ?>">
										<?php echo esc_html__( 'Ladda fler', 'boo-energy' ); ?>
									</a>
								</div>
								<section aria-labelledby="Boo-skolan" class="boo-post-inner-section-wrapper d-p-88">
									<div class="row">
										<div class="col-md-7 col-sm-12">
											<div class="boo-post-inner-section-top">
												<h2><?php echo esc_html__( 'Lär dig allt du behöver vet om energi i Boo-skolan', 'boo-energy' ); ?>
												</h2>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div id="boo-posts-inner-section" class="boo-post-inner-section-posts boo-postbox-wrapper">
												<?php
												$arg = array(
													'post_type' => 'skolan',
													'posts_per_page' => '3',
												);
												$skolan_posts = new WP_Query( $arg );
												if ( $skolan_posts->have_posts() ) :
													while ( $skolan_posts->have_posts() ) :
														$skolan_posts->the_post();
														get_template_part( 'template-parts/blog/content-blog' );

													endwhile;
													wp_reset_postdata();
												endif;
												?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="boo-postbox-pagination d-flex justify-content-center">
												<a href="<?php echo home_url( '/' ) . 'skolan/'; ?>"
													class="boo-btn boo-btn-white link-large">
													<?php echo esc_html__( 'Till Boo-skolan', 'boo-energy' ); ?>
												</a>

											</div>
										</div>
									</div>
								</section>
								<div id="boo-load-more-posts" class="boo-postbox-wrapper">

									<?php
									get_template_part( 'template-parts/blog/content-blog' );

								else :
									get_template_part( 'template-parts/blog/content-blog' );
								endif;

							endwhile;

							// Pagination
							?>
						</div>
						<div class="boo-postbox-pagination load-more-btn-posts-second text-center d-pt-32">
							<a href="#" id="load-more-post-btn" class="boo-btn link-large"
								data-max-pages="<?php echo $max_pages; ?>">
								<?php echo esc_html__( 'Ladda fler', 'boo-energy' ); ?>
							</a>
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

<?php get_template_part( 'template-parts/blog/section-boo-studion' ); ?>
<?php
get_footer();