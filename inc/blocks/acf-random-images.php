	<?php
	$rows = get_field('images_aleatoires' );
		if( $rows ) {
			$index = array_rand( $rows );
			$rand_row = $rows[ $index ];
			$image = $rand_row['image'];
			$id = $image['id'];
			$url = $image['url'];
			$alt = $image['alt'];
			// var_dump($url);
			$className = 'random-image';
			if( !empty($block['className']) ){
				$className .= ' ' . $block['className'];
			}?>
			<div id="container-images-random" class="container-images-random">	
				
				<img id="<?= $className .'-'. $id ?>" class="<?= $className?>" src="<?= $url ?>" alt="<?= $alt ?>" />
				<h1><?= bloginfo('description'); ?></h1>
			
			</div>
		 <?php   } 
	?>
