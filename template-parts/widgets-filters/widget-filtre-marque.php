<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-brands">
	<span class="title-filtre">Marques</span>
	<ul id="filter-brands" class="list-items-brand-filters">
		<li class="item-filter"><a id="toutes" class="actif" href="#"><i class="ti-close"></i></a></li>
		<?php	
			$terms_brand = get_terms(
				array(
					'taxonomy' => 'marques',
					'hide_empty' => true
				)
			);
			foreach ($terms_brand as $term_brand){
				$term_brand_slug = $term_brand->slug;
				$term_brand_name = $term_brand->name;
		?>
		<li class="item-filter item-filter-brand"><a href="#" id="<?=$term_brand_slug;?>" class="filter-brand"><?=$term_brand_name;?></a></li>
		<?php
			}
		?>
	</ul>
</div>