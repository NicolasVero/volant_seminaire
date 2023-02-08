<?php
if (! defined('ABSPATH')) {
    exit;
}

if ( is_tax('types_de_vehicules') ) :

    include('data/data-taxonomy-types.php');

    if (!empty($image)): ?>
        <figure class="star-tax star-tax-<?= $slug ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($alt); ?>" /></figure>
        <?php endif; ?>
        
        <div class="container container-page-tax container-page-tax-<?= $slug ?>">
            <div class="row">
                    <?php include('items/items-breadcrumb.php');?>
                <div class="top-intro-tax">
                    <h1>Les <?= $title ?></h1>
                    <p><?= $description ?></p>
                </div>
            </div>
        </div>
        <div class="container container-page-list-tax container-page-list-tax-<?= $slug ?>">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 sidebar-filters block-content-list-tax">
                    <div id="content-search-tax" class="content-search-tax">
                        <?php
                        include('widgets-filters/widget-filtre-searchform.php');
                        include('widgets-filters/widget-filtre-type.php');
                        ?>
                    </div>
                    <div id="content-sidebar-filters" class="content-sidebar-filters d-none d-md-block">
                    <h3>Filtrez votre sélection par :</h3>
                        <?php
                        include('widgets-filters/widget-filtre-marque.php');
                        include('widgets-filters/widget-filtre-tarifs.php');
                        include('widgets-filters/widget-filtre-modele.php');
                        include('widgets-filters/widget-filtre-chambre.php');
                        include('widgets-filters/widget-filtre-carte.php');
                        include('widgets-filters/widget-filtre-couchage.php');
                        ?>
                    </div>
                </div>
                
                    <?php if (have_posts()) :?>
                    
                    <div id="list-vehicules" class="col-12 col-md-8 col-lg-9 d-md-flex flex-md-column block-content-list-tax">
                    <?php while (have_posts()) : the_post();
                    include('data/data-vehicules.php');
                if ($promo_vehicule) {
                    ?>
                    <article class="row article-vehicule article-vehicule-<?= $ID ?> article-vehicule-promo <?= $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $promo_price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
                        <figure class="col-12 col-lg-6">
                            <?= $imageFeatured ?>
                        </figure>
                        <div class="container-details-single col-12 col-lg-6 d-flex flex-column justify-content-end">
                           <div class="d-flex justify-content-start">
                               <h4 class="etiquette-vehicule vehicule-promo">promo</h4>
                           </div>
                            <h3 class="brand-vehicule">
                                <?= $term_name_brand ?>
                            </h3>
                            <h2 class="title-vehicule"><?= $title_vehicule ?></h2>

                            <aside class="details-single-tax d-flex flex-column justify-content-center">
                                    <p class="promo-price-vehicule d-flex"><?= $price_vehicule_single ?> €</p>
                                <div class="d-flex align-items-center">
                                    <p class="price-vehicule d-flex align-items-center"><?= $promo_price_vehicule_single ?> €</p>
                                    <a href="<?= $permalink_vehicule ?>" class="more-vehicule d-flex align-items-center justify-content-between" title="En savoir plus sur le véhicule : <?= $term_name_brand . ' ' . $title_vehicule ;?>">plus de détails<i class="ti-search"></i></a>
                                </div>
                            </aside>
                        </div>
                    </article>
                    <?php
                } elseif ($new_vehicule) {?>
                    <article class="row article-vehicule article-vehicule-<?= $ID ?> article-vehicule-new <?= $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
                        <figure class="col-12 col-lg-6">
                            <?= $imageFeatured ?>
                        </figure>
                        <div class="container-details-single col-12 col-lg-6 d-flex flex-column justify-content-end">
                            <div class="d-flex justify-content-start">
                                <h4 class="etiquette-vehicule">nouveau</h4>
                            </div>
                                <h3 class="brand-vehicule">
                                    <?= $term_name_brand ?>
                                </h3>
                                <h2 class="title-vehicule"><?= $title_vehicule ?></h2>
 
                            <aside class="details-single-tax d-flex align-items-center">
                                    <p class="price-vehicule d-flex align-items-center"><?= $price_vehicule_single ?> €</p>
                                    <a href="<?= $permalink_vehicule ?>" class="more-vehicule d-flex align-items-center justify-content-between" title="En savoir plus sur le véhicule : <?= $term_name_brand . ' ' . $title_vehicule ;?>">plus de détails<i class="ti-search"></i></a>
                            </aside>
                        </div>
                    </article>
            
                    <?php } elseif ($sold_vehicule) { ?>
                    <article class="row article-vehicule article-vehicule-<?= $ID ?> article-vehicule-sold <?= $term_slug_brand . ' ' . $term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
                        <figure class="col-12 col-lg-6">
                            <?= $imageFeatured ?>
                        </figure>
                        <div class="container-details-single col-12 col-lg-6 d-flex flex-column justify-content-end">
                            <div class="d-flex justify-content-start">
                                <h4 class="etiquette-vehicule">vendu</h4>
                            </div>
                            <h3 class="brand-vehicule">
                                <?= $term_name_brand ?>
                            </h3>
                            <h2 class="title-vehicule"><?= $title_vehicule ?></h2>
                            <aside class="details-single-tax d-flex justify-content-end align-items-end">
                                    <p class="price-vehicule d-none align-items-center"><?= $price_vehicule_single ?> €</p>
                                    <a href="<?= $permalink_vehicule ?>" class="more-vehicule d-flex align-items-center justify-content-between" title="En savoir plus sur le véhicule : <?= $term_name_brand . ' ' . $title_vehicule ;?>">plus de détails<i class="ti-search"></i></a>
                            </aside>
                        </div>
                    </article>
            
                    <?php } else { ?>     
                    <article class="row article-vehicule article-vehicule-<?= $ID ?> <?= $term_slug_brand . ' ' .$term_slug_model . ' ' . $term_slug_chamber . ' ct-' . $term_slug_carte . ' plc-' . $term_slug_place ?>" data-price="<?= $price_vehicule ?>" data-slug="<?= $term_slug_chamber ?>">
                        <figure class="col-12 col-lg-6">
                            <?= $imageFeatured ?>
                        </figure>
                        <div class="container-details-single col-12 col-lg-6 d-flex flex-column justify-content-end">
                           <h3 class="brand-vehicule">
                               <?= $term_name_brand ?>
                           </h3>
                            <h2 class="title-vehicule"><?= $title_vehicule ?></h2>
                            <aside class="d-flex align-items-center details-single-tax">
                                <p class="price-vehicule d-flex align-items-center"><?= $price_vehicule_single ?> €</p>
                                <a href="<?= $permalink_vehicule ?>" class="more-vehicule d-flex align-items-center justify-content-between" title="En savoir plus sur le véhicule : <?= $term_name_brand . ' ' . $title_vehicule ;?>" href="<?= $permalink_vehicule ?>">plus de détails<i class="ti-search"></i></a>
                            </aside>
                        </div>
                    </article>        
                    <?php }     
                endwhile; ?>
                </div><!-- #list-vehicules --> 
            </div><!-- .row -->
            <div class="row">
                <?php
                if( function_exists('pagination') ){
                    pagination();
                }?>
            </div><!-- /.row -->
        </div><!-- .container -->
            <?php else :?>
            <div id="list-vehicules" class="col-12 col-md-8 col-lg-9 d-flex flex-column align-items-center block-content-list-tax">
            
                <p>Nous sommes désolé, mais il n'y a pas de véhicules disponibles en ce moment.<br/>Merci de revenir plus tard ou contactez-nous pour vous tenir informé sur les arrivées prochaines.</p>
                <a class="button contact-taxo" href="/contact-sav" title="contactez-nous par email">Nous contacter</a>

            </div>   
    <?php endif;
else :?>
    affichage des autres taxonomies.
<?php endif; ?>