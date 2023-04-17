<?php if($rows_options){ ?>
	<ul>
		<?php foreach ($rows_options as $row_option){ 
		$titre_option = $row_option['titre_option'];
		$prix_option = $row_option['prix_option'];
		$prix_option = number_format($prix_option, 0, ',', ' ');
		
		$text_option = $row_option['texte_option'];
		?>
		
			<li class="item-list-caracteristiques d-md-flex">
				<p class="title-item-caracteristique col-12 col-md-5 p-0 m-0"><strong><?= $titre_option  ?></strong></p>
				<?php if($prix_option){?>
				<p class="item-caracteristique col-12 col-md-7 p-0"><?= $prix_option ?> €</p>
				<?php }?>
			</li>
			<?php if($text_option){ ?>
				<li class="item-list-caracteristiques d-md-flex">
					<p class="item-caracteristique col-12 p-0"><?= $text_option ?></p>
				</li>
			<?php } 
		} ?>
	</ul>
<?php }?>
