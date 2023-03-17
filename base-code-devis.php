<?php
// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_GET['devis_items'] ) ? $_GET['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	<div class="devis-form-container">
		<?php echo do_shortcode( '[contact-form-7 id="1" title="Formulaire de demande de devis"]' ); ?>
		<div class="devis-items-container">
			<h2>Items sélectionnés</h2>
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
				?>
				<div class="devis-item">
					<div class="devis-item-image">
						<img src="<?php echo esc_url( $image_url ); ?>" />
					</div>
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<p><?php echo esc_html( $activite->post_excerpt ); ?></p>
						<h4>Informations de réservation</h4>
						<?php echo do_shortcode( '[text nombre-personnes "Nombre de personnes"]' ); ?>
						<?php echo do_shortcode( '[date date-activite "Date de l\'activité"]' ); ?>
						<?php echo do_shortcode( '[text adresse-seminaire "Adresse du séminaire"]' ); ?>
						<?php echo do_shortcode( '[checkbox horaires "Horaires de l\'activité" "Matinée (9h-12h)" "Après-midi (14h-17h)" "Soirée (19h-22h)"]' ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}
add_shortcode( 'display_devis_form', 'display_devis_form' );

// Ajouter un item au devis
function add_to_devis() {
	$devis_items = isset( $_GET['devis_items'] ) ? $_GET['devis_items'] : '';
	$activite_id = isset( $_POST['activite_id'] ) ? intval( $_POST['activite_id'] ) : 0;
	if ( $activite_id ) {
		if ( !empty( $devis_items ) ) {
			$devis_items .= ',';
		}
		$devis_items .= $activite_id;
	}
	wp_redirect( home_url( '/demander-un-devis/?devis_items=' . $devis_items ) );
	exit();
}
add_action( 'admin_post_add_to_devis', 'add_to_devis' );





// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_POST['devis_items'] ) ? $_POST['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	<div class="devis-form-container">
		<?php echo do_shortcode( '[contact-form-7 id="1" title="Formulaire de demande de devis"]' ); ?>
		<div class="devis-items-container">
			<h2>Items sélectionnés</h2>
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				$image_url = get_the_post_thumbnail_url( $activite->ID, 'medium' );
				?>
				<div class="devis-item">
					<div class="devis-item-image">
						<img src="<?php echo esc_url( $image_url ); ?>" />
					</div>
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<p><?php echo esc_html( $activite->post_excerpt ); ?></p>
						<h4>Informations de réservation</h4>
						<?php echo do_shortcode( '[text nombre-personnes "Nombre de personnes"]' ); ?>
						<?php echo do_shortcode( '[date date-activite "Date de l\'activité"]' ); ?>
						<?php echo do_shortcode( '[text adresse-seminaire "Adresse du séminaire"]' ); ?>
						<?php echo do_shortcode( '[checkbox horaires "Horaires de l\'activité" "Matinée (9h-12h)" "Après-midi (14h-17h)" "Soirée (19h-22h)"]' ); ?>
						<?php
						// Ajouter les balises dynamiques dans le formulaire Contact Form 7
						add_filter( 'wpcf7_special_mail_tags', function( $output, $name, $html ) use ( $activite, $image_url ) {
							if ( $name == 'activite_image' ) {
								return $image_url;
							} elseif ( $name == 'activite_titre' ) {
								return $activite->post_title;
							} elseif ( $name == 'activite_extrait' ) {
								return $activite->post_excerpt;
							} else {
								return $output;
							}
						}, 10, 3 );
						?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

add_shortcode( 'display_devis_form', 'display_devis_form' );



