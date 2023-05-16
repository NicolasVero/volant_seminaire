<?php 
	$args = array(
		'post_title'    => $_COOKIE['reference'],
		'post_content'  => generate_content(),
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'devis',
	);
		
	wp_insert_post($args);
	
	//destroy_cookies();
	
	function generate_content() {
		
		$message = '
			<h2>Référence du devis ['. $_COOKIE['reference'] .']</h2>
			<p>Demandé par <strong>' . ucfirst(strtolower($_COOKIE['firstname'])) . ' ' . ucfirst(strtolower($_COOKIE['lastname'])) . '</strong></p> 
			<p>Fiche contact : <br/>Email : <strong>&lsaquo;' . $_COOKIE['email'] . '&rsaquo;</strong><br/>Téléphone : <strong>' . $_COOKIE['phone'] . '</strong><p>';
			
		$message .= '<p><i>' . $_COOKIE['message'] . '</i></p>';
	
		$activite_datas_index  = ['titre_activite', 'nombre_personnes', 'lieu_seminaire', 'date_activite', 'horaires_debut', 'horaires_fin'];	
		
		foreach(explode('/', $_COOKIE['ids']) as $id) {
			
			$message .= '<h3>' . $_COOKIE[$activite_datas_index[0] . '-' . $id] . '</h3>';	
			$message .= '<p>Nombre de personnes : <strong>' . $_COOKIE[$activite_datas_index[1] . '-' . $id] . ' personne(s)</strong>
						 Date, heures, et lieu souhaités :<strong> ' . $_COOKIE[$activite_datas_index[3] . '-' . $id] . ', de ' . $_COOKIE[$activite_datas_index[4] . '-' . $id]. ' à ' . $_COOKIE[$activite_datas_index[5] . '-' . $id] . ', à ' . ucfirst(strtolower($_COOKIE[$activite_datas_index[2] . '-' . $id])) . '</strong></p>';
			$message .= '<hr>';

			if( isset( $_COOKIE['lieu_seminaire_hotel'] ) ) 
				$message .= "<p>Préstation hôtelière à : <strong>" . ucfirst(strtolower($_COOKIE['lieu_seminaire_hotel'])) . '</strong></p>';
		}
		
		return $message;
	}
	
	function destroy_cookies() {
		foreach ($_COOKIE as $cookieName => $cookieValue) {
			setcookie($cookieName, '', time() - 3600, '/');
		}
	}
?>