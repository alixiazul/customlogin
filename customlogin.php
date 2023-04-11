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
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
}

// Include dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'admin/includes/core-functions.php';


// Default plugin options
function arcustomlogin_default_options() {

    // These default values are used by the plugin until the user makes changes via the plugin settings page
    return array(
        'custom_url'        => 'https://wordpress.org',
        'custom_title'      => 'Powered by WordPress',
        'custom_style'      => 'disable',
        'custom_message'    => '<p class="custom-message">My custom message</p>',
        'custom_footer'     => 'Special message for users',
        'custom_toolbar'    => false,
        'custom_scheme'     => 'default'
    );
}