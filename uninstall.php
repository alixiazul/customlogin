<?php
/*	
	uninstall.php
	- fires when plugin is uninstalled via the Plugins screen
*/

// Exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {	
	exit;	
}

// Delete the plugin options
delete_option( 'arcustomlogin_options' );