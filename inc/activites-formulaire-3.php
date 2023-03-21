<?php
function display_devis_form() {
	$devis_items = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
	$devis_items_array = explode( ',', $devis_items );

	?>
	<div class="devis-form-container">
		
		<div class="devis-items-container">
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
				?>
				<div class="devis-item">
					<div class="devis-item-image">
						<img src="<?= esc_url( $image_url ) ?>" />
					</div>
					<div class="devis-item-content">
						<h3><?= esc_html( $activite->post_title ) ?></h3>
						<p><?= esc_html( $activite->post_excerpt ) ?></p>
					</div>
					<div class="devis-item-form">
						<label>Nombre de personnes</label>
						<input type="number" name="nombre_personnes" value="" />
						<label>Date de l'activité</label>
						<input type="date" name="date_activite" value="" />
						<label>Adresse du séminaire</label>
						<input type="text" name="adresse_seminaire" value="" />
						<label>Horaires de l'activité</label>
						<select name="horaires_heure_debut">
							<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
						h
						<select name="horaires_minute_debut">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
						à
						<select name="horaires_heure_fin">
							<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
						h
						<select name="horaires_minute_fin">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
					</div>					
				</div>
			<?php endforeach; ?>
			<?php echo do_shortcode( '[contact-form-7 id="4" title="Formulaire de demande de devis"]' ); ?>
		</div>
	</div>
	<?php
}
add_shortcode( 'display_devis_form', 'display_devis_form' );




// Ajouter les champs personnalisés au formulaire de Contact Form 7
function add_custom_devis_fields( $devis_item ) {
	wpcf7_add_form_tag( 'titre_activite' . $devis_item, 'custom_titre_activite_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'nombre_personnes' . $devis_item, 'custom_nombre_personnes_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'date_activite' . $devis_item, 'custom_date_activite_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'adresse_seminaire' . $devis_item, 'custom_adresse_seminaire_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_heure_debut' . $devis_item, 'custom_horaires_heure_debut_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_minute_debut' . $devis_item, 'custom_horaires_minute_debut_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_heure_fin' . $devis_item, 'custom_horaires_heure_fin_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires_minute_fin' . $devis_item, 'custom_horaires_minute_fin_field_handler', array( 'name-attr' => true ) );
}
add_action( 'wpcf7_init', 'add_custom_devis_fields' );


// Personnaliser le message envoyé par email pour les demandes de devis
function customize_devis_message( $message, $form_data ) {
	// Ajouter les en-têtes pour autoriser les requêtes cross-origin
	$headers = array(
		'Access-Control-Allow-Origin: *',
		'Access-Control-Allow-Methods: POST',
	);

	// Envoyer les données du devis au formulaire de contact 7
	wp_remote_post( 'https://volant-seminaire.gribdev.net/wp-json/contact-form-7/v1/contact-forms/4/feedback', array(
		'headers' => $headers,
		'body' => $form_data,
	) );

	// Retourner le message personnalisé
	return $message;
}
add_filter( 'wpcf7_posted_data', 'customize_devis_message', 10, 2 );