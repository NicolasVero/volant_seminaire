<?php

if (! defined('ABSPATH')) {
    exit;
}

$urlTemplate = get_stylesheet_directory();
?>

<a class="site-branding d-flex justify-content-center d-md-block" href="/" class="navbar-brand" rel="home">
    <span><?php bloginfo('name'); echo ', '; bloginfo('description'); ?></span>
</a>