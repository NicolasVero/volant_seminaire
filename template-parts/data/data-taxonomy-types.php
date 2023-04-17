<?php

if (! defined('ABSPATH')) {
    exit;
}
$term = get_queried_object();
$image = get_field('image_categorie', $term);
$size = 'taxonomy';
$img = $image['sizes'][$size];
$alt = $image['alt'];
$title = $term->name;
$title = strtolower($title);
$description = $term->description;
$slug = $term->slug;
