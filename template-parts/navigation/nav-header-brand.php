<?php

if (! defined('ABSPATH')) {
    exit;
}
?>
<div class="site-branding d-flex justify-content-center d-md-block">
    <a class="d-block" href="/" class="navbar-brand" rel="home">
        <span><?php bloginfo('name'); echo ', '; bloginfo('description'); ?></span>
    </a>
    <button id="menu-toggle" class="menu-toggle-mobile d-flex flex-column align-items-center justify-content-center d-sm-none" aria-controls="primary-menu" aria-expanded="false"><span><?php _e('Menu', 'volant-seminaire'); ?></span></button>
</div>