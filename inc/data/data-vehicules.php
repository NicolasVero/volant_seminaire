<?php

$ID = get_the_ID();
$title_vehicule = get_the_title($ID);
$brand_vehicule = get_field('marque', $ID);
$price_vehicule = get_field('prix', $ID);
$promo_vehicule = get_field('promo', $ID);
$promo_price_vehicule = get_field('prix_promo', $ID);
$permalink_vehicule = get_permalink($ID);
$new_vehicule = get_field('nouveau', $ID);
$sold_vehicule = get_field('vendu', $ID);


if (is_singular()) {
    $size = 'slider-vehicules';
    $imageFeatured= get_the_post_thumbnail($ID, $size);
} else {
    $size = 'vignette-vehicules';
    $imageFeatured = get_the_post_thumbnail($ID, $size);
}
