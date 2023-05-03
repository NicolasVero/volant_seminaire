<?php
	
	echo'a';
	// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
	$to = $_POST['admin_email']; // Adresse personnalisée
	
	if(count($all_activities) == 1 )
		$subject = 'Nouvelle demande de devis pour l\'activité ' . $all_activities[0][0] ;
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
	$headers = 'From: ' . $_POST['blog_info'] . ' <' . $to . '>' . "\r\n";
	$headers .= 'Reply-To: ' . $to . "\r\n";
	$headers .= 'CC: ' . htmlspecialchars( $_POST['email'] ) . "\r\n"; // Adresse de l'internaute
	
	mail( $to, $subject, $message, $headers );