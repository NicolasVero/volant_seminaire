<?php

if (! defined('ABSPATH')) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'volant_seminaire_style' );
function volant_seminaire_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
}


// MAINTENANCE
// require_once('inc/maintenance.php');

// PERSONNALISATION DE LA PAGE DE LOGIN
require_once('inc/login.php');

// PERSONNALISATION DU DASHBORD
require_once('inc/dashboard.php');

// SÉCURITÉ WORDPRESS
// require_once('inc/security.php');

// SUPPRESSION DE CERTAINES FONCTIONNALITÉS DU THÈME PARENT
require_once('inc/tunning.php');

// COMMENTAIRES
require_once('inc/comments.php');

// GESTION DES WIDGETS
require_once('inc/widgets.php');

// JQUERY
require_once('inc/jquery.php');

//NAVIGATIONS
require_once('inc/navigation.php');

//IMAGES
require_once('inc/images.php');

//CUSTOM POST-TYPES
require_once('inc/custom-post.php');

//TAXONOMIES
require_once('inc/custom-taxonomy.php');

//BREADCRUMB
require_once('inc/breadcrumb.php');

//GOOGLE MAPS
require_once('inc/google-map.php');

// GESTION GUTEMBERG ET ACF
require_once('inc/register-blocks-acf.php');
// require_once('inc/custom-blocks-callback.php');

//STICKY CUSTOM POST TYPE
require_once('inc/sticky-custom-posts-type.php');

//RANGE
require_once('inc/range-field.php');
// GESTION WP GRID BUILDER

// require_once('inc/grid_builder.php');

// FORMATAGE DES TEXTES (EXTRAITS,...)
require_once('inc/formating-content.php');

// PAGINATION
require_once('inc/pagination.php');
