<?php
// AJOUTER SLUG CATEGORY ET SLUG POST AU BODY CLASS
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

// AJOUTER SLUG PAGE AU BODY CLASS
function add_slug_body_class( $classes ) {
	if ( is_page() ){
		global $post;
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	if ( is_search() ){
		$classes[] = 'search';
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );