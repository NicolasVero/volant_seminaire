// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_GET['devis_item'] ) ? $_GET['devis_item'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	
	<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
		<ol class="forms">
			<div class="devis-form-container">
				
				<ul class="devis-items-container">
					<?php foreach ( $devis_items_array as $devis_item ) :
						$activite = get_post( $devis_item );
						$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
						?>
						<li class="devis-item">
							<div class="devis-item-image">
								<img src="<?= esc_url( $image_url ) ?>" />
							</div>
							<div class="devis-item-content">
								<h3><?= esc_html( $activite->post_title ) ?></h3>
								<p><?= esc_html( $activite->post_excerpt ) ?></p>
							</div>
							<div class="devis-item-form">
								<label>Nombre de personnes</label>
								<input type="number" name="nombre_personnes_<?php echo $devis_item; ?>" value="<?php if(isset($_POST["nombre_personnes_' . $devis_item . '"])) echo $_POST["nombre_personnes_' . $devis_item . '"];?>" class="requiredField" />
								<?php if($nbrePersonnes != '') { ?>
									<span class="error"><?=$nameError;?></span> 
								<?php } ?>
								<label>Date de l'activité</label>
								<input type="date" name="date_activite_<?php echo $devis_item; ?>" value="" />
								<label>Adresse du séminaire</label>
								<input type="text" name="adresse_seminaire_<?php echo $devis_item; ?>" value="" />
								<label>Horaires de l'activité</label>
								<select name="horaires_heure_debut_<?php echo $devis_item; ?>">
									<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
								h
								<select name="horaires_minute_debut_<?php echo $devis_item; ?>">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
								à
								<select name="horaires_heure_fin_<?php echo $devis_item; ?>">
									<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
								h
								<select name="horaires_minute_fin_<?php echo $devis_item; ?>">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
							</div>					
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</ol>
	</form>
	
	<?php
}
add_shortcode( 'display_devis_form', 'display_devis_form' );




// Ajouter les champs personnalisés au formulaire de devis
function add_custom_devis_fields( $devis_item ) {
	
	wpcf7_add_form_tag( 'titre_activite_' . $devis_item, 'custom_titre_activite_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'nombre_personnes_' . $devis_item, 'custom_nombre_personnes_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'date_activite_' . $devis_item, 'custom_date_activite_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'adresse_seminaire_' . $devis_item, 'custom_adresse_seminaire_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_heure_debut_' . $devis_item, 'custom_horaires_heure_debut_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_minute_debut_' . $devis_item, 'custom_horaires_minute_debut_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_heure_fin_' . $devis_item, 'custom_horaires_heure_fin_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_minute_fin_' . $devis_item, 'custom_horaires_minute_fin_field_handler', array( 'name-attr' => true ) );	
}
add_action( 'wpcf7_init', 'add_custom_devis_fields' );

// Gestionnaire pour le champ titre_activite
function custom_titre_activite_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$html = '<div class="form-group">'.
				'<label for="' . $tag->name . '">Titre de l\'activité</label>'.
				'<input type="text" name="' . $tag->name . '" value="' . $tag->get_default_option( 'value' ) . '">'.
			'</div>';

	return $html;
}

// Gestionnaire pour le champ nombre_personnes
function custom_nombre_personnes_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$html = '<label>' . esc_html( $tag->name ) . '</label><br />';
	$html .= '<input type="number" name="' . esc_attr( $tag->name ) . '" value="' . esc_attr( $tag->get_default_option( 'value', '1' ) ) . '" />';
	return $html;
}

// Gestionnaire pour le champ date_activite
function custom_date_activite_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$html = '<label>' . esc_html( $tag->name ) . '</label><br />';
	$html .= '<input type="date" name="' . esc_attr( $tag->name ) . '" value="' . esc_attr( $tag->get_default_option( 'value' ) ) . '" />';
	return $html;
}

// Gestionnaire pour le champ adresse_seminaire
function custom_adresse_seminaire_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$html = '<label>' . esc_html( $tag->name ) . '</label><br />';
	$html .= '<textarea name="' . esc_attr( $tag->name ) . '">' . esc_html( $tag->get_default_option( 'value' ) ) . '</textarea>';
	return $html;
}

