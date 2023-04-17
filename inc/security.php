<?php
//SUPPRESSION RENOUVELLEMENT MDP
function supprimer_rest_mdp() {return false;}
add_filter ('allow_password_reset','supprimer_rest_mdp');

function enleve_mdp_textfr ($text) {if ($text == 'Mot de passe oublié&nbsp;?') {$text = '';} return $text;}
function enleve_mdp_fr() {add_filter('gettext','enleve_mdp_textfr');}
add_action ('login_head','enleve_mdp_fr');
function enleve_mdp_textfr2 ($text) {return str_replace('Avez-vous perdu votre mot de passe</a>&nbsp;?','</a>',$text);}
add_filter ('login_errors','enleve_mdp_textfr2');