<!-- Start Header Top -->
<section class="top-bar-area-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="top-bar-left d-flex">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'menu_class'     => 'top-bar-left-menu d-flex boo-reset-ul',
						)
					);
					?>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="top-bar-right">
					<nav class="top-bar-menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-4',
								'menu_class'     => 'd-flex justify-content-end boo-reset-ul',
							)
						);
						?>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Header Top -->

<!-- Start Main Header  -->
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
					<?php boo_header_menu(); ?>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- End Main Header -->


<div id="boo-content">
	<!-- Page content will be loaded here -->
</div>