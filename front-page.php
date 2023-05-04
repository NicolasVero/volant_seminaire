<?php

if (! defined('ABSPATH')) {
	exit;
}

get_header();


	if(have_posts()) : 
		
		
		
	while(have_posts()) : the_post();
	
		$id = get_the_ID();
		$size = 'hero';
		$hero_image = get_the_post_thumbnail_url($id, $size);
		$hero_name = get_bloginfo('name');
		$hero_content = get_the_content();
	?>
	
	<div class="hero-featured">
		<img src="<?= $hero_image ?>" alt="<? $hero_name ?> accueil">
		<div class="container">
			<h1><?= $hero_name ?></h1>
			<?= $hero_content ?>
		</div>
	</div>

	<?php endwhile; endif;?>
	
	<?php if( function_exists('cpt_allActivities') ){
		cpt_allActivities();
	}?>

<?php get_footer();

?>