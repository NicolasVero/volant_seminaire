<script>
	if ($('#list-items-activities').length) {
	  $('#list-items-activities li.item-activite').each(function (index) {
		let data_activiteID = $(this).attr('data-activiteID');
		let data_activiteTITLE =  $(this).attr('data-activiteTITLE');
		let html_item = $(this).children().html();
		
		let form = '<?php 
		  $activiteID =  ' + data_activiteID + ';
		  $activite = get_post( $activiteID );
		  $activite_title = esc_html($activite->post_title);
		  $activite_description = esc_html($activite->post_excerpt);
		  $activite_image_url = get_the_post_thumbnail_url( $activiteID, 'medium' );
		?>' + '<input type="hidden" name="titre_activite-' + data_activiteID + '" value="' + data_activiteTITLE + '"><label for="nombre_personnes-' + data_activiteID + '">Nombre de personnes :</label><input type="number" name="nombre_personnes-' + data_activiteID + '" required><label for="date_activite-' + data_activiteID + '">Date de l\'activité :</label><input type="date" name="date_activite-' + data_activiteID + '" required><label for="lieu_seminaire-' + data_activiteID + '">Lieu du séminaire :</label> <input type="text" name="lieu_seminaire-' + data_activiteID + '" required><label for="horaires_debut-' + data_activiteID + '">Horaires :</label> <p>de <input type="time" name="horaires_debut-' + data_activiteID + '" required> à <input type="time" name="horaires_fin-' + data_activiteID + '" required></p><button><i class="ti-trash"></i></button>';
		
		$(this).click(function () {
		  $('#form-devis').prepend('<article id="titre_activite-' + data_activiteID + '" class="devis-item"><figure class="devis-item-image"><img src="<?php echo esc_url( $activite_image_url ); ?>" /></figure><div class="devis-item-content"><h3><?php echo esc_html( $activite_title ); ?></h3><p><?php echo esc_html( $activite_description ); ?></p></div>' + form + '</article>');
		});
	  });
	}
</script>