<?php
/**
 * Page Menu: Boo Energy.
 */
function boo_menu_top_level() {
	add_menu_page(
		__( "Boo Energy", "boo-energy" ),
		__( "Boo Energy", "boo-energy" ),
		"manage_options",
		"boo-main-menu",
		"",
		"/app/uploads/2024/11/boo.svg",
		4,
	);
}
add_action( "admin_menu", "boo_menu_top_level" );

/**
 * Post Types For Boo
 */

function boo_notification_post_type() {
	$labels = [ 
		"name" => esc_html__( "Notifications", "boo-energy" ),
		"singular_name" => esc_html__( "Notification", "boo-energy" ),
		"menu_name" => esc_html__( "Notifications", "boo-energy" ),
	];
	$args = [ 
		"label" => esc_html__( "Notifications", "boo-energy" ),
		"labels" => $labels,
		"description" => "Add Notification Here",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_menu" => "boo-main-menu",
		"hierarchical" => false,
		"can_export" => false,
		"supports" => [ "title", "editor", "thumbnail", "revisions" ],
	];
	register_post_type( "notification", $args );
}

function boo_studion_post_type() {
	$labels = [ 
		"name" => esc_html__( "Studions", "boo-energy" ),
		"singular_name" => esc_html__( "Studion", "boo-energy" ),
		"menu_name" => esc_html__( "Studions", "boo-energy" ),
	];
	$args = [ 
		"label" => esc_html__( "Studions", "boo-energy" ),
		"labels" => $labels,
		"description" => "Add Studion Here",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_menu" => "boo-main-menu",
		"hierarchical" => false,
		"can_export" => false,
		"supports" => [ "title", "editor", "thumbnail", "revisions" ],
	];
	register_post_type( "studion", $args );
}

function boo_skolan_post_type() {
	$labels = [ 
		"name" => esc_html__( "Skolans", "boo-energy" ),
		"singular_name" => esc_html__( "Skolan", "boo-energy" ),
		"menu_name" => esc_html__( "Skolans", "boo-energy" ),
	];
	$args = [ 
		"label" => esc_html__( "Skolans", "boo-energy" ),
		"labels" => $labels,
		"description" => "Add Skolan Here",
		"public" => true,
		"publicly_queryable" => true,
		'has_archive' => false,
		"show_ui" => true,
		"show_in_menu" => "boo-main-menu",
		"hierarchical" => false,
		"can_export" => false,
		"supports" => [ "title", "editor", "thumbnail", "revisions" ],
		'taxonomies' => array( 'category', 'post_tag' ),

	];
	register_post_type( "skolan", $args );
}

add_action( 'init', 'boo_notification_post_type' );
add_action( 'init', 'boo_studion_post_type' );
add_action( 'init', 'boo_skolan_post_type' );

