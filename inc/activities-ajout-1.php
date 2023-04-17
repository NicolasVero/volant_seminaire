<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
include( $urlTemplate . '/inc/datas/function display_devis_form() {
	global $post;
	
	// Récupérer les activités
	$args = array(
		'post_type' => 'activite',
		'posts_per_page' => -1,
	);
	$activites = get_posts($args);
	
	// Afficher la liste des activités
	echo '<ul class="activites-list">';
	foreach ($activites as $activite) {
		$thumbnail = get_the_post_thumbnail($activite->ID, 'thumbnail');
		$titre = get_the_title($activite->ID);
		$resume = get_the_excerpt($activite->ID);
		$url = get_permalink($activite->ID);
		echo '<li class="activite">';
		echo '<div class="activite-thumbnail">'.$thumbnail.'</div>';
		echo '<div class="activite-content">';
		echo '<h3 class="activite-titre">'.$titre.'</h3>';
		echo '<p class="activite-resume">'.$resume.'</p>';
		echo '<a href="#" class="ajouter-activite" data-url="'.$url.'">Ajouter</a>';
		echo '</div>';
		echo '</li>';
	}
	echo '</ul>';
	
	// Afficher le formulaire de demande de devis
	echo '<div class="devis-form">';
	echo do_shortcode('[contact-form-7 id="1234" title="Formulaire de demande de devis"]');
	echo '</div>';
	
	// Ajouter le script pour gérer l'ajout d'activité
	echo '<script>
		jQuery(document).ready(function($){
			$(".ajouter-activite").on("click", function(e){
				e.preventDefault();
				var url = $(this).data("url");
				$(".activites-selectionnees").append("<li><input type=\'hidden\' name=\'activites[]\' value=\'"+url+"\' />"+url+"</li>");
			});
		});
	</script>';
}.php');
