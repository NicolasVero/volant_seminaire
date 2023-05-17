<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_fixe = get_field( 'telephone_fixe', $acfw );

if($telephone_fixe):
?>
<a href=""><i class="icon-phone"></i><?= $telephone_fixe ?></a>
	
<?php endif;?>