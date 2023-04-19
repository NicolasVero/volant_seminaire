<?php

if (! defined('ABSPATH')) {
	exit;
} 
	$ID = get_the_ID();
?>

<div id="container-page-article" class="container container-page-article">
	<div class="container-article-page container-article-page-<?= $ID ?>">
				<?php the_title( '<h1 class="title-article-page">', '</h1>' ); ?>
				<?php the_content(); ?>
	</div>
</div>
