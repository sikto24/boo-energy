<div class="single-boo-blog-wrapper">
	<div class="single-boo-blog-thumbnail">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
	<div class="single-boo-details">
		<div class="single-boo-blog-title">
			<h5><?php the_title(); ?></h5>
		</div>
		<div class="single-boo-blog-details">
			<p><?php the_content(); ?></p>
		</div>
		<div class="single-boo-blog-btn">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Läs mer', 'boo-energy' ); ?></a>
		</div>
	</div>
</div>