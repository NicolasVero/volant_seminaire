<?php
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
//WIDGET
function grib_widgets_init() {
	register_sidebar( array(
		'name'          => 'Menu latéral',
		'id'            => 'widget-menu-lateral',
		'class'         => 'widget-menu-lateral',
		'before_widget' => '<div id="%1$s" class="%2$s widget-container-map d-flex container-fluid">',
		'after_widget'  => '</div>'
	) );
}
add_action( 'widgets_init', 'grib_widgets_init' );
//SUPPRESSION SIDEBAR DE BASE
//SUPPRESSION SIDEBAR DE BASE
function remove_some_widgets(){
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'fourth-footer-widget-area' );
	unregister_sidebar( 'left-sidebar' );
	unregister_sidebar( 'right-sidebar' );
	unregister_sidebar( 'both-sidebars' );
	unregister_sidebar( 'both-right' );
	unregister_sidebar( 'both-left' );
	unregister_sidebar( 'header' );
	unregister_sidebar( 'top-bar' );
	unregister_sidebar( 'footer-bar' );
	unregister_sidebar( 'footer-1' );
	unregister_sidebar( 'footer-2' );
	unregister_sidebar( 'footer-3' );
	unregister_sidebar( 'footer-4' );
	unregister_sidebar( 'footer-5' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );