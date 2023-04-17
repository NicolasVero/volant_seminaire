<div class="widget-filter widget-filter-search">
	<h3>Vous recherchez ?</h3>
	<form role="search" method="get" class="search-form-sidebar d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<button type="submit" class="submit-search d-flex justify-content-center align-items-center"><i class="ti-search"></i></button>
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Votre recherche', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			
	</form>

</div>