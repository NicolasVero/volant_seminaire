<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
// include( $urlTemplate . '/inc/datas/);

function get_random_grid_class($n, $max) {

	$categorie = rand(1, $n) + 3;
	$slug      = rand(1, $max);

	return ['grid-' . $categorie . '-' . $slug, $categorie, $slug];
}
