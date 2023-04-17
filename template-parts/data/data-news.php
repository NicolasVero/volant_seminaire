<?php

$ID = get_the_ID();
$title = get_the_title();
$size = 'sticky-news';
$size_star = 'taxonomy';
$size_news = 'slider';
$img = get_the_post_thumbnail($ID, $size);
$imgStar = get_the_post_thumbnail($ID, $size_star);
$url_imgStar = get_the_post_thumbnail_url($ID, $size_star);
$imgNews = get_the_post_thumbnail($ID, $size_news);
$link = get_the_permalink($ID);
$datetime = get_the_date('Y-m-d');
$date = get_the_date();

$tax_terms = get_the_category($ID);
foreach ($tax_terms as $term) {
    $term_name = $term->name;
}
$tags_terms = get_the_tag_list('<div class="meta-mots-cles"><h3>Mots clés :</h3><ul class="meta-mots-cles-list d-inline"><li> #',',</li><li>#', '</li></ul></div>', $ID);

$sticky = get_field('first', $ID);
