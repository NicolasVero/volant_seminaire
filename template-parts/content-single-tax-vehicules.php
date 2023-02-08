<?php
if (! defined('ABSPATH')) {
	exit;
}

	include('data/data-vehicules.php');
	
	if( !empty($url_imgStar) ):?>
	
	<figure id="star-tax-single" class="star-tax star-tax-single star-tax-<?= $ID ?> star-tax-<?= $term_slug_type ?>" data-img="<?= $url_imgStar ?>"><?= $imgStar ?>
		<div id="bg-star-tax-single" class="bg-star-tax-single"></div>
	</figure>
	
	<?php endif;?>

	<div id="container-page-single-tax" class="container container-page-single-tax container-page-single-tax-<?= $ID ?>">	
		
		<?php include('items/items-breadcrumb.php');?>
		
		<!-- <div class="row"> -->
		<?php if ($promo_vehicule) { ?>
			<article class="col-12 article-vehicule article-single-vehicule article-single-<?= $term_slug_type ?> article-single-vehicule-<?= $ID ?> article-vehicule-promo <?= $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $promo_price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
				<h4 class="etiquette-vehicule vehicule-promo d-inline-block">promo</h4>
				<div class="d-flex justify-content-between">
					<header class="d-flex flex-column flex-md-row">
						<h2 class="brand-vehicule">
							<?= $term_name_brand ?>
						</h2>
						<h1 class="title-vehicule"><?= $title_vehicule ?></h1>
					</header>
					<aside class="details-single d-flex flex-column justify-content-center align-items-end align-items-md-center">
						<p class="price-vehicule price-<?= $term_slug_type ?> d-flex align-items-center"><?= $promo_price_vehicule_single ?> €</p>
						<p class="promo-price-vehicule d-flex"><?= $price_vehicule_single ?> €</p>
					</aside>
				</div>				
		<?php } elseif ($new_vehicule) {?>
			<article class="col-12 article-vehicule article-single-vehicule article-single-<?= $term_slug_type ?> article-vehicule-<?= $ID . ' ' . $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
				<h4 class="etiquette-vehicule d-inline-block">nouveau</h4>
				<div class="d-flex justify-content-between">
					<header class="d-flex flex-column flex-md-row">
						<h2 class="brand-vehicule">
							<?= $term_name_brand ?>
						</h2>
						<h1 class="title-vehicule"><?= $title_vehicule ?></h1>
					</header>
					<aside class="details-single d-flex flex-column justify-content-center align-items-end align-items-md-center">
						<p class="price-vehicule d-flex align-items-center"><?= $price_vehicule_single ?> €</p>
					</aside>
				</div>
		<?php } elseif ($sold_vehicule) { ?>
				<article class="col-12 article-vehicule article-single-vehicule article-single-<?= $term_slug_type ?> article-vehicule-<?= $ID . ' ' . $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
					<h4 class="etiquette-vehicule d-inline-block">vendu</h4>
					<div class="d-flex justify-content-between">
						<header class="d-flex flex-column flex-md-row">
							<h2 class="brand-vehicule">
								<?= $term_name_brand ?>
							</h2>
							<h1 class="title-vehicule"><?= $title_vehicule ?></h1>
						</header>
						<aside class="details-single d-flex flex-column justify-content-center align-items-end align-items-md-center">
						</aside>
					</div>
		<?php } else { ?>     
				<article class="col-12 article-vehicule article-single-vehicule article-single-<?= $term_slug_type ?> article-vehicule-<?= $ID . ' ' . $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
					
					<div class="d-flex justify-content-between">
						<header class="d-flex flex-column flex-md-row">
							<h2 class="brand-vehicule">
								<?= $term_name_brand ?>
							</h2>
							<h1 class="title-vehicule"><?= $title_vehicule ?></h1>
						</header>
						<aside class="details-single d-flex flex-column justify-content-center align-items-end align-items-md-center">
							<p class="price-vehicule d-flex align-items-center"><?= $price_vehicule_single ?> €</p>
						</aside>
					</div>
				       
				<?php }?>
					<div id="module-gallery" class="module-gallery">
						<?php include('content-slider-gallery.php'); ?>			
					</div>
					<div id="content-descriptif" class="row content-descriptif">
						<div class="col-12 col-md-6 col-text-single">
							<p><?= $descriptif_vehicule ?></p>	
							<?php if($tags_terms): echo $tags_terms; endif; ?>
						</div>
						
						<div class="col-12 col-md-6 col-widgets-single">
							<?php if( $visite_Pano ){?>
							<a id="button-360" class="button button-360 d-inline-block" href="#visite-pano">Visite à 360°<i class="icon-icon-360"></i></a>
							<?php }?>
							 <a class="button button-rdv d-inline-block" href="<?php bloginfo('url');?>/demande-de-rendez-vous?vehicule=<?= $url_title ?>">Intéressez ? Prendre un rendez-vous ?<i class="far fa-calendar-alt"></i></a>
	
							<?php echo do_shortcode( '[bws_pdfprint display="pdf"]' );?>
	
							<?php if( $file ):?>
								<a class="button button-pdf d-inline-block" href="<?= $file['url']?>" title="Télécharger la fiche récapitulative du véhicule : <?= $term_name_brand . ' ' . $title_vehicule ?>">Télécharger la fiche<i class="fas fa-cloud-download-alt" target="_blank"></i></a>
							<?php endif;?>
							
						</div>
						<?php if( $visite_Pano ){?>
						<div id="visite-pano" class="col-12 visite-pano">
							<h3 class="title-caracteristiques">Visite virtuelle</h3>
							<?php echo do_shortcode ('[panorama id=' . $visite_Pano . ']'); ?>
						</div>
						<?php }?>
					</div>
					<div id="content-caracteristiques" class="row content-caracteristiques">
						<div class="col-12 col-md-6 col-caracteristiques">
							<h3 class="title-caracteristiques">Caractéristiques techniques & équipements</h3>
							<ul>
								<?php include('content-single-caracteristiques.php');?>	
							</ul>
						</div>
						<div class="col-12 col-md-6 col-caracteristiques">
							<div class="d-flex flex-column">
								<h3 class="title-dimenssions">Dimensions (en m)</h3>
								<ul>
									<?php include('content-single-dimensions.php');?>	
								</ul>
							</div>
							<div class="d-flex flex-column">
								<h3 class="title-implantation">Implantation</h3>
								<ul>
									<?php include('content-single-implantations.php');?>	
								</ul>
							</div>
							<?php if($garantie){?>
								<div class="d-flex flex-column">
									<h3 class="title-garantie">Garantie</h3>
									<p class="text-garantie"><?= $garantie ?></p>
								</div>
							<?php }else{ ?>
								<div class="d-flex flex-column">
									<h3 class="title-garantie">Garantie</h3>
									<p class="text-garantie">-</p>
								</div>
							<?php } ?>
						</div>
						<?php
						if($option){?>
						<div class="col-12 d-flex flex-column">
							<h3 class="title-option">Option(s)</h3>
								<?php include('content-single-options.php');?>	
						</div>
						<?php }
						if($other_options){?>
						<div class="col-12 d-flex flex-column">
							<h3 class="title-option">Option(s) disponible(s)</h3>
								<?= $other_options ?>	
						</div>
						<?php }
						if($advantages){?>
							<div class="col-12 d-flex flex-column">
								<h3 class="title-option">Avantages Havre Caravano</h3>
									<?= $advantages ?>	
							</div>
						<?php } ?>
						
						<div class="col-12 d-flex flex-column">
							<h3 class="title-option">Prix</h3>
							<ul>
								<?php if ($promo_vehicule) { ?>
								<li class="item-list-caracteristiques">
									<p class="recap_promo-price-vehicule">Prix public : <span><?= $promo_price_vehicule ?> €</span></p>
								</li>
								<li class="item-list-caracteristiques">
									<p class="recap_price-vehicule">Prix promotionnel : <span><strong><?= $price_vehicule ?> €</strong></span></p>
								</li>
								<?php }else{
								
									if ($price_vehicle == 0){?>
										<li class="item-list-caracteristiques">
										<p class="recap_price-vehicule">Vendu</p>
									</li>
									<?php }
									else{
									?>
									
									<li class="item-list-caracteristiques">
										<p class="recap_price-vehicule">Prix public : <span><strong><?= $price_vehicule ?> €</strong></span></p>
									</li>
									<?php }
								}?>
								</li>
							</ul>
						</div>
					</div>
				</article>
	</div>
	<?php include('items/items-nav-post.php');?>
	<?php include('content-sticky-vehicules.php');?>