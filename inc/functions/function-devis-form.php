<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

unset($_SESSION);

// if(isset($_POST['submit_delete-80'])) {
// 	echo "<h1>Is set</h1>";
// }

// DETECTION ERREURS
if(isset($_POST['email'])) {

	
	foreach($_POST as $post) {
		$post = secure_input($post);
	}


	foreach($_POST as $index => $post) {
		if(preg_match('/nombre_personnes-/', $index) && !isset($_POST['submit_delete-' . substr($index, 17 - strlen($index))])) {
			$ids[] = substr($index, 17 - strlen($index));
			echo $index;
		}
	}

	
	$errors_log = array();
	$inputs_errors_name = array();
	
	if(strlen($_POST['phone']) < 10 ) {
		$errors_log[] = "Le numéro de téléphone renseigné est invalide";
		$inputs_errors_name[] = 'phone';
	}
	
	if(strlen($_POST['firstname']) < 1) {
		$errors_log[] = "Veuillez renseigner votre prénom";		
		$inputs_errors_name[] = 'firstname';
	}
	
	if(strlen($_POST['lastname']) < 1 ) {
		$errors_log[] = "Veuillez renseigner votre nom";
		$inputs_errors_name[] = 'lastname';
	}
	
	if(strlen($_POST['social_reason']) < 1 ) {
		$errors_log[] = "Veuillez renseigner une raison sociale";
		$inputs_errors_name[] = 'social_reason';
	}
	
	if(strlen($_POST['message']) < 1 ) {
		$errors_log[] = "Veuillez écrire un message";
		$inputs_errors_name[] = 'message';
	}
	
	
	
	if(isset($_POST['hotels']) && isset($_POST['lieu_seminaire_hotel'])) {
		if($_POST['hotels'] == 'on' && strlen($_POST['lieu_seminaire_hotel']) < 1) {
			$errors_log[] = "Veuillez sélectionner un hôtel";
			$inputs_errors_name[] = 'lieu_seminaire_hotel';
		} 
	}
	
	
	$inputs = ['nombre_personnes', 'date_activite', 'lieu_seminaire', 'horaires_debut', 'horaires_fin'];
	$errors = [
		'Veuillez renseigner un nombre de personne', 
		'Veuillez renseigner une date pour votre activité', 
		'Veuillez renseigner un lieu pour votre séminaire', 
		'Veuillez renseigner un horaire correct', 
		'Veuillez renseigner un horaire correct'
	];
	
	foreach($ids as $id) {
		for($i = 0; $i < count($inputs); $i++) {
			if(strlen($_POST[$inputs[$i] . '-' . $id]) < 1) {
				$errors_log[] = $errors[$i];
				$inputs_errors_name[] = $inputs[$i] . '-' . $id;
			}
		}
	}
	
	session_start();
		
	$_SESSION = $_POST;
	$_SESSION['erreurs'] = $errors_log;
	$_SESSION['input_erreurs'] = $inputs_errors_name;
	$_SESSION['ids'] = $ids;
	
	if(count($errors_log) == 0) {
		// header("Location: " . $urlTemplate . "/inc/functions/function-submit-devis.php");
		header("Location: https://volant-seminaire.gribdev.net/wp-content/themes/volant-seminaire/inc/functions/function-submit-devis.php");
		echo 'urltemp : ' . $urlTemplate;
	}
	
}

