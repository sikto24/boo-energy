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
			echo '<div class="basic-pagination"><nav><ul>';
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


