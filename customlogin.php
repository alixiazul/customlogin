<?php
/*
Plugin Name:  Custom Login
Description:  Plugin which creates a custom login page
Plugin URI:   https://aliciarodriguezweb.com
Author:       Alicia Rodriguez
Version:      1.0
Text Domain:  customlogin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

// text domain --> needed for internationalisation. Must match the plugin folder and main plugin file.
// domain path --> needed for internationalisation. Must much the languages folder
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
        'custom_title'      => esc_html__( 'Powered by WordPress', 'customlogin' ), // Using the underscore function. These are strings that need to be translated.
        'custom_style'      => 'disable',
        'custom_message'    => esc_html__( '<p class="custom-message">My custom message</p>', 'customlogin' ),
        'custom_footer'     => esc_html__( 'Special message for users' ),
        'custom_toolbar'    => false,
        'custom_scheme'     => 'default'
    );

    // __()     --> double underscore function
    // __e()    --> echoes the string instead of returning it
    // __x()    --> provides an extra parameter that can be used to specify context

    // Safer way to localise strings. They provide built-in sanitisation for the translated strings, which helps keep translations correct and stop translators from
    // running malicious code.
    // esc_html__()
    // esc_html_e()
    // esc_html_x()
}

// Load text domain --> for internationlisation
function arcustomlogin_load_textdomain() {

    // The plugin text domain should match up with the "text domain" especified in this file header
    load_plugin_textdomain( 'customlogin', false, plugin_dir_path( __FILE__ ) . '/languages' );
}

add_action( 'plugins_loaded', 'arcustomlogin_load_textdomain' );


// Technique to uninstall the plugin. Although the uninstall.php has been used instead.

// // Remove options on uninstall
// function arcustomlogin_on_uninstall() {

// 	if ( ! current_user_can( 'activate_plugins' ) ) return;

//     // This removes the options for the plugin. You can check if the options are or not in here:
//     // 1. Go to PHP My Admin
//     // 2. Choose the database (aliciarodriguez)
//     // 3. Choose the options table (ar_options)
//     // 4. Make a search where "option_name" LIKE "nameoftheplugin_options" (arcustomlogin_options)
// 	delete_option( 'arcustomlogin_options' );   

// }
// register_uninstall_hook( __FILE__, 'arcustomlogin_on_uninstall' );