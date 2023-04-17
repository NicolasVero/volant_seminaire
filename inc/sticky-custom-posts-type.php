<?php 
add_action( 'admin_footer-post.php', 'gkp_add_sticky_post_support' );
add_action( 'admin_footer-post-new.php', 'gkp_add_sticky_post_support' );
function gkp_add_sticky_post_support() 
{ global $post, $typenow; ?>
	
	<?php if ( $typenow == 'vehicules' && current_user_can( 'edit_others_posts' ) ) : ?>
	<script>
	jQuery(function($) {
		var sticky = "<br/><span id='sticky-span'><input id='sticky' name='sticky' type='checkbox' value='sticky' <?php checked( is_sticky( $post->ID ) ); ?> /> <label for='sticky' class='selectit'><?php _e( "Stick this post to the front page" ); ?></label><br /></span>";	
		$('[for=visibility-radio-public]').append(sticky);	
	});
	</script>
	<?php endif; ?>
	
<?php
}
	?>