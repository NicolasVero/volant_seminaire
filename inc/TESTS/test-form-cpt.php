<?php
/*
  Template Name: FormulaireContact 
 */
?>
<?php get_header();?>
<?php
$nom=htmlspecialchars($_POST['nom']);
$mail=htmlspecialchars($_POST['mail']);
$commentaire=htmlspecialchars($_POST['commentaire']);
//on vérifie que le formulaire a bien été posté et qu'il n'y a pas de champ vide dans le formulaire
//on crée un tableau de messages,qu'on affiche s'il y a des erreurs
if($_SERVER['REQUEST_METHOD'] == "POST"){
		$messages = array();
		if(! isset($_POST['nom']) || ! strlen($_POST['nom'])){
				$messages[] = "Le nom doit être renseigné";
		}
		if(! isset($_POST['mail']) || ! strlen($_POST['mail'])|| (!filter_var($mail, FILTER_VALIDATE_EMAIL))){
				$messages[] ="L'adresse e-mail doit être renseignée";
		}
		if(! isset($_POST['commentaire']) || ! strlen($_POST['commentaire'])){
				$messages[] ="Le champ texte doit être renseigné";
		}
if(empty($messages)){
//message de confirmation pour le client 
$destinataire = $_POST['mail']; 
$sujet = "Recapitulatif de votre demande d'information"; 
$msg= "Bonjour ".$_POST['prenom']." ".$_POST['Nom'].", 
Nous avons bien pris en compte votre demande, nous revenons vers vous dans les plus brefs delais. 
_________________________________________________________________________________ 

Ceci est un mail automatique. Merci de ne pas y repondre. Vous pouvez nous contacter directement a : votre@mail.fr"; 
$headers = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
$headers .= 'From: votre societe <contact@votresociete.com>' . "\r\n"; 
mail($destinataire, $sujet, $msg, $headers);
$to = 'votre@mail.fr'; 
$subject = 'Un nouveau message de votre societe : '; 
$message = 'Nom : ' .$_POST['nom'].'<br />Adresse Email : '.$_POST['mail'].'<br />Message : '.$_POST['commentaire'].'<br />'.'<n />'; 
$headers = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$headers .= 'From: votre@mail.fr <votre@mail.fr>' . "\r\n" .'Reply-To: votre@mail.fr' . "\r\n" .
	 'X-Mailer: PHP/' . phpversion(); 
mail($to, $subject, $message, $headers); 
 $mailSent = true;
}
 /*
				 * Créer un custom post de type 'contact'
				 */
				$contact_post = array(
						'post_title' => $nom . ' | ' . $mail,
						'post_content' => $message,
						'post_type' => 'contact',
						'post_status' => 'publish'
				);
			   if (wp_insert_post($contact_post)) echo 'Votre message a bien été enregistré.<br>';
				else echo 'Erreur d\'enregistrement du message';
}
?>
  <?php if (!empty($_POST['messages'])): ?>
						<?php foreach ($_POST['messages'] as $msg) : ?>
							<?php echo $msg ?><br/>
						<?php endforeach; ?>
						<?php
					endif;
					unset($_POST['messages']);
					?>
					<br>
					<!--**************le formulaire**********-->   
					<?php if (isset($mailSent) && $mailSent == true) { ?>
<div align="center">
	<div id="post" >
		<h1>Merci, <?= $nom; ?></h1>
		<p>Votre e-mail a été envoyé avec succès. Vous recevrez une réponse sous peu.</p>
	</div>
</div>
<?php } else { ?>
			<?php if (isset($messages)) { ?>
				<p>Une erreur est survenue lors de l'envoi du formulaire.</p>
			<?php } ?>
			<div align="center">
				<div id="contact" >
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post" onsubmit="return valider_contact(this);">
						<ol class="forms">
							<li><label for="nom">Nom</label>
								<input type="text" name="nom" id="nom" placehoder="Nom" required  />                             
							</li>
							<li><label for="mail">E-mail</label>
								<input type="text" name="mail" id="mail" placehoder="Nom" required  />                           
							</li>
							<li class="textarea"><label for="commentaire">Message</label>
								<textarea name="commentaire" id="commentaire" rows="20" cols="30"  required  ></textarea>
								   </li>
							<li><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" class="btn btn-info">Envoyer</button></li>
						</ol>
					</form>
				 
				  </div>
  
			</div>  
<?php } ?>
<?php get_footer();?>