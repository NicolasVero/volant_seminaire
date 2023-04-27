<?php

if (! defined('ABSPATH')) {
    exit;
}
    get_header();

    $post_type= 'activites';

    if (is_singular($post_type)) {
        get_template_part('template-parts/content', 'single-activites');
    } else {
        get_template_part('template-parts/content', 'single-post');
    }

    get_footer();
