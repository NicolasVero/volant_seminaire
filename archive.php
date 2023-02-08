<?php
if (! defined('ABSPATH')) {
    exit;
}

get_header();

if (is_archive('vehicules')){
    get_template_part('template-parts/content', 'taxonomy');
}else{
    get_template_part('template-parts/content', 'archive');
}

get_footer();?>