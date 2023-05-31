<?php

$activiteID =  get_the_ID();
$activite = get_post( $activiteID );
$activite_title = esc_html($activite->post_title);
$activite_slug = esc_html($activite->post_name);
$activite_link = get_the_permalink( $activiteID );
$activite_description = esc_html($activite->post_excerpt);
$activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
$activite_taxonomy = 'types_d_activites';
$activite_taxos = get_the_terms( $activiteID , $activite_taxonomy);

$taxos = [];
$classes = '';
for( $i = 0; $i< count( $activite_taxos ); $i++ ){
	$taxos[] = $activite_taxos[$i]->slug;
	$classes .= 'item-activite-' . $taxos[$i] . ' ';
}
//if( is_front_page() ) { 
	?>
	<li class="item-activite <?= $classes ?> col-6 col-md-3" data-activiteID="<?= $activiteID ?>" data-activiteTITLE="<?= $activite_title ?>">
		<article id="Add_activite-<?= $activiteID ?>" class="link-Add_activite" >
			<a href="<?= $activite_link ?>" title="En savoir plus sur l'activité : <?= $activite_title ?>">

				<figure class="devis-item-image">
					<img src="<?= esc_url( $activite_image_url ) ?>" alt="volant-seminaire-<?= $activite_title ?>"/>
					<i class="icon-plus"></i>
				</figure>
				<header class="devis-item-content">
					<h3><?= $activite_title ?></h3>
					<p><?= $activite_description ?></p>
				</header>
			</a>
		</article>
	</li>
