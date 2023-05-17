<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
// include( $urlTemplate . '/inc/datas/);

function get_random_grid_class($max) {
	return 'grid-' . rand(1, $max);
}
