<?php

if (! defined('ABSPATH')) {
	exit;
}

$instagram = get_field( 'instagram', $acfw );

if($instagram):
?>


<a href="" class="d-flex align-items-center">
    <i class="icon-insta"></i>
    <span class=""><?= $instagram ?></span>
</a>

	
<?php endif;?>