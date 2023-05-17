<?php

if (! defined('ABSPATH')) {
	exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/datas-activites.php');	
	
?>
	<div id="container-page-single-tax" class="container container-page-single-tax container-page-single-tax-<?= $ID ?>">	
			<article class="article-activite article-single-activite article-single- article-single-activite-<?= $ID ?>">
					<header class="">
						<h1 class="title-activite"><?= $title ?></h1>
						<?php
							if( function_exists('add_to_devis_list_button') ){
								add_to_devis_list_button();				
							}
						?>
					</header>
					<?php
					the_content();
					
					$images = get_field('galerie');
					
					
					if( $images ): 
						$random_grid = get_random_grid_class(5);
						?>

						<ul id="galerie-medium" class="grid-galerie <?= $random_grid ?>">
							<?php for( $i=0; $i < 5; $i++ ){
								$size = 'full';
								$image_id =  $images[$i]['id'];
							?>	
								<li class="item-<?= $i ?>">
									<?php echo wp_get_attachment_image( $image_id, $size ); ?>
								</li>
								
							<?php } ?>
						</ul>
					<?php endif; ?>
					
			</article>
	</div>	


<?php 

	function get_random_grid_class($max) {
		return 'grid-' . rand(1, $max);
	}