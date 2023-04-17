<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();


// Ajouter le bouton "Ajouter à la liste de devis"
function add_to_devis_list_button() {
	if ( is_singular( 'activites' ) ) {
		global $post;
		$current_post_id = get_the_ID();
		$current_post_slug = $post->post_name;
		echo '<a href="' . esc_url( add_query_arg( 'devis_item', $current_post_id, site_url( '/demander-un-devis/' ) ) ) . '" class="button">Ajouter</a>';

	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );



// Ajouter activité au devis
function add_to_devis( $current_post_slug ) {
	$devis_item = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
	$activite_id = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
	
	//var_dump($devis_item);
	
	if ( ctype_digit($activite_id) && $activite_id ) {
		if ( ! empty( $devis_item ) ) {
			$devis_items .= ',';
		}
		$devis_item .= $activite_id;
	}
	
	if ( empty( $devis_item ) ) {
		wp_safe_redirect( home_url( '/demander-un-devis/' ) );
		exit;
	}

	$nonce_url = wp_nonce_url( home_url( '/demander-un-devis/?devis_item=' . $devis_item ), 'add_to_devis' );
	wp_safe_redirect( $nonce_url );
	exit;
	
	
	// Ajouter la valeur de la variable $devis_item à un champ caché [hidden] du formulaire Contact Form 7
	$additional_post = array(
		'devis-item' => $devis_item,
	);
	$_POST = array_merge($_POST, $additional_post);
	
	// Soumettre le formulaire de contact 7 avec les données post supplémentaires
	$submission = WPCF7_Submission::get_instance();
	$submission->set_posted_data($_POST);
	$result = WPCF7_Submission::get_instance()->submit();
	if ( $result->is_ok() ) {
		wp_safe_redirect( home_url( '/demander-un-devis/' ) );
	} else {
		echo "Le formulaire de contact n'a pas été soumis correctement.";
	}
	exit;
	
}
add_action( 'admin_post_add_to_devis', 'add_to_devis' );


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
				
	<?php endforeach; ?>
				
				
				
				
				
				<?php
				
				add_filter( 'wpcf7_form_tag', 'add_devis_item_to_cf7', 10, 2 );
				function add_devis_item_to_cf7( $tag, $unused ) {
					$devis_item = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
					if ( $devis_item ) {
						$tag['values'] = str_replace( "'", "\\'", $devis_item ) . ' ' . $tag['values'];
					}
					return $tag;
				}
				// Créer une nouvelle balise de formulaire pour ajouter $devis_item
				// function devis_item_form_tag_func( $tag ) {
				// 	if ( 'devis_item' == $tag['name'] ) {
				// 		$tag['values'] = $devis_items;
				// 	}
				// 	return $tag;
				// }
				// wpcf7_add_form_tag( 'devis_item', 'devis_item_form_tag_func', array( 'name-attr' => true ) );
				// 
				// // Utiliser la balise de formulaire pour ajouter $devis_item
				// echo do_shortcode( '[contact-form-7 id="4" title="Formulaire de demande de devis" devis_item="' . $devis_items . '"]' );
				?> 
			</div>
		</div>
		<?php
	}
	add_shortcode( 'display_devis_form', 'display_devis_form' );				
				



//Création de nouveaux champs personnalisés
function register_cf7_titre_activite_tag() {
	wpcf7_add_form_tag(
		[ 'titre_activite', 'titre_activite*' ],
		__NAMESPACE__ . '\\output_cf7_titre_activite_tag',
		[ 'name-attr' => true ]
	);
}
add_action( 'wpcf7_init', __NAMESPACE__ . '\\register_cf7_titre_activite_tag', 10, 0 );

function output_cf7_titre_activite_tag( $tag ) {
	if ( empty( $tag->name ) ) {
		return '';
	}

	$validation_error = wpcf7_get_validation_error( $tag->name );
	$class            = wpcf7_form_controls_class( $tag->type, 'wpcf7-activite' );
	$atts             = [];
	$value            = (string) reset( $tag->values );

	if ( $validation_error ) {
		$class .= ' wpcf7-not-valid';
	}

	$atts['type']          = 'text';
	$atts['name']          = $tag->name;
	$atts['class']         = $tag->get_class_option( $class );
	$atts['id']            = $tag->get_id_option();
	$atts['tabindex']      = $tag->get_option( 'tabindex', 'signed_int', true );
	$atts['autocomplete']  = $tag->get_option( 'autocomplete', '[-0-9a-zA-Z]+', true );
	$atts['aria-invalid']  = $validation_error ? 'true' : 'false';
	$atts['size']          = $tag->get_size_option( '10' );
	$atts['maxlength']     = $tag->get_maxlength_option();
	$atts['minlength']     = $tag->get_minlength_option();

	if ( $tag->has_option( 'readonly' ) ) {
		$atts['readonly'] = 'readonly';
	}

	if ( $tag->is_required() ) {
		$atts['aria-required'] = 'true';
	}

	if ( $tag->has_option( 'placeholder' ) || $tag->has_option( 'watermark' ) ) {
		$atts['placeholder'] = $value;
		$value               = '';
	}

	$value = $tag->get_default_option( $value );
	$value = wpcf7_get_hangover( $tag->name, $value );

	if ( isset( $_GET['titre_activite' ] ) && ! empty( $_GET['titre_activite' ]) ) {
		$value = (int) $_GET['titre_activite' ];
	}

	$atts['value'] = $value;
	$atts          = wpcf7_format_atts( $atts );

	$html = sprintf(
		'<span class="wpcf7-form-control-wrap %1$s"><input %2$s />%3$s</span>',
		sanitize_html_class( $tag->name ),
		$atts,
		$validation_error
	);

	return $html;
}

function validate_titre_activite_input_value( $result, $tag ) {
	$name = $tag->name;

	if ( $tag->basetype !== 'titre_activite' ) {
		return $result;
	}

	$value = isset( $_POST[ $name ] ) ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", ' ' ) ) ) : '';
	$value = strtoupper( $value );

	// Check if value is empty?
	if ( $tag->is_required() && empty( $value ) ) {
		$result->invalidate( $tag, wpcf7_get_message( 'activite_field_required' ) );
	}

	// Check if we're dealing with a correct WooCommerce Order?
	if ( ! $order = wc_get_order( $value ) ) {
		$result->invalidate( $tag, wpcf7_get_message( 'activite_field_invalid' ) );
	}

	return $result;
}
add_filter( 'wpcf7_validate_activite', __NAMESPACE__ . '\\validate_titre_activite_input_value', 10, 2 );
add_filter( 'wpcf7_validate_activite*', __NAMESPACE__ . '\\validate_titre_activite_input_value', 10, 2 );
