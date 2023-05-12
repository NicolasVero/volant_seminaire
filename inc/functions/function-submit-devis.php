<?php
$urlTemplate = $_SESSION['blog_url'];
echo 'bienvenue';
		session_start();


	


	if(isset($_SESSION['email']) ){
		
		$activites_rewrite = array();
		$activites_rewrite_id = array();
		foreach($_SESSION as $index => $session) {
			if(preg_match('/id_activite-/', $index)) {
				if(substr($index, 12 - strlen($index)) != $_SESSION['id_principale']) {
					$activites_rewrite_id[] = substr($index, 12 - strlen($index));
				}
			}
		}
		
		foreach($activites_rewrite_id as $activite_rewrite_id) {
			$datas = array();
			foreach($_SESSION as $index => $session) {
				if(preg_match('/' . $activite_rewrite_id . '/', $index)) {
					$datas[] = [$index, $session];
				}
			}
			$activites_rewrite[] = $datas;
		}
		
		var_dump($activites_rewrite);
		var_dump($activites_rewrite_id);
		
		
		$all_activities = array();
		
		$cpt = 0;
		foreach($_SESSION as $index => $session) {
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
				$activite[] = htmlspecialchars( $_SESSION[$datas[$j] . '-' . $activite_id] );
			}
			$all_activities[] = $activite;
		}
	
		// Envoyer un email à l'adresse personnalisée et à l'adresse de l'internaute qui a rempli le formulaire
		//$to = $_POST['admin_email']; // Adresse personnalisée --> webmaster@gribouillenet.fr
		$to = 'testappligrib@gmail.com';


		if(count($all_activities) == 1 )
			$subject = 'Demande de devis pour l\'activité ' . $all_activities[0][0] ;
		else 
			$subject = 'Demande de devis pour plusieurs activités';
			
		$reference = create_reference($_SESSION);

		$message_user   = get_message_user ($all_activities, $_SESSION, $urlTemplate , $reference);
		$message_admin  = get_message_admin ($all_activities, $_SESSION, $urlTemplate, $reference);

		echo $message_user;
		echo $message_admin;

		$headers = 'From: ' . $_SESSION['blog_info'] . ' <' . $to . '>' . "\r\n";
		$headers .= 'Reply-To: ' . $to . "\r\n";
		$headers .= 'CC: ' . htmlspecialchars( $_SESSION['email'] ) . "\r\n"; // Adresse de l'internaute
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		//mail( $_SESSION['email'], $subject, $message_user , $headers );
		//mail( $to, $subject, $message_admin, $headers );
	}

	//header('Location:' . $urlTemplate . '/confirmation-demande-de-devis/');
	
	function formate_phone_number($numero) {
		
		if(strlen($numero) == 10)
			return implode(' ', str_split($numero, 2));

		if(strlen($numero) > 10)
			return implode(' ', explode(substr($numero, 2, 1), $numero));
		
		return $numero;
	}

	function formate_date($date) {
		$date_formate = explode('-', $date);
		return $date_formate[2] . '.' . $date_formate[1] . '.' . $date_formate[0];
	}

	function formate_heure($heure) {
		return str_replace(':', 'h', $heure);
	}

	function create_reference($user_datas) {
		$reference = date('ymd');
		$reference .= strtoupper( substr($user_datas['firstname'], 0, 1) );
		$reference .= strtoupper( substr($user_datas['lastname'], 0, 1) );
		$reference .= '_';

		$alphabet="abcdefghijklmnopqrstuvwxyz";
		$reference .= strtoupper($alphabet[rand(0,25)]);

		return $reference;
	}

	function get_message_user($all_activities, $user_datas, $image_url, $reference) {
		$message = get_mail_header($image_url);

		$message .= '
			<h2 style="margin-left: 10%; margin-top: 50px; font-family: Arial, Helvetica, sans-serif;">Bonjour ' . ucfirst(strtolower($user_datas['firstname'])) . ' ' . ucfirst(strtolower($user_datas['lastname'])) . '</h2>
			<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">Référence de votre devis : ' . $reference . '</p>
			<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">Vous avez fait une demande de devis, et nous vous en remercions.</p>
			<hr>
			<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">Récapitulatif de votre demande : </p>'; 
						
		$message .= get_mail_loop($all_activities);
		$message .= get_mail_footer();

		return $message;
	}

	function get_message_admin($all_activities, $user_datas, $image_url, $reference) {

		$message = get_mail_header($image_url);

		$message .= '
			<h2 style="margin-left: 10%; margin-top: 50px; font-family: Arial, Helvetica, sans-serif;">Un utilisateur a fait une demande de devis</h2>
			<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">Référence du devis : ' . $reference . '</p>
			<div style="line-height: 6px;">
				<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">' . ucfirst(strtolower($user_datas['firstname'])) . ' ' . ucfirst(strtolower($user_datas['lastname'])) . '</p>
				<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">' . formate_phone_number($user_datas['phone']) . '</p>
				<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">' . $user_datas['email'] . '</p>
				<p style="margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">' . $user_datas['social_reason'] . '</p>
			</div>
			<p style="margin-left: 15%; margin-right: 15%; font-style: italic; margin-bottom: 50px; margin-top: 35px; font-family: Arial, Helvetica, sans-serif;">' . $user_datas['message'] . '</p>
			
			<hr>';

		$message .= get_mail_loop($all_activities);
		$message .= get_mail_footer();

		return $message;
	}
	

	function get_mail_header($image_url) {
		return 
		'<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>Votre bon de commande</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				   <meta content="width=device-width">
			</head>
			<body style="background-color: #DBDBDB;">
				<table style="width: 100%;">
					<tbody>
						<tr>
							<td align="center">
								<table style="background-color: #333333; height: 75px; min-width: 50%; max-width: 1000px;">
									<tbody>
										<tr>
											<td style="text-align: center">
												<img src="' .  $image_url . '/email/volant-seminaire-logo.png" alt="volant-seminaire-logo">
											</td>
										</tr> 
									</tbody>
								</table>
								<table style="background-color: white; min-width: 50%; max-width: 1000px;">
									<tbody>
										<tr>
											<td>';
	}

	function get_mail_loop($all_activities) {
		$message = '';

		for($i = 0; $i < count($all_activities); $i++) {
			$message .= '<h3 style="margin-bottom: 5px; margin-left: 10%; font-family: Arial, Helvetica, sans-serif;">' . $all_activities[$i][0] . '</h3>
			<p style="margin-left: 10%; margin-bottom: 30px; margin-top: 10px; font-family: Arial, Helvetica, sans-serif;">
			Pour ' . $all_activities[$i][1] . ' personne' .  ($all_activities[$i][1] > 1 ? 's' : '') . ', 
			<span style="display: block;">Le ' . formate_date($all_activities[$i][2]) . ', 
			à ' . ucfirst($all_activities[$i][3]) . ', de ' . formate_heure($all_activities[$i][4]) . ' à ' . formate_heure($all_activities[$i][5]) . '</span></p>';
		}

		return $message;
	}

	function get_mail_footer() {
		return '
				</td>
					</tr>
						</tbody>
								</table>
								<table style="background-color: #FF4E00; height: 75px; min-width: 50%; max-width: 1000px;">
									<tbody>
										<tr style="text-align: center">
											<td style="color: white; font-family: Arial, Helvetica, sans-serif">© ' . date("Y") . ' Volant Séminaire</td>
										</tr>    
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>';
	}
	