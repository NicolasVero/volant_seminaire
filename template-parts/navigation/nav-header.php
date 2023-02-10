<?php

if (! defined('ABSPATH')) {
    exit;
}

$urlTemplate = get_stylesheet_directory();

include( $urlTemplate . '/inc/datas/data-navigation.php');
?>
<div id="container-menu-primary" class="container-menu-primary">
<?php if (has_nav_menu('primary')) { wp_nav_menu($args); } ?>

<button id="menu-toggle" class="menu-toggle-mobile d-flex flex-column align-items-center justify-content-center" aria-controls="primary-menu" aria-expanded="false"><span><?php _e('Menu', 'volant-seminaire'); ?></span></button>

</div>