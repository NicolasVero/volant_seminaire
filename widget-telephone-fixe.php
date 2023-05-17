<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_fixe = get_field( 'telephone_fixe', $acfw );

if($telephone_fixe):
?>

<a href="" class="d-flex align-content-center">
	<i class="icon-phone"></i>
	<span><?= $telephone_fixe ?></span>
</a>

<?php endif;?>