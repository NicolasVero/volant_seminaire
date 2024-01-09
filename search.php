<?php get_header();

if ( have_posts() ) :
?>

<div id="container-page-article" class="container container-page-article">

		<header class="article-header">
		<h1 class="title-page col-12">Voici les résultats de votre recherche<br>
		<?php printf( __( 'Pour le ou les mot(s) : %s' ), '<span class="words-results">"' . esc_html( get_search_query() ) . '"</span>' ); ?></h1>

		</header>
		<ul>
		<?php 
		
			while ( have_posts() ) : the_post();
				if ( get_post_type() === 'activites' ) {
					get_template_part( 'template-parts/content', 'search' );
				}
			endwhile;?>
		</ul>




<?php else :?>

<div id="container-page-article" class="container container-page-article">
	<div class="row container-article-page">
		<header class="article-header">
			<h1 class="container-fluid corner-round corner-round-bibliographie title-page col-12"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h1>
		</header>
		<?php get_template_part( 'template-parts/content', 'none' );?>
	</div>
</div>

<?php endif; ?>

</div>

<?php get_footer(); ?>