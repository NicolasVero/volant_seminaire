<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();


// Ajouter le bouton "Ajouter à la liste de devis"
function add_to_devis_list_button() {
	if ( is_singular( 'activites' ) ) {
		global $post;
		// var_dump($post);
		$current_post_id = get_the_ID();
		$current_post_slug = $post->post_name;
		$current_post_title = $post->post_title;
		echo '<a href="' . esc_url( add_query_arg( 'devis_item', $current_post_slug, site_url( '/demander-un-devis' ) ) ) . '" class="button">Ajouter</a>';

	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );


// Ajouter activité au devis
function add_to_devis( $current_post_slug ) {
	$devis_item = $activite_id = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
	
	var_dump($devis_item);
	
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
		'devis_item' => $devis_item,
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


function devis_form_CF7() {
	
$devis_items = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
$devis_items_array = explode( ',', $devis_items );

$args = array(
		'page_id' => 108,
	);
	$query = new WP_Query($args);

		if($query->have_posts()) : while($query->have_posts()) : $query-> the_post();
			the_title( '<h1 class="title-article-page">', '</h1>' );
		endwhile; endif; wp_reset_query();
?>

<div class="devis-form-container">
	<div class="devis-items-container">
		<?php foreach ( $devis_items_array as $devis_item ) :
			$activite = get_post( $devis_item );
			$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
			
			if(!is_page(108) ){?> 
				<div class="devis-item">
					<figure class="devis-item-image">
						<img src="<?= esc_url( $image_url ) ?>" />
					</figure>
					<div class="devis-item-content">
						
						<h3><?= esc_html( $activite->post_title ) ?></h3>
						<p><?= esc_html( $activite->post_excerpt ) ?></p>
						
					</div>
				</div>
			<?php } 
			
			endforeach; 
				
				function add_devis_item_to_cf7( $hidden_fields ) {
					$devis_item = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
					if ( $devis_item ) {
						$hidden_fields[] = array(
							'name' => 'devis_item',
							'value' => $devis_item,
							'is_hidden' => true
						);
					}
					return $hidden_fields;
				}
				add_filter( 'wpcf7_form_hidden_fields', 'add_devis_item_to_cf7' );
				
				//Créer une nouvelle balise de formulaire pour ajouter $devis_item
				function devis_item_form_tag_func( $devis_item, $tag ) {
					if ( 'devis_item' == $tag['name'] ) {
						$tag['values'] = $devis_item;
					}
					return $tag;
					//var_dump($tag);
				}
				wpcf7_add_form_tag( 'devis_item', 'devis_item_form_tag_func', array( 'name-attr' => true ) );
				
				// Utiliser la balise de formulaire pour ajouter $devis_item
				echo do_shortcode( '[contact-form-7 id="4" title="Formulaire de demande de devis" devis_item="' . $devis_item . '"]' );
				?> 
		</div>
		<?php
	}
	add_shortcode( 'devis_form_CF7', 'devis_form_CF7' );

?>