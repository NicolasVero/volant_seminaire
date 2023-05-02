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
		<form id="form-devis" method="post">
		<?php foreach ( $devis_items_array as $devis_item ) :
			
			$activiteID =  get_the_ID();
			$activite = get_post( $activiteID );
			$activite_title = esc_html($activite->post_title);
			$activite_description = esc_html($activite->post_excerpt);
			$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );

			?>
			 
				<article id="titre_activite-<?= $activiteID ?>" class="devis-item">
					<figure class="devis-item-image">
						<img src="<?= esc_url( $activite_image_url ) ?>" />
					</figure>
					<div class="devis-item-content">
						
						<h3><?= $activite_title ?></h3>
						<p><?= $activite_description ?></p>
						
					</div>
				
					<input type="hidden" name="titre_activite-<?= $activiteID ?>" value="<?php echo esc_attr( $activite_title ); ?>">
					
					<label for="nombre_personnes-<?= $activiteID ?>">Nombre de personnes :</label>
					<input type="number" name="nombre_personnes-<?= $activiteID ?>" required>
					
					<label for="date_activite-<?= $activiteID ?>">Date de l'activité :</label>
					<input type="date" name="date_activite-<?= $activiteID ?>" required>
					
					<label for="lieu_seminaire-<?= $activiteID ?>">Lieu du séminaire :</label>
					<input type="text" name="lieu_seminaire-<?= $activiteID ?>" required>
					
					<label for="horaires_debut-<?= $activiteID ?>">Horaires :</label>
					<p>de <input type="time" name="horaires_debut-<?= $activiteID ?>" required>
					à <input type="time" name="horaires_fin-<?= $activiteID ?>" required></p>
					<button><i class="ti-trash"></i></button>
				</article>
			<?php
			$activitiesID[] = $activiteID;

			endforeach;
		
			?> 
						
				<label for="email">Votre adresse e-mail :</label>
				<input value="contact@gribouillenet.fr" type="email" name="email" required>
				
				<input type="submit" value="Envoyer">
			</form>
		</div>
		
	</div>
	
	<?php
		cpt_allActivities();
		
		if ( isset( $_POST['email'] ) ){
			submit_devis( $activitiesID );
		}
}		
	
add_shortcode( 'devis_form', 'devis_form' );
		
	
function submit_devis( $activitiesID ) {
			//$activitiesID );
			foreach( $activitiesID as $activiteID ){
			// Récupérer les valeurs des champs du formulaire
			
			$activite_title 	= htmlspecialchars( sanitize_text_field( $_POST[ 'titre_activite-' . $activiteID ] ) );
			$nombre_personnes 	= htmlspecialchars( sanitize_text_field( $_POST['nombre_personnes-' . $activiteID ] ) );
			$date_activite 		= htmlspecialchars( sanitize_text_field( $_POST['date_activite-' . $activiteID ] ) );
			$lieu_seminaire 	= htmlspecialchars( sanitize_text_field( $_POST['lieu_seminaire-' . $activiteID ] ) );
			$horaires_debut		= htmlspecialchars( sanitize_text_field( $_POST['horaires_debut-' . $activiteID ] ) );
			$horaires_fin		= htmlspecialchars( sanitize_text_field( $_POST['horaires_fin-' . $activiteID ] ) );
			
			$all_activities[] = array($activite_title, $nombre_personnes, $date_activite, $lieu_seminaire, $horaires_debut, $horaires_fin);
			
			}
			
			var_dump( $all_activities );
			
			to_db( $all_activities );
			send_mail( $all_activities );
		

}
	
function send_mail( $all_activities ){
	// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
		$to = 'webmaster@gribouillenet.fr'; // Adresse personnalisée
		
		if(count($all_activities) == 1 )
			$subject = 'Nouvelle demande de devis pour l\'activité ' . get_the_title( $all_activities[0][1] );
		else 
			$subject = 'Nouvelle demande de devis pour plusieurs activités';
		
		$message = '';
		
		for($i = 0; $i < count($all_activities); $i++) {
		
			$message .=	'Titre de l\'activité : ' 	. $all_activities[$i][0] . "\n" .
						'Nombre de personnes : ' 	. $all_activities[$i][1] . "\n" .
						'Date de l\'activité : ' 	. $all_activities[$i][2] . "\n" .
						'Lieu du séminaire : ' 		. $all_activities[$i][3] . "\n" .
						'Horaires : de ' 			. $all_activities[$i][4] . " à " .
													  $all_activities[$i][5] . "\r\n\n";
		
		}
		$headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
		$headers .= 'Reply-To: ' . get_option( 'admin_email' ) . "\r\n";
		$headers .= 'CC: ' . sanitize_email( $_POST['email'] ) . "\r\n"; // Adresse de l'internaute
		
		wp_mail( $to, $subject, $message, $headers );
		
		// Rediriger l'utilisateur vers la page de confirmation de demande de devis
		wp_safe_redirect( home_url( '/confirmation-de-demande-de-devis/' ) );
		exit;
}

function to_db( $all_activities ){
	// Ajouter les données dans la base de données
	// global $wpdb;
	// 
	// $table_name = $wpdb->prefix . 'devis';
	
	// $data = array(
	// 	'activite_title' 	=> $activite_title,
	// 	'activite_id' 		=> $activiteID,
	// 	'nombre_personnes' 	=> $nombre_personnes,
	// 	'date_activite' 	=> $date_activite,
	// 	'lieu_seminaire' 	=> $lieu_seminaire,
	// 	'horaires' 			=> $horaires,
	// );
	// 
	// $format = array(
	// 	'%s',
	// 	'%d',
	// 	'%d',
	// 	'%s',
	// 	'%s',
	// 	'%s',
	// );
	
	// $wpdb->insert( $table_name, $data, $format );
}

function cpt_allActivities(){

		$args = array(
				'post_type' => 'activites',
				'posts_per_page'=>-1,
			);
			$query = new WP_Query($args);
				if($query->have_posts()) : ?>
					<div id="" class="">
						<ul id="list-items-activities" class="">	
						<?php while($query->have_posts()) : $query-> the_post();
							$activiteID =  get_the_ID();
							$activite = get_post( $activiteID );
							$activite_title = esc_html($activite->post_title);
							$activite_description = esc_html($activite->post_excerpt);
							$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
							?>
							<li class="item-activite" data-activiteID="<?= $activiteID ?>" data-activiteTITLE="<?= $activite_title ?>">
								<article id="Add_activite-<?= $activiteID ?>" class="link-Add_activite" >
									
										<figure class="devis-item-image">
											<img src="<?= esc_url( $activite_image_url ) ?>" />
										</figure>
										<div class="devis-item-content">
											
											<h3><?= $activite_title ?></h3>
											<p><?= $activite_description ?></p>
											
										</div>

								</article>	
							</li>
    					<?php endwhile; ?>
						</ul>
					</div>
		<?php endif; wp_reset_query();

}