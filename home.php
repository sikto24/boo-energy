<?php
/**
Template Name: Home
 */
get_header(); ?>
<!-- Start Main Header  -->
<pre>
	<?php

	$args = array(
		'post_type' => 'notification',
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );
	echo ( $query->found_posts );


	?>
</pre>
<header class="header-area-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="boo-site-logo">
					<?php echo boo_header_logo(); ?>
				</div>
			</div>
			<div class="col-lg-8 d-flex align-items-center justify-content-end">
				<nav class="main-menu-wrapper boo-main-menu ">
					<ul class="primary-menu d-flex boo-reset-ul">
						<li class="menu-item-has-children mega-menu-toggle-on">
							<a href="#">Våra elavtal</a>
							<ul class="boo-mega-sub-menu" id="main-mega-menu">
								<li class="menu-item-type-custom">
									<a href="#">Våra elavtal och priser</a>
								</li>
								<li class="menu-item-has-children boo-sub-menu-active">

									<a href="#">Boo-portföljen</a>
									<p>Vi optimerar elpriserna</p>
									<ul class="boo-mega-sub-menu-second " id="sub-mega-menu">
										<li><a href="#">Flytta elavtal 1</a></li>
										<li><a href="#">Flytta elavtal 1</a></li>
										<li><a href="#">Flytta elavtal 1</a></li>
										<li><a href="#">Flytta elavtal 1</a></li>
										<li><a href="#">Flytta elavtal 1</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children">
									<a href="#">Bundet elavtal</a>
									<p>Vi optimerar elpriserna</p>
									<ul class="boo-mega-sub-menu-second" id="sub-mega-menu">
										<li><a href="#">Flytta elavtal 2</a></li>
										<li><a href="#">Flytta elavtal 2</a></li>
										<li><a href="#">Flytta elavtal 2</a></li>
										<li><a href="#">Flytta elavtal 2</a></li>
										<li><a href="#">Flytta elavtal 2</a></li>
										<li><a href="#">Flytta elavtal 2</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children">
									<a href="#">Bundet elavtal</a>
									<p>Vi optimerar elpriserna</p>
									<ul class="boo-mega-sub-menu-second" id="sub-mega-menu">
										<li><a href="#">Flytta elavtal 3</a></li>
										<li><a href="#">Flytta elavtal 3</a></li>
										<li><a href="#">Flytta elavtal 3</a></li>
										<li><a href="#">Flytta elavtal 3</a></li>
										<li><a href="#">Flytta elavtal 3</a></li>
										<li><a href="#">Flytta elavtal 3</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="#">Elnät</a></li>
						<li><a href="#">Energitjänster</a></li>
						<li><a href="#">Smart elanvändning</a></li>
						<li><a href="#">Boo-aktuellt</a></li>
					</ul>
				</nav>
			</div>
		</div>
</header>

<!-- End Main Header -->
<?php get_footer(); ?>