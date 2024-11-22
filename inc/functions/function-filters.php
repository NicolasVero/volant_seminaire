<div class="container-filters">	

			<ul id="filters" class="list-items-filters">
	
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
					echo '<li class="item-filter"><a id="all" class="actif d-flex flex-column justify-content-center align-items-center" href="#"><figure class="item-filter-img d-flex justify-content-center"><img src="' . $sorted_terms[0]['term_icon']['url'] . '" alt="' . $sorted_terms[0]['term_icon']['alt'] . '"></figure><span>' . $sorted_terms[0]['term_name'] . '</span></a></li>';				
				// 		
				for($cpt = 1; $cpt < count($sorted_terms); $cpt++){
						echo '<li class="item-filter item-filter-' . $sorted_terms[$cpt]['term_id'] . '"><a href="#" id="'. $sorted_terms[$cpt]['term_slug'] . '" class="filter d-flex flex-column justify-content-center align-items-center"><figure class="item-filter-img d-flex justify-content-center"><img src="' . $sorted_terms[$cpt]['term_icon']['url'] . '" alt="' . $sorted_terms[$cpt]['term_icon']['alt'] . '"></figure><span>' . $sorted_terms[$cpt]['term_name'] . '</span></a></li>';
				}
				?>
				
	</ul>
	<div id="navigation-activities" class="navigation-activities"></div>
</div>