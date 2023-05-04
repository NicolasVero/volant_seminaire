<?php

//IMAGES RESPONSIVE
function responsive_images($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}   
add_filter('post_thumbnail_html', 'responsive_images', 10);
add_filter('image_send_to_editor', 'responsive_images', 10);
add_filter('wp_get_attachment_link', 'responsive_images', 10);

//ACTIVATION DES MINIATURES
add_theme_support('post-thumbnails', array('post'));
set_post_thumbnail_size(150, 150, true);

//NOUVELLE TAILLE D'IMAGE
function new_format_image()
{
    add_image_size('hero', 2540, 530, true);
    add_image_size('sticker', 248, 206, true);
}
add_action('after_setup_theme', 'new_format_image');

//TAILLE D'IMAGES PAR DÉFAUT
function options_defaut_img()
{
    update_option('image_default_align', 'center');
    update_option('image_default_link_type', 'none');
    update_option('image_default_size', 'full');
}
add_action('after_setup_theme', 'options_defaut_img');
