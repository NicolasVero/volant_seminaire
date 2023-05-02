<?php
function devis_form_CF7() {

$args = array(
		'page_id' => 108,
	);
	$query = new WP_Query($args);

		if($query->have_posts()) : while($query->have_posts()) : $query-> the_post();
			the_title( '<h1 class="title-article-page">', '</h1>' );
		endwhile; endif; wp_reset_query();
		
	$devis_items = isset( $_GET['activites'] ) ? sanitize_text_field( $_GET['activites'] ) : '';
	$devis_items_array = explode( ',', $devis_items );		
			//var_dump($devis_items);
			
	?>

<div class="devis-form-container">
	<div class="devis-items-container">
		<?php foreach ( $devis_items_array as $devis_item ) :
			$activiteID =  get_the_ID();
			$activite = get_post( $activiteID );
			
			// var_dump($activiteID);
			$image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
			
			if(!is_page(108) ){?> 
				<div class="devis-item">
					<figure class="devis-item-image">
						<img src="<?= esc_url( $image_url ) ?>" />
					</figure>
					<div class="devis-item-content">
						
						<h3><?= esc_html( $activite->post_title ) ?></h3>
						<p><?= esc_html( $activite->post_excerpt ) ?></p>
						
					</div>
				</div>
			<?php } 
			
			endforeach; 
			// Utiliser la balise de formulaire pour ajouter $devis_item
			echo do_shortcode( '[contact-form-7 id="4" title="Formulaire de demande de devis"]' );
			?> 
		</div>
		<?php
	}
	add_shortcode( 'devis_form_CF7', 'devis_form_CF7' );