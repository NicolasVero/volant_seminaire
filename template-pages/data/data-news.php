<?php

$id = get_the_ID();
$title = get_the_title();
$size = 'sticky-news';
$size_star = 'taxonomy';
$size_news = 'slider';
$img = get_the_post_thumbnail($id, $size);
$imgStar = get_the_post_thumbnail($id, $size_star);
$url_imgStar = get_the_post_thumbnail_url($id, $size_star);
$imgNews = get_the_post_thumbnail($id, $size_news);
$link = get_the_permalink($id);
$datetime = get_the_date('Y-m-d');
$date = get_the_date();

$tax_terms = get_the_category($id);
foreach ($tax_terms as $term) {
    $term_name = $term->name;
}
$sticky = get_field('first', $id);
