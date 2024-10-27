<?php
function boo_custom_customizer( $wp_customize ) {
	// Main Panel
	$wp_customize->add_panel(
		'boo_theme_panel',
		array(
			'title'       => esc_html__( 'Boo Theme Panel', 'boo-energy' ),
			'description' => esc_html__( 'Custom Panel for Boo Energy', 'boo-energy' ),
			'priority'    => 10,
		)
	);

	// Call sub-functions to add sections and settings
	boo_general_options( $wp_customize );
	boo_social_options( $wp_customize );
	boo_footer_options( $wp_customize );
}
add_action( 'customize_register', 'boo_custom_customizer' );

// General Options
function boo_general_options( $wp_customize ) {
	$wp_customize->add_section(
		'boo_general_section',
		array(
			'title'       => esc_html__( 'General Options', 'boo-energy' ),
			'description' => esc_html__( 'General settings for Boo Energy', 'boo-energy' ),
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
			)
		)
	);
}

// Social Options
function boo_social_options( $wp_customize ) {
	$wp_customize->add_section(
		'boo_social_section',
		array(
			'title'       => esc_html__( 'Social Links', 'boo-energy' ),
			'description' => esc_html__( 'Add social links for Boo Energy', 'boo-energy' ),
			'panel'       => 'boo_theme_panel',
		)
	);

	// Instagram
	$wp_customize->add_setting(
		'boo_social_instagram_link',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'boo_social_instagram_link',
		array(
			'label'   => esc_html__( 'Instagram URL', 'boo-energy' ),
			'section' => 'boo_social_section',
			'type'    => 'url',
		)
	);

	// Facebook
	$wp_customize->add_setting(
		'boo_social_facebook_link',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'boo_social_facebook_link',
		array(
			'label'   => esc_html__( 'Facebook URL', 'boo-energy' ),
			'section' => 'boo_social_section',
			'type'    => 'url',
		)
	);
}

// Footer Options
function boo_footer_options( $wp_customize ) {
	// Footer Section
	$wp_customize->add_section(
		'boo_footer_section',
		array(
			'title'       => esc_html__( 'Footer', 'boo-energy' ),
			'description' => esc_html__( 'Options for the footer area of Boo Energy', 'boo-energy' ),
			'panel'       => 'boo_theme_panel',
		)
	);

	// Footer CTA Heading
	$wp_customize->add_setting(
		'boo_footer_cta_heading',
		array(
			'default'   => 'Vi är stolta över att vara små',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'boo_footer_cta_heading',
		array(
			'label'       => esc_html__( 'Heading', 'boo-energy' ),
			'description' => esc_html__( 'Add a custom footer call-to-action heading.', 'boo-energy' ),
			'section'     => 'boo_footer_section',
			'type'        => 'text',
		)
	);

	// Footer CTA Description
	$wp_customize->add_setting(
		'boo_footer_cta_desc',
		array(
			'default'   => 'Vi är lokalt förankrade i Saltsjöö-Boo men tillgängliga för hela Sverige',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'boo_footer_cta_desc',
		array(
			'label'       => esc_html__( 'Details', 'boo-energy' ),
			'description' => esc_html__( 'Add a custom footer call-to-action details.', 'boo-energy' ),
			'section'     => 'boo_footer_section',
			'type'        => 'textarea',
		)
	);

	// Footer CTA Image
	$wp_customize->add_setting(
		'boo_footer_cta_img',
		array(
			'default'   => BOO_THEME_IMG_DIR . 'boo-energy-flag.svg',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'boo_footer_cta_img',
			array(
				'label'       => esc_html__( 'Image', 'boo-energy' ),
				'description' => esc_html__( 'Add a custom footer call-to-action image.', 'boo-energy' ),
				'section'     => 'boo_footer_section',
				'settings'    => 'boo_footer_cta_img',
			)
		)
	);

	// Footer CTA Button Text
	$wp_customize->add_setting(
		'boo_footer_cta_button_text',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'boo_footer_cta_button_text',
		array(
			'label'       => esc_html__( 'Button', 'boo-energy' ),
			'description' => esc_html__( 'Add a custom footer call-to-action button text.', 'boo-energy' ),
			'section'     => 'boo_footer_section',
			'type'        => 'text',
		)
	);

	// Footer CTA Button URL
	$wp_customize->add_setting(
		'boo_footer_cta_button_url',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'boo_footer_cta_button_url',
		array(
			'label'       => esc_html__( 'Button URL', 'boo-energy' ),
			'description' => esc_html__( 'Add a custom footer call-to-action button URL.', 'boo-energy' ),
			'section'     => 'boo_footer_section',
			'type'        => 'url',
		)
	);
}
