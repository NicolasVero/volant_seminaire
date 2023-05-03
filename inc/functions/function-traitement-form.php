<?php
if (! defined('ABSPATH')) {
	exit;
}


if(isset($_POST['email']) ){
	var_dump($_POST);
	
	$all_activities = array();
	
	$cpt = 0;
	foreach($_POST as $index => $post) {
		if(preg_match('/id_activite-/', $index)) {
			$id[] = substr($index, 12);
			$cpt++;
		}
	}
	
	$datas = array('titre_activite', 'nombre_personnes', 'date_activite', 'lieu_seminaire', 'horaires_debut', 'horaires_fin');
	
	for($i = 0; $i < $cpt; $i++) {
		$activite = array();
		$activite_id = $id[$i]; 
		for($j = 0; $j < count($datas); $j++) {
			$activite[] = htmlspecialchars( sanitize_text_field( $_POST[$datas[$j] . '-' . $activite_id] ) );
		}
		$all_activities[] = $activite;
	}

}
	
	function send_mail( $all_activities ){
		
		// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
		$to = 'webmaster@gribouillenet.fr'; // Adresse personnalisée
				
		if(count($all_activities) == 1 ) {	
			//$subject = 'Nouvelle demande de devis pour l\'activité ' . get_the_title( $all_activities[0][1] );
			$subject = 'Nouvelle demande de devis pour l\'activité ' .  $all_activities[0][0];
		} else {
			$subject = 'Nouvelle demande de devis pour plusieurs activités';			
		}
		
		$message = '';
		
		for($i = 0; $i < count($all_activities); $i++) {
		
			$message .=	'Titre de l\'activité : ' 	. $all_activities[$i][0] . "\n" .
						'Nombre de personnes : ' 	. $all_activities[$i][1] . "\n" .
						'Date de l\'activité : ' 	. $all_activities[$i][2] . "\n" .
						'Lieu du séminaire : ' 		. $all_activities[$i][3] . "\n" .
						'Horaires : de ' 			. $all_activities[$i][4] . " à " .
													  $all_activities[$i][5] . "\r\n\n";
		
		}
		
		echo $message;
		
		$headers = 'From: ' . 'moi' . ' <toto>' . "\r\n";
		$headers .= 'Reply-To: toto' . "\r\n";
		$headers .= 'CC: ' . $_POST['email'] . "\r\n"; // Adresse de l'internaute
		echo 'reussi';
		
		
		// $headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
		// $headers .= 'Reply-To: ' . get_option( 'admin_email' ) . "\r\n";
		// $headers .= 'CC: ' . sanitize_email( $_POST['email'] ) . "\r\n"; // Adresse de l'internaute
		
		
		
		
		
		wp_mail( $to, $subject, $message, $headers );
		
		// Rediriger l'utilisateur vers la page de confirmation de demande de devis
		//wp_safe_redirect( home_url( '/confirmation-de-demande-de-devis/' ) );
		//exit;
	}




	var_dump($all_activities);	
	
	send_mail($all_activities);

		
	
	
	
	

	
	//! meme fonction, redeplacer apres
	//include( $urlTemplate . 'function-submit-devis.php');
	
	
	//ENVOI EMAIL	
	//include( $urlTemplate . 'function-send-mail.php');
	
	//AJOUT DES ACTIVITES À LA BDD
	//include( $urlTemplate . 'function-to-db.php');
