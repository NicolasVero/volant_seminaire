<?php

if (! defined('ABSPATH')) {
    exit;
}
?>
<div class="site-widgets site-widgets-header d-flex justify-content-center  justify-content-md-end order-first order-md-last">
    <div class="container-widgets-social-search d-flex flex-row flex-lg-column flex-xl-row justify-content-end">
        <?php
            include('nav-medias-sociaux.php');
        ?>
        <div class="widget-search widget-header-search d-flex justify-content-start align-items-center">
            <a class="d-block" href="#0" title="Vous recherchez ?">
                <i class="ti-search d-block"></i><span class="d-block">Ouvrir la recherche</span>
            </a>
        </div>
    </div>
    <div class="container-widgets-contact d-flex flex-row flex-lg-column flex-xl-row">
        <?php
        include('nav-contact-sav.php');
        dynamic_sidebar('Téléphone');

    ?>
    </div>
</div>