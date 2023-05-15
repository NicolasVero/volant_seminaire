<?php

if (! defined('ABSPATH')) {
    exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/data-navigation.php');
?>
<button id="menu-open" class="menu-open d-flex flex-column align-items-center justify-content-center" aria-controls="primary-menu" aria-expanded="false"><span><?php _e('Menu', 'volant-seminaire'); ?></span><i class="icon-menu"></i></button>
<nav id="navigation-container" class="navigation-container">
    <a class="site-branding-big d-flex justify-content-center" href="/" class="site-branding-big" rel="home">
        <span><?php bloginfo('name'); echo ', '; bloginfo('description'); ?></span>
    </a>
    <button id="menu-close" class="menu-close d-flex flex-column align-items-center justify-content-center" aria-controls="primary-menu-close" aria-expanded="false"><span><?php _e('Fermer', 'volant-seminaire'); ?></span><i class="icon-close"></i></button>
    
    <?php if(function_exists('menu_navigation')) echo menu_navigation(); ?>

    <hr>

</nav>
 <?php 
    dynamic_sidebar('Menu latéral');    
?>