// Afficher le formulaire de demande de devis avec les items ajoutés
function display_devis_form() {
	$devis_items = isset( $_POST['devis_items'] ) ? $_POST['devis_items'] : '';
	$devis_items_array = explode( ',', $devis_items );
	?>
	<div class="devis-form-container">
		
		<div class="devis-items-container">
			<?php foreach ( $devis_items_array as $devis_item ) :
				$activite = get_post( $devis_item );
				?>
				<div class="devis-item">
					<div class="devis-item-content">
						<h3><?php echo esc_html( $activite->post_title ); ?></h3>
						<?php echo do_shortcode( '[text activite-id id:activite-id readonly "ID de l\'activité" "'.$activite->ID.'"]' ); ?>
						<div class="content-form">
							<label for="nombre-personnes">Nombre de personnes</label>
							<input type="number" name="nombre-personnes" id="nombre-personnes" value="<?php echo isset($_POST['nombre-personnes']) ? $_POST['nombre-personnes'] : ''; ?>">
						</div>
						<div class="content-form">
							<label for="date-activite">Date de l'activité</label>
							<input type="date" name="date-activite" id="date-activite" value="<?php echo isset($_POST['date-activite']) ? $_POST['date-activite'] : ''; ?>">
						</div>
						<div class="content-form">
							<label for="adresse-seminaire">Adresse du séminaire</label>
							<input type="text" name="adresse-seminaire" id="adresse-seminaire" value="<?php echo isset($_POST['adresse-seminaire']) ? $_POST['adresse-seminaire'] : ''; ?>">
						</div>
						<div class="content-form">
							<label for="horaires-heures">Horaires</label>
							<span>de</span>
								<select name="horaires-heures" id="horaires-heures">
									<option value="00">00</option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>							
								</select>
								<span>h</span>
								<select name="horaires-minutes" id="horaires-minutes">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
								<span>à</span>
								<select name="horaires-heures-fin" id="horaires-heures-fin">
									<option value="00">00</option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>							
								</select>
								<span>h</span>
								<select name="horaires-minutes-fin" id="horaires-minutes-fin">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

add_shortcode( 'display_devis_form', 'display_devis_form' );

// Ajouter les balises dynamiques pour les champs personnalisés dans le formulaire contact form 7
add_filter( 'wpcf7_special_mail_tags', 'add_custom_fields_to_mail' );
function add_custom_fields_to_mail( $tags ) {
	$tags['activite-id'] = $_POST['activite-id'];
	$tags['nombre-personnes'] = $_POST['nombre-personnes'];
	$tags['date-activite'] = $_POST['date-activite'];
	$tags['adresse-seminaire'] = $_POST['adresse-seminaire'];
	$tags['horaires'] = $_POST['horaires-heures'] . ':' . $_POST['horaires-minutes'] . ' - ' . $_POST['horaires-a-heures'] . ':' . $_POST['horaires-a-minutes'];
	return $tags;
}


// Ajouter les champs personnalisés au mail
function add_custom_fields_to_mail( $template, $prop ) {
	if ( $prop === 'mail' ) {
		global $wpdb;
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) {
			$form_data = $submission->get_posted_data();
			$devis_items = isset( $form_data['devis_items'] ) ? $form_data['devis_items'] : '';
			$devis_items_array = explode( ',', $devis_items );
			$activites = array();
			foreach ( $devis_items_array as $devis_item ) {
				$activite = get_post( $devis_item );
				$activites[] = array(
					'titre' => $activite->post_title,
					'image_url' => get_the_post_thumbnail_url( $activite->ID, 'medium' ),
					'resume' => $activite->post_excerpt,
					'nombre_personnes' => isset( $form_data['nombre-personnes'] ) ? sanitize_text_field( $form_data['nombre-personnes'] ) : '',
					'date_activite' => isset( $form_data['date-activite'] ) ? sanitize_text_field( $form_data['date-activite'] ) : '',
					'adresse_seminaire' => isset( $form_data['adresse-seminaire'] ) ? sanitize_text_field( $form_data['adresse-seminaire'] ) : '',
					'horaires' => isset( $form_data['horaires-heures'] ) ? sanitize_text_field( $form_data['horaires-heures'] ) . ':' . sanitize_text_field( $form_data['horaires-minutes'] ) . ' - ' . sanitize_text_field( $form_data['horaires-a-heures'] ) . ':' . sanitize_text_field( $form_data['horaires-a-minutes'] ) : '',
				);
			}
			$template = str_replace( '[activites]', json_encode( $activites ), $template );
		}
	}
	return $template;
}
add_filter( 'wpcf7_special_mail_tags', 'add_custom_fields_to_mail', 10, 2 );?>





<?php
///formulaire
?>
<div class="content-form">
	<label for="nombre-personnes">Nombre de personnes</label>
	<input type="number" name="nombre-personnes" id="nombre-personnes" value="<?php echo isset($_POST['nombre-personnes']) ? $_POST['nombre-personnes'] : ''; ?>">
</div>
<div class="content-form">
	<label for="date-activite">Date de l'activité</label>
	<input type="date" name="date-activite" id="date-activite" value="<?php echo isset($_POST['date-activite']) ? $_POST['date-activite'] : ''; ?>">
</div>
<div class="content-form">
	<label for="adresse-seminaire">Adresse du séminaire</label>
	<input type="text" name="adresse-seminaire" id="adresse-seminaire" value="<?php echo isset($_POST['adresse-seminaire']) ? $_POST['adresse-seminaire'] : ''; ?>">
</div>
<div class="content-form">
	<label for="horaires-heures">Horaires</label>
	<span>de</span>
		<select name="horaires-heures" id="horaires-heures">
			<option value="00">00</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>							
		</select>
		<span>h</span>
		<select name="horaires-minutes" id="horaires-minutes">
			<option value="00">00</option>
			<option value="15">15</option>
			<option value="30">30</option>
			<option value="45">45</option>
		</select>
		<span>à</span>
		<select name="horaires-a-heures" id="horaires-a-heures">
			<option value="00">00</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>							
		</select>
		<span>h</span>
		<select name="horaires-a-minutes" id="horaires-a-minutes">
			<option value="00">00</option>
			<option value="15">15</option>
			<option value="30">30</option>
			<option value="45">45</option>
		</select>
</div>
