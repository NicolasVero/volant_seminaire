<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-carte-grise">
	<span class="title-filtre">Nombre de places carte grise</span>
	
	<ul id="filter-carte" class="list-items-carte-filters list-items-dropdown">
		<li class="filter-carte filter-item-first d-flex align-items-center justify-content-between"><a href="#" class="filter-link-carte-first actif" id="init-ct" >Toutes</a><i id="dropdown-ct" class="dropdown ti-angle-down"></i></li>
		<ul class="sub-menu-carte sub-menu-dropdown">
		<?php
			$terms_carte = get_terms(
				array(
					'taxonomy' => 'carte_grise',
					'hide_empty' => true
				)
			);
			foreach ($terms_carte as $term_carte){
				$term_slug_carte = $term_carte->slug;
			?>
			<li class="item-filter-carte" data-carte="<?= $term_slug_carte ?>"><a href="#" class="filter-carte" id="ct-<?= $term_slug_carte ?>" ><?= $term_slug_carte ?></a></li>
		<?php
			}
		?>
		</ul>
	</ul>
</div>