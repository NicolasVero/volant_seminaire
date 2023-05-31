<form role="search" method="get" class="search-form d-flex search-on" action="<?= esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?= esc_attr_x( 'Ici votre recherche...', 'placeholder'); ?>" value="<?= get_search_query(); ?>" name="s" />
	<button type="submit" class="submit-search d-flex justify-content-center align-items-center">Ok</button>
</form>