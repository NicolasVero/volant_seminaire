<?php
/*
Template Name: Devis
*/

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-common.php');

get_header();
	echo do_shortcode('[devis_form]'); 
get_footer();?>
