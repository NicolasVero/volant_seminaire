<?php

if (! defined('ABSPATH')) {
	exit;
}

?>
<?php

$location = get_field( 'google_map', $acfw );
$address = $location['address'];
$tel = get_field( 'telephone', $acfw );
$ouverture = get_field('ouverture', $acfw);
$fermeture = get_field('fermeture', $acfw);
$url = get_bloginfo( 'stylesheet_directory' );

?>

<div class="col-12 col-md-6 col-lg-4 infos-map">
		<figure class="brand-footer"><img src="<?= $url ?>/assets/images/svg/havre-caravano-white.svg" alt="Havre Caravano #partenairedevosloisirs"/></figure>
	<h3 class="title-address">votre concessionnaire<br/><b>Camping-cars ADRIA et Mini-Vans ELIOS</b></h3>
	<address class="address d-block"><?= $address ?></address>
	<div class="infos-contact infos-horaires d-flex flex-column flex-lg-row">
		<p class="col-12 col-lg-6 contact-open"><?= $ouverture ?></p>
		<p class="col-12 col-lg-6 contact-close"><?= $fermeture ?><p>
	</div>
	<div class="infos-contact d-flex flex-column align-items-center">	
		<div id="widget-tel-footer" class="widget-tel d-inline-block align-items-center"><i class="ti-mobile"></i><?= $tel ?></div>
		<a class="link-way d-inline-block align-items-center" href="https://www.google.fr/maps/dir//Havre+Caravano,+256+Rte+des+Falaises,+76430+Sandouville/@49.4923,0.2870699,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x47e03701a623d585:0x239831fee725399c!2m2!1d0.2892224!2d49.4922704" title="Itinéraire GPS au Havre Caravano par Google Map" target="_blank">
			<i class="ti-map-alt d-inline-block"></i><span class="d-inline-block">Itinéraire</span>
		</a>
	</div>
</div>

<?php if( !empty($location) ):?>
	<div class="col-md-6 col-lg-8 acf-map">
		<div class="marker" data-icon="<?= $url ?>/assets/images/png/mark-google.png" data-lat="<?= $location['lat'] ?>" data-lng="<?= $location['lng'] ?>">
		</div>
	</div>
<?php endif; ?>