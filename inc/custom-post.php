<?php

function custom_post()
{

    //LES VÉHICULES

    $labels = array(
        'name'                => _x('Les véhicules', 'Post Type General Name'),
        'singular_name'       => _x('Véhicule', 'Post Type Singular Name'),
        'menu_name'           => __('Les véhicules'),
        'all_items'           => __('Tous les véhicules'),
        'view_item'           => __('Voir les véhicules'),
        'add_new_item'        => __('Ajouter un nouveau véhicule'),
        'add_new'             => __('Ajouter'),
        'edit_item'           => __('Editer un véhicule'),
        'update_item'         => __('Modifier le véhicule'),
        'search_items'        => __('Rechercher'),
        'not_found'           => __('Non trouvé'),
        'not_found_in_trash'  => __('Non trouvé dans la corbeille'),
    );

    $args = array(
        'label'               => __('Les véhicules'),
        'description'         => __('Les véhicules neufs et d\'occasions vendus par le Havre Caravano'),
        'labels'              => $labels,
        'menu_icon'           => 'dashicons-car',
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'vehicules'),
        'show_in_rest'        => false,

    );

    register_post_type('vehicules', $args);

    // 	//ACTUALITÉS
//
// 	$labels = array(
// 		'name'                => _x( 'Actualités', 'Post Type General Name'),
// 		'singular_name'       => _x( 'Actualité', 'Post Type Singular Name'),
// 		'menu_name'           => __( 'Actualités'),
// 		'all_items'           => __( 'Toutes les actualités'),
// 		'view_item'           => __( 'Voir l\'actualité'),
// 		'add_new_item'        => __( 'Ajouter une nouvelle actualité'),
// 		'add_new'             => __( 'Ajouter'),
// 		'edit_item'           => __( 'Editer une actualité'),
// 		'update_item'         => __( 'Modifier l\'actualité'),
// 		'search_items'        => __( 'Rechercher'),
// 		'not_found'           => __( 'Non trouvée'),
// 		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
// 	);
//
// 	$args = array(
// 		'label'               => __( 'Actualités'),
// 		'description'         => __( 'Toute l\'actualité de Lanimea'),
// 		'labels'              => $labels,
// 		'menu_icon'           => 'dashicons-media-spreadsheet',
// 		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'has_archive'         => true,
// 		'rewrite'			  => array( 'slug' => 'actualites'),
// 		'show_in_rest'        => true,
//
// 	);
//
// 	register_post_type( 'actualites', $args );
}

add_action('init', 'custom_post', 0);
