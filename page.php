<?php

if (! defined('ABSPATH')) {
    exit;
}
get_header();

    if (is_page('lactualite') || is_page(49) ) {
        get_template_part('template-pages/page', 'blog');   
    }elseif( is_page(300)){
        get_template_part('template-pages/page', 'vehicules');      
    }else {
        while (have_posts()) : the_post();
        get_template_part('template-pages/page', 'content');
        endwhile;
    }

get_footer();
