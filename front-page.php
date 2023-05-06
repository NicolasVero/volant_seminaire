<?php

if (! defined('ABSPATH')) {
	exit;
}

get_header();


	if(have_posts()) : ?>
		<div class="hero-featured">	
	<?php while(have_posts()) : the_post();
	
		$id = get_the_ID();
		$size = 'hero';
		$hero_image = get_the_post_thumbnail_url($id, $size);
		$hero_name = get_bloginfo('name');
		$hero_content = get_the_content();
	?>
		<figure><img src="<?= $hero_image ?>" alt="<? $hero_name ?> accueil"></figure>
		<div class="container container-hero-featured">
			<h1><?= $hero_name ?></h1>
			<?= $hero_content ?>
		</div>
	<?php endwhile; ?>
		</div>
	<?php endif;
	
	if ( function_exists('cpt_services') ){
		cpt_services();
	}
	
	 if( function_exists('cpt_allActivities') ){
		cpt_allActivities();
	}?>

<?php get_footer();

?>