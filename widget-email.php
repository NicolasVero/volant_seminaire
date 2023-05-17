<?php

if (! defined('ABSPATH')) {
	exit;
}

$email = get_field( 'email', $acfw );

if($email):
?>

<div class="d-flex align-items-center">
	<i class="icon-email" class="d-flex align-content-center"></i><?= $email ?>
</div>

<?php endif;?>