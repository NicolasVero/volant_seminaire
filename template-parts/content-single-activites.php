<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-activites.php');	
	
?>
	<div id="container-page-single-tax" class="container container-page-single-tax container-page-single-tax-<?= $ID ?>">
			<a class="button-return-back d-flex align-items-center" href="/" title="Revenir à la page d'accueil"><i class="icon-arrow-left"></i> activités filtrées</a>
			<article class="article-activite article-single-activite article-single-activite-<?= $ID ?>">
					<header class="header-article-activite d-flex justify-content-between align-items-center">
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
		