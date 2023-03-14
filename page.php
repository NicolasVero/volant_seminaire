<?php

if (! defined('ABSPATH')) {
    exit;
}
get_header();

    if ( is_page('actualite') ) {
        get_template_part('template-pages/template', 'blog');         
    }else {
        while ( have_posts()) : the_post();
        get_template_part('template-pages/template', 'content');
        endwhile;
    }
get_footer();
