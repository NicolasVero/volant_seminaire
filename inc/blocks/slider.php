<?php

	$slides = get_field( 'slides' );

	$className = 'slider-home';

	if( !empty($block['className']) ){
		$className .= ' ' . $block['className'];
	}

	if($slides){

	?>
<div class="container-slider-home">
	<ul class="<?= $className ?>">

		<?php foreach($slides as $slide){
			setup_postdata( $slide );


			$id = $slide->ID;

			$linkOn = get_field( 'link_slide_on', $id );
			$linkSlide = get_field( 'link_slide', $id );
			$imgSlide = get_field( 'image_slide', $id );
			$imgSize = 'slider';


			if($linkOn){
		?>
				<li class="slide">
					<a href="<?= $linkSlide ?>" title="En savoir plus">
						<figure><img src="<?php echo esc_url($imgSlide['url']); ?>" alt="<?php echo esc_attr($imgSlide['alt']); ?>" /></figure>
					</a>
				</li>

		<?php }else{ ?>
				<li class="slide slide-<?= $id ?>">
					<figure><?php echo wp_get_attachment_image( $imgSlide, $imgSize ); ?></figure>
				</li>
		<?php }

		} ?>

	</ul>
</div>
	<?php
		wp_reset_postdata();

	}