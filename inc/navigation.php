<?php
// AJOUT MENU
register_nav_menus( array(
	'menu-header' => __( 'Menu header' ),
	'menu-footer' => __( 'Menu footer' ),
	'menu-copyright' => __( 'Menu copyright' ),
	'menu-widgets' => __( 'Menu widgets' ),
	'menu-medias-sociaux' => __( 'Menu medias sociaux' )
) );

//AJOUTER CLASSE SUR LI MENU
function special_nav_class($classes, $item) {
	$slug = strtolower($item->title);
    $slug = str_replace(' ?', '', $slug);
    $slug = str_replace('<span>', ' ', $slug);
    $slug = str_replace('</span>', ' ', $slug);
	$slug = str_replace('<strong>', ' ', $slug);
	$slug = str_replace('</strong>', ' ', $slug);
    $slug = str_replace(' !', '', $slug);
    $slug = str_replace(' ', '-', $slug);
	$slug = str_replace('--', '-', $slug);
	$slug = str_replace('<i-class="menu-icon-icon-icon-', '', $slug);
	$slug = str_replace('</i>', '', $slug);
	$slug = str_replace("d'", '', $slug);
	$slug = str_replace('">', '', $slug);
    $slug = preg_replace('#è|é|ê|ë|È|É|Ê|Ë#', 'e', $slug);
    $slug = preg_replace('#à|À#', 'a', $slug);
	$slug = str_replace('vehicules-neufs-vehicules-neufs', 'vehicules-neufs', $slug);
	$slug = str_replace('-vehicules-neufs', 'vehicules-neufs', $slug);
	$slug = str_replace('vehicules-occasions-vehicules-occasions', 'vehicules-occasions', $slug);
	$slug = str_replace('-vehicules-occasions', 'vehicules-occasions', $slug);
	$slug = str_replace('vehicules-occasionsvehicules-occasion', 'vehicules-occasions', $slug);
	$slug = str_replace('vehicules-occasions-vehicules-occasion', 'vehicules-occasions', $slug);
	$slug = str_replace('-vehicules-occasion-vehicules-occasion', 'vehicules-occasions', $slug);
	$classes[] = $slug;
	// if ( is_post_type_archive( 'Les véhicules' ) ){
	// 	if ( is_post_type_archive( 'Les véhicules' ) && get_post_type_archive_link( 'Les véhicules' ) == $item->url ){
	// 		$classes[] = 'current-menu-item';
	// 	}
	// }
	// echo '<pre>';
	// var_dump($classes);
	// echo '</pre>';
	return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

//AJOUT D'UNE IMAGE AU MENU
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
	foreach( $items as &$item ) {
		$icon = get_field('icone', $item);
		if( $icon ) {
			// echo '<pre>';
			// var_dump($item);
			// echo '</pre>';
			$item->title .='<i class="menu-icon icon-icon-'. $icon .'"></i>';
		}
	}
	return $items;
}
