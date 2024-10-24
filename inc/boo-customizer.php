<?php
function boo_custom_customizer( $wp_customize ) {
	boo_general_options( $wp_customize );
	boo_typography_options( $wp_customize );
}

add_action( 'customize_register', 'boo_custom_customizer' );

// General Options
function boo_general_options( $wp_customize ) {
	$wp_customize->add_panel(
		'boo_theme_panel',
		array(
			'title' => esc_html__( 'Boo Theme Panel', 'boo-energy' ),
			'description' => esc_html__( 'Custom Panel For Boo Energy', 'boo-energy' ),
			'priority' => '10',
		)
	);

	$wp_customize->add_section(
		'boo_general_section',
		array(
			'title' => esc_html__( 'General Options', 'boo-energy' ),
			'description' => esc_html__( 'Here you find all options for Boo Energy', 'boo-energy' ),
			'panel' => 'boo_theme_panel',
		)
	);

	$wp_customize->add_setting(
		'boo_preloader_switcher',
		array(
			'default' => false,
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'boo_preloader_switch_control',
			array(
				'label' => esc_html__( 'Enable Preloader', 'boo-energy' ),
				'description' => esc_html__( 'Enable or disable the preloader for the theme', 'boo-energy' ),
				'section' => 'boo_general_section',
				'settings' => 'boo_preloader_switcher',
				'type' => 'checkbox',
			),
		)
	);
}

// Function for Typography Options
function boo_typography_options( $wp_customize ) {
	// Add Typography Section
	$wp_customize->add_section(
		'boo_typography_section',
		array(
			'title' => esc_html__( 'Typography Options', 'boo-energy' ),
			'description' => esc_html__( 'Typography settings for Boo Energy', 'boo-energy' ),
			'panel' => 'boo_theme_panel',
		)
	);

	// Add Font Size Setting
	$wp_customize->add_setting(
		'boo_font_size',
		array(
			'default' => '16px',
			'transport' => 'postMessage',
		)
	);

	// Add Font Size Control
	$wp_customize->add_control(
		'boo_font_size_control',
		array(
			'label' => esc_html__( 'Font Size', 'boo-energy' ),
			'section' => 'boo_typography_section',
			'settings' => 'boo_font_size',
			'type' => 'text',
		)
	);
}
