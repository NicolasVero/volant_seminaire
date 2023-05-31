<?php

if (! defined('ABSPATH')) {
    exit;
}

$urlTemplate = get_stylesheet_directory();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<?php //include_once("analyticstracking.php"); ?>

<body <?php body_class(); ?>>
    <header id="main-header" class="main-header header-site" role="banner">
        <div class="container-fluid main-header-container container d-flex flex-column flex-md-row justify-content-md-between align-items-lg-center">
            <?php
                get_template_part('template-parts/navigation/nav', 'header-brand');
                get_template_part('template-parts/navigation/nav', 'widgets');
                get_template_part('template-parts/navigation/nav', 'header');
            ?>
        </div>

        <div class="search-form-container search-form-hidden container-fluid" id="search-form-container">
            <?php get_search_form();?>
        </div>
        
        <script>
document.addEventListener('DOMContentLoaded', function() {
  var widgetSearch = document.getElementById('widget-search');
  var searchFormContainer = document.getElementById('search-form-container');
  
  widgetSearch.addEventListener('click', function(event) {
    event.preventDefault();
    searchFormContainer.classList.toggle('search-form-visible');
  });
});

        </script>

        <div class="overlay"></div>
    </header>
    <?php if (is_front_page()):?>
    <main id="main-site" class="main-site main-home">
        <?php elseif (is_page() || is_home()):
    $ID = get_the_ID();
?>
        <main id="main-site" class="main-site main-page main-page-<?= $ID ?>">
            <?php elseif (is_tax('types_de_vehicules') || is_singular('vehicules') ):?>
            <main id="main-site" class="main-site main-tax">
                <?php elseif (is_singular('post')) :?>
                <main id="main-site" class="main-site main-single-post">
                    <?php elseif (is_search()) :?>
                    <main id="main-site" class="main-site main-page main-page-search">
                        <?php else :?>
                        <main id="main-site" class="main-site main-page">
                            <?php endif; ?>