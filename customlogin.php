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

// Display the settings page
function arcustomlogin_display_settings_page() {

    // Check if user is allowed access
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields
            settings_fields( 'arcustomlogin_options' );

            // Output settings sections
            do_settings_sections( 'arcustomlogin' );

            // Submit button
            submit_button();
            ?>
        </form>
    </div>

    <?php
}