<?php
if (! defined('ABSPATH')) {
	exit;
} 
get_header(); ?>

	<div id="container-page-article" class="container container-page-article">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();

				the_content();

				// End the loop.
			endwhile;


			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


	</div>

<?php get_footer(); ?>