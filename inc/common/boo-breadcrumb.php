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

	$enable_custom_page_title = ( get_field( "enable_custom_page_title" ) === true ) ? true : false;
	$boo_custom_page_title = ( true === $enable_custom_page_title ) ? get_field( 'page_title' ) : get_the_title();
	$enable_description = ( get_field( "enable_description" ) === true ) ? true : false;
	$page_description = get_field( "page_description" );
	$enable_breadcrumb_secendary_color = ( get_field( "enable_breadcrumb_secendary_color" ) === true ) ? true : false;

	$breadcrumb_bg_color = ( true === $enable_breadcrumb_secendary_color || is_single() ) ? 'var(--e-global-color-8ba6df9)' : 'var(--e-global-color-primary)';
	$pageTitleColor = ( true === $enable_breadcrumb_secendary_color || is_single() ) ? 'var(--e-global-color-1c78a44)' : 'var(--e-global-color-3de5e34)';

	$breadcrumb_bg_image = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url() : '/app/uploads/2024/11/breadcrumb-bg.svg';
	$breadcrumb_class = ( has_post_thumbnail() ) ? 'boo-single-post-breadcrumb' : 'boo-default-breadcrumb';
	global $post;

	if ( is_single() && get_post_type() == 'post' ) {
		// $single_blog_calendar = get_the_time( get_option( 'date_format' ) );
		$single_blog_class = 'single-blog-style';
		$single_boo_tag = get_tags();
	} else {
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


	<section style="background-color:<?php echo $breadcrumb_bg_color; ?>;"
		class="breadcrumb-area-wrapper  d-flex <?php echo esc_attr( $single_blog_class . ' ' . $breadcrumb_class ) ?>">
		<div class="breadcrumb-area section_px_left">
			<?php if ( has_tag() && ! empty( $single_boo_tag ) ) : ?>
				<div class="boo-tag">
					<h5><?php echo esc_html__( $single_boo_tag[0]->name ); ?></h5>
				</div>
			<?php endif; ?>
			<h1 style="color:<?php echo $pageTitleColor; ?>"><?php echo esc_html__( $boo_custom_page_title ); ?>
			</h1>
			<?php
			if ( 'true' == $enable_description ) {
				echo wpautop( $page_description );
			}
			?>
		</div>
		<div class="breadcrumb-area-img d-flex justify-content-end">
			<img src="<?php echo esc_html__( $breadcrumb_bg_image ); ?>"
				alt="<?php echo esc_attr( $boo_custom_page_title ); ?>">
		</div>
	</section>
	<?php
}
// Conditionally add the breadcrumb markup for pages other than the front page
function add_breadcrumb_for_non_front_page() {
	if ( ! is_front_page() && ! is_page( 'foretag' ) && 'elementor_header_footer' !== get_page_template_slug() ) {
		add_action( 'boo_before_main_content', 'boo_energy_breadcrumb_markup' );
	}
}
add_action( 'wp', 'add_breadcrumb_for_non_front_page' );




function boo_search_mockup() {
	?>


	<div class="boo-search-bar-area-wrapper">
		<div class="row boo-search-bar-top">
			<div class="col-md-8 col-12">
				<div class="search-bar-top-left">
					<h6>Vad letar du efter?</h6>
				</div>
			</div>
			<div class="col-md-4 col-12">
				<div class="search-bar-top-right justify-content-end d-flex">
					<span class="search-close-btn">Stäng X</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="boo-search-bar">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>


	<?php
}
add_action( 'boo_before_main_content', 'boo_search_mockup' );


