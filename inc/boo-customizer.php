<?php
function boo_custom_customizer( $wp_customize ) {
	boo_general_options( $wp_customize );
	boo_social_options( $wp_customize );
}

add_action( 'customize_register', 'boo_custom_customizer' );

// General Options
function boo_general_options( $wp_customize ) {
	$wp_customize->add_panel(
		'boo_theme_panel',
		array(
			'title'       => esc_html__( 'Boo Theme Panel', 'boo-energy' ),
			'description' => esc_html__( 'Custom Panel For Boo Energy', 'boo-energy' ),
			'priority'    => '10',
		)
	);

	$wp_customize->add_section(
		'boo_general_section',
		array(
			'title'       => esc_html__( 'General Options', 'boo-energy' ),
			'description' => esc_html__( 'Here you find all options for Boo Energy', 'boo-energy' ),
			'panel'       => 'boo_theme_panel',
		)
	);

	$wp_customize->add_setting(
		'boo_preloader_switcher',
		array(
			'default'   => false,
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'boo_preloader_switch_control',
			array(
				'label'       => esc_html__( 'Enable Preloader', 'boo-energy' ),
				'description' => esc_html__( 'Enable or disable the preloader for the theme', 'boo-energy' ),
				'section'     => 'boo_general_section',
				'settings'    => 'boo_preloader_switcher',
				'type'        => 'checkbox',
			),
		)
	);
}

// Social Options
function boo_social_options( $wp_customize ) {
	// Add Social Section
	$wp_customize->add_section(
		'boo_social_section',
		array(
			'title'       => esc_html__( 'Social Links', 'boo-energy' ),
			'description' => esc_html__( 'Add Social Links for Boo Energy', 'boo-energy' ),
			'panel'       => 'boo_theme_panel',
		)
	);

	// Add Setting for LinkedIn
	$wp_customize->add_setting(
		'boo_social_linkedin_link',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	// Add LinkedIn Control
	$wp_customize->add_control(
		'boo_social_linkedin_link',
		array(
			'label'    => esc_html__( 'LinkedIn URL', 'boo-energy' ),
			'section'  => 'boo_social_section',
			'settings' => 'boo_social_linkedin_link',
			'type'     => 'url',
		)
	);

	// Add Setting for Facebook
	$wp_customize->add_setting(
		'boo_social_facebook_link',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	// Add Facebook Control
	$wp_customize->add_control(
		'boo_social_facebook_link',
		array(
			'label'    => esc_html__( 'Facebook URL', 'boo-energy' ),
			'section'  => 'boo_social_section',
			'settings' => 'boo_social_facebook_link',
			'type'     => 'url',
		)
	);
}

add_action( 'customize_register', 'boo_social_options' );
