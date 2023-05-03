<?php

$urlTemplate = $_POST['blog_info'];

	if(isset($_POST['email']) ){
		//var_dump($_POST);
		
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
				$activite[] = htmlspecialchars( $_POST[$datas[$j] . '-' . $activite_id] );
			}
			$all_activities[] = $activite;
		}
	
	
		$to = $_POST['admin_email']; // Adresse personnalisée
		
		if(count($all_activities) == 1 )
			$subject = 'Nouvelle demande de devis pour l\'activité ' . $all_activities[0][0];
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
	}
	header('Location:' . $urlTemplate. '/confirmation-de-demande-de-devis/');
	

	
	