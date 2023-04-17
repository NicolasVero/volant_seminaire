<?php function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAZLojBGDFbHBIPFV-yZkQ7ZDeuNigO5fk');
}
add_action('acf/init', 'my_acf_init');?>