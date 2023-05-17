<?php

if (! defined('ABSPATH')) {
	exit;
}

$email = get_field( 'email', $acfw );

if($email):
?>
<i class="icon-email"></i><?= $email ?>
	
<?php endif;?>