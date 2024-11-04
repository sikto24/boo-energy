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
 * Post Type: Notifications.
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

add_action( 'init', 'boo_notification_post_type' );

