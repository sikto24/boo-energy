<?php
/**
 * Template Name: Aktuell driftstatus 
 * */
/** * T * * @package Boo_Energy */

get_header();

?>

<?php
$args = array( 'post_type' => 'notification',
	'post_status' => array( 'publish' ),
	'posts_per_page' => -1,
);
$future_posts = new WP_Query( $args );

?>



<div class="notifications-area-main d-p-88 m-p-32">
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
					<a class="tab-filter" data-filter="history" data-status="pending" href="#">
						<?php echo esc_html__( 'Historik', 'boo-energy' ); ?>
					</a>
				</li>
			</ul>

		</div>
	</div>
	<div id="notification-results" class="notification-area-result d-flex flex-column">
		<?php while ( $future_posts->have_posts() ) :
			$future_posts->the_post();
			get_template_part( '/template-parts/notifications/content-notification' );
			?>
		<?php endwhile; ?>
	</div>
</div>


<?php

get_footer();

