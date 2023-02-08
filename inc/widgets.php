<?php
//WIDGET
function grib_widgets_init() {
	register_sidebar( array(
		'name'          => 'Téléphone',
		'id'            => 'widget-header-tel',
		'class'         => 'widget-tel',
		'before_widget' => '',
		'after_widget'  => ''
	) );
	register_sidebar( array(
		'name'          => 'Map',
		'id'            => 'widget-footer-map',
		'before_widget' => '<div id="%1$s" class="acf-container-map %2$s widget-container-map d-flex container-fluid">',
		'after_widget'  => '</div>'
	) );
}
add_action( 'widgets_init', 'grib_widgets_init' );
//SUPPRESSION SIDEBAR DE BASE
function remove_some_widgets(){
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'fourth-footer-widget-area' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );