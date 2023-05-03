<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

// BOUTON AJOUTER SUR SINGLE ACTIVITE
include( $urlTemplate . '/inc/functions/function-add-list-button.php');

// AJOUT DE L'ACTIVITE AU DEVIS DEPUIS SINGLE
include( $urlTemplate . '/inc/functions/function-add-to-devis.php');

//FORMULAIRE DEVIS
include( $urlTemplate . '/inc/functions/function-devis-form.php');

//LISTE DE TOUTES LES ACTIVITES
include( $urlTemplate . '/inc/functions/function-activities-cpt.php');