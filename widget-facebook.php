<?php

if (! defined('ABSPATH')) {
	exit;
}

$facebook = get_field( 'facebook', $acfw );

if($facebook):
?>

<div class="d-flex align-items-center">
	<a href="" class="d-flex align-content-center"><i class="icon-facebook"></i><?= $facebook ?></a>
</div>
	
<?php endif;?>