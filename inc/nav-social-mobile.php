<?php if ( has_nav_menu( 'social' ) ) : ?>

	<nav id="sticky-navigation-social" class="sticky-navigation-social" role="navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'social',
				'menu_class'     => 'sticky-social-menu d-flex justify-content-center align-content-center',
				'depth'          => 1,
				'link_before'    => '<span class="sticky-social-link d-none">',
				'link_after'     => '</span>',
			) );
		?>
	</nav><!-- .social-navigation -->

<?php endif; ?>