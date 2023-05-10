<?php

if (! defined('ABSPATH')) {
	exit;
}


if(isset($_POST['email'])) {
	echo "coucou";
	$errors_log = array();
	
	if(strlen($_POST['phone']) != 10       ) $errors_log[] = "Le numéro de téléphone renseigné est invalide";
	if(strlen($_POST['firstname']) < 1     ) $errors_log[] = "Veuillez renseigner votre prénom";
	if(strlen($_POST['lastname']) < 1      ) $errors_log[] = "Veuillez renseigner votre nom";
	//if(strlen($_POST['social_reason']) < 1 ) $errors_log[] = "Veuillez renseigner une raison sociale";
	if(strlen($_POST['message']) < 1       ) $errors_log[] = "Veuillez écrire un message";
	
	foreach($_POST as $index => $post) {
		if(preg_match('/nombre_personnes-/', $index)) {
			$ids[] = substr(17 - strlen($index));
		}
	}
	
	foreach($ids as $id) {
		if($_POST['nombre-personnes ']) {}
	}
	
	
	
	//var_dump($errors_log);
	
	if(count($errors_log) == 0) {
		session_start();
		
		$_SESSION = $_POST;
		
		//var_dump($_SESSION);
		//header("Location: " . $urlTemplate . "/inc/functions/function-submit-devis.php");
	}
	
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
			
			<!-- Faire appel au fichier de création de formulaire -->
			
			<form id="form-devis" method="post" action="<?php echo( $urlTemplate . '/inc/functions/function-submit-devis.php'); ?>">
			<?php foreach ( $devis_items_array as $devis_item ) :
				
				$activiteID =  get_the_ID();
				$activite = get_post( $activiteID );
				$activite_title = esc_html($activite->post_title);
				$activite_description = esc_html($activite->post_excerpt);
				$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
				$blog_info = get_bloginfo( 'name' );
				$blog_url = get_bloginfo( 'url' );
				$blog_admin = get_option( 'admin_email' ); 
				
				?>
				 
					<div id="titre_activite-<?= $activiteID ?>" class="devis-item">
						<div class="row">
							<figure class="devis-item-image col-3 col-md-3">
								<img src="<?= esc_url( $activite_image_url ) ?>" />
							</figure>
							<div class="devis-item-content col-9 col-md-8">						
								<h2><?= $activite_title ?></h2>
								<p><?= $activite_description ?></p>
							</div>
							<button class="delete-activity col-1"><i class="ti-trash"></i></button>
						</div>
						<div class="row">
							<input type="hidden" name="blog_info" value="<?= $blog_info ?>">
							<input type="hidden" name="blog_url" value="<?= $blog_url ?>">
							<input type="hidden" name="admin_email" value="<?= $blog_admin ?>">
							
							<!-- ID ACTIVITE PRINCIPALE -->
							
							<input type="hidden" name="id_principale" value="<?= $activiteID ?>">
							
							<!--  -->
							
							
							<input type="hidden" name="id_activite-<?= $activiteID ?>" value="<?= $activiteID ?>">
							<input type="hidden" name="titre_activite-<?= $activiteID ?>" value="<?php echo esc_attr( $activite_title ); ?>">
							<div class="col-12 col-md-6">
								<div class="d-flex align-items-center input-people">
									<label class="col-6 pl-0" for="nombre_personnes-<?= $activiteID ?>">Nombre de personnes</label>
									<input class="col-6" type="number" name="nombre_personnes-<?= $activiteID ?>" required>
								</div>
								<div class="d-flex align-items-center input-date">
									<label class="col-6 pl-0" for="date_activite-<?= $activiteID ?>">Date de l'activité</label>
									<input class="col-6" type="date" name="date_activite-<?= $activiteID ?>" min="<?= get_today_date() ?>" max="<?= get_max_date(6) ?>" required>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="d-flex align-items-center input-place">
									<label class="col-6 pl-0" for="lieu_seminaire-<?= $activiteID ?>">Lieu du séminaire</label>
									<input type="text" name="lieu_seminaire-<?= $activiteID ?>" required>
								</div>
								<div class="d-flex align-items-center input-hours">
									<label class="col-6 pl-0 d-flex align-items-center" for="horaires_debut-<?= $activiteID ?>">Horaires</label>
									<div class="d-flex col-6 align-items-center"><span>de</span><input type="time" name="horaires_debut-<?= $activiteID ?>" required> <span>à</span><input type="time" name="horaires_fin-<?= $activiteID ?>" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
	
				endforeach;
		
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
						<input class="d-inline-block" type="text" name="firstname" placeholder="Votre prénom" required>
						
						<label class="d-inline-block" for="lastname">Nom</label>
						<input class="d-inline-block" type="text" name="lastname" placeholder="Votre nom" required>
						
						<label class="d-inline-block" for="social_reason">Raison sociale</label>
						<input class="d-inline-block" type="text" name="social_reason" placeholder="Entreprise ou particuliers">
					</div>
					<div class="col-12 col-md-6">	
						<label class="d-inline-block" for="phone">Téléphone</label>
						<input class="d-inline-block" type="tel" name="phone" placeholder="+33 00 00 00 00 00" required>
						
						<label class="d-inline-block" for="email">Adresse e-mail</label>
						<input class="d-inline-block" type="email" name="email" placeholer="Votre adresse email" required>
					</div>
				</div>	
				<div class="row">
					<h3 class="col-12">Message</h3>
					<div class="col-12"><textarea name="message" placeholder="Votre message"></textarea></div>
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<input type="submit" value="Envoyer">
					</div>
				</div>
	
					
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