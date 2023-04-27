<?php

if (! defined('ABSPATH')) {
	exit;
} 

	$urlTemplate = get_stylesheet_directory();
	$ID = get_the_ID();
?>


	<div class="container-article-page container-article-page-<?= $ID ?>">
				<h1>Demander un devis</h1>
				<?php the_content(); ?>
	</div>
