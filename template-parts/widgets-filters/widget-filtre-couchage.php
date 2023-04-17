<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-place-couchage">
	<span class="title-filtre">Nombre de places couchage</span>
	
	<ul id="filter-couchage" class="list-items-couchage-filters list-items-dropdown">
		<li class="filter-couchage filter-item-first d-flex align-items-center justify-content-between"><a href="#" class="filter-link-couchage-first actif" id="init-pl" >Toutes</a><i id="dropdown-pl" class="dropdown ti-angle-down"></i></li>
		<ul class="sub-menu-couchage sub-menu-dropdown">
		<?php
			$terms_place = get_terms(
				array(
					'taxonomy' => 'places',
					'hide_empty' => true
				)
			);
			foreach ($terms_place as $term_place){
				$term_slug_place = $term_place->slug;
			?>
			<li class="item-filter-couchage"><a href="#" class="filter-couchage" id="plc-<?= $term_slug_place ?>" ><?= $term_slug_place ?></a></li>
		<?php
			}
		?>
		</ul>
	</ul>
</div>