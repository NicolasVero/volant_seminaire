<?php if( $term_slug_type == 'vehicules-neufs' ) { ?>
		<li class="item-list-caracteristiques d-md-flex">
			<p class="title-item-caracteristique col-12 col-md-5 p-0">Catégorie de véhicule</p>
			<p class="item-caracteristique col-12 col-md-7 p-0"><strong>Neuf</strong></p>
		</li>
		<?php if( $term_name_model ){?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Modèle</p>
				<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_name_model ?></strong></p>
			</li>
		<?php }else{ ?>
				<li class="item-list-caracteristiques d-md-flex">
					<p class="title-item-caracteristique col-12 col-md-5 p-0">Modèle</p>
					<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
				</li>
		<?php } 								
		if( $collection ){ ?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Collection</p>
				<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $collection ?></strong></p>
			</li>
			<?php }else{ ?>
				<li class="item-list-caracteristiques d-md-flex">
					<p class="title-item-caracteristique col-12 col-md-5 p-0">Collection</p>
					<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
				</li>
			<?php }?>
<?php }else{ ?>
		<li class="item-list-caracteristiques d-md-flex">
			<p class="title-item-caracteristique col-12 col-md-5 p-0">Catégorie de véhicule</p>
			<p class="item-caracteristique col-12 col-md-7 p-0"><strong>Occasion</strong></p>
		</li>
		<?php if( $term_name_model ){?>
		<li class="item-list-caracteristiques d-md-flex">
			<p class="title-item-caracteristique col-12 col-md-5 p-0">Modèle</p>
			<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_name_model ?></strong></p>
		</li>
		<?php }else{?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Modèle</p>
				<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
			</li>
		<?php } 								
		if( $circulation ){ ?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Mise en circulation</p>
				<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $circulation ?></strong></p>
			</li>
		<?php }else{?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Mise en circulation</p>
				<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
			</li>
		<?php }
		if( $km ){ ?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Kilomètrage</p>
				<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $km ?> km</strong></p>
			</li>
		<?php }else{ ?>
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0">Kilomètrage</p>
				<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
			</li>
		<?php }?>
<?php }
if( $ptac ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">P.T.A.C.</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $ptac ?> KG</strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">P.T.A.C.</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $ch_utile ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Charge utile</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $ch_utile ?> KG</strong></p>
	</li>
	<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Charge utile</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $porteur ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Porteur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $porteur ?></strong></p>
	</li>
	<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Porteur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
	<?php }
if( $cv ){ ?>
<li class="item-list-caracteristiques d-md-flex">
	<p class="title-item-caracteristique col-12 col-md-5 p-0">Moteur</p>
	<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $cv ?> CV</strong></p>
</li>
<?php }else{ ?>
<li class="item-list-caracteristiques d-md-flex">
	<p class="title-item-caracteristique col-12 col-md-5 p-0">Moteur</p>
	<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
</li>
<?php }
if( $fiscaux ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">CV Fiscaux</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $fiscaux ?> CV</strong></p>
	</li>
	<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">CV Fiscaux</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }

if( $term_slug_carte ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Places carte grise</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_slug_carte ?></strong></p>
	</li>
	<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Places carte grise</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $term_slug_place ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Places couchages</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_slug_place ?></strong></p>
	</li>
	<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Places couchages</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }