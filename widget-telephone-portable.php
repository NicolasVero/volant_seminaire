<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_portable = get_field( 'telephone_portable', $acfw );

if( $telephone_portable ):
?>
<a href=""><i class="icon-mobile"></i><?= $telephone_portable ?></a>
	
<?php endif;?>