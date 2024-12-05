<?php

$boo_omrade = get_field( 'omrade' );
$avbrott_startar = get_field( 'avbrott_startar' );
$avbrott_avslutas = get_field( 'avbrott_avslutas' );
$post_mode_selector = get_field( 'post_mode_selector' );
$link_contact_person = get_field( 'link_contact_person' );
$select_member = get_field( 'select_member' );
$boo_plan_status = get_field( 'plan_status' );
?>
<pre>
	<?php echo var_dump( $post_mode_selector ); ?>
</pre>

<div class="single-notification-result">
	<div class="single-notification-result-top">
		<div class="single-notification-result-date">
			<p><?php the_date(); ?></p>
		</div>
		<?php if ( ! empty( $boo_plan_status ) ) : ?>
			<div class="single-notification-result-type">
				<p><?php echo $boo_plan_status; ?></p>
			</div>
		<?php endif; ?>
	</div>
	<div class="single-notification-result-middle">
		<div class="single-notification-result-title">
			<h4>
				<?php the_title(); ?>
			</h4>
		</div>
		<div class="single-notification-result-informartion">
			<p><?php echo esc_html__( 'Område: ', 'boo-energy' ) . '<span>' . $boo_omrade['label'] . '</span>'; ?>
			</p>
			<p>
				<?php echo esc_html__( 'Avbrott startar: ', 'boo-energy' ) . '<span>' . $avbrott_startar . '</span>'; ?>
			</p>
			<p>
				<?php echo esc_html__( 'Avbrott avslutas: ', 'boo-energy' ) . '<span>' . $avbrott_avslutas . '</span>'; ?>
			</p>
		</div>
		<div class="single-notification-result-desc">
			<p><?php the_content(); ?></p>
		</div>
		<div class="single-notification-result-btn">
			<div class="single-notification-contact-area">
				<p><a href="#"><?php echo esc_html__( 'Kontakt', 'boo-energy' ); ?></a></p>
			</div>
			<div style="display:none" class="single-notification-result-main">
				<p>Name</p>
				<p><a target="_blank" href="tel:">Telefon: 12345</a></p>
				<p><a target="_blank" href="mailto:main@test.com">Mailadress: main@test.com</a></p>
				<p></p>
			</div>
		</div>

	</div>
</div>