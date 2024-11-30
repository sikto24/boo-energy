<?php
/**
 * The template for displaying search results pages
 *
 * @package Boo_Energy
 */

get_header();

$search_query = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
$post_types = get_post_types( array( 'public' => true ), 'objects' );
$posts_per_page = get_option( 'posts_per_page' );

// Count posts per type
$post_type_counts = array(
	'posts' => 0,
	'pages' => 0,
);
foreach ( $post_types as $post_type => $post_type_object ) {
	$group = ( $post_type === 'page' ) ? 'pages' : 'posts';
	$args = array(
		's' => $search_query,
		'post_type' => $post_type,
		'posts_per_page' => $posts_per_page,
	);
	$query = new WP_Query( $args );
	if ( $query->found_posts > 0 ) {
		$post_type_counts[ $group ] += $query->found_posts;
	}
	wp_reset_postdata();
}

$countFindPosts = array_sum( $post_type_counts );

// Determine selected post type
$selected_post_type = isset( $_GET['post_type'] ) && array_key_exists( $_GET['post_type'], $post_types )
	? sanitize_text_field( $_GET['post_type'] )
	: array_keys( $post_types );

// Fetch search results
$args = [ 
	's' => $search_query,
	'post_type' => $selected_post_type,
	'posts_per_page' => $posts_per_page,
	'paged' => max( 1, get_query_var( 'paged' ) ),
];
$search_results = new WP_Query( $args );
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
									<a class="<?php echo empty( $_GET['post_type'] ) ? 'search-filter-active' : ''; ?>"
										href="<?php echo add_query_arg( [ 's' => $search_query ], get_search_link() ); ?>">
										<?php echo esc_html__( 'Alla', 'boo-energy' ) . ' (' . esc_html( $countFindPosts ) . ')'; ?>
									</a>
								</li>
								<?php if ( 0 < $post_type_counts['pages'] && 0 < $post_type_counts['posts'] ) : ?>
									<li>
										<a class="<?php echo ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'page' ) ? 'search-filter-active' : ''; ?>"
											href="<?php echo add_query_arg( [ 's' => $search_query, 'post_type' => 'page' ], get_search_link() ); ?>">
											<?php echo esc_html__( 'Sidor', 'boo-energy' ) . ' (' . esc_html( $post_type_counts['pages'] ) . ')'; ?>
										</a>
									</li>
									<li>
										<a class="<?php echo ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'post' ) ? 'search-filter-active' : ''; ?>"
											href="<?php echo add_query_arg( [ 's' => $search_query, 'post_type' => 'post' ], get_search_link() ); ?>">
											<?php echo esc_html__( 'Artiklar', 'boo-energy' ) . ' (' . esc_html( $post_type_counts['posts'] ) . ')'; ?>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</section>
						<section class="search-result-area-wrapper" id="search-results">
							<div id="search-results-container">
								<?php
								if ( $search_results->have_posts() ) :
									while ( $search_results->have_posts() ) :
										$search_results->the_post();
										get_template_part( 'template-parts/content', 'search' );
									endwhile;

									// Pagination
									echo '<div class="boo-basic-pagination">';
									echo paginate_links( [ 
										'total' => $search_results->max_num_pages,
										'current' => max( 1, get_query_var( 'paged' ) ),
										'prev_text' => '&laquo;',
										'next_text' => '&raquo;',
										'add_args' => [ 
											's' => $search_query,
											'post_type' => isset( $_GET['post_type'] ) ? sanitize_text_field( $_GET['post_type'] ) : '',
										],
									] );
									echo '</div>';

									wp_reset_postdata();
								else :
									get_template_part( 'template-parts/content', 'none' );
								endif;
								?>
							</div>
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