<div id="titre_activite-<?= $activiteID ?>" class="devis-item">
	<div class="row">
		<figure class="devis-item-image col-3 col-md-3">
			<img src="<?= esc_url( $activite_image_url ) ?>" />
		</figure>
		<div class="devis-item-content col-9 col-md-8">						
			<h2><?= $activite_title ?></h2>
			<p><?= $activite_description ?></p>
		</div>
		<button type="submit" name="submit_delete-<?= $activiteID ?>" class="delete-activity col-1"><i class="ti-trash"></i></button>
	</div>
	<div class="row">
		<input type="hidden" name="id_activite-<?= $activiteID ?>" value="<?= $activiteID ?>">
		<input type="hidden" name="titre_activite-<?= $activiteID ?>" value="<?php echo esc_attr( $activite_title ); ?>">
		<div class="col-12 col-md-6">
			<div class="d-flex align-items-center input-people item-input-form">
				<label class="col-6 pl-0" for="nombre_personnes-<?= $activiteID ?>">* Nombre de personnes</label>
				<input class="col-6" type="number" name="nombre_personnes-<?= $activiteID ?>" value="<?= rewrite('nombre_personnes-' . $activiteID) ?>">
				<?= display_error('nombre_personnes', $activiteID) ?>
			</div>
			<div class="d-flex align-items-center input-date item-input-form">
				<label class="col-6 pl-0" for="date_activite-<?= $activiteID ?>">* Date de l'activité</label>
				<input class="col-6" type="date" name="date_activite-<?= $activiteID ?>" min="<?= get_today_date() ?>" max="<?= get_max_date(6) ?>" value="<?= rewrite('date_activite-' . $activiteID) ?>" >
				<?= display_error('date_activite', $activiteID) ?>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="d-flex align-items-center input-place item-input-form">
				<label class="col-6 pl-0" for="lieu_seminaire-<?= $activiteID ?>">* Lieu du séminaire</label>
				<input type="text" name="lieu_seminaire-<?= $activiteID ?>" value="<?= rewrite('lieu_seminaire-' . $activiteID) ?>">
			</div>
			<div class="d-flex align-items-center input-hours item-input-form">
				<label class="col-6 pl-0 d-flex align-items-center" for="horaires_debut-<?= $activiteID ?>">* Horaires</label>
				<div class="d-flex col-6 align-items-center"><span>de</span><input type="time" name="horaires_debut-<?= $activiteID ?>" value="<?= rewrite('horaires_debut-' . $activiteID) ?>"> <span>à</span><input type="time" name="horaires_fin-<?= $activiteID ?>" value="<?= rewrite('horaires_fin-' . $activiteID) ?>">
				</div>
				<?= display_error('horaires_debut', $activiteID) ?>
				<?= display_error('horaires_fin', $activiteID) ?>
			</div>
		</div>
	</div>
</div>