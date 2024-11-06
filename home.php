<?php
/**
Template Name: Home
 */
get_header();

function mmenuJs() {
	?>
	<style>
		html:has(body.mm-wrapper) {
			margin: 0px !important;
		}
	</style>
	<script>
		document.addEventListener(
			"DOMContentLoaded", () => {
				new Mmenu("#menu", {
					"offCanvas": {
						"position": "left"
					},
					"theme": "white",
					"navbars": [
						{
							"position": "top",
							"content": [
								"searchfield"
							]
						}
					]
				});
			}
		);

		jQuery(document).ready(function ($) {
			$('.mm-navbar__title span').text('Boo Energy');
		});
	</script>

	<?php
}

add_action( "wp_footer", "mmenuJs" );
?>
<!-- Start Main Header  -->

<header class="header-area-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col">
				<div class="boo-site-logo">
					<?php echo boo_header_logo(); ?>
				</div>
			</div>
			<div class="col-lg-8 col d-flex justify-content-end align-items-center">
				<div id="headerr">
					<a href="#menu" class="fas fa-bars">MENU</a>
				</div>
			</div>
		</div>
</header>

<nav id="menu">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-6',
			'menu_id' => 'panel-menu',
		)
	);
	?>
</nav>
<!-- End Main Header -->
<?php get_footer(); ?>