<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boo_Energy
 */

?>

<div class="boo-page-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
			the_content();
			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'biddut' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'biddut' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text"> </span>',
				)
			);

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
</article>
</div>
