<?php
function add_to_devis() {
	$devis_item = $activite_id = isset( $_GET['activites'] ) ? sanitize_text_field( $_GET['activites'] ) : '';
	
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
	
	$nonce_url = wp_nonce_url( home_url( '/demander-un-devis/?activites=' . $devis_item ), 'add_to_devis' );
	wp_safe_redirect( $nonce_url );
	exit;
}
add_action( 'admin_post_add_to_devis', 'add_to_devis' );