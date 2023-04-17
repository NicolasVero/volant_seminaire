<?php
//GESTION DES CSS ADMIN
function admin_styles_grib(){
wp_enqueue_style('admin-blocks', get_theme_file_uri('/css/admin.css'), array(), '20180820');
}
add_action( 'admin_enqueue_scripts', 'admin_styles_grib' );

// BLOCK REMONTÉE IMAGES ALÉATOIRES EN HOME PAGE
function block_images_random_home(){

	if( function_exists('acf_register_block') ) {

		acf_register_block_type(array(
			'name'				=> 'block-random-home',
			'title'				=> __('Images aléatoires'),
			'description'		=> __('Ici ajouter une image aléatoire qui s\'affichera en haut de la page d\'accueil.'),
			'render_callback'   => 'image_random_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'images-alt',
			'mode'				=> 'preview',
			'keywords'			=> array( 'Random', 'Image', 'Zone' ),
		));
	}
}
add_action('acf/init', 'block_images_random_home');

function image_random_render_callback( $block, $content = '', $is_preview = false ) {

	include 'blocks/acf-random-images.php';
}

// BLOCK REMONTÉE DES SLIDES POUR LE SLIDER EN HOME PAGE
function block_slide_home(){

	if( function_exists('acf_register_block') ) {

		acf_register_block_type(array(
			'name'				=> 'block-slide',
			'title'				=> __('Slide page d\'accueil'),
			'description'		=> __('Ici ajouter un slide qui s\'affichera sur la page d\'accueil.'),
			'render_callback'   => 'slide_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'images-alt',
			'mode'				=> 'preview',
			'keywords'			=> array( 'Slide', 'Image', 'Zone' ),
		));
	}
}
add_action('acf/init', 'block_slide_home');

function slide_render_callback( $block, $content = '', $is_preview = false ) {

		include 'blocks/acf-slider.php';
}
// BLOCK REMONTÉE D'UN ARTICLE ÉVÈNEMENT EN HOME PAGE
function block_event_home(){

	if( function_exists('acf_register_block') ) {

		acf_register_block_type(array(
			'name'				=> 'block-event',
			'title'				=> __('Remontée de l\'article évènement'),
			'description'		=> __('Ici choisir l\'article qui s\'affichera dans le bloc évènement de la page d\'accueil.'),
			'render_callback'   => 'event_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'format-image',
			'mode'				=> 'preview',
			'keywords'			=> array( 'Évènement', 'Image', 'Zone' ),
		));
	}
}
add_action('acf/init', 'block_event_home');

function event_render_callback( $block, $content = '', $is_preview = false ) {

		include 'blocks/acf-event.php';
}
// BLOCK REMONTÉE VÉHICULES À NE PAS MANQUER EN HOME PAGE
function block_sticky_vehicules(){

	if( function_exists('acf_register_block') ) {

		acf_register_block_type(array(
			'name'				=> 'block-sticky-vehicules',
			'title'				=> __('Remontée des véhicules à ne pas manquer'),
			'description'		=> __('Ici vont s\'afficher les véhicules mis en avant'),
			'render_callback'   => 'sticky_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'dashicons-car',
			'mode'				=> 'preview',
			'keywords'			=> array( 'Mis en avant', 'Véhicule', 'Zone', 'Sticky' ),
		));
	}
}
add_action('acf/init', 'block_sticky_vehicules');

function sticky_render_callback( $block, $content = '', $is_preview = false ) {

		include 'blocks/acf-sticky-vehicules.php';
}