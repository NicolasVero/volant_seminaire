<?php

if (! defined('ABSPATH')) {
	exit;
}

$instagram = get_field( 'instagram', $acfw );

if($instagram):
?>

<div class="d-flex align-items-center">
	<a href="" class="d-flex align-content-center"><i class="icon-insta"></i><?= $instagram ?></a>
</div>
	
<?php endif;?>