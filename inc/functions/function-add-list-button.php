<?php
function add_to_devis_list_button() {
	// Ajouter le bouton "Ajouter à la liste de devis"
	if ( is_singular( 'activites' ) ) {
		global $post;
		// var_dump($post);
		$current_post_id = get_the_ID();
		$current_post_slug = $post->post_name;
		$current_post_title = $post->post_title;
		echo '<a href="' . esc_url( add_query_arg( 'activites', $current_post_slug, site_url( '/demander-un-devis' ) ) ) . '" class="button">Ajouter</a>';
	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );