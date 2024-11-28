<?php
/**
 * The template for displaying search results pages
 *
 * @package Boo_Energy
 */

get_header();

$search_query = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
$post_types = get_post_types( array( 'public' => true ), 'objects' );

$post_type_counts = array();
foreach ( $post_types as $post_type => $post_type_object ) {
	$args = array(
		's' => $search_query,
		'post_type' => $post_type,
		'posts_per_page' => 10,
	);
	$query = new WP_Query( $args );
	if ( $query->found_posts > 0 ) {
		$post_type_counts[ $post_type ] = $query->found_posts;
	}
	wp_reset_postdata();
}

$countFindPosts = array_sum( $post_type_counts );
?>

<section class="search-result-wrapper">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="search-breadcrumb-area">
					<h2 class="typography-h2-large"><?php echo esc_html__( 'Sök på sidan', 'boo-energy' ); ?></h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<section class="search-area-result-main-wrapper">
					<div class="search-form-wrapper-main boo-search-bar">
						<p><?php esc_html_e( 'What are you looking for?', 'boo-energy' ); ?></p>
						<?php get_search_form(); ?>
					</div>
					<header class="page-header">
						<p class="typography-bread-large">
							<?php
							printf(
								esc_html__( 'Your search for %s returned %s results', 'boo-energy' ),
								'<span>“' . esc_html( $search_query ) . '”</span>',
								'<span>' . esc_html( $countFindPosts ) . '</span>'
							);
							?>
						</p>
					</header>
					<?php if ( $countFindPosts > 0 ) : ?>
						<section class="search-filter-tab-area-wrapper">
							<ul id="filter-tabs">
								<li>
									<a class="search-filter-active" href="#" data-post-type="all">
										<?php echo esc_html__( 'All', 'boo-energy' ) . ' (' . esc_html( $countFindPosts ) . ')'; ?>
									</a>
								</li>
								<?php foreach ( $post_type_counts as $post_type => $count ) : ?>
									<?php $label = $post_types[ $post_type ]->labels->name; ?>
									<li>
										<a href="#" data-post-type="<?php echo esc_attr( $post_type ); ?>">
											<?php echo esc_html( $label ) . ' (' . esc_html( $count ) . ')'; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</section>
						<section class="search-result-area-wrapper" id="search-results">
							<div id="search-results-container">
								<?php
								// Fetch initial search results
								$args = [ 
									's' => $search_query,
									'post_type' => array_keys( $post_types ),
									'posts_per_page' => 5,
								];

								$search_results = new WP_Query( $args );

								if ( $search_results->have_posts() ) :
									while ( $search_results->have_posts() ) :
										$search_results->the_post();
										get_template_part( 'template-parts/content', 'search' );
									endwhile;

									// Pagination
									echo '<div class="search-pagination">';
									echo paginate_links( [ 
										'total' => $search_results->max_num_pages,
										'current' => max( 1, get_query_var( 'paged' ) ),
										'prev_text' => '&laquo;',
										'next_text' => '&raquo;',
									] );
									echo '</div>';

									wp_reset_postdata();
								else :
									get_template_part( 'template-parts/content', 'none' );
								endif;
								?>
							</div>
							<div id="pagination-container"></div>
							<?php boo_pagination( $search_results ); ?>
						</section>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>