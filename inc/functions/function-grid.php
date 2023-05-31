<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();
// include( $urlTemplate . '/inc/datas/);

function get_galerie() {

	$images    = get_field('galerie'       );
	$n_min     = get_field('min_de_photo'  );
	$n_max     = get_field('max_de_photo'  );
	$is_random = get_field('mode_aleatoire');


	if(!$images) return; 
	
	if($n_max > count($images)) $n_max = count($images);
	if($n_min > count($images))
		$n_min = ( count($images) > 1 ) ? $n_max - 1 : $n_max;
		
	if($n_min < 1 || $n_min > 8) $n_min = 4;
	if($n_max < 1 || $n_max > 8) $n_max = 6;
	
	if($n_min > $n_max) [$n_min, $n_max] = [$n_max, $n_min];

	$intervalle = $n_max - $n_min + 1;
	$categorie = rand($n_min, $n_max);

	if(in_array($categorie, [1, 2, 8])) $max_slug = 1;
	if(in_array($categorie, [3, 7]   )) $max_slug = 2;
	if(in_array($categorie, [4, 5, 6])) $max_slug = 5;
	
	$slug = rand(1, $max_slug);
	$class = 'grid-' . $categorie . '-' . $slug;

	if($is_random)
		shuffle($images);


	$galerie = "<ul id='galerie-medium' class='grid-galerie $class'>";
	
	for( $i = 1; $i <= $categorie; $i++ ) {
		$size = 'full';
		$image_id = $images[$i - 1]['id'];
		
		$galerie .= "<li class='item-grid item-$i'>";
		$galerie .= wp_get_attachment_image( $image_id, $size );
		$galerie .= "</li>";
	} 

	return $galerie .= "</ul>";
}

function the_galerie() {
	echo get_galerie();
}

function get_the_galerie() {
	return get_galerie();
}