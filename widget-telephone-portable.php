<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_portable = get_field( 'telephone_portable', $acfw );

if( $telephone_portable ):
?>


<a href="" class="d-flex align-items-center">
	<i class="icon-mobile"></i>
	<span><?= $telephone_portable ?></span>
</a>
	
<?php endif;?>