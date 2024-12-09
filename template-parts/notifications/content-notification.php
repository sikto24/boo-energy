<?php

$boo_omrade = get_field( 'omrade' );
$avbrott_startar = get_field( 'avbrott_startar' );
$avbrott_avslutas = get_field( 'avbrott_avslutas' );
$post_mode_selector = get_field( 'post_mode_selector' );
$link_contact_person = get_field( 'link_contact_person' ) ? get_field( 'link_contact_person' ) : false;
$boo_plan_status = get_field( 'plan_status' );
$contact_person_name = get_field( 'contact_person_name' );
$contact_person_email = get_field( 'contact_person_email' );
$contact_person_phone = get_field( 'contact_person_phone' );


?>


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
			<p><?php echo esc_html__( 'Område: ', 'boo-energy' ) . '<span>' . $boo_omrade . '</span>'; ?>
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
		<?php if ( $link_contact_person ) : ?>
			<div class="single-notification-result-btn">
				<div class="single-notification-contact-area d-flex flex-row justify-content-between">
					<p><a href="#"><?php echo esc_html__( 'Kontakt', 'boo-energy' ); ?></a></p>
					<img src="<?php echo BOO_THEME_IMG_DIR . 'arrow-down.svg'; ?>">
				</div>
				<div style="display:none" class="single-notification-result-main">
					<p><?php echo esc_html__( $contact_person_name, 'boo-energy' ); ?></p>
					<p><a target="_blank" href="tel:<?php echo $contact_person_phone; ?>">
							<?php echo esc_html__( 'Telefon: ' . $contact_person_phone, 'boo-energy' ); ?></a></p>
					<p><a target="_blank"
							href="mailto:<?php echo esc_attr( $contact_person_email ); ?>"><?php echo esc_html__( 'Mailadress: ' . $contact_person_email, 'boo-energy' ); ?></a>
					</p>
					<p></p>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>