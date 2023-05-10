<div class="container-filtres">	

			<ul class="list-items-filters d-flex justify-content-center">
	
			<?php	$terms = get_terms(
					array(
						'taxonomy' => 'types_d_activites',
						array(
							'hide_empty' => true,
							'order' => 'DESC'
						)
						
					)
				);
	
				foreach ($terms as $term){
				$term_id 	= $term -> term_id;
				$term_slug 	= $term -> slug;
				$term_name 	= $term -> name;
				$term_icon = get_field( 'icon_taxo_activite', $term );
				$term_parent = $term -> parent;
				var_dump($term);
				
				
						
					if( $term_parent == 0 ){
						echo '<li class="item-filter-' .$term_id . '"><a id="toutes" class="filter actif" href="#" id="'. $term_slug . '" class="filter"><img src="' . $term_icon['url'] . '" alt="' . $term_icon['alt'] . '"><span>' . $term_name . '</span></a></li>';
					}elseif ( $term_parent > 0 ){
						echo '<li class="item-filter-' .$term_id . '	"><a href="#" id="'. $term_slug . '" class="filter"><img src="' . $term_icon['url'] . '" alt="' . $term_icon['alt'] . '"><span>' . $term_name . '</span></a></li>';
					}
				}			
				
				?>
				
	</ul>
</div>


	