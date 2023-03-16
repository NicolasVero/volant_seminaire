<div class="form-content"><label>Nombre de personnes*</label>[number number-personnes]</div>
<div class="form-content"><label>Date de l'activité*</label>[date date-activity]</div>
<div class="form-content"><label>Lieu du séminaire*</label>[text adresse-activity]</div>
<div class="form-content"><label>Horaires*</label>de [text time class:walcf7-timepicker] à [text time class:walcf7-timepicker]</div>
[post_image_checkbox post_image_checkbox-676 posts-number:-1 image-size:medium publish post-type:activites tax-relation:OR value-field:thumbnail orderby:title order:DESC "%title%"]



le code  wp_redirect( home_url( '/demander-un-devis/' ) ); dans la fonction function add_to_devis(); ne marche pas, corrige-leide





// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_POST['devis_items'] ) ? $_POST['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	<div class="devis-form-container">
		<div class="devis-items-container">
			<h2>Items sélectionnés</h2>
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				?>
				<div class="devis-item">
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<?php echo do_shortcode( '[text activite-id id:activite-id readonly "ID de l\'activité" "'.$activite->ID.'"]' ); ?>
						<h4>Informations de réservation</h4>
						<?php echo do_shortcode( '[text nombre-personnes "Nombre de personnes"]' ); ?>
						<?php echo do_shortcode( '[date date-activite "Date de l\'activité"]' ); ?>
						<?php echo do_shortcode( '[text adresse-seminaire "Adresse du séminaire"]' ); ?>
						<?php echo do_shortcode( '[select horaires-heures "Heures" "9" "10" "11" "14" "15" "16" "19" "20" "21"]' ); ?>
						<?php echo do_shortcode( '[select horaires-minutes "Minutes" "00" "15" "30" "45"]' ); ?>
						<?php echo do_shortcode( '[select horaires-a-heures "Heures" "9" "10" "11" "14" "15" "16" "19" "20" "21"]' ); ?>
						<?php echo do_shortcode( '[select horaires-a-minutes "Minutes" "00" "15" "30" "45"]' ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php echo do_shortcode( '[contact-form-7 id="1" title="Formulaire de demande de devis"]' ); ?>
	</div>
	<?php
}

add_shortcode( 'display_devis_form', 'display_devis_form' );

// Ajouter les balises dynamiques pour les champs personnalisés dans le formulaire contact form 7
add_filter( 'wpcf7_special_mail_tags', 'add_custom_fields_to_mail' );
function add_custom_fields_to_mail( $tags ) {
	$tags['activite-id'] = $_POST['activite-id'];
	$tags['nombre-personnes'] = $_POST['nombre-personnes'];
	$tags['date-activite'] = $_POST['date-activite'];
	$tags['adresse-seminaire'] = $_POST['adresse-seminaire'];
	$tags['horaires'] = $_POST['horaires-heures'] . ':' . $_POST['horaires-minutes'] . ' - ' . $_POST['horaires-a-heures'] . ':' . $_POST['horaires-a-minutes'];
	return $tags;
}



// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_POST['devis_items'] ) ? $_POST['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	<div class="devis-form-container">
		<?php echo do_shortcode( '[contact-form-7 id="1" title="Formulaire de demande de devis"]' ); ?>
		<div class="devis-items-container">
			<h2>Items sélectionnés</h2>
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				?>
				<div class="devis-item">
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<p><?php echo esc_html( $activite->post_excerpt ); ?></p>
						<h4>Informations de réservation</h4>
						<label>Nombre de personnes</label>
						<input type="number" name="nombre_personnes_<?php echo $devis_item; ?>" value="" />
						<label>Date de l'activité</label>
						<input type="date" name="date_activite_<?php echo $devis_item; ?>" value="" />
						<label>Adresse du séminaire</label>
						<input type="text" name="adresse_seminaire_<?php echo $devis_item; ?>" value="" />
						<label>Horaires de l'activité</label>
						<select name="horaires_heure_debut_<?php echo $devis_item; ?>">
							<?php for ( $i = 9; $i <= 19; $i++ ) : ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?>h</option>
							<?php endfor; ?>
						</select>
						<select name="horaires_minute_debut_<?php echo $devis_item; ?>">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
						à
						<select name="horaires_heure_fin_<?php echo $devis_item; ?>">
							<?php for ( $i = 10; $i <= 22; $i++ ) : ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?>h</option>
							<?php endfor; ?>
						</select>
						<select name="horaires_minute_fin_<?php echo $devis_item; ?>">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

add_shortcode( 'display_devis_form', 'display_devis_form' );

// Ajouter les champs dynamiques dans le contenu de l'email envoyé par Contact Form 7
add_filter( 'wpcf7_special_mail_tags', 'add_custom_devis_fields', 10, 3 );
function add_custom_devis_fields() {
	echo '<div class="custom-devis-fields">';
	echo '<h2>Informations de réservation</h2>';
	echo '<label>Nombre de personnes<br>';
	echo '[text nombre-personnes]</label><br>';
	echo '<label>Date de l\'activité<br>';
	echo '[date date-activite]</label><br>';
	echo '<label>Adresse du séminaire<br>';
	echo '[text adresse-seminaire]</label><br>';
	echo '<label>Horaires de l\'activité<br>';
	echo '[select heures_debut "Heures" "9" "10" "11" "14" "15" "16" "19" "20" "21"]';
	echo '[select minutes_debut "Minutes" "00" "15" "30" "45"] à ';
	echo '[select heures_fin "Heures" "9" "10" "11" "14" "15" "16" "19" "20" "21"]';
	echo '[select minutes_fin "Minutes" "00" "15" "30" "45"]</label>';
	echo '</div>';
}




// Ajouter les champs personnalisés au mail
function add_custom_fields_to_mail( $template, $prop ) {
	if ( $prop === 'mail' ) {
		global $wpdb;
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) {
			$form_data = $submission->get_posted_data();
			$devis_items = isset( $form_data['devis_items'] ) ? $form_data['devis_items'] : '';
			$devis_items_array = explode( ',', $devis_items );
			$activites = array();
			foreach ( $devis_items_array as $devis_item ) {
				$activite = get_post( $devis_item );
				$activites[] = array(
					'titre-activite' => $activite->post_title,
					'nombre-personnes' => isset( $form_data['nombre-personnes'] ) ? sanitize_text_field( $form_data['nombre-personnes'] ) : '',
					'date-activite' => isset( $form_data['date-activite'] ) ? sanitize_text_field( $form_data['date-activite'] ) : '',
					'adresse-seminaire' => isset( $form_data['adresse-seminaire'] ) ? sanitize_text_field( $form_data['adresse-seminaire'] ) : '',
					'horaires' => isset( $form_data['horaires-heures'] ) ? sanitize_text_field( $form_data['horaires-heures'] ) . ':' . sanitize_text_field( $form_data['horaires-minutes'] ) . ' à ' . sanitize_text_field( $form_data['horaires-a-heures'] ) . ':' . sanitize_text_field( $form_data['horaires-a-minutes'] ) : '',
				);
			}
			$template = str_replace( '[activites]', json_encode( $activites ), $template );
		}
	}
	return $template;
}
add_filter( 'wpcf7_special_mail_tags', 'add_custom_fields_to_mail', 10, 2 );