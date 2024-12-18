<?php

/**
 * boo_theme_scripts description
 *
 * @return [type] [description]
 */
function boo_theme_scripts() {
	/**
	 * all css
	 */
	wp_enqueue_style( 'bootstrap', BOO_THEME_CSS_DIR . 'bootstrap.min.css', null, '5.0', 'all' );
	wp_enqueue_style( 'boo-aniamtion', BOO_THEME_CSS_DIR . 'boo-custom-animation.css', null, null, 'all' );
	wp_enqueue_style( 'boo-main', BOO_THEME_CSS_DIR . 'style.css', null, null, 'all' );
	wp_enqueue_style( 'boo-spacing', BOO_THEME_CSS_DIR . 'boo-spacing.css', null, null, 'all' );
	if ( ! wp_is_mobile() ) {
		wp_enqueue_style( 'boo-megamenu', BOO_THEME_CSS_DIR . 'boo-megamenu.css', null, null, 'all' );
	}
	if ( is_front_page() || is_page( 'foretag' ) ) {
		wp_enqueue_style( 'boo-slick-slider', BOO_THEME_CSS_DIR . 'slick.min.css', null, '1.9.0', 'all' );
		wp_enqueue_style( 'boo-section-slider', BOO_THEME_CSS_DIR . 'boo-section-slider.css', array( 'boo-slick-slider' ), '1.0.0', 'all' );
	}
	wp_enqueue_style( 'boo-style', get_stylesheet_uri() );

	// CSS based on Section / Page
	if ( is_single() ) {
		wp_enqueue_style( 'boo-single-post', BOO_THEME_CSS_DIR . 'boo-single-post.css', null, '1.0.0', 'all' );
		wp_enqueue_style( 'magnific-popup', BOO_THEME_CSS_DIR . 'magnific-popup.min.css', null, '1.1.0', 'all' );
	}
	if ( is_home() && ! is_front_page() ) {
		wp_enqueue_style( 'boo-blog-css', BOO_THEME_CSS_DIR . 'boo-blog-post.css', null, '1.0.0', 'all' );
	}

	// all js
	wp_enqueue_script( 'bootstrap', BOO_THEME_JS_DIR . 'bootstrap.min.js', array( 'jquery' ), '5.0', true );
	if ( ! wp_is_mobile() ) {
		wp_enqueue_script( 'boo-megamenu', BOO_THEME_JS_DIR . 'boo-megamenu.js', array( 'jquery' ), '5.0', true );

	}

	wp_enqueue_script( 'boo-slick-slider', BOO_THEME_JS_DIR . 'slick.min.js', array( 'jquery' ), '1.9.0', true );
	wp_enqueue_script( 'boo-main', BOO_THEME_JS_DIR . 'main.js', array( 'jquery' ), false, true );


	// JS based on Section / Page
	if ( is_single() ) {
		wp_enqueue_script( 'magnific-popup', BOO_THEME_JS_DIR . 'jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	}

}
add_action( 'wp_enqueue_scripts', 'boo_theme_scripts' );



// Boo Energy admin_custom_scripts
function boo_admin_custom_scripts() {
	wp_enqueue_media();
	wp_enqueue_style( 'customizer-style', BOO_THEME_URI . '/inc/css/customizer-style.css', array() );
	wp_enqueue_script( 'boo-admin-custom', BOO_THEME_URI . '/inc/js/admin_custom.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'boo-customizer', BOO_THEME_URI . '/inc/js/customizer.js', array( 'jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'boo_admin_custom_scripts' );


