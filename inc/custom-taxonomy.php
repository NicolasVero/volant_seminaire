<?php

add_action('init', 'wpm_add_taxonomies', 0);

function wpm_add_taxonomies()
{

    //TYPES DE VÉHICULES

    $labels_type = array(
        'name'              			=> _x('Types de véhicules', 'taxonomy general name'),
        'singular_name'     			=> _x('Type de véhicule', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un type'),
        'all_items'        				=> __('Tous les types'),
        'edit_item'         			=> __('Editer le type'),
        'update_item'       			=> __('Mettre à jour le type'),
        'add_new_item'     				=> __('Ajouter un nouveau type'),
        'new_item_name'     			=> __('Nom du nouveau type'),
        'separate_items_with_commas'	=> __('Séparer les types par une virgule'),
        'menu_name'         => __('Types de véhicule'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'les-vehicules' ),

    );

    register_taxonomy('types_de_vehicules', 'vehicules', $args_type);


    //MARQUES DE VÉHICULES

    $labels_type = array(
        'name'              			=> _x('Marques', 'taxonomy general name'),
        'singular_name'     			=> _x('Marque', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher une marque'),
        'all_items'        				=> __('Toutes les marques'),
        'edit_item'         			=> __('Editer la marque'),
        'update_item'       			=> __('Mettre à jour la marque'),
        'add_new_item'     				=> __('Ajouter une nouvelle marque'),
        'new_item_name'     			=> __('Nom de la nouvelle marque'),
        'separate_items_with_commas'	=> __('Séparer les marques par une virgule'),
        'menu_name'         => __('Marques de véhicule'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'marques-vehicules' ),

    );

    register_taxonomy('marques', 'vehicules', $args_type);

    //MODÈLES DE VÉHICULES

    $labels_type = array(
        'name'              			=> _x('Modèles', 'taxonomy general name'),
        'singular_name'     			=> _x('Modèle', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un modèle'),
        'all_items'        				=> __('Tous les modèles'),
        'edit_item'         			=> __('Editer le modèle'),
        'update_item'       			=> __('Mettre à jour le modèle'),
        'add_new_item'     				=> __('Ajouter un nouveau modèle'),
        'new_item_name'     			=> __('Nom du nouveau modèle'),
        'separate_items_with_commas'	=> __('Séparer les modèles de véhicule par une virgule'),
        'menu_name'         => __('Modèles de véhicule'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'modeles-vehicules' ),

    );

    register_taxonomy('modeles', 'vehicules', $args_type);
    
    
    //STYLE DE CHAMBRE

    $labels_type = array(
        'name'              			=> _x('Styles de chambre', 'taxonomy general name'),
        'singular_name'     			=> _x('Style de chambre', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un style de chambre'),
        'all_items'        				=> __('Tous les styles de chambre'),
        'edit_item'         			=> __('Editer le style de chambre'),
        'update_item'       			=> __('Mettre à jour le style de chambre'),
        'add_new_item'     				=> __('Ajouter un nouveau style de chambre'),
        'new_item_name'     			=> __('Nom du nouveau style de chambre'),
        'separate_items_with_commas'	=> __('Séparer les styles de chambre par une virgule'),
        'menu_name'         => __('Styles de chambre'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'styles-chambres-vehicules' ),

    );

    register_taxonomy('chambres', 'vehicules', $args_type);
    
    //STYLE SALON

    $labels_type = array(
        'name'              			=> _x('Styles de salon', 'taxonomy general name'),
        'singular_name'     			=> _x('Style de salon', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un style de salon'),
        'all_items'        				=> __('Tous les styles de salon'),
        'edit_item'         			=> __('Editer le style de salon'),
        'update_item'       			=> __('Mettre à jour le style de salon'),
        'add_new_item'     				=> __('Ajouter un nouveau style de salon'),
        'new_item_name'     			=> __('Nom du nouveau style de salon'),
        'separate_items_with_commas'	=> __('Séparer les styles de salon par une virgule'),
        'menu_name'         => __('Styles de salon'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'styles-salon-vehicules' ),

    );

    register_taxonomy('salons', 'vehicules', $args_type);
    
    //PLACES COUCHAGE

    $labels_type = array(
        'name'              			=> _x('Nombre de places couchages', 'taxonomy general name'),
        'singular_name'     			=> _x('Nombre de place couchage', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un nombre de place couchage'),
        'all_items'        				=> __('Tous les nombres de place couchage'),
        'edit_item'         			=> __('Editer un nombre place couchage'),
        'update_item'       			=> __('Mettre à jour nombre de place couchage'),
        'add_new_item'     				=> __('Ajouter un nombre de place couchage'),
        'new_item_name'     			=> __('Nom du nouveau nombre place couchage'),
        'separate_items_with_commas'	=> __('Séparer les nombres de place couchage par une virgule'),
        'menu_name'         => __('Nombre de place de couchage'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'places-couchage-vehicules' ),

    );

    register_taxonomy('places', 'vehicules', $args_type);
    
    //PLACES CARTE GRISE

    $labels_type = array(
        'name'              			=> _x('Nombre de places carte grise', 'taxonomy general name'),
        'singular_name'     			=> _x('Nombre de place carte grise', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un nombre de place carte grise'),
        'all_items'        				=> __('Tous les nombres de place carte grise'),
        'edit_item'         			=> __('Editer un nombre place carte grise'),
        'update_item'       			=> __('Mettre à jour nombre de place carte grise'),
        'add_new_item'     				=> __('Ajouter un nombre de place carte grise'),
        'new_item_name'     			=> __('Nom du nouveau nombre place carte grise'),
        'separate_items_with_commas'	=> __('Séparer les nombres de place carte grise par une virgule'),
        'menu_name'         => __('Nombre de place carte grise'),
    );

    $args_type = array(

        'hierarchical'      => true,
        'labels'            => $labels_type,
        'show_ui'           => false,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'places-carte-grise-vehicules' ),

    );

    register_taxonomy('carte_grise', 'vehicules', $args_type);

    //MOTS CLÉS VÉHICULES

    $labels_mots = array(
        'name'              			=> _x('Mots clés', 'taxonomy general name'),
        'singular_name'     			=> _x('Mot clé', 'taxonomy singular name'),
        'search_items'      			=> __('Chercher un mot clé'),
        'all_items'        				=> __('Tous les mots clés'),
        'edit_item'         			=> __('Editer le mot clé'),
        'update_item'       			=> __('Mettre à jour le mot clé'),
        'add_new_item'     				=> __('Ajouter un nouveau mot clé'),
        'new_item_name'     			=> __('Nom du nouveau mot clé'),
        'separate_items_with_commas'	=> __('Séparer les mots clés par une virgule'),
        'menu_name'         => __('Mots clés'),
    );

    $args_mots = array(

        'hierarchical'      => false,
        'labels'            => $labels_mots,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'		=> true,
        'show_in_nav_menus'	=> false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'mots-cles' ),

    );

    register_taxonomy('mots_cles', 'vehicules', $args_mots);

}
