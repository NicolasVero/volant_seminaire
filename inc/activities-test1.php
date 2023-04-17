<?php


//intercepte et insère
function add_contact_form_to_activites_submission() {
	if ( is_singular( 'activites' ) ) {
		$activite_id = get_the_ID();
		$activite = get_post( $activite_id );
		$image_url = get_the_post_thumbnail_url( $activite_id, 'medium' );
		$form = '[contact-form-7 id="4" title="' . $activite->post_title . '"]';
		$content = '<div class="activite-form-container"><div class="activite-form-image"><img src="' . $image_url . '" /></div><div class="activite-form-content"><h2>' . $activite->post_title . '</h2><p>' . $activite->post_excerpt . '</p>' . $form . '</div></div>';
		$post = array(
			'ID' => $activite_id,
			'post_content' => $content,
		);
		wp_update_post( $post );
	}
}
add_action( 'init', 'add_contact_form_to_activites_submission' );

//bouton
function add_activite_button() {
	global $post;
		echo '<button id="add-activite-button" class="add-activite-button" data-activite-url="' . get_permalink( $post->ID ) . '">Ajouter</button>';
}
add_action( 'wp_content', 'add_activite_button' );

//affiche sur une autre page
function add_activite_form_popup() {
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var buttons = document.querySelectorAll('.add-activite-button');
			buttons.forEach(function(button) {
				button.addEventListener('click', function() {
					var activiteUrl = this.dataset.activiteUrl;
					var formUrl = '<?php echo get_bloginfo(); ?>/demander-un-devis?activite=' + encodeURIComponent(activiteUrl);
					window.open(formUrl, '_blank');
				});
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'add_activite_form_popup' );
