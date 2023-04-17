<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
//include( $urlTemplate . '/inc/datas/mon-fichier.php');


$ID = get_the_ID();
$title = get_the_title($ID);
$url_title = urlencode($title);
$terms_type = get_terms(
array(
	'object_ids' => $ID,
	'taxonomy' => 'types_de_vehicules'
)
);
