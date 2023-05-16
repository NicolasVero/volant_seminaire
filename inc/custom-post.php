 <?php

function custom_post()
{

    //LES ACTVITÉS

    $labels = array(
        'name'                => _x('Les activités', 'Post Type General Name'),
        'singular_name'       => _x('Activité', 'Post Type Singular Name'),
        'menu_name'           => __('Les activités'),
        'all_items'           => __('Toutes les activités'),
        'view_item'           => __('Voir les activités'),
        'add_new_item'        => __('Ajouter une nouvelle activité'),
        'add_new'             => __('Ajouter'),
        'edit_item'           => __('Editer une activité'),
        'update_item'         => __('Modifier l\'activité'),
        'search_items'        => __('Rechercher'),
        'not_found'           => __('Non trouvée'),
        'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
    );

    $args = array(
        'label'               => __('Les activités'),
        'description'         => __('Les activités neufs et d\'occasions vendus par le Havre Caravano'),
        'labels'              => $labels,
        'menu_icon'           => 'dashicons-car',
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'menu' ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'les-activites'),
        'show_in_rest'        => false,

    );

    register_post_type('activites', $args);

    	//SERVICES

	$labels = array(
		'name'                => _x( 'Services', 'Post Type General Name'),
		'singular_name'       => _x( 'Service', 'Post Type Singular Name'),
		'menu_name'           => __( 'Services'),
		'all_items'           => __( 'Tous les services'),
		'view_item'           => __( 'Voir le service'),
		'add_new_item'        => __( 'Ajouter une nouvelle Service'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer un service'),
		'update_item'         => __( 'Modifier le service'),
		'search_items'        => __( 'Rechercher'),
		'not_found'           => __( 'Non trouvé'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);

	$args = array(
		'label'               => __( 'Services'),
		'description'         => __( 'Toute l\'Service de Lanimea'),
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-admin-tools',
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'menu' ),
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'les-services'),
		'show_in_rest'        => true,

	);

	register_post_type( 'services', $args );
    
    
    
    //DEVIS
    
    $labels = array(
        'name'                => _x( 'Devis', 'Post Type General Name'),
        'singular_name'       => _x( 'Devis', 'Post Type Singular Name'),
        'menu_name'           => __( 'Devis'),
        'all_items'           => __( 'Tous les devis'),
        'view_item'           => __( 'Voir le devis'),
        'add_new_item'        => __( 'Ajouter un nouveau devis'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer un devis'),
        'update_item'         => __( 'Modifier le devis'),
        'search_items'        => __( 'Rechercher'),
        'not_found'           => __( 'Non trouvé'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );
    
    $args = array(
        'label'               => __( 'Devis'),
        'description'         => __( 'Toute l\'Service de Lanimea'),
        'labels'              => $labels,
        'menu_icon'           => 'dashicons-format-aside',
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'menu' ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'les-devis'),
        'show_in_rest'        => true,
    
    );
    
    register_post_type( 'devis', $args );
}

add_action('init', 'custom_post', 0);
