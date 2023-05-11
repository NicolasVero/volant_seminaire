<div id="filters" class="container-filters">	

			<ul class="list-items-filters d-flex justify-content-center">
	
			<?php	$terms = get_terms(
					array(
						'taxonomy' => 'types_d_activites',
						'hide_empty' => true
					)
				);

				$termKey = [];
				foreach( $terms as $index => $term ){
					$termKey[] = $index; 
				}
				
				$i = 1;
				for($cpt = 0; $cpt < count($terms); $cpt++) {
 	
					$term_id 	= $terms[$termKey[$cpt]] -> term_id;
					$term_slug 	= $terms[$termKey[$cpt]] -> slug;
					$term_name 	= $terms[$termKey[$cpt]] -> name;
					$term_icon = get_field( 'icon_taxo_activite', $terms[$termKey[$cpt]] );
					$term_parent = $terms[$termKey[$cpt]] -> parent;
					
					if( $term_parent != 0){
						$sorted_terms[$i] = [
							'term_id' 		=> $term_id, 
							'term_slug' 	=> $term_slug, 
							'term_name'		=> $term_name, 
							'term_icon'		=> $term_icon, 
							'term_parent'	=> $term_parent
							];
						$i++;
					}else{
						$sorted_terms[0] = [
							'term_id' 		=> $term_id, 
							'term_slug' 	=> $term_slug, 
							'term_name'		=> $term_name, 
							'term_icon'		=> $term_icon, 
							'term_parent'	=> $term_parent
						];

					}
				}
				
				echo '<li class="item-filter-' . $sorted_terms[0]['term_id'] . '"><a id="all" class="filter actif" href="#"><img src="' . $sorted_terms[0]['term_icon']['url'] . '" alt="' . $sorted_terms[0]['term_icon']['alt'] . '"><span>' . $sorted_terms[0]['term_name'] . '</span></a></li>';
				// 		
				for($cpt = 1; $cpt < count($sorted_terms); $cpt++){
					
					echo '<li class="item-filter-' . $sorted_terms[$cpt]['term_id'] . '	"><a href="#" id="'. $sorted_terms[$cpt]['term_slug'] . '" class="filter"><img src="' . $sorted_terms[$cpt]['term_icon']['url'] . '" alt="' . $sorted_terms[$cpt]['term_icon']['alt'] . '"><span>' . $sorted_terms[$cpt]['term_name'] . '</span></a></li>';
				}
				?>
				
	</ul>
</div>


	