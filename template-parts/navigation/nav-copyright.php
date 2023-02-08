<?php

if (! defined('ABSPATH')) {
	exit;
}
// $ args
// ( array ) (Facultatif) Tableau d'arguments du menu de navigation.
//
// 'menu'
// (int | string | WP_Term ) Menu souhaité. Accepte un ID de menu, un slug, un nom ou un objet.
// 'menu_class'
// (string) Classe CSS à utiliser pour l'élément ul qui forme le menu. «Menu» par défaut.
// 'menu_id'
// (string) L'ID appliqué à l'élément ul qui forme le menu. La valeur par défaut est le slug de menu, incrémenté.
// 'container'
// (string) Indique s'il faut envelopper l'ul et avec quoi l'envelopper. Par défaut 'div'.
// 'container_class'
// (string) Classe appliquée au conteneur. Par défaut 'menu- {menu slug} -container'.
// 'container_id'
// (string) ID appliqué au conteneur.
// 'container_aria_label'
// (string) L'attribut aria-label qui est appliqué au conteneur lorsqu'il s'agit d'un élément nav.
// 'fallback_cb'
// (callable | false) Si le menu n'existe pas, une fonction de rappel se déclenchera. La valeur par défaut est «wp_page_menu». Défini sur false pour aucune solution de secours.
// 'before'
// (chaîne) Texte avant le balisage du lien.
// 'after'
// (chaîne) Texte après le balisage du lien.
// 'link_before'
// (chaîne) Texte avant le texte du lien.
// 'link_after'
// (chaîne) Texte après le texte du lien.
// 'echo'
// (booléen) Indique s'il faut faire écho au menu ou le renvoyer. Valeur par défaut true.
// 'depth'
// (int) Combien de niveaux de la hiérarchie doivent être inclus. 0 signifie tout. Valeur par défaut 0. Valeur par défaut 0.
// 'walker'
// (objet) Instance d'une classe de marcheur personnalisée.
// 'theme_location'
// (chaîne) Emplacement du thème à utiliser. Doit être enregistré avec register_nav_menu () afin d'être sélectionnable par l'utilisateur.
// 'items_wrap'
// (string) Comment les éléments de la liste doivent être encapsulés. Utilise le format printf () avec des espaces réservés numérotés. La valeur par défaut est un ul avec un identifiant et une classe.
// 'item_spacing'
// (string) Indique s'il faut conserver les espaces dans le code HTML du menu. Accepte «préserver» ou «jeter». Par défaut «préserver».?>
<?php

$args = array(
	'theme_location'  => 'menu-copyright',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => 'widget-coyright',
	'container_id'    => 'navigation-copyright',
	'menu_class'      => 'items-copyright',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);


if (has_nav_menu('menu-copyright')) {
	wp_nav_menu($args);
}