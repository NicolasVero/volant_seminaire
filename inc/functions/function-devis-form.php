<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

unset($_SESSION);

// DETECTION ERREURS
if(isset($_POST['email'])) {

	// Sécurisation des données
	foreach($_POST as $post) {
		$post = secure_input($post);
	}

	$ids = array();
	$errors_log = array();
	$inputs_errors_name = array();
	$skip_verif = false;

	// Récupérer ID des différentes activités
	foreach($_POST as $index => $post) {
		if(preg_match('/nombre_personnes-/', $index) && !isset($_POST['submit_delete-' . substr($index, 17 - strlen($index))])) {
			$ids[] = substr($index, 17 - strlen($index));
		}
	}
	
	// Si tous les posts supprimés, revient à celui de base	
	if(count($ids) == 0 && isset($_POST['id_principale'])) {
		$ids[] = $_POST['id_principale'];
		$skip_verif = true;
	}


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
	
	// if(strlen($_POST['social_reason']) < 1 ) {
	// 	$errors_log[] = "Veuillez renseigner une raison sociale";
	// 	$inputs_errors_name[] = 'social_reason';
	// }
	
	if(strlen($_POST['email']) < 1) {
		$errors_log[] = "Veuillez renseigner un email";
		$inputs_errors_name[] = 'email';
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
		'Veuillez renseigner un horaire de début correct', 
		'Veuillez renseigner un horaire de fin correct'
	];
	
	if(!$skip_verif) {
		foreach($ids as $id) {
			for($i = 0; $i < count($inputs); $i++) {
				if(strlen($_POST[$inputs[$i] . '-' . $id]) < 1 || ($i == 0 && $_POST['nombre_personnes'] < 0)) {
					$errors_log[] = $errors[$i];
					$inputs_errors_name[] = $inputs[$i] . '-' . $id;
				}
			}
			if(strlen($_POST[$inputs[3] . '-' . $id]) > 0 && strlen($_POST[$inputs[4] . '-' . $id]) > 0) {
				if(!compare_hours($_POST[$inputs[3] . '-' . $id], $_POST[$inputs[4] . '-' . $id] )) {
					$errors_log[] = "Les heures de début et de fin de séminaire ne sont pas correctes";
					$inputs_errors_name[] = $inputs[3] . '-' . $id;
					$inputs_errors_name[] = $inputs[4] . '-' . $id;
				}
			}
		}
	}
	
	
	session_start();
		
	$_SESSION = $_POST;
	$_SESSION['erreurs'] = $errors_log;
	$_SESSION['input_erreurs'] = $inputs_errors_name;
	$_SESSION['ids'] = $ids;
	
	if(count($errors_log) == 0) {
		//header("Location: " . $urlTemplate . "/inc/functions/function-submit-devis.php");
		header("Location: https://volant-seminaire.gribdev.net/wp-content/themes/volant-seminaire/inc/functions/function-submit-devis.php");
	}
	
}

// UTILITAIRE 
function secure_input($input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

function compare_hours($heure_1, $heure_2) {
	if(strlen($heure_1) != 5 || strlen($heure_2) != 5) return null;
	
	return str_replace(':', '', $heure_1) < str_replace(':', '', $heure_2);
}

function rewrite($index) {
	if(isset($_SESSION[$index])) return $_SESSION[$index];
}

function display_error($input, $id = null) {
	if($id != null) $input .= '-' . $id;
	if(isset($_SESSION['input_erreurs'])) {
		foreach($_SESSION['input_erreurs'] as $index => $input_erreur) {
			if($input == $input_erreur) {
				return '<span class="d-inline-block error-form">' . $_SESSION['erreurs'][$index] . '</span>';
			}
		}
	}
	return false;
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
	
		if($query->have_posts()) :?>
	<div id="container-article-page-devis" class="container-article-page container-article-page-devis">		
		<div id="devis-form-container" class="container devis-form-container">
		<?php while($query->have_posts()) : $query-> the_post();
			the_title( '<h1 class="title-article-page">', '</h1>' );
		endwhile; endif; wp_reset_query();
			
		$devis_items = isset( $_GET['activites'] ) ? sanitize_text_field( $_GET['activites'] ) : '';
		$devis_items_array = explode( ',', $devis_items );		
				
		?>
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
				<div class="add-seminaire">
				<a href="#" id="add-more-activity" class="button button-add-more-activity d-inline-block"><span class="d-flex align-items-center"><i class="button-orange button-circle icon-plus d-flex justify-content-center align-items-center"></i><span class="d-block">Ajouter une autre activité</span></a>
				</div>
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
						<div class="item-input-form">
							<label class="d-inline-block" for="firstname">* Prénom</label>
							<input class="d-inline-block" type="text" name="firstname" placeholder="Votre prénom" value="<?= rewrite('firstname') ?>">
							<?= display_error('firstname') ?>
						</div>
						<div class="item-input-form">
							<label class="d-inline-block" for="lastname">* Nom</label>
							<input class="d-inline-block" type="text" name="lastname" placeholder="Votre nom" value="<?= rewrite('lastname') ?>">
							<?= display_error('lastname') ?>
						</div>
						<div class="item-input-form">
							<label class="d-inline-block" for="social_reason">Raison sociale</label>
							<input class="d-inline-block" type="text" name="social_reason" placeholder="Entreprise ou particuliers" value="<?= rewrite('social_reason') ?>">
							<?= display_error('social_reason') ?>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="item-input-form">	
							<label class="d-inline-block" for="phone">* Téléphone</label>
							<input class="d-inline-block" type="tel" name="phone" placeholder="+33 00 00 00 00 00" value="<?= rewrite('phone') ?>">
							<?= display_error('phone') ?>
						</div>
						<div class="item-input-form">
							<label class="d-inline-block" for="email">* Adresse e-mail</label>
							<input class="d-inline-block" type="email" name="email" placeholer="Votre adresse email" value="<?= rewrite('email') ?>">
							<?= display_error('email') ?>
						</div>
					</div>
				</div>	
				<div class="row">
					<h3 class="col-12">* Message</h3>
					<div class="item-input-form">
						<div class="col-12"><textarea name="message" placeholder="Votre message"><?= rewrite('message') ?></textarea></div>
						<?= display_error('message') ?>	
					</div>
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<input type="submit" value="Envoyer">
					</div>
				</div>
				
			</form>
		</div>
	</div>
	<?php cpt_allActivities();			
}		
add_shortcode( 'devis_form', 'devis_form' );