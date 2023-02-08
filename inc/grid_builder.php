<?php 
function vehicules_register_block( $blocks ) {
	
	// 'my_block' corresponds to the block slug.
	$blocks['vehicules'] = [
		'name' => __( 'Carte véhicules', 'text-domain' ),
		'render_callback' => 'vehicules_render',
	];

	return $blocks;
	
}

add_filter( 'wp_grid_builder/blocks', 'vehicules_register_block', 10, 1 );

// The render callback function allows to output content in cards.
function vehicules_render() {?>
<?php
	if (have_posts()) : while (have_posts()) : the_post();
		
	include('data/data-vehicules.php');

		if ($promo_vehicule) {
		?>
			<article class="article-vehicule article-vehicule-<?= $ID ?> article-vehicule-promo d-flex">
				<figure class="col-12 col-md-6">
					<?= $imageFeatured ?>
					<h4 class="vehicule-promo">promo</h4>
				</figure>
				<div class="col-12 col-md-6">
					<h3 class="brand-vehicule"><?= $brand_vehicule ?></h3>
					<h2 class="title-vehicule"><?= $title_vehicule ?></h2>
					<aside>
						<div class="d-flex">
							<p class="promo-price-vehicule col-6"><?= $price_vehicule ?></p>
						</div>
						<div class="d-flex">
							<p class="price-vehicule col-6"><?= $promo_price_vehicule ?></p>
							<a class="more-vehicule d-flex align-items-center justify-content-between col-6" title="En savoir plus sur le véhicule : <?= $brand_vehicule . ' ' . $title_vehicule?> " href="<?= $permalink_vehicule ?>">plus de détails<i class="ti-search"></i></a>
						</div>
					</aside>
				</div>
			</article>
	
			<?php
		} elseif ($new_vehicule) { ?>
	
			<article class="article-vehicule article-vehicule-<?= $ID ?> article-vehicule-new d-flex">
				<figure class="col-12 col-md-6">
					<?= $imageFeatured ?>
					<h4 class="vehicule-promo">nouveau</h4>
				</figure>
				<div class="col-12 col-md-6">
					<h3 class="brand-vehicule"><?= $brand_vehicule ?></h3>
					<h2 class="title-vehicule"><?= $title_vehicule ?></h2>
					<aside>
						<div class="d-flex">
							<p class="price-vehicule col-6"><?= $price_vehicule ?></p>
							<a class="more-vehicule d-flex align-items-center justify-content-between col-6" title="En savoir plus sur le véhicule : <?= $brand_vehicule . ' ' . $title_vehicule?> " href="<?= $permalink_vehicule ?>">plus de détails<i class="ti-search"></i></a>
						</div>
					</aside>
				</div>
			</article>
	
		<?php } elseif ($sold_vehicule) { ?>
	
			<article class="article-vehicule article-vehicule-<?= $ID ?> article-vehicule-sold d-flex">
				<figure class="col-12 col-md-6">
					<?= $imageFeatured ?>
					<h4 class="vehicule-promo">vendu</h4>
				</figure>
				<div class="col-12 col-md-6">
					<h3 class="brand-vehicule"><?= $brand_vehicule ?></h3>
					<h2 class="title-vehicule"><?= $title_vehicule ?></h2>
					<aside>
						<div class="d-flex">
							<p class="price-vehicule col-6"><?= $price_vehicule ?></p>
							<a class="more-vehicule d-flex align-items-center justify-content-between col-6" title="En savoir plus sur le véhicule : <?= $brand_vehicule . ' ' . $title_vehicule?> " href="<?= $permalink_vehicule ?>">plus de détails<i class="ti-search"></i></a>
						</div>
					</aside>
				</div>
			</article>
	
			<?php } else { ?>
	
			<article class="article-vehicule article-vehicule-<?= $ID ?> d-flex">
				<figure class="col-12 col-md-6">
					<?= $imageFeatured ?>
				</figure>
				<div class="col-12 col-md-6">
					<h3 class="brand-vehicule"><?= $brand_vehicule ?></h3>
					<h2 class="title-vehicule"><?= $title_vehicule ?></h2>
					<aside class="d-flex">
						<p class="price-vehicule col-6"><?= $price_vehicule ?></p>
						<a class="more-vehicule d-flex align-items-center justify-content-between col-6" title="En savoir plus sur le véhicule : <?= $brand_vehicule . ' ' . $title_vehicule?> " href="<?= $permalink_vehicule ?>">plus de détails<i class="ti-search"></i></a>
					</aside>
				</div>
			</article>
	
		<?php endif; } 
}