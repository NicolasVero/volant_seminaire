<?php

if (! defined('ABSPATH')) {
	exit;
}

$facebook = get_field( 'facebook', $acfw );

if($facebook):
?>
<a href=""><i class="icon-facebook"></i><?= $facebook ?></a>
	
<?php endif;?>