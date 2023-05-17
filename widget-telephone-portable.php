<?php

if (! defined('ABSPATH')) {
	exit;
}

$telephone_portable = get_field( 'telephone_portable', $acfw );

if( $telephone_portable ):
?>

<div class="d-flex align-items-center">
	<a href="" class="d-flex align-content-center"><i class="icon-mobile"></i><?= $telephone_portable ?></a>
</div>
	
<?php endif;?>