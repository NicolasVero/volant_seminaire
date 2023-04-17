<?php
/*
Template Name: Devis
*/

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-common.php');

	//If the form is submitted
	if(isset($_POST['submitted'])) {
	
		//Check to see if the honeypot captcha field was filled in
		if(trim($_POST['checking']) !== '') {
			$captchaError = true;
		} else {
			
			//Check to make sure that the nbre personnes field is not empty
			if(trim($_POST['nombre_personnes']) === '') {
				$nbrePersonnes = 'Indiquez le nombre de personnes.';
				$hasError = true;
			} else {
				$nbrePersonnes = trim($_POST['nombre_personnes']);
			}
			
			//Check to make sure that the name field is not empty
			if(trim($_POST['contactName']) === '') {
				$nameError = 'Indiquez votre nom.';
				$hasError = true;
			} else {
				$name = trim($_POST['contactName']);
			}
			
			//Check to make sure sure that a valid email address is submitted
			if(trim($_POST['email']) === '')  {
				$emailError = 'Indiquez une adresse e-mail valide.';
				$hasError = true;
			} else if (!mb_eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
				$emailError = 'Adresse e-mail invalide.';
				$hasError = true;
			} else {
				$email = trim($_POST['email']);
			}
				
			//Check to make sure comments were entered	
			if(trim($_POST['comments']) === '') {
				$commentError = 'Entrez votre message.';
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$comments = stripslashes(trim($_POST['comments']));
				} else {
					$comments = trim($_POST['comments']);
				}
			}
				
			//If there is no error, send the email
			if(!isset($hasError)) {
				
				$emailTo = 'webmaster@gribouillenet.fr';
				$subject = 'Demande de devis';
				$sendCopy = trim($_POST['sendCopy']);
				$body .= "\n\nTitre de l'activité : $titreActivite";
				$body .= "\n\nNombre de personnes : $nbrePersonnes";
				$body .= "";
				$body .= "";
				$body .= "\n\nNom : $name";
				$body .= "\n\nEmail : $email";
				$body .= "\n\nMessage : $comments";
	
			
				$headers = 'De : mon site <'.$emailTo.'>' . "\r\n" . 'Répondre à : ' . $email;
				
				mail($emailTo, $subject, $body, $headers);
				
				if($sendCopy == true) {
					$subject = 'Formulaire de contact';
					$headers = 'De : <noreply@volant-seminaire.fr>';
					mail($email, $subject, $body, $headers);
				}
				$emailSent = true;
			}
		}
	} 

get_header();
?>

<div id="container-page-article" class="container container-page-article">
		<?php 
		get_template_part( 'template-parts/items/items', 'breadcrumb' );
	?>	
	<div class="container-article-page container-article-page-<?= $ID ?>">
				
				<?php
				
				if(isset($emailSent) && $emailSent == true) { ?>
				
					<div class="thanks" data="<?=$name;?>">
						<h1>Merci, <?=$name;?></h1>
						<p>Votre e-mail a été envoyé avec sucés. Vous recevrez une réponse sous peu.</p>
					</div>
				
				<?php } else { ?>
				
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<h1><?php the_title(); ?></h1>
							
							<?php 	$devis_items = isset( $_GET['devis_item'] ) ? $_GET['devis_item'] : '';
									$devis_items_array = explode( ',', $devis_items );
							?>
							
							<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
								<ol class="forms">
									<div class="devis-form-container">
										
										<ul class="devis-items-container">
											<?php foreach ( $devis_items_array as $devis_item ) :
												$activite = get_post( $devis_item );
												$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
												$idActivite = $activite->ID;
												$titreActivite = esc_html( $activite->post_title );
												$DescriptActivite = esc_html( $activite->post_excerpt );
												?>
												<li id="devis-item-<?= $idActivite ?>" class="devis-item">
													<div class="devis-item-image">
														<img src="<?= esc_url( $image_url ) ?>" />
													</div>
													<div class="devis-item-content">
														<h3><?= $titreActivite ?></h3>
														<p><?= $DescriptActivite ?></p>
													</div>
													<div class="devis-item-form">
														<?php var_dump($_POST);?>
														<input type="hidden" name="<?= $titreActivite ?>" value="<?php if(isset($titreActivite)) echo $titreActivite; ?>">
														<label>Nombre de personnes</label>
														<input type="number" name="nombre_personnes_<?php echo $devis_item; ?>" value="<?php if(isset($_POST['nombre_personnes'])) echo $_POST['nombre_personnes'];?>" class="requiredField" />
														
														<label>Date de l'activité</label>
														<input type="date" name="date_activite_<?php echo $devis_item; ?>" value="" />
														<label>Adresse du séminaire</label>
														<input type="text" name="adresse_seminaire_<?php echo $devis_item; ?>" value="" />
														<label>Horaires de l'activité</label>
														<select name="horaires_heure_debut_<?php echo $devis_item; ?>">
															<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
																<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php endfor; ?>
														</select>
														h
														<select name="horaires_minute_debut_<?php echo $devis_item; ?>">
															<option value="00">00</option>
															<option value="15">15</option>
															<option value="30">30</option>
															<option value="45">45</option>
														</select>
														à
														<select name="horaires_heure_fin_<?php echo $devis_item; ?>">
															<?php for ( $i = 00; $i <= 23; $i++ ) : ?>
																<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
															<?php endfor; ?>
														</select>
														h
														<select name="horaires_minute_fin_<?php echo $devis_item; ?>">
															<option value="00">00</option>
															<option value="15">15</option>
															<option value="30">30</option>
															<option value="45">45</option>
														</select>
													</div>					
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
									
									<?php /// champs identiques ?>
									
									<li><label for="contactName">Nom</label>
										<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
									</li>
									
									<li><label for="email">E-mail</label>
										<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
									</li>
									
									<li class="textarea"><label for="commentsText">Message</label>
										<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
									</li>
									<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /><label for="sendCopy">Recevoir une copie du message</label></li>
									<li class="screenReader"><label for="checking" class="screenReader">Pour envoyer ce formulaire, ne saisissez RIEN dans ce champ</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
									<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Envoyer</button></li>
									
									
									
									
								</ol>
							</form>
							
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Une erreur est survenue lors de l'envoi du formulaire.</p>
							<?php } ?>
							
						<?php endwhile; ?>
					<?php endif; ?>
			<?php } ?>
	</div>
</div>


<?php get_footer();?>
