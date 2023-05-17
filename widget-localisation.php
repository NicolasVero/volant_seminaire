<?php

if (! defined('ABSPATH')) {
	exit;
}

$localisation = get_field( 'localisation', $acfw );

if($localisation):
?>
<a href=""><i class="icon-localisation"></i><?= $localisation ?></a>
	
<?php endif;?>