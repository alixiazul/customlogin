<?php // Custom Login - Settings Page

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
            // arcustomlogin_options is the name of the plugin settings group that it's going to be displayed.
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