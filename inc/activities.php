<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();


// Ajouter le bouton "Ajouter à la liste de devis"
function add_to_devis_list_button() {
	if ( is_singular( 'activites' ) ) {
		$current_post_id = get_the_ID();
		echo '<a href="' . esc_url( add_query_arg( 'devis_item', $current_post_id, site_url( '/demander-un-devis/' ) ) ) . '" class="button">Ajouter</a>';
	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );

// Ajouter activité au devis
function add_to_devis() {
	$devis_items = isset( $_GET['devis_items'] ) ? $_GET['devis_items'] : '';
	$activite_id = isset( $_POST['activite_id'] ) ? intval( $_POST['activite_id'] ) : 0;
	if ( $activite_id ) {
		if ( !empty( $devis_items ) ) {
			$devis_items .= ',';
		}
		$devis_items .= $activite_id;
	}
	wp_safe_redirect( home_url( '/demander-un-devis/?devis_items=' . $devis_items ) );
	exit;
}
add_action( 'admin_post_add_to_devis', 'add_to_devis' );


// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_GET['devis_item'] ) ? $_GET['devis_item'] : '';
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
				</div>
			<?php endforeach; ?>
			<?php echo do_shortcode( '[contact-form-7 id="4" title="Formulaire de demande de devis"]' ); ?>
		</div>
	</div>
	<?php
}
add_shortcode( 'display_devis_form', 'display_devis_form' );

// Ajouter les champs personnalisés au formulaire de devis
function add_custom_devis_fields() {
	wpcf7_add_form_tag( 'nombre_personnes', 'custom_nombre_personnes_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'date_activite', 'custom_date_activite_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'adresse_seminaire', 'custom_adresse_seminaire_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'horaires', 'custom_horaires_field_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'titre_activite', 'custom_titre_activite_field_handler', array( 'name-attr' => true ) );
}
add_action( 'wpcf7_init', 'add_custom_devis_fields' );

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
function custom_horaires_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$html = '<label>' . esc_html( $tag->name ) . '</label><br />';
	$html .= '<select name="' . esc_attr( $tag->name ) . '">';
	$options = $tag->get_option( 'options', '' );
	if ( $options ) {
		foreach ( $options as $option ) {
			$html .= '<option value="' . esc_attr( $option ) . '">' . esc_html( $option ) . '</option>';
		}
	}
	$html .= '</select>';
	return $html;
}

// Gestionnaire pour le champ titre_activite
function custom_titre_activite_field_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );
	$html = '<label>' . esc_html( $tag->name ) . '</label><br />';
	$html .= '<input type="text" name="' . esc_attr( $tag->name ) . '" value="' . esc_attr( $tag->get_default_option( 'value' ) ) . '" />';
	return $html;
}

// Modifie le contenu du message de l'email envoyé depuis le formulaire de contact 7
function customize_devis_mail_body( $body, $form ) {
	if($form->id == 4){
		
		$datas = $form->posted_data;
				
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
		
		return $body;
	
	}
}
add_filter( 'wpcf7_mail_components', 'customize_devis_mail_body', 10, 2 );