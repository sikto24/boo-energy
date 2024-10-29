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
	if ( is_front_page() ) {
		wp_enqueue_style( 'boo-slick-slider', BOO_THEME_CSS_DIR . 'slick.min.css', null, '1.8.1', 'all' );
	}
	wp_enqueue_style( 'boo-fonts', boo_fonts_url(), array(), '1.0.0' );
	wp_enqueue_style( 'boo-style', get_stylesheet_uri() );

	// all js
	wp_enqueue_script( 'bootstrap', BOO_THEME_JS_DIR . 'bootstrap.min.js', array( 'jquery' ), '5.0', true );
	if ( is_front_page() ) {
		wp_enqueue_script( 'boo-slick-slider', BOO_THEME_JS_DIR . 'slick.min.js', array( 'jquery' ), '1.8.1', true );
	}
	wp_enqueue_script( 'boo-main', BOO_THEME_JS_DIR . 'main.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'boo_theme_scripts' );

function boo_fonts_url() {
	$font_url = 'https://fonts.googleapis.com/css2?' . urlencode( 'family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap' );
	return $font_url;
}



// Boo Energy admin_custom_scripts
function boo_admin_custom_scripts() {
	wp_enqueue_media();
	wp_enqueue_style( 'customizer-style', BOO_THEME_URI . '/inc/css/customizer-style.css', array() );
	wp_enqueue_script( 'boo-admin-custom', BOO_THEME_URI . '/inc/js/admin_custom.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'boo-customizer', BOO_THEME_URI . '/inc/js/customizer.js', array( 'jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'boo_admin_custom_scripts' );
