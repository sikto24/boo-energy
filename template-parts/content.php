<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boo_Energy
 */
$boo_attached_video = get_field( 'attached_video' );
$boo_studion = get_field( 'boo_studion' );
$video_url = get_field( 'video_url' );
if ( $boo_studion ) {
	if ( is_array( $boo_studion ) ) {
		$studion_post_id = $boo_studion[0]->ID;
	} else {
		$studion_post_id = $boo_studion->ID;
	}

	$boo_video_url = get_field( 'video_url', $studion_post_id );
}
if ( $boo_studion ) {
	$boo_studion_post_id = $boo_studion->ID;
	$boo_studion_post_thumbnail = get_the_post_thumbnail_url( $boo_studion_post_id );
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( ( in_array( get_post_type(), [ 'post', 'skolan' ] ) ) ) :
			?>
			<div class="entry-meta">
				<?php
				echo esc_html__( 'Publicerad: ', 'boo-energy' ) . get_the_time( get_option( 'date_format' ) );
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header>
	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'boo-energy' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'boo-energy' ),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<?php if ( true === $boo_attached_video ) : ?>
		<div class="post-video-wrapper">
			<div class="post-video-thumbnail ratio ratio-16x9 mfp-iframe boo-video-play-btn">
				<img src="<?php echo esc_url( $boo_studion_post_thumbnail ) ?>"
					alt="<?php echo esc_attr( get_the_title() ); ?>">
			</div>
			<h5 class="post-video-title">
				<?php echo esc_html__( $boo_studion->post_title, 'boo-energy' ); ?>
			</h5>
			<p class="post-video-details">
				<?php echo esc_html__( $boo_studion->post_content, 'boo-energy' ); ?>
			</p>
			<a href="<?php echo esc_attr( $boo_video_url ); ?>" class="post-video-url boo-video-play-btn mfp-iframe">
				<?php echo esc_html__( 'Spela video', 'boo-energy' ); ?>
			</a>
		</div>
	<?php endif; ?>

</article>