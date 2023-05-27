<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-activites.php');	
	
?>
	<div id="container-page-single-tax" class="container container-page-single-tax container-page-single-tax-<?= $ID ?>">	
			<article class="article-activite article-single-activite article-single- article-single-activite-<?= $ID ?>">
					<header class="headetr-article-activite d-flex justify-content-between">
						<h1 class="title-activite"><?= $title ?></h1>
						<?php
							if( function_exists('add_to_devis_list_button') ){
								add_to_devis_list_button();				
							}
						?>
					</header>
					<?php
					echo get_galerie();
					the_content();
					
					?>
					
			</article>
	</div>
		