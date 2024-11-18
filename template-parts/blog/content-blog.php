<?php
$single_boo_tag = get_tags();
?>
<div <?php post_class( 'single-boo-blog-wrapper' ); ?>>
	<div class="single-boo-blog-thumbnail">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
	<div class="single-boo-details">

		<div class="single-boo-details-top">
			<?php if ( has_tag() && ! empty( $single_boo_tag ) ) : ?>
				<div class="single-boo-blog-tag">
					<div class="boo-tag">
						<p><?php echo esc_html( $single_boo_tag[0]->name ); ?></p>
					</div>
				</div>
			<?php endif; ?>

			<div class="single-boo-blog-title">
				<h5><?php the_title(); ?></h5>
			</div>
			<div class="single-boo-blog-details">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="single-boo-blog-btn">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Läs mer', 'boo-energy' ); ?></a>
		</div>
	</div>
</div>