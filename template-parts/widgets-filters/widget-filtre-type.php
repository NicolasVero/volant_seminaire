<?php

if (! defined('ABSPATH')) {
	exit;
}
?>
<div class="widget-filter widget-filter-type d-none d-md-block">
	<h3>Les véhicules</h3>
	<ul id="filter-types" class="list-items-types-filters">
		
		<?php
		$terms = wp_get_post_terms( $post->ID, 'types_de_vehicules');
		$terms_slug = $terms[0]->slug;
		$args = array(
			'orderby'       => 'include', 
			'order'         => 'DESC',
			'hide_empty'    => false,
		);
		
		$terms_types = get_terms( 'types_de_vehicules' , $args );

		foreach ($terms_types as $term_type){
			$term_type_slug = $term_type->slug;
			$term_type_name = $term_type->name;
			$term_type_count = $term_type->count;
			
	if($terms_slug == $term_type_slug ){
	?>
	
<li><a class="current-tax" href="/<?= $term_type_slug ?>" title="Consulter les <?= $term_type_count ?> véhicule(s) de la catégorie : <?= $term_type_name ?>"><?= $term_type_name ?> <span class="count-type">(<?= $term_type_count ?>)</span></a></li>
	<?php
	}else{?>
		<li><a href="/<?= $term_type_slug ?>" title="Consulter les <?= $term_type_count ?> véhicule(s) de la catégorie : <?= $term_type_name ?>"><?= $term_type_name ?> <span class="count-type">(<?= $term_type_count ?>)</span></a></li>
	<?php }
 } ?>
	</ul>
</div>