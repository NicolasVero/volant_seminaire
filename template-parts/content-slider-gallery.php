<?php if($images): ?>
	<div class="slider-wrapper">
		<ul class="slider-preview noPad noMar col-12 col-lg-10">
			<?php foreach( $images as $image ):
				// var_dump($image); 
			?>
			<li class="type-image">
				<img src="<?php echo esc_url($image['sizes']['slider-vehicules']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<a class="pop-up" href="<?php echo esc_url($image['sizes']['large']); ?>"><i class="ti-search"></i></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<ul class="slider-thumb noPad noMar col-12 col-lg-2">
			<?php foreach( $images as $image ): ?>
			<li class="type-image">
				<img src="<?php echo esc_url($image['sizes']['thumbnail-slider-vehicules']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?>
<figure>
	<?= $imageFeatured ?>
</figure>
<?php endif;?>