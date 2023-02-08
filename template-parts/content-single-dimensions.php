<?php
if( $longueur ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Longueur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $longueur ?></strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Longueur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $largeur ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Largeur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $largeur ?></strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Largeur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $hauteur ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Hauteur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $hauteur ?></strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Hauteur</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }