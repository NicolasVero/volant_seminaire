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
function add_to_devis($devis_url) {
	$devis_items = isset( $_GET['devis_items'] ) ? $_GET['devis_items'] : '';
	$activite_id = isset( $_GET['devis_item'] ) ? intval( $_GET['devis_item'] ) : 0;
	if ( $activite_id ) {
		if ( !empty( $devis_items ) ) {
			$devis_items .= ',';
		}
		$devis_items .= $activite_id;
	}
	wp_safe_redirect( home_url( '/demander-un-devis/?devis_item=' . $devis_items ) );
	exit;
}

add_action( 'admin_post_add_to_devis', 'add_to_devis' );
