<?php
function cpt_services(){
	$args = array(
			'post_type' => 'services',
			'posts_per_page'=>-1,
		);
		$query = new WP_Query($args);
			if($query->have_posts()) : ?>
				<div id="container-list-items-services" class="container-list-items-services container">
					<ul id="list-items-services" class="row">	
					<?php while($query->have_posts()) : $query-> the_post();
						$serviceID =  get_the_ID();
						$service = get_post( $serviceID );
						$service_title = esc_html($service->post_title);
						$service_link = get_the_permalink( $serviceID );
						$service_description = esc_html($service->post_content);
						$service_image_url = get_the_post_thumbnail_url( $serviceID, 'medium' );
						//var_dump($service);
						?>
						
							<li class="item-service item-service-choice col-6 col-md-3">
								<article id="article-service-<?= $serviceID ?>" class="article-service d-flex flex-column align-items-center" >
									<figure class="service-item-image">
										<img src="<?= esc_url( $service_image_url ) ?>" alt="volant-seminaire-<?= $service_title ?>"/>
									</figure>
									<div class="service-item-content">
										<h2><?= $service_title ?></h2>
										<p><?= $service_description ?></p>
									</div>
								</article>
							</li>

						<?php endwhile; ?>
					</ul>
				</div>
	<?php endif; wp_reset_query();
}



?>