<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-models">
	<span class="title-filtre">Modèles</span>
	<ul id="filter-models" class="list-items-brand-filters">
		<li class="item-filter"><a id="tous" class="actif" href="#"><i class="ti-close"></i></a></li>
		<?php
			$terms_models = get_terms(
				array(
					'taxonomy' => 'modeles',
					'hide_empty' => true
				)
			);
			foreach ($terms_models as $term_model){
				$term_model_slug = $term_model -> slug;
				$term_model_name = $term_model -> name;
		?>
		<li class="item-filter"><a href="#" id="<?= $term_model_slug ?>" class="filter-model"><?= $term_model_name ?></a></li>
		<?php
			}
		?>
	</ul>
</div>