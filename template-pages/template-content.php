<?php

if (! defined('ABSPATH')) {
	exit;
} 

$urlTemplate = get_stylesheet_directory();
$ID = get_the_ID();

?>

<div class="container container-article-page container-article-page-<?= $ID ?>">
	<?php 
		the_title('<h1>', '</h1>');
		the_content();
	?>
</div>

<?php  
if( is_page(452) && isset($_COOKIE)) {
	include $urlTemplate . '/inc/functions/function-create-devis.php';
}
?>
