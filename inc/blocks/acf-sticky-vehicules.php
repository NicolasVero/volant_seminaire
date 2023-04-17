<?php

$sticky_actif = get_field('activer');

if($sticky_actif){

get_template_part( 'template-parts/content', 'sticky-vehicules' );
	
}?>