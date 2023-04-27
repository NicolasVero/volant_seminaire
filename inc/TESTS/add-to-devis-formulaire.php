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


function add_to_devis( $current_post_slug ) {
	$devis_item = $activite_id = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';

	$devis_items = '';

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

	// Créer un tableau de données pour l'activité
	$activity_data = array(
		'title' => get_the_title($activite_id),
		'slug' => $current_post_slug,
		'number_of_people' => '',
		'activity_date' => '',
		'location' => '',
		'time_range' => '',
	);

	// Stocker le tableau de données dans la session
	session_start();
	$_SESSION['activity_data'] = $activity_data;

	$nonce_url = wp_nonce_url( home_url( '/demander-un-devis/?devis_item=' . $devis_item ), 'add_to_devis' );
	wp_safe_redirect( $nonce_url );
	exit;
}


function display_devis_form() {
	$activite_id = isset( $_GET['devis_item'] ) ? sanitize_text_field( $_GET['devis_item'] ) : '';
	
	// Vérifiez si l'ID de l'activité est un nombre entier
	if ( ctype_digit($activite_id) && $activite_id ) {
		// Obtenez les données de l'activité à partir de son ID
		$activite = get_post( $activite_id );
		$activite_title = $activite->post_title;
		$activite_description = $activite->post_content;
		$activite_price = get_post_meta( $activite_id, 'prix', true );
	} else {
		// Si l'ID de l'activité n'est pas valide, redirigez l'utilisateur vers la page de demande de devis
		wp_safe_redirect( home_url( '/demander-un-devis/' ) );
		exit;
	}
	
	?>
	<form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
		<input type="hidden" name="action" value="submit_devis">
		<input type="hidden" name="activite_id" value="<?php echo esc_attr( $activite_id ); ?>">
		
		<h2><?php echo esc_html( $activite_title ); ?></h2>
		<p><?php echo esc_html( $activite_description ); ?></p>
		<p>Prix : <?php echo esc_html( $activite_price ); ?> €</p>
		
		<label for="nombre_personnes">Nombre de personnes :</label>
		<input type="number" name="nombre_personnes" required>
		
		<label for="date_activite">Date de l'activité :</label>
		<input type="date" name="date_activite" required>
		
		<label for="lieu_seminaire">Lieu du séminaire :</label>
		<input type="text" name="lieu_seminaire" required>
		
		<label for="horaires">Horaires :</label>
		<input type="text" name="horaires" placeholder="ex: de 9h à 17h" required>
		
		<label for="email">Votre adresse e-mail :</label>
		<input type="email" name="email" required>
		
		<input type="submit" value="Envoyer">
	</form>
	<?php
}

add_shortcode( 'devis_form', 'display_devis_form' );

function submit_devis() {
	if ( isset( $_POST['nombre_personnes'] ) && isset( $_POST['date_activite'] ) && isset( $_POST['lieu_seminaire'] ) && isset( $_POST['horaires'] ) ) {
		
		// Récupérer les valeurs des champs du formulaire
		$activite_id = sanitize_text_field( $_POST['activite_id'] );
		$nombre_personnes = sanitize_text_field( $_POST['nombre_personnes'] );
		$date_activite = sanitize_text_field( $_POST['date_activite'] );
		$lieu_seminaire = sanitize_text_field( $_POST['lieu_seminaire'] );
		$horaires = sanitize_text_field( $_POST['horaires'] );
		
		// Ajouter les données dans la base de données
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'devis';
		
		$data = array(
			'activite_id' => $activite_id,
			'nombre_personnes' => $nombre_personnes,
			'date_activite' => $date_activite,
			'lieu_seminaire' => $lieu_seminaire,
			'horaires' => $horaires,
		);
		
		$format = array(
			'%d',
			'%d',
			'%s',
			'%s',
			'%s',
		);
		
		$wpdb->insert( $table_name, $data, $format );
		
		// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
		$to = 'webmaster@gribouillenet.fr'; // Adresse personnalisée
		$subject = 'Nouvelle demande de devis pour l\'activité ' . get_the_title( $activite_id );
		$message = 'Nombre de personnes : ' . $nombre_personnes . "\n" .
				   'Date de l\'activité : ' . $date_activite . "\n" .
				   'Lieu du séminaire : ' . $lieu_seminaire . "\n" .
				   'Horaires : ' . $horaires;
		$headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
		$headers .= 'Reply-To: ' . get_option( 'admin_email' ) . "\r\n";
		$headers .= 'CC: ' . sanitize_email( $_POST['email'] ) . "\r\n"; // Adresse de l'internaute
		
		wp_mail( $to, $subject, $message, $headers );
		
		// Rediriger l'utilisateur vers la page de confirmation de demande de devis
		wp_safe_redirect( home_url( '/confirmation-de-demande-de-devis/' ) );
		exit;
	} else {
		// Si des champs sont manquants, rediriger l'utilisateur vers la page de demande de devis
		wp_safe_redirect( home_url( '/demander-un-devis/' ) );
		exit;
	}
}