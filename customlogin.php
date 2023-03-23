<?php
/*
Plugin Name:  Custom Login
Description:  Plugin which creates a custom login page
Plugin URI:   https://aliciarodriguezweb.com
Author:       Alicia Rodriguez
Version:      1.0
Text Domain:  arcustomlogin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

// If there is "admin access"
if ( is_admin() ) {

    // Include dependencies
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
}

// Register plugin settings
function myplugin_register_settings() {
    
    /*
	
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback
	);
	
	*/
    
    register_setting(
        'arcustomlogin_options', // Should match the name of the group set in "settings-page.php" in the function "settings_fields"
        'arcustomlogin_options', // The name of the option itself. We use this name when retrieving the option from the database.
        'arcustomlogin_validate_options'
    );

	/*
	
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	
	*/

    // First section to show the login options
    add_settings_section( 
        'arcustomlogin_section_login', 
        'Customise Login Page', 
        'arcustomlogin_callback_section_login',
        'arcustomlogin' // Page where this section is displayed. Should match the menu slug specified in "add_submenu_page" function
    );

    // Second section to show the admin area of the plugin
    add_settings_section( 
        'arcustomlogin_section_admin', 
        'Customise Admin Area', 
        'arcustomlogin_callback_section_admin',
        'arcustomlogin' // Page where this section is displayed. Should match the menu slug specified in "add_submenu_page" function
    );

}

// Admin_init hook only fires in the admin area --> perfect to register plugin settings
add_action( 'admin_init', 'myplugin_register_settings');

// Validate plugin options in settings
function arcustomlogin_validate_options( $input ) {
    return $input;
}

// Call back: Login section
function arcustomlogin_callback_section_login() {
    echo '<p>These settings enable you to customize the WP Login screen.</p>';
}

// Call back: Admin section
function arcustomlogin_callback_section_admin() {
    echo '<p>These settings enable you to customize the WP Admin Area.</p>';
}