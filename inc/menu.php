<?php

// Ajout d'une zone de menu
// function add_menu() {
    // register_nav_menus(
    //     array(
    //         'menu-header' => __('Menu header')
    //     )
    // );
// }
// add_action('init', 'add_menu');

function menu_navigation() {
            
    return construct_menu('menu-header');
}



function construct_menu($menu) {
	
    $datas = wp_get_nav_menu_items($menu);

    $s = "<dl class='menu-$menu'>";

    foreach($datas as $data) {

        // var_dump($data->ID);
        $s .= "<i class='icon-" . get_icon($data->ID) . "'></i>";
        $s .= "<dt><a href='" . $data->url . "'>$data->title</a></dt>";
        
        if(($data->description) != "")
            $s .= "<dd style='color: white' class='navigation-element-extrait'>" . $data->description . "</dd>";
    }
        
    return $s . "</dl>";
}

function get_icon($id) {
    if($id == 674) return 'accueil';
    if($id == 672) return 'devis';

    return 'base';
}