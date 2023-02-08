<?php

// SUPPRESSION DE FONCTIONNALITÉ DU THEME PARENT
function wp_acs_remove_features()
{

    // SUPPRESSION SIDEBAR
    add_action('widgets_init', 'wp_acs_parent_unregister_widgets', 10);
    function wp_acs_parent_unregister_widgets()
    {
        unregister_widget('twentysixteen_widgets_init');
    }
    // SUPPRESSION SCRIPTS JS
    add_action('wp_print_scripts', 'child_overwrite_scripts', 100);
    function child_overwrite_scripts()
    {
        wp_deregister_script('twentysixteen-script');
    }
}
add_action('after_setup_theme', 'wp_acs_remove_features', 10);

//SUPPRESSION NAV PARENT
function remove_nav_parent()
{
    remove_action('register_nav_menus', 'twentysixteen_setup');
}
add_action('after_setup_theme', 'remove_nav_parent');

// SUPPRESSION DU MENU ARTICLE DE L'ADMIN
// function remove_menu_admin()
// {
//     // 	remove_menu_page( 'edit.php' );
//     remove_menu_page('edit-comments.php');
//
//     global $menu;
//     $restricted = array( __('Comments'));
//     end($menu);
//     while (prev($menu)) {
//         $value = explode(' ', $menu[key($menu)][0]);
//
//         if (in_array($value[0] != null ? $value[0] : "", $restricted)) {
//             unset($menu[key($menu)]);
//         }
//     }
// }
// add_action('admin_menu', 'remove_menu_admin');


// EXCERPT DANS LES PAGES
add_action('init', 'page_excerpt');
function page_excerpt()
{
    add_post_type_support('page', 'excerpt');
}

// AJOUT CLASS AUX EXCERPTS
add_filter("the_excerpt", "add_class_to_excerpt");
function add_class_to_excerpt($excerpt)
{
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}

 //CHANGER STRUCTURE HTML DES CAPTIONS
 add_filter('img_caption_shortcode', 'img_caption_shortcode_html5', 10, 3);


if (!function_exists('img_caption_shortcode_html5')) {
    function img_caption_shortcode_html5($val, $attr, $content = null)
    {
        extract(shortcode_atts(array(
            'id'	=> '',
            'align'	=> '',
            'width'	=> '',
            'caption' => ''
        ), $attr));

        if (empty($caption) || 1 > (int)$width) {
            return $val;
        }

        $capid = '';
        if ($id) {
            $id = esc_attr($id);
            $capid = 'id="figcaption_'. $id . '" ';
            $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
        }

        return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
        . (10 + (int) $width) . 'px">' . do_shortcode($content) . '<figcaption ' . $capid
        . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
    }
}

//AJOUT COLONNE ADMIN VEHICULES
// // ajout de la colonne
// add_filter( 'manage_vehicules_posts_columns', function ($columns) {
//     return array_merge( $columns, array(
//         'sticky' => __( 'À ne pas manquer' )
//     ) );
// } );
// add_action( 'manage_vehicules_posts_custom_column', function ($column, $post_id) {
//     // Switch sur chaque colonne
//     switch ($column) {
//         // Notre colonne custom
//         case 'sticky':
//             // On récupère la valeur du champs
//             $sticky = get_post_meta( $post_id, 'sticky', true );
// 
//             // On affiche un résultat
//             echo empty( $sticky ) ?
//                 '<span aria-hidden="true">-</span>' :
//                 'Oui' ;
// 
//             break;
//     }
// }, 10, 2 );s

// FORMAT COLONNE FULLWIDTH
/*
function custom_wide() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'custom_wide' );
*/

function customs_by_grib()
{
    add_theme_support('align-wide');
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Bleu #004B99', 'theme Havre caravano'),
            'slug' => 'blue#004B99',
            'color' => '#004B99',
        ),
        array(
            'name' => __('Bleu #0059B5', 'theme Havre caravano'),
            'slug' => 'blue#0059B5',
            'color' => '#0059B5',
        ),
        array(
            'name' => __('Bleu #A5D1FF', 'theme Havre caravano'),
            'slug' => 'blue#A5D1FF',
            'color' => '#A5D1FF',
        ),
        array(
            'name' => __('Bleu #162E46', 'theme Havre caravano'),
            'slug' => 'blue#162E46',
            'color' => '#162E46',
        ),
    ));
    add_theme_support('disable-custom-colors');
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('small', 'themeLangDomain'),
            'shortName' => __('S', 'themeLangDomain'),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __('regular', 'themeLangDomain'),
            'shortName' => __('M', 'themeLangDomain'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => __('large', 'themeLangDomain'),
            'shortName' => __('L', 'themeLangDomain'),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => __('larger', 'themeLangDomain'),
            'shortName' => __('XL', 'themeLangDomain'),
            'size' => 50,
            'slug' => 'larger'
        )
    ));
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'customs_by_grib');
