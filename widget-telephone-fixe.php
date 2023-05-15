<?php

if (! defined('ABSPATH')) {
	exit;
}

$tel = get_field( 'telephone_fixe', $acfw );

if($tel):
?>
<div id="widget-tel" class="widget-tel d-flex align-items-center"><i class="ti-mobile"></i><?= $tel ?></div>

<?php endif;?>