// UTILITAIRE 
function secure_input($input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

function rewrite($index) {
	if(isset($_SESSION[$index])) return $_SESSION[$index];
}

function get_today_date() {
	return date('Y-m-d');
}

function get_max_date($n) {
	return date("Y-m-d", strtotime("+" . $n . " year"));
}

function devis_form() {
	$urlTemplate = get_stylesheet_directory_uri();
	
	$args = array(
			'page_id' => 108,
		);
		$query = new WP_Query($args);
	
		if($query->have_posts()) : while($query->have_posts()) : $query-> the_post();
			the_title( '<h1 class="title-article-page">', '</h1>' );
		endwhile; endif; wp_reset_query();
			
		$devis_items = isset( $_GET['activites'] ) ? sanitize_text_field( $_GET['activites'] ) : '';
		$devis_items_array = explode( ',', $devis_items );		
				
		?>	
	
	<div class="devis-form-container">
		<div class="devis-items-container">
			<form id="form-devis" method="post" action="">

			<?php 
							
				$activiteID 			= get_the_ID();
				$activite 				= get_post( $activiteID );
				$activite_title 		= esc_html($activite->post_title);
				$activite_description 	= esc_html($activite->post_excerpt);
				$activite_slug 		  	= esc_html($activite->post_name);
				$activite_image_url 	= get_the_post_thumbnail_url( $activiteID, 'medium' );
				$blog_info          	= get_bloginfo( 'name' );
				$blog_url 				= get_bloginfo( 'url' );
				$blog_admin 			= get_option( 'admin_email' ); 
				
				?>
				 
					<input type="hidden" name="blog_info"     value="<?= $blog_info     ?>">
					<input type="hidden" name="blog_url"      value="<?= $blog_url      ?>">
					<input type="hidden" name="admin_email"   value="<?= $blog_admin    ?>">
					<input type="hidden" name="id_principale" value="<?= $activiteID    ?>">
					<input type="hidden" name="activite_slug" value="<?= $activite_slug ?>">
				 
				<?php 
				
					if(isset($_POST['email'])) {
						for($i = 0; $i < count($_SESSION['ids']); $i++) {
						
							$activiteID 			= $_SESSION['ids'][$i];
							$activite 				= get_post( $activiteID );
							$activite_title 		= esc_html($activite->post_title);
							$activite_description 	= esc_html($activite->post_excerpt);
							$activite_slug 		  	= esc_html($activite->post_name);
							$activite_image_url 	= get_the_post_thumbnail_url( $activiteID, 'medium' );
							$blog_info          	= get_bloginfo( 'name' );
							$blog_url 				= get_bloginfo( 'url' );
							$blog_admin 			= get_option( 'admin_email' ); 

							include( 'function-activite-form.php' );	
						}
					} else {
						include( 'function-activite-form.php' );
					}				
					
				?> 
				
				<button class="add-more-activity"><i id="open-menu" class="ti-plus"></i><span>Ajouter une autre activité</span></button>
				
				<div class="row">
					<h3 class="col-12">Séminaire clé en main</h3>
					<p class="d-flex justify-content-center">Nous travaillons depuis plus de 10 ans avec<br/>des prestataires Hôteliers.</p>
					
					<label class="d-inline-block" for="hotels">Recevoir une offre prestataire hoteliers</label>
					<input type="checkbox" id="hotels" name="hotels"> 
					
					<label class="d-inline-block" for="lieu_seminaire_hotel">Lieu souhaité du séminaire</label>
					<input type="text" id="lieu_seminaire_hotel" name="lieu_seminaire_hotel" disabled="true"></input>
					
				</div>
				<div class="row">
					<h3 class="col-12">Mes coordonnées</h3>
					<div class="col-12 col-md-6">
						<label class="d-inline-block" for="firstname">Prénom</label>
						<input class="d-inline-block" type="text" name="firstname" placeholder="Votre prénom" value="<?= rewrite('firstname') ?>">
						
						<label class="d-inline-block" for="lastname">Nom</label>
						<input class="d-inline-block" type="text" name="lastname" placeholder="Votre nom" value="<?= rewrite('lastname') ?>">
						
						<label class="d-inline-block" for="social_reason">Raison sociale</label>
						<input class="d-inline-block" type="text" name="social_reason" placeholder="Entreprise ou particuliers" value="<?= rewrite('social_reason') ?>">
					</div>
					<div class="col-12 col-md-6">	
						<label class="d-inline-block" for="phone">Téléphone</label>
						<input class="d-inline-block" type="tel" name="phone" placeholder="+33 00 00 00 00 00" value="<?= rewrite('phone') ?>">
						
						<label class="d-inline-block" for="email">Adresse e-mail</label>
						<input class="d-inline-block" type="email" name="email" placeholer="Votre adresse email" value="<?= rewrite('email') ?>">
					</div>
				</div>	
				<div class="row">
					<h3 class="col-12">Message</h3>
					<div class="col-12"><textarea name="message" placeholder="Votre message"><?= rewrite('message') ?></textarea></div>
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<input type="submit" value="Envoyer">
					</div>
				</div>
				
				<div class="errors" style="background-color: #FFB0B0;">
				
					<?php 
					
						if(isset($_SESSION['input_erreurs']))
							var_dump($_SESSION['input_erreurs']);
	
						if(isset($_SESSION['ids']))
							var_dump($_SESSION['ids']);
	
	
						if(isset($_SESSION['erreurs'])) {
							foreach($_SESSION['erreurs'] as $error) {
								echo '<p>' . $error . '</p>';		
							}
						}
						
					?>
					
				</div>
				

			</form>
		</div>
		
	</div>
			
		<?php
			 cpt_allActivities();
			
// 			if ( isset( $_POST['email'] ) ){
// 				submit_devis( $activitiesID );
// 			}
}		
add_shortcode( 'devis_form', 'devis_form' );