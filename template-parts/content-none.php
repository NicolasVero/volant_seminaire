<?php if ( is_search() ) : ?>

<p>Désolé, mais rien ne correspond à votre recherche. Veuillez réessayer avec des mots différents dans la barre de recherche ci-dessous.</p>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Ici votre recherche...', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="submit-search">Ok</button>
</form>


<?php else : ?>

<p>Désolé, mais il semblerait que ce vous rechercher n'existe pas. Merci d'utiliser l'application de recherche du site situé en à droite de votre écran dans la navigation du site.</p>

<?php endif; ?>
