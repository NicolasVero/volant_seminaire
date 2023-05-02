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
		echo '<a href="' . esc_url( add_query_arg( 'activites', $current_post_slug, site_url( '/demander-un-devis' ) ) ) . '" class="button">Ajouter</a>';
	}
}
add_action( 'genesis_entry_content', 'add_to_devis_list_button' );


// Ajouter activité au devis
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


function devis_form() {

$args = array(
		'page_id' => 108,
	);
	$query = new WP_Query($args);

		if($query->have_posts()) : while($query->have_posts()) : $query-> the_post();
			the_title( '<h1 class="title-article-page">', '</h1>' );
		endwhile; endif; wp_reset_query();
		
	$devis_items = isset( $_GET['activites'] ) ? sanitize_text_field( $_GET['activites'] ) : '';
	$devis_items_array = explode( ',', $devis_items );		
			//var_dump($devis_items);
			
	?>

<div class="devis-form-container">
	<div class="devis-items-container">
	
			
		<form method="post" action="<?php  //echo esc_url( admin_url('admin-post.php') ); ?>">
		<!-- <input type="hidden" name="action" value="submit_devis"> -->
		
		<?php foreach ( $devis_items_array as $devis_item ) :
			$activiteID =  get_the_ID();
			$activite = get_post( $activiteID );
			$activite_title = esc_html($activite->post_title);
			$activite_description = esc_html($activite->post_excerpt);
			
			// var_dump($activiteID);
			$image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
			
			
			?>
			 
				<div id="titre_activite-<?= $activiteID ?>" class="devis-item">
					<figure class="devis-item-image">
						<img src="<?= esc_url( $image_url ) ?>" />
					</figure>
					<div class="devis-item-content">
						
						<h3><?= $activite_title ?></h3>
						<p><?= $activite_description ?></p>
						
					</div>
				
					<input type="hidden" name="titre_activite-<?= $activiteID ?>" value="<?php echo esc_attr( $activite_title ); ?>">
					
					<label for="nombre_personnes">Nombre de personnes :</label>
					<input value="80" type="number" name="nombre_personnes" required>
					
					<label for="date_activite">Date de l'activité :</label>
					<input value="2023-10-10" type="date" name="date_activite" required>
					
					<label for="lieu_seminaire">Lieu du séminaire :</label>
					<input value="Elbeuf" type="text" name="lieu_seminaire" required>
					
					<label for="horaires">Horaires :</label>
					<input value="9h à 17h" type="text" name="horaires" placeholder="ex: de 9h à 17h" required>
					<button><i class="ti-trash"></i></button>
				</div>
			<?php
			
			endforeach; 
			// Utiliser la balise de formulaire pour ajouter $devis_item
			?> 
			
				
				
				<label for="email">Votre adresse e-mail :</label>
				<input value="contact@gribouillenet.fr" type="email" name="email" required>
				
				<input type="submit" value="Envoyer">
			</form>
		</div>
		
</div>
<?php
	if ( isset( $_POST['nombre_personnes'] ) && isset( $_POST['date_activite'] ) && isset( $_POST['lieu_seminaire'] ) && isset( $_POST['horaires'] ) )
		submit_devis($activiteID);	
?>

	<script>function submit_devis(toto){
		console.log(toto);
	}</script>	
		
		<?php
	}
	
	add_shortcode( 'devis_form', 'devis_form' );
		
	
function submit_devis($activiteID) {

			
			// Récupérer les valeurs des champs du formulaire
			
			$activite_title = sanitize_text_field( $_POST[ 'titre_activite-' . $activiteID ] );
			$nombre_personnes = sanitize_text_field( $_POST['nombre_personnes'] );
			$date_activite = sanitize_text_field( $_POST['date_activite'] );
			$lieu_seminaire = sanitize_text_field( $_POST['lieu_seminaire'] );
			$horaires = sanitize_text_field( $_POST['horaires'] );
			
			// Ajouter les données dans la base de données
			global $wpdb;
			
			$table_name = $wpdb->prefix . 'devis';
			
			$data = array(
				'activite_title' 	=> $activite_title,
				'activite_id' 		=> $activiteID,
				'nombre_personnes' 	=> $nombre_personnes,
				'date_activite' 	=> $date_activite,
				'lieu_seminaire' 	=> $lieu_seminaire,
				'horaires' 			=> $horaires,
			);
			
			$format = array(
				'%s',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
			);
			
			$wpdb->insert( $table_name, $data, $format );
			
			// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
			$to = 'webmaster@gribouillenet.fr'; // Adresse personnalisée
			$subject = 'Nouvelle demande de devis pour l\'activité ' . get_the_title( $activiteID );
			$message = 
						'Titre de l\'activité : ' . $activite_title . "\n" .
						'Nombre de personnes : ' . $nombre_personnes . "\n" .
					   'Date de l\'activité : ' . $date_activite . "\n" .
					   'Lieu du séminaire : ' . $lieu_seminaire . "\n" .
					   'Horaires : ' . $horaires;
			$headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
			$headers .= 'Reply-To: ' . get_option( 'admin_email' ) . "\r\n";
			$headers .= 'CC: ' . sanitize_email( $_POST['email'] ) . "\r\n"; // Adresse de l'internaute
			
			wp_mail( $to, $subject, $message, $headers );
			
			// Rediriger l'utilisateur vers la page de confirmation de demande de devis
			wp_safe_redirect( home_url( '/confirmation-de-demande-de-devis/' ) );
			//exit;
		
	}