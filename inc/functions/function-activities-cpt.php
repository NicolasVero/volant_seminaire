<?php

function cpt_allActivities(){?>
	
	<div id="container-list-items-activities" class="container-list-items-activities container">
	<h2>Les activités</h2>
	
		<?php 
		$urlTemplate = get_stylesheet_directory();
		include( $urlTemplate . '/inc/functions/function-filters.php'); 
		
		$args = array(
				'post_type' => 'activites',
				'posts_per_page'=>-1,
				'orderby' => 'ID',
				'order'  => 'ASC'
			);
		
		$query = new WP_Query($args);
			if($query->have_posts()) : ?>
				
					<ul id="list-items-activities" class="row">	
					<?php 
					while($query->have_posts()) : $query-> the_post();
						
						$activiteID =  get_the_ID();
						$activite = get_post( $activiteID );
						$activite_title = esc_html($activite->post_title);
						$activite_link = get_the_permalink( $activiteID );
						$activite_description = esc_html($activite->post_excerpt);
						$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
						
						
						//var_dump($activite);
						
						?>
							<li class="item-activite item-activite-choice col-6 col-md-3" data-activiteID="<?= $activiteID ?>" data-activiteTITLE="<?= $activite_title ?>">
								<article id="Add_activite-<?= $activiteID ?>" class="link-Add_activite" >
									<?php if( is_front_page() ) : ?>
									<a href="<?= $activite_link ?>" title="En savoir plus sur l'activité : <?= $activite_title ?>">
									<?php endif;?>
										<figure class="devis-item-image">
											<img src="<?= esc_url( $activite_image_url ) ?>" alt="volant-seminaire-<?= $activite_title ?>"/>
											<i class="ti-plus"></i>
										</figure>
										<div class="devis-item-content">
											<h3><?= $activite_title ?></h3>
											<p><?= $activite_description ?></p>
										</div>
									<?php if( is_front_page() ) : ?>
									</a>
									<?php endif;?>
								</article>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
	<?php endif; wp_reset_query();
}

?>

