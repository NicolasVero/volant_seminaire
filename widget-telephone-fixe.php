<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_fixe = get_field( 'telephone_fixe', $acfw );

if($telephone_fixe):
?>

<div class="d-flex align-items-center">
	<a href="" class="d-flex align-content-center"><i class="icon-phone"></i><?= $telephone_fixe ?></a>
</div>	
<?php endif;?>