<?php
/**
 * Custom Breadcrumbs for the theme.
 *
 * @package     Boo_Energy
 * @author      Strativ
 * @copyright   Copyright (c) 2024, Sikto
 * @since       Boo_Energy 1.0.0
 */

// Define the breadcrumb markup
function boo_energy_breadcrumb_markup() {
	global $post;

	if ( is_single() && get_post_type() == 'post' ) {
		$single_blog_calendar = get_the_time( get_option( 'date_format' ) );
		$single_blog_class = 'single-blog-style';
	} else {
		$single_blog_calendar = '';
		$single_blog_class = '';
	}

	if ( is_single() ) {
		$title = get_the_title();
	} elseif ( is_home() ) {
		$title = esc_html__( 'Home', 'boo-energy' );
	} elseif ( is_search() ) {
		$title = esc_html__( 'Search Results for : ', 'boo-energy' ) . get_search_query();
	} elseif ( is_404() ) {
		$title = esc_html__( 'Page not Found', 'boo-energy' );
	} else {
		$title = get_the_title();
	}
	?>
	<section class="breadcrumb-area-wrapper section-gap <?php echo esc_attr( $single_blog_class ); ?>">
		<div class="container-xxl">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-area">
						<h1><?php echo $title; ?></h1>
						<?php
						if ( function_exists( 'bcn_display' ) ) {
							bcn_display();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}
// Conditionally add the breadcrumb markup for pages other than the front page
function add_breadcrumb_for_non_front_page() {
	if ( ! is_front_page() ) {
		add_action( 'boo_before_main_content', 'boo_energy_breadcrumb_markup' );
	}
}
add_action( 'wp', 'add_breadcrumb_for_non_front_page' );


