<?php

if (! defined('ABSPATH')) {
    exit;
}
    get_header();

    $post_type= 'vehicules';

    if (is_singular($post_type)) {
        get_template_part('template-parts/content', 'single-tax-vehicules');
    } else {
        get_template_part('template-parts/content', 'single-post');
    }

    get_footer();
