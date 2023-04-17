<?php

if (! defined('ABSPATH')) {
    exit;
}

//BREADCRUMB
function the_breadcrumb()
{
    echo '<ul class="d-flex">'; // BREADCRUMB NAVIGATION

    if (is_page() && !is_front_page() || is_single() || is_singular() || is_category() || is_archive()) {
        echo '<li class="return-home d-flex align-items-center"><a title="Revenir à l\'Accueil" rel="nofollow" href="/"><i class="ti-home d-flex align-items-center justify-content-center"></i></a></li>';

        // PAGE / SOUS-PAGE
        if (is_page()) {
            global $post;
            $ancestors = get_post_ancestors($post);

            if ($ancestors) {
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor) {
                    echo '<li href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) .'</a></li><li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>'. get_the_title() . '</li>';
                }
            } else {
                echo '<li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>' . get_the_title() . '</li>';
            }
        }

        //SINGLE CUSTOM POST-TYPE / SOUS SINGLE CUSTOM POST-TYPE
        elseif (is_singular() && !is_singular('actualites') && !is_page()) {
            global $post;

            $obj_type = $post->post_type;
            $title_type = strtolower($obj_type);

            $obj_parent = $post->post_parent;
            $title_parent = get_the_title($obj_parent);
            $title_parent = strtolower($title_parent);

            $news ='l\'actualité';
            $news_slug='lactualite';

            if ($obj_type && $obj_parent != 0) {
                echo '<li><a class="d-flex align-items-center" href="/' . $title_type . '"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>' . $title_type . '</a></li><li></i><a class="d-flex align-items-center" href="/' . $title_parent . '"><i class="ti-angle-right d-flex align-items-center justify-content-center">' . $title_parent . '</a></li><li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>'. get_the_title() . '</li>';
            } elseif (is_singular('vehicules')) {

                //SINGULAR
                $ID = get_the_ID();
                $taxes = wp_get_post_terms($ID, 'types_de_vehicules');
                // var_dump($taxes);
                foreach ($taxes as $tax):
                    $term_slug = $tax->slug;
                $term_name = $tax->name;
                endforeach;

                echo '<li><a class="d-flex align-items-center" href="/les-vehicules/' . $term_slug . '"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>' . $term_name . '</a></li><li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>' . get_the_title() . '</li>';
            } else {
                echo '<li class="breadcrumb-current-page d-flex align-items-center"><a class="d-flex align-items-center" href="/' . $news_slug . '"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>' . $news . '</a></li><li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>'. get_the_title() . '</li>';
            }
        }

        // //SINGLE POST-TYPE ACTUALITES
        // elseif( is_singular('actualites') && !is_page() ){
//
        // 	echo '<a class="d-flex align-items-center" href="/lecole" title="Retour à la page d\'informations sur l\'école">L\'école</a></li><i class="ti-angle-right"></i><li><a class="d-flex align-items-center" href="/lecole/actualites" title="Voir tous les actualités de Lanimea">Les actualités</a></li><i class="ti-angle-right"></i><li class="breadcrumb-current-page">' . get_the_title() . '</li>';
//
        // }

        //POST-TYPE
        elseif (is_post_type_archive() && !is_post_type_archive('vehicules') && !is_tax() && !is_singular('vehicules')) {
            $archive = post_type_archive_title('', false);

            echo '<li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>'. $archive .'</li>';
        }

        // //POST-TYPE ACTUALITES OU PARTENAIRES
        // elseif( is_post_type_archive( 'actualites' ) || is_post_type_archive( 'partenaires' ) ){
        // 		$archive = post_type_archive_title( '', false );
//
        // 		echo '<a class="d-flex align-items-center" href="/lecole/">l\'école</a></li><i class="ti-angle-right"></i><li class="breadcrumb-current-page">Les '. $archive .'</li>';
        // }

        //TAXONOMY TYPES
        elseif (taxonomy_exists('types_de_vehicules')) {
            $ID = get_the_ID();
            $tax = get_queried_object();
            $term_slug = $tax->name;

            echo '<li><a class="d-flex align-items-center" href="/les-vehicules"><i class="ti-angle-right d-flex align-items-center"></i>les véhicules</a></li><li class="breadcrumb-current-page d-flex align-items-center"><i class="ti-angle-right d-flex align-items-center justify-content-center"></i>'. $term_slug .'</li>';
        }

        echo '</ul>';
    }
}
