<div class="container-filtres">	

			<ul class="list-items-filters d-flex justify-content-center">
			<li class="item-filter"><a id="tous" class="actif" href="#">Toutes</a></li>
	
			<?php	$terms = get_terms(
					array(
						'taxonomy' => 'types_d_activites',
						'hide_empty' => true
				
					)
				);
	
				foreach ($terms as $term){
				$term_slug = $term -> slug;
				$term_name = $term -> name;
		
				echo '<li class="item-filter"><a href="#" id="'. $term_slug . '" class="filter">' . $term_name . '</a></li>';
				
				}			
				
				?>
				
	</ul>
</div>


	