<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Boo_Energy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

// Boo Energy Logo
function boo_header_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( $custom_logo_id ) {
			$site_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
			$site_logo = sprintf(
				'<a href="%s"><img src="%s" alt="%s" /></a>',
				esc_url( home_url() ),
				esc_url( $site_logo_url ),
				esc_attr( get_bloginfo( 'name' ) )
			);
		} else {

			$site_logo = sprintf(
				'<a href="%s"><h1>%s</h1></a>',
				esc_url( home_url() ),
				esc_html( get_bloginfo( 'name' ) )
			);
		}
	}

	// Output the logo or site name
	return $site_logo;
}

// Boo Energy Main Menu

function boo_header_menu() {
	if ( function_exists( 'boo_header_menu' ) ) {

		if ( class_exists( 'acf' ) && get_field( 'boo_page_menu' ) ) {
			$boo_select_page_menu = get_field( 'boo_page_menu' );
			$boo_main_menu = ( 'private-menu' === $boo_select_page_menu ) ? 'menu-1' : 'menu-2';
		} else {
			$boo_main_menu = 'menu-1';
		}
		if ( has_nav_menu( 'menu-1' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => $boo_main_menu,
					'menu_id' => 'primary-menu',
					'menu_class' => 'primary-menu d-flex boo-reset-ul',
					'container' => 'nav',
					'container_class' => 'main-menu-wrapper boo-main-menu',
					'container_id' => 'boo-main-menu-wrapper',
					'walker' => new WP_Bootstrap_Navwalker_Custom(),
				)
			);
		}
	}
}

// Boo Energy Top Left Menu
function booTopMenuLeft() {
	wp_nav_menu(
		array(
			'theme_location' => 'menu-3',
			'menu_class' => 'top-bar-left-menu d-flex boo-reset-ul',
		)
	);
}

// Boo Energy Top Right Menu
function booTopMenuRight() {
	wp_nav_menu(
		array(
			'theme_location' => 'menu-4',
			'menu_class' => 'd-flex justify-content-end boo-reset-ul',
		)
	);
}

// Assign Header

function boo_header_wrapper() {
	get_template_part( 'template-parts/header/header' );
}
add_action( 'boo_header', 'boo_header_wrapper', 10 );


// Assign Footer

function boo_footer_wrapper() {
	get_template_part( 'template-parts/footer/footer' );
}
add_action( 'boo_footer', 'boo_footer_wrapper', 10 );


// Register Elementor locations for both header and footer
function boo_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'boo_register_elementor_locations' );

/**
 *
 * pagination
 */
if ( ! function_exists( 'boo_pagination' ) ) {

	function boo_pagination() {
		$paginations = paginate_links(
			array(
				'type' => 'array',
				'prev_text' => '<i class="fa-regular fa-arrow-left"></i>',
				'next_text' => '<i class="fa-regular fa-arrow-right"></i>',
			)
		);
		if ( $paginations ) {
			echo '<div class="boo-basic-pagination"><nav><ul>';
			foreach ( $paginations as $pagination ) {
				echo "<li>$pagination</li>";
			}
			echo '</ul></nav></div>';
		}
	}
}


// Load Elementor Kits on Other page where Elementor Not loaded
function load_elementor_global_styles() {
	// Check if Elementor is active
	if ( did_action( 'elementor/loaded' ) ) {

		// Get the active global kit ID
		$global_kit_id = get_option( 'elementor_active_kit' );

		// If a global kit is active, enqueue its global styles
		if ( $global_kit_id ) {
			// Construct the URL for the global stylesheet
			$global_styles_url = wp_upload_dir()['baseurl'] . '/elementor/css/post-' . $global_kit_id . '.css';

			// Enqueue the global stylesheet
			wp_enqueue_style( 'elementor-global-styles', $global_styles_url, array(), null );
		}

		// Optionally, enqueue Elementor's frontend styles for consistent styling
		wp_enqueue_style( 'elementor-frontend' );
	}
}
add_action( 'wp_enqueue_scripts', 'load_elementor_global_styles' );


// Boo Comments
if ( ! function_exists( 'boo_energy_comment' ) ) {
	function boo_energy_comment( $comment, $args, $depth ) {
		$GLOBAL['comment'] = $comment;
		extract( $args, EXTR_SKIP );
		$args['reply_text'] = '<div class="boo-postbox-comment-reply"><span>Reply</span>
    </div>';
		$replayClass = 'comment-depth-' . esc_attr( $depth );
		?>


		<li id="comment-<?php comment_ID(); ?>" class="comment-list">
			<div class="boo-postbox-comment-box border-mr p-relative">
				<div class="boo-postbox-comment-box-inner d-flex">
					<div class="boo-postbox-comment-avater">
						<?php print get_avatar( $comment, 102, null, null, array( 'class' => array() ) ); ?>
					</div>
					<div class="boo-postbox-comment-content">
						<div class="boo-postbox-comment-author d-flex align-items-center">
							<h5 class="boo-postbox-comment-name"><?php print get_comment_author_link(); ?></h5>
							<p class="boo-postbox-comment-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
						</div>
						<?php comment_text(); ?>
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'depth' => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
						?>
					</div>
				</div>
			</div>
			<?php
	}
}