// Gestionnaire pour le champ horaires
function ccustom_horaires_heure_debut_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$html = '<div class="form-group">'.
				'<label for="' . $tag->name . '">Horaires</label>'.
				'<input type="text" name="' . $tag->name . '">' . $tag->get_default_option( 'value' ) . '">';

	return $html;
}

function custom_horaires_minute_debut_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$html = '<input type="text" name="' . $tag->name . '">' . $tag->get_default_option( 'value' ) . '">';

	return $html;
}

function custom_horaires_heure_fin_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$html = '<input type="text" name="' . $tag->name . '">' . $tag->get_default_option( 'value' ) . '">';

	return $html;
}

function custom_horaires_minute_fin_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$html = '<input type="text" name="' . $tag->name . '">' . $tag->get_default_option( 'value' ) . '">'.
			'</div>';

	return $html;
}

// Modifie le contenu du message de l'email envoyé depuis le formulaire de contact 7
function customize_devis_mail_body( $body, $form ) {
		
		$fields = $form->scan_form_tags();
		$nombre_personnes = '';
		$date_activite = '';
		$adresse_seminaire = '';
		$horaires = '';
		$titre_activite = '';
		
		foreach ( $fields as $field ) {
			if ( 'nombre_personnes' == $field['type'] ) {
				$nombre_personnes = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
				$body = str_replace( '[nombre-personnes]', $nombre_personnes, $body );
			} elseif ( 'date_activite' == $field['type'] ) {
				$date_activite = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
				$body = str_replace( '[date-activite]', $date_activite, $body );
			} elseif ( 'adresse_seminaire' == $field['type'] ) {
				$adresse_seminaire = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
				$body = str_replace( '[adresse-seminaire]', $adresse_seminaire, $body );
			} elseif ( 'horaires' == $field['type'] ) {
				$horaires = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
				$body = str_replace( '[horaires]', $horaires, $body );
			} elseif ( 'titre_activite' == $field['type'] ) {
				$titre_activite = isset( $_POST[ $field['name'] ] ) ? sanitize_text_field( $_POST[ $field['name'] ] ) : '';
				$body = str_replace( '[titre-activite]', $titre_activite, $body );
			}
		}
		//error_log(print_r($form->get_posted_data(), true));

		return $body;
		
		var_dump($body);

}
add_filter( 'wpcf7_mail_components', 'customize_devis_mail_body', 10, 2 );

function send_devis_form( $cf7 ) {
	
	
	// Check si c'est bien le formulaire ID 4
	if ( $cf7->id() != 4 ) {
		return;
	}

	// récupère les datas du formulaire
	$submission = WPCF7_Submission::get_instance();
	if ( $submission ) {
		$posted_data = $submission->get_posted_data();


		// Get the recipient email address from the Contact Form 7 form
		$mail = $cf7->prop( 'mail' );
		$to = $mail['recipient'];

		// Set the email subject
		$subject = 'Nouvelle demande de devis : ' . $posted_data['titre_activite'];

		// Customize the email body
		$body = customize_devis_mail_body( '', $cf7 );

		// Add the form data to the email body
		$body .= "\n\nVoici les informations de la demande de devis :\n\n";
		$body .= "Titre de l'activité : " . $posted_data['titre_activite'] . "\n";
		$body .= "Nombre de personnes : " . $posted_data['nombre_personnes'] . "\n";
		$body .= "Date de l'activité : " . $posted_data['date_activite'] . "\n";
		$body .= "Adresse du séminaire : " . $posted_data['adresse_seminaire'] . "\n";
		$body .= "Horaires : " . $posted_data['horaires'] . "\n";

		// Set the email headers
		$headers = array(
			'Content-Type: text/plain; charset=utf-8',
			'From: ' . $mail['sender']
		);

		// Send the email
		wp_mail( $to, $subject, $body, $headers );
	}
}
add_action( 'wpcf7_mail_sent', 'send_devis_form' );