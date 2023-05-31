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
<<<<<<< HEAD

	<div class="container container-article-page container-article-page-<?= $ID ?>">
=======
>>>>>>> master

		<?php 
<<<<<<< HEAD
		//echo do_shortcode( '[devis_form_CF7]' );
		
		echo do_shortcode('[devis_form]');
		?>

=======
		get_template_part( 'template-parts/items/items', 'breadcrumb' );
	?>	
	<div class="container-article-page container-article-page-<?= $ID ?>">
				
				<?php
				
				the_title( '<h1 class="title-article-page">', '</h1>' );
					echo do_shortcode( '[display_devis_form]' );
				?>
				
>>>>>>> master
	</div>


<?php get_footer();?>
