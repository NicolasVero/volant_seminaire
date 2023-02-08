<?php
if( $terms_chamber ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Type de chambre</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_name_chamber ?> </strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Type de chambre</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }
if( $terms_salon ){ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Type de salon</p>
		<p class="item-caracteristique col-12 col-md-7 p-0"><strong><?= $term_name_salon ?> </strong></p>
	</li>
<?php }else{ ?>
	<li class="item-list-caracteristiques d-md-flex">
		<p class="title-item-caracteristique col-12 col-md-5 p-0">Type de salon</p>
		<p class="item-caracteristique col-12 col-md-7 p-0">-</p>
	</li>
<?php }