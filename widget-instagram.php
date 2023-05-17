<?php

if (! defined('ABSPATH')) {
	exit;
}

$instagram = get_field( 'instagram', $acfw );

if($instagram):
?>
<a href=""><i class="icon-insta"></i><?= $instagram ?></a>
	
<?php endif;?>