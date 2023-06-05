<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

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





function get_full_galerie() {
	$images = get_field('galerie');
	if(count($images) > 18)
		$images = array_slice($images, 0, 18);

	$videos = array();

	if( have_rows('galerie_videos') ) {
		while( have_rows('galerie_videos') ) {
			the_row();
			$videos[] = get_sub_field('video');
		} 
	}

	$total_elements = count($images) + count($videos);

	if($total_elements > 20) $total_elements = 20;

	$galerie = "<ul class='grid-full-galerie grid-full-galerie-$total_elements'>";

	$videos_positions = [];

	if(count($videos) > 0) {
		if(count($videos) == 1) $videos_positions = [1];
		if(count($videos) == 2) $videos_positions = [1, 7];

		for($i = 0; $i < count($videos); $i++) {
			$galerie .= "<li class='item-grid item-" . $videos_positions[$i] . "'>" . $videos[$i] . "<li>";
		}
	}

	$gap = 0;
	for($i = 1; $i <= $total_elements; $i++) {

		if(in_array($i, $videos_positions)) {
			$gap++;
			continue;
		}

		$galerie .= "<li class='item-grid item-$i'>";
		
		$size = 'full';
		$image_id = $images[$i - 1 - $gap]['id'];
		$galerie .= wp_get_attachment_image( $image_id, $size );

		$galerie .= "</li>";
	}

	$galerie .= "<ul>";
	return $galerie;
}

function the_full_galerie() {
	echo get_full_galerie();
}

function get_the_full_galerie() {
	return get_full_galerie();
}