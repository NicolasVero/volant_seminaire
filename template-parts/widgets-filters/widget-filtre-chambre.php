<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-chambers">
	<span class="title-filtre">Style de chambre</span>
	<ul id="filter-chambers" class="list-items-chamber-filters">
		<?php
			$terms_chamber = get_terms(
				array(
					'taxonomy' => 'chambres',
					'hide_empty' => true
				)
			);
			foreach ($terms_chamber as $term_chamber){
				$term_slug_chamber = $term_chamber->slug;
				$term_name_chamber = $term_chamber->name;
			?>
		
		<li class="item-filter-<?= $term_slug_chamber ?>" data-slug="<?= $term_slug_chamber ?>"><label id="label-chamber-<?= $term_slug_chamber ?>" for="filter-chamber-<?= $term_slug_chamber ?>"><input type="checkbox" value="style de chambre" id="filter-chamber-<?= $term_slug_chamber ?>" checked="checked"/><?= $term_name_chamber ?></label></li>
		<?php
			}
		?>
	</ul>
</div>