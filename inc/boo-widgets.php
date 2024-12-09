<?php

function boo_energy_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 1', 'boo-energy' ),
			'id' => 'footer-1',
			'description' => esc_html__( 'Add widgets here.', 'boo-energy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s boo-reset-ul">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="boo-footer-widget-title pb-16">',
			'after_title' => '</h6>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 2', 'boo-energy' ),
			'id' => 'footer-2',
			'description' => esc_html__( 'Add widgets here.', 'boo-energy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s boo-reset-ul">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="boo-footer-widget-title pb-16">',
			'after_title' => '</h6>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 3', 'boo-energy' ),
			'id' => 'footer-3',
			'description' => esc_html__( 'Add widgets here.', 'boo-energy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s boo-reset-ul">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="boo-footer-widget-title pb-16">',
			'after_title' => '</h6>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 4', 'boo-energy' ),
			'id' => 'footer-4',
			'description' => esc_html__( 'Add widgets here.', 'boo-energy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s boo-reset-ul">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="boo-footer-widget-title d-pb-32">',
			'after_title' => '</h6>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer 5', 'boo-energy' ),
			'id' => 'footer-5',
			'description' => esc_html__( 'Add widgets here.', 'boo-energy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s boo-reset-ul">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="boo-footer-widget-title d-pb-24">',
			'after_title' => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'boo_energy_widgets_init' );



class Notification_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'notification_widget',
			__( 'Notification Widget', 'boo-energy' ),
			array( 'description' => __( 'Displays notifications by status.', 'boo-energy' ) )
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		$query_args = array(
			'post_type' => 'notification',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
		$notifications = new WP_Query( $query_args );

		if ( $notifications->have_posts() ) : ?>
			<div class="notifications-area-main">
				<div class="notification-area">
					<div class="notification-area-filter">
						<ul class="tab-area-filter-main">
							<li>
								<a class="tab-filter tab-filter-active" data-filter="ongoing" data-status="publish" href="#">
									<?php echo esc_html__( 'Pågående', 'boo-energy' ); ?>
								</a>
							</li>
							<li>
								<a class="tab-filter" data-filter="planned" data-status="future" href="#">
									<?php echo esc_html__( 'Planerade', 'boo-energy' ); ?>
								</a>
							</li>
							<li>
								<a class="tab-filter" data-filter="history" data-status="draft" href="#">
									<?php echo esc_html__( 'Historik', 'boo-energy' ); ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div id="notification-results" class="notification-area-result d-flex flex-column">
					<?php
					while ( $notifications->have_posts() ) :
						$notifications->the_post();
						get_template_part( '/template-parts/notifications/content-notification' );
					endwhile;
					?>
				</div>
			</div>
			<?php
		endif;
		wp_reset_postdata();

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		?>
		<p>
			<?php _e( 'No settings available for this widget.', 'boo-energy' ); ?>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}

function register_notification_widget() {
	register_widget( 'Notification_Widget' );
}
add_action( 'widgets_init', 'register_notification_widget' );
