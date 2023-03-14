<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
// include( $urlTemplate . '/inc/datas/mon-fichier.php');

// Ajouter le bouton "Ajouter à la liste de devis"
function add_to_devis_list_button() {
	if ( is_singular( 'activites' ) ) {
		$current_post_id = get_the_ID();
		echo '<a href="' . esc_url( add_query_arg( 'devis_item', $current_post_id, site_url( '/demander-un-devis/' ) ) ) . '" class="button">Ajouter</a>';
	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );

// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_POST['devis_items'] ) ? $_POST['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	var_dump($devis_items_array);
	?>
	<div class="devis-form-container">
		<?php echo do_shortcode( '[contact-form-7 id="4" title="Formulaire activités"]' ); ?>
		<div class="devis-items-container">
			<h2>Items sélectionnés</h2>
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
				
				
				?>
				<div class="devis-item">
					<div class="devis-item-image">
						<img src="<?php echo esc_url( $image_url ); ?>" />
					</div>
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<p><?php echo esc_html( $activite->post_excerpt ); ?></p>
						<h4>Informations de réservation</h4>
						<?php echo do_shortcode( '[text nombre-personnes "Nombre de personnes"]' ); ?>
						<?php echo do_shortcode( '[date date-activite "Date de l\'activité"]' ); ?>
						<?php echo do_shortcode( '[text adresse-seminaire "Adresse du séminaire"]' ); ?>
						<?php echo do_shortcode( '[checkbox horaires "Horaires de l\'activité" "Matinée (9h-12h)" "Après-midi (14h-17h)" "Soirée (19h-22h)"]' ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

add_shortcode( 'display_devis_form', 'display_devis_form' );


