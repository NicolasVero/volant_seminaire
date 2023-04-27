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

<div id="container-page-article" class="container container-page-article">
	<div class="container-article-page container-article-page-<?= $ID ?>">
				
				<?php
					echo do_shortcode( '[display_devis_form]' );
				?>
				
	</div>
</div>


<?php get_footer();?>
