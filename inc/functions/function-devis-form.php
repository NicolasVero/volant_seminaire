<?php

if (! defined('ABSPATH')) {
	exit;
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
			<form id="form-devis" method="post" action="<?php echo( $urlTemplate . '/inc/functions/function-submit-devis.php'); ?>">
			<?php foreach ( $devis_items_array as $devis_item ) :
				
				$activiteID =  get_the_ID();
				$activite = get_post( $activiteID );
				$activite_title = esc_html($activite->post_title);
				$activite_description = esc_html($activite->post_excerpt);
				$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
				$blog_info = get_bloginfo( 'name' );
				$blog_admin = get_option( 'admin_email' ); 
				
				?>
				 
					<div id="titre_activite-<?= $activiteID ?>" class="devis-item">
						<figure class="devis-item-image">
							<img src="<?= esc_url( $activite_image_url ) ?>" />
						</figure>
						<div class="devis-item-content">
							
							<h2><?= $activite_title ?></h2>
							<p><?= $activite_description ?></p>
							
						</div>
						<input type="hidden" name="blog_info" value="<?= $blog_info ?>">
						<input type="hidden" name="admin_email" value="<?= $blog_admin ?>">
						<input type="hidden" name="id_activite-<?= $activiteID ?>" value="<?= $activiteID ?>">
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
					</div>
				<?php
	
				endforeach;
		
				?> 
				<div class="row">
					<h3 class="col-12">Séminaire clé en main</h3>
					<p class="d-flex justify-content-center">Nous travaillons depuis plus de 10 ans avec<br/>des prestataires Hôteliers.</p>
					<label class="d-inline-block" for=""></label>
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
					<div class="col-12" <textarea name="message" placeholder="Votre message"></textarea></div>
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