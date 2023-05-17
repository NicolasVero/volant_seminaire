<?php

if (! defined('ABSPATH')) {
	exit;
}

$localisation = get_field( 'localisation', $acfw );
$ville = get_field( 'ville', $acfw );

if($localisation):
?>
<div class="d-flex align-items-center">
    <i class="icon-localisation d-block"></i>
    <div class="">
        <span class="d-block"><?= $localisation ?></span>
        <span class="d-block"><?= $ville ?></span>
    </div>
</div>
	
<?php endif;?>