// Boo Tag
function boo_tags( $postType = 'post', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$single_boo_tag = get_the_tags( $post_id );
	$single_boo_tag_class = ( 'post' === get_post_type( $post_id ) ) ? 'boo-tag-post' : 'boo-tag-skolan';

	if ( has_tag( '', $post_id ) && ! empty( $single_boo_tag ) && get_post_type( $post_id ) === $postType ) : ?>
			<div class="boo-tag <?php echo esc_attr( $single_boo_tag_class ); ?>">
				<h5><?php echo esc_html( $single_boo_tag[0]->name ); ?></h5>
			</div>
		<?php endif;
}




// Count Notification In Header
function boo_get_notification_count() {
	$arg = array(
		'post_type' => 'notification',
		'posts_per_page' => -1,
	);
	$notificationQuery = new WP_Query( $arg );
	$booNotificationCount = $notificationQuery->found_posts;
	wp_reset_postdata();

	// Localize the script with the notification count
	$localization_script = 'var booNotificationData = ' . json_encode( array(
		'count' => $booNotificationCount,
	) ) . ';';

	// Add inline script to load after boo-main
	wp_add_inline_script( 'boo-main', $localization_script, 'after' );
}
add_action( 'wp_footer', 'boo_get_notification_count' );



/**
 * Summary of boo_load_more_posts
 * @return void
 * Load More posts With Out Filter
 */
function boo_load_more_posts() {
	// Validate nonce
	check_ajax_referer( 'load_more_posts_nonce', 'nonce' );

	$paged = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
	$category_slug = isset( $_POST['category_slug'] ) ? sanitize_text_field( $_POST['category_slug'] ) : '';

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 6,
		'paged' => $paged,
	);

	// If a category slug is provided, add it to the query
	if ( ! empty( $category_slug ) && $category_slug !== 'all' ) {
		$args['category_name'] = $category_slug; // Filter by category slug
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/blog/content-blog' );
		}
		wp_reset_postdata();
	} else {
		wp_send_json_error( 'No more posts to load.' );
	}

	wp_die();
}

// Load More Post Ajax
add_action( 'wp_ajax_load_more_posts', 'boo_load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'boo_load_more_posts' );



/**
 * Filter Posts
 * Summary of filter_posts_by_category
 * @return void
 */
function filter_posts_by_category() {
	check_ajax_referer( 'blogPosts', 'nonce' );
	if ( isset( $_POST['category_slug'] ) ) {
		$category_slug = sanitize_text_field( $_POST['category_slug'] );

		$args = array(
			'post_type' => array( 'post' ),
			'posts_per_page' => 5,
		);

		if ( ! empty( $category_slug ) ) {
			$args['category_name'] = $category_slug;
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $category_slug,
				),
			);
		}


		$query = new WP_Query( $args );


		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/blog/content-blog' );
			endwhile;
			wp_reset_postdata();
		else :
			echo '<p>' . esc_html__( 'No posts found', 'boo-energy' ) . '</p>';
		endif;
	}


	wp_die();
}
add_action( 'wp_ajax_filter_posts', 'filter_posts_by_category' );
add_action( 'wp_ajax_nopriv_filter_posts', 'filter_posts_by_category' );

/**
 * Load All Posts on Filter
 * Summary of load_all_posts
 * @return void
 */
function load_all_posts() {
	check_ajax_referer( 'blogPosts', 'nonce' );
	$args = array(
		'post_type' => array( 'post' ),
		'posts_per_page' => 5,
		'paged' => isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/blog/content-blog' ); // Adjust the template part as needed
		endwhile;
	else :
		echo '<p>No posts found.</p>';
	endif;

	wp_reset_postdata();
	wp_die();
}

add_action( 'wp_ajax_load_all_posts', 'load_all_posts' );
add_action( 'wp_ajax_nopriv_load_all_posts', 'load_all_posts' );


/**
 * Summary of boo_ajax_live_search
 * @return void
 */
function boo_ajax_live_search() {
	$search_query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : '';
	$suggestions = [];

	if ( ! empty( $search_query ) ) {
		$args = [ 
			's' => $search_query,
			'post_type' => [ 'post', 'page' ],
			'posts_per_page' => 5,
		];
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$suggestions[] = [ 
					'title' => get_the_title(),
					'link' => get_permalink(),
				];
			}
		}
		wp_reset_postdata();
	}

	wp_send_json_success( $suggestions );
	wp_die();
}
add_action( 'wp_ajax_boo_live_search', 'boo_ajax_live_search' );
add_action( 'wp_ajax_nopriv_boo_live_search', 'boo_ajax_live_search' );




/**
 *  move_notifications_to_history
 * @return void
 */
if ( ! wp_next_scheduled( 'move_expired_notifications' ) && get_field( 'post_mode_selector', 'option' ) === 'false' ) {
	wp_schedule_event( time(), 'hourly', 'move_expired_notifications' );
}
add_action( 'move_expired_notifications', 'move_notifications_to_history' );

function move_notifications_to_history() {
	$post_mode_selector = get_field( 'post_mode_selector', 'option' );
	if ( $post_mode_selector === 'true' ) {
		return;
	}
	$current_time = current_time( 'Y-m-d H:i:s' );
	$args = array(
		'post_type' => 'notification',
		'post_status' => 'publish',
		'meta_query' => array(
			'posts_per_page' => -1,
			array(
				'key' => 'avbrott_avslutas',
				'value' => $current_time,
				'compare' => '<=',
				'type' => 'DATETIME',
			),
		),
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			wp_update_post( array(
				'ID' => $post_id,
				'post_status' => 'pending',
			) );
		}
	}
	wp_reset_postdata();
}

// Move Draft to trash after 48hours

if ( ! wp_next_scheduled( 'trash_history_notifications' ) && get_field( 'post_mode_selector', 'option' ) === 'false' ) {
	wp_schedule_event( time(), 'hourly', 'trash_history_notifications' );
}
add_action( 'trash_history_notifications', 'trash_expired_notifications' );


function trash_expired_notifications() {
	$post_mode_selector = get_field( 'post_mode_selector', 'option' );
	if ( 'true' === $post_mode_selector ) {
		return;
	}
	$args = array(
		'post_type' => 'notification',
		'post_status' => 'pending',
		'date_query' => array(
			array(
				'column' => 'post_modified_gmt',
				'before' => '48 hours ago',
			),
		),
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			wp_trash_post( get_the_ID() );
		}
	}
	wp_reset_postdata();
}

/**
 * Summary of boo_filter_notifications
 * @return void
 */
function boo_filter_notifications() {
	check_ajax_referer( 'booNotifications', 'nonce' );
	$post_status = sanitize_text_field( $_POST['post_status'] );
	$args = array(
		'post_type' => 'notification',
		'post_status' => $post_status,
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( '/template-parts/notifications/content-notification' );
		}
	} else {
		echo '<p>' . esc_html__( 'No notifications found.', 'boo-energy' ) . '</p>';
	}

	wp_die();
}
add_action( 'wp_ajax_filter_notifications', 'boo_filter_notifications' );
add_action( 'wp_ajax_nopriv_filter_notifications', 'boo_filter_notifications' );

// Manuall Control for notification posts
add_action( 'acf/save_post', 'update_post_status_for_notifications', 20 );
function update_post_status_for_notifications( $post_id ) {
	if ( get_post_type( $post_id ) !== 'notification' && ( false === get_field( 'post_mode_selector', $post_id ) ) ) {
		return;
	}


	$new_status = get_field( 'select_post_mode', $post_id );

	$status_mapping = [ 
		'ongoing' => 'publish',
		'history' => 'pending',
	];

	if ( isset( $status_mapping[ $new_status ] ) && true === get_field( 'post_mode_selector', $post_id ) ) {
		$updated_post = wp_update_post( [ 
			'ID' => $post_id,
			'post_status' => $status_mapping[ $new_status ],
		] );

		error_log( 'Post Update Result: ' . ( is_wp_error( $updated_post ) ? $updated_post->get_error_message() : 'Success' ) );
	} else {
		error_log( 'Invalid Status: ' . $new_status );
	}
}


// Custom Post State Show If manual Mode on
add_filter( 'display_post_states', function ($states, $post) {
	if ( get_post_type( $post ) !== 'notification' ) {
		return $states;
	}
	if ( get_field( 'post_mode_selector', $post->ID ) === true ) {
		$post_mode_selector = get_field( 'select_post_mode', $post->ID );

		if ( $post_mode_selector ) {
			switch ( $post_mode_selector ) {
				case 'ongoing':
					$post_mode_selector = 'Ongoing';
					break;
				case 'history':
					$post_mode_selector = 'History';
					break;
				case 'planned':
					$post_mode_selector = 'Planned';
					break;
				default:
					break;
			}

			// Add the translated post mode as a custom post state label
			$states[] = 'Manually — ' . esc_html( $post_mode_selector );
		}
	}

	return $states;
}, 10, 2 );
