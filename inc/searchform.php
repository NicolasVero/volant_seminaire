<form role="search" method="get" class="search-form d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Ici votre recherche...', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="submit-search d-flex justify-content-center align-items-center">Ok</button>
</form>

