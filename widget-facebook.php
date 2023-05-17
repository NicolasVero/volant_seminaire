<?php

if (! defined('ABSPATH')) {
	exit;
}

$facebook = get_field( 'facebook', $acfw );

if($facebook):
?>


<a href="" class="d-flex align-items-center">
	<i class="icon-facebook"></i>
	<span><?= $facebook ?></span>
</a>

	
<?php endif;?>