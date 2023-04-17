<?php
//DASHBOARD
add_action('admin_head', 'my_custom_logo');

function my_custom_logo(){
echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item { background: url('.get_bloginfo('stylesheet_directory').'/assets/images/login/avatar-grib-negatif.png) no-repeat left 10px center !important;
background-size:60% !important;
width:30px; }
#wpadminbar .ab-icon, #wpadminbar .ab-item::before, #wpadminbar > #wp-toolbar > #wp-admin-bar-root-default .ab-icon{
	display:none;
}
</style>
';
}

add_filter('admin_footer_text', 'remove_footer_admin');

function remove_footer_admin(){
echo "Site réalisé par <a href='https://gribouillenet.fr'>Gribouillenet©</a>. Tous droits réservés. <em>V1.0</em>";
}