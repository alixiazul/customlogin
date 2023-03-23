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

// Display the settings page of the plugin
function arcustomlogin_display_settings_page() {

    // Check if user is allowed access to the plugins page
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <!-- Display the plugin name, which is the title of the admin page, as the page heading -->
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <!-- Action always have to be "options.php" and the method always have to be "post" -->
        <form action="options.php" method="post">
            <?php
            // Output required security fields
            // arcustomlogin_options is the name of the settings group that it's going to be displayed.
            settings_fields( 'arcustomlogin_options' );

            // Output the MARKUP (html) that displays the plugins' settings sections
            // arcustomlogin is the name of the menu slug
            do_settings_sections( 'arcustomlogin' );

            // Submit button
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

// Add top-level administrative menu
function arcustomlogin_add_toplevel_menu() {
    /* 
		add_menu_page(
			string   $page_title, 
			string   $menu_title, 
			string   $capability, 
			string   $menu_slug, 
			callable $function = '', 
			string   $icon_url = '', 
			int      $position = null 
		)
	*/

    add_menu_page(
        'Custom Login Settings',
        'Custom Login',
        'manage_options',
        'arcustomlogin',
        'arcustomlogin_display_settings_page',
        'dashicons-admin-generic',
        null
    );	
}

add_action( 'admin_menu', arcustomlogin_add_toplevel_menu );