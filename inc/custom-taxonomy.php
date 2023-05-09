<?php

add_action('init', 'wpm_add_taxonomies', 0);

function wpm_add_taxonomies()
{

    //TYPES D'ACTIVITÉ

    $labels_type = array(
        'name'              			=> _x('Types d\'activités', 'taxonomy general name'),
        'singular_name'     			=> _x('Type d\'activité', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un type'),
        'all_items'        				=> __('Tous les types'),
        'edit_item'         			=> __('Editer le type'),
        'update_item'       			=> __('Mettre à jour le type'),
        'add_new_item'     				=> __('Ajouter un type d\'activité'),
        'new_item_name'     			=> __('Nom du nouveau type'),
        'separate_items_with_commas'	=> __('Séparer les types par une virgule'),
        'menu_name'         => __('Types d\'activités'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'types-activites' ),

    );

    register_taxonomy('types_d_activites', 'activites', $args_type);


    //META TAGS ACTIVITÉS

    $labels_mots = array(
        'name'              			=> _x('Meta tags', 'taxonomy general name'),
        'singular_name'     			=> _x('Meta tag', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un meta tag'),
        'all_items'        				=> __('Tous les meta tags'),
        'edit_item'         			=> __('Editer le meta tag'),
        'update_item'       			=> __('Mettre à jour le meta tag'),
        'add_new_item'     				=> __('Ajouter un nouveau meta tag'),
        'new_item_name'     			=> __('Nom du nouveau meta tag'),
        'separate_items_with_commas'	=> __('Séparer les meta tags par une virgule'),
        'menu_name'         => __('Meta tags'),
    );

    $args_mots = array(

        'hierarchical'      => false,
        'labels'            => $labels_mots,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'meta-tag' ),

    );

    register_taxonomy('mots_cles', 'activites', $args_mots);

}