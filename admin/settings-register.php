<?php // Custom Login - Register Settings

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

// Register plugin settings using the Settings API
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
        esc_html__( 'Customise Login Page', 'customlogin' ), 
        'arcustomlogin_callback_section_login',
        'arcustomlogin' // Page where this section is displayed. Should match the menu slug specified in "add_submenu_page" function
    );

    // Second section to show the admin area of the plugin
    add_settings_section( 
        'arcustomlogin_section_admin', 
        esc_html__( 'Customise Admin Area', 'customlogin' ), 
        'arcustomlogin_callback_section_admin',
        'arcustomlogin' // Page where this section is displayed. Should match the menu slug specified in "add_submenu_page" function
    );

    /*

	add_settings_field(
    	string   $id,
		string   $title,
		callable $callback,
		string   $page,
		string   $section = 'default',
		array    $args = []
	);

	*/

    // Custom URL field - text
    add_settings_field(
        'custom_url', // setting value in the database
        esc_html__( 'Custom URL', 'customlogin' ),
        'arcustomlogin_callback_field_text', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_login',
        [ 'id' => 'custom_url', 'label' => esc_html__( 'Custom URL for the login logo', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom title field - text
    add_settings_field(
        'custom_title', // setting value in the database
        esc_html__( 'Custom Title', 'customlogin' ),
        'arcustomlogin_callback_field_text', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_login',
        [ 'id' => 'custom_title', 'label' => esc_html__( 'Custom title attribute for the login logo', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom style field - radio
    add_settings_field(
        'custom_style', // setting value in the database
        esc_html__( 'Custom Style', 'customlogin' ),
        'arcustomlogin_callback_field_radio', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_login',
        [ 'id' => 'custom_style', 'label' => esc_html__( 'Custom CSS for the login screen', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom message field - textarea
    add_settings_field(
        'custom_message', // setting value in the database
        esc_html__( 'Custom Message', 'customlogin' ),
        'arcustomlogin_callback_field_textarea', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_login',
        [ 'id' => 'custom_message', 'label' => esc_html__( 'Custom text and/or markup for the login screen', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom footer field - text
    add_settings_field(
        'custom_footer', // setting value in the database
        esc_html__( 'Custom Footer', 'customlogin' ),
        'arcustomlogin_callback_field_text', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_admin',
        [ 'id' => 'custom_footer', 'label' => esc_html__( 'Custom footer text', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom toolbar - checkbox
    add_settings_field(
        'custom_toolbar', // setting value in the database
        esc_html__( 'Custom Toolbar', 'customlogin' ),
        'arcustomlogin_callback_field_checkbox', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_admin',
        [ 'id' => 'custom_toolbar', 'label' => esc_html__( 'Remove new post and comment links from the toolbar', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );

    // Custom scheme - select
    add_settings_field(
        'custom_scheme', // setting value in the database
        esc_html__( 'Custom Scheme', 'customlogin' ),
        'arcustomlogin_callback_field_select', // function that outputs the markup required to display this field/setting
        'arcustomlogin',
        'arcustomlogin_section_admin',
        [ 'id' => 'custom_scheme', 'label' => esc_html__( 'Default color scheme for new users', 'customlogin' ) ] // arguments for the call back function (the one that outputs the markup)
        // adding as arguments the field id and the label to the call back function
    );
}

// Admin_init hook only fires in the admin area --> perfect to register plugin settings
add_action( 'admin_init', 'myplugin_register_settings');