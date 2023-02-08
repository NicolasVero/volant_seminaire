<?php

//SUPPRESSION DES COMMENTAIRES
add_filter('comments_open', 'wpc_comments_closed', 10, 2);
function wpc_comments_closed( $open, $post_id ) {
$post = get_post( $post_id );
if ('post' == $post->post_type)
$open = false;
return $open;
}


//AJOUT CHAMPS DÉPARTEMENT
/*
function saveCommentMeta($comment_id){
	if(isset($_POST['departement']) && !empty($_POST['departement']) ){
		add_comment_meta( $comment_id, 'departement', $_POST['departement'], true );
	}
}
add_action( 'comment_post', 'saveCommentMeta' );
*/

//GESTION DE L'AFFICHAGE DU FORMULAIRE DE COMMENTAIRE PAR DÉFAUT
/*
function wpdocs_comment_form_defaults( $defaults ) {
	$defaults = array(
		'title_reply' => __( 'Votre message' ),
		'title_reply_before' => '<div class="col-respons"><h4>',
		'title_reply_after' => '</h4>',
		'label_submit' => __( 'Envoyer' ),
		 'comment_notes_before' => '<em>En laissant un commentaire vous acceptez que campingcar.tv publie vos données personnelles et vous êtes d\'accord avec la politique de confidentialité des données du site. Vous disposez d\'un droit sur la publication de vos données suivant les conditions générales d\'utilisation du site que vous pouvez consulter <a href="/mentions-legales" title="Consulter les mentions légales">ici</a>. Les Champs avec une * sont obligatoires.</em>',
		 'comment_notes_after' => '',
		'comment_field' => __('<p class="comment-form-textarea"><textarea class="comment" name="comment" rows="8" aria-required="true" placeholder="150 mots maxi*"></textarea></p></div>')
  );
  return $defaults;
}
add_filter( 'comment_form_defaults', 'wpdocs_comment_form_defaults' );
*/

