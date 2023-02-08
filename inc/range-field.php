<?php 
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-range-field/acf-range.php');
}