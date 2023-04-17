<?php

$ID = get_the_ID();
$title_vehicule = get_the_title($ID);
$url_title = urlencode($title_vehicule);
$terms_type = get_terms(
array(
    'object_ids' => $ID,
    'taxonomy' => 'types_de_vehicules'
)
);
foreach ($terms_type as $term_type){
$term_slug_type= $term_type->slug;
}
$terms_brand = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'marques',
        'hide_empty' => true
    )
);
foreach ($terms_brand as $term_brand){
    $term_slug_brand = $term_brand->slug;
    $term_name_brand = $term_brand->name;
}
$terms_model = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'modeles',
        'hide_empty' => true
    )
);
foreach ($terms_model as $term_model){
    $term_slug_model = $term_model->slug;
    $term_name_model = $term_model->name;
}
$terms_chamber = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'chambres',
        'hide_empty' => true
    )
);
foreach ($terms_chamber as $term_chamber){
    $term_slug_chamber = $term_chamber->slug;
    $term_name_chamber = $term_chamber->name;
}
$terms_salon = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'salons',
        'hide_empty' => true
    )
);
foreach ($terms_salon as $term_salon){
    $term_slug_salon = $term_salon->slug;
    $term_name_salon = $term_salon->name;
}
$terms_carte = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'carte_grise',
        'hide_empty' => true
    )
);
foreach ($terms_carte as $term_carte){
    $term_slug_carte = $term_carte->slug;
}
$terms_place = get_terms(
    array(
        'object_ids' => $ID,
        'taxonomy' => 'places',
        'hide_empty' => true
    )
);
foreach ($terms_place as $term_place){
    $term_slug_place = $term_place->slug;
}

$price_vehicule = get_field('prix', $ID);
$price_vehicule_single = number_format((int)$price_vehicule, 0, ',', ' ');
$promo_vehicule = get_field('promo', $ID);
$promo_price_vehicule = get_field('prix_promo', $ID);
$promo_price_vehicule_single = number_format((int)$promo_price_vehicule, 0, ',', ' ');
$permalink_vehicule = get_permalink($ID);
$new_vehicule = get_field('nouveau', $ID);
$sold_vehicule = get_field('vendu', $ID);

$descriptif_vehicule = get_the_content( $ID );


if (is_singular()) {
    
    $size_imgStar ='taxonomy';
    $url_imgStar = get_the_post_thumbnail_url( $ID, $size_imgStar );
    $imgStar = get_the_post_thumbnail($ID, $size_imgStar);
    
    $slider_size = 'slider-vehicules';
    $thumb_size = 'thumbnail-slider-vehicules';
    $imageFeatured= get_the_post_thumbnail($ID, $slider_size);    
    $images = get_field('galerie_images_vehicules', $ID);
    
    $size_sticky = 'vignette-vehicules';
    $stickyFeatured = get_the_post_thumbnail($ID, $size_sticky);
    
} else {
    $size = 'vignette-vehicules';
    $imageFeatured = get_the_post_thumbnail($ID, $size);
    $size_sticky = 'vignette-vehicules';
    $stickyFeatured = get_the_post_thumbnail($ID, $size_sticky);
}


$collection = get_field('collection', $ID);
$circulation = get_field('mise_en_circulation', $ID);
$km = get_field('kilometrage', $ID);
$ptac = get_field('ptac', $ID);
$cv = get_field('moteur', $ID);
$fiscaux = get_field('cv_fiscaux', $ID);
$porteur = get_field('porteur', $ID);
$ch_utile = get_field('charge_utile', $ID);
$longueur =  get_field('longueur', $ID);
$largeur = get_field('largeur', $ID);
$hauteur =  get_field('hauteur', $ID);
$garantie = get_field('garantie', $ID);
$option = get_field('option', $ID);
$rows_options = get_field('ajout_options', $ID);
$file = get_field('file', $ID);
$visite_Pano = get_field('panorama', $ID);
$other_options = get_field('autres_options', $ID);
$advantages =  get_field('avantages', $ID);

$tags_terms = get_the_term_list($ID, 'mots_cles', '<div class="meta-mots-cles d-flex flex-column flex-lg-row"><h3>Mots clés :</h3><ul class="meta-mots-cles-list d-flex"><li> #',',</li><li>#', '</li></ul></div>');


