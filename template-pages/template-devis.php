<?php
/*
Template Name: Devis
*/

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-common.php');

get_header();?>

	<div id="container-article-page-devis" class="container container-article-page container-article-page-devis container-article-page-<?= $ID ?>">

		<?php echo do_shortcode('[devis_form]'); ?>

	</div>


<?php get_footer();?>
