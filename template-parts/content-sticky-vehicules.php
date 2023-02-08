<?php 
	$sticky = get_option('sticky_posts');
	$args = array(
		'post_type' => 'vehicules',
		'posts_per_page' => '-1',
		'post__in' => $sticky,
	);
	$query = new WP_Query($args);
	
	if($sticky){
	
	if($query->have_posts()) : 
	?>
							 
		<div class="container-fluid sticky-vehicules-container">
			<div class="container">
				<h3>Les véhicules à ne pas manquer</h3>
				<ul id="carousel-sticky" class="carousel-sticky">
					<?php while($query->have_posts()) : $query-> the_post();
						include('data/data-vehicules.php');
						?>
						<li class="d-inline-block content-sticky">
							<a class="d-block" href="<?= $permalink_vehicule ?>" title="Je suis intéressé par le véhicule : <?= $term_name_brand . ' ' . $title_vehicule ?>"> 
								<figure><?= $stickyFeatured ?></figure>
								<h4><?= $term_name_brand . '<br/>' . $title_vehicule ?></h4>
								<?php if( $promo_vehicule ){ ?>
									<p class="etiquette-vehicule vehicule-promo d-inline-block">promo</p>
									<div class="d-flex justify-content-center align-items-center">
										<p class="promo-price-vehicule d-inline-block"><?= $price_vehicule ?> €</p>
										<h5 class="price-vehicule d-inline-block"><?= $promo_price_vehicule ?> €</h5>
									</div>
								<?php } elseif( $new_vehicule ){ ?>
									<p class="etiquette-vehicule d-inline-block">Nouveau</p>
									<h5 class="price-vehicule d-inline-block"><?= $price_vehicule ?> €</h5>
								<?php } elseif( $sold_vehicule ){ ?>
									<p class="etiquette-vehicule d-inline-block">Vendu</p>
								<?php } else { ?>
									<h5 class="price-vehicule d-inline-block"><?= $price_vehicule ?> €</h5>
								<?php }?>
								<i class="ti-arrow-right d-block"></i>
							</a>
						</li>			
						<?php //endif;
					endwhile;?>
				</ul>
			</div>
		</div>
	<?php 
	endif; wp_reset_query();
	
	}?>