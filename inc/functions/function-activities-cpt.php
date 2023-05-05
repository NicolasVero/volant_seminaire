<?php
function cpt_allActivities(){
	$args = array(
			'post_type' => 'activites',
			'posts_per_page'=>-1,
		);
		$query = new WP_Query($args);
			if($query->have_posts()) : ?>
				<div id="container-list-items-activities" class="container-list-items-activities container">
					<ul id="list-items-activities" class="row">	
					<?php while($query->have_posts()) : $query-> the_post();
						$activiteID =  get_the_ID();
						$activite = get_post( $activiteID );
						$activite_title = esc_html($activite->post_title);
						$activite_link = get_the_permalink( $activiteID );
						$activite_description = esc_html($activite->post_excerpt);
						$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
						
						if( is_front_page() ) :?>
							<li class="item-activite i col-6 col-md-3" data-activiteID="<?= $activiteID ?>" data-activiteTITLE="<?= $activite_title ?>" onclick="//ajout_activite(<?php //echo $activiteID ?>)">
								<article id="Add_activite-<?= $activiteID ?>" class="link-Add_activite" >
									<a href="<?= $activite_link ?>" title="En savoir plus sur l'activité : <?= $activite_title ?>">
										<figure class="devis-item-image">
											<img src="<?= esc_url( $activite_image_url ) ?>" alt="volant-seminaire-<?= $activite_title ?>"/>
										</figure>
										<div class="devis-item-content">
											<h2><?= $activite_title ?></h2>
											<p><?= $activite_description ?></p>
										</div>
									</a>
								</article>	
							</li>
						<?php else: ?>
							<li class="item-activite item-activite-choice col-6 col-md-3" data-activiteID="<?= $activiteID ?>" data-activiteTITLE="<?= $activite_title ?>" onclick="//ajout_activite(<?php //echo $activiteID ?>)">
								<article id="Add_activite-<?= $activiteID ?>" class="link-Add_activite" >
									<figure class="devis-item-image">
										<img src="<?= esc_url( $activite_image_url ) ?>" alt="volant-seminaire-<?= $activite_title ?>"/>
									</figure>
									<div class="devis-item-content">
										<h2><?= $activite_title ?></h2>
										<p><?= $activite_description ?></p>
									</div>
								</article>
								<i class="ti-plus"></i>	
							</li>
						<?php endif;
						endwhile; ?>
					</ul>
				</div>
	<?php endif; wp_reset_query();
}

?>

