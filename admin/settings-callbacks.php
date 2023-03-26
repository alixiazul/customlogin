<?php // Custom Login - Settings callbacks

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

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

// Call back: text field
function arcustomlogin_callback_field_text( $args ) {

    // 1: Defining variables

    // Options API

    // Getting the plugin options from the database. 
    // 1st argument: The name of the option itself. We use this name when retrieving the option from the database. It is defined in the "register_setting", 
    // as the 2nd parameter
    // 2nd argument: default options to use in case the options are not found in the database
    $options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );

    // The arguments should match the ones set in the settings-register.php for each setting field
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : ''; 

    // Get the value for the text field that we are displaying
    $value  = isset($options[$id])  ? sanitize_text_field( $options[$id] ) : '';

    // ------------------------------------------------------------------

    // 2: Output the field markup
    echo '<input id="arcustomlogin_option_'. $id .'" name="arcustomlogin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
    echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label>';
}

// Call back: radio field
function arcustomlogin_callback_field_radio( $args ) {
    // 1: Defining variables

    // Options API

    // Getting the plugin options from the database. 
    // 1st argument: The name of the option itself. We use this name when retrieving the option from the database. It is defined in the "register_setting", 
    // as the 2nd parameter
    // 2nd argument: default options to use in case the options are not found in the database
    $options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );

    // The arguments should match the ones set in the settings-register.php for each setting field
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Get the value for the radio field that we are displaying
    $selected_option = isset($options[$id]) ? sanitize_text_field( $options[$id] ) : '';

    // Get all the radio options available
    $radio_options = array(
        // value    =>  label
        'enable'    => 'Enable custom styles',
        'disable'   => 'Disable custom styles'
    );

    // ------------------------------------------------------------------

    // 2: Output the radio field markup
    foreach( $radio_options as $value => $label ) {
        // checked ( $checked, $current, $echo)
        // $checked = one of the values to compare
        // $current = the other value to compare (default = true)
        // $echo    = whether to echo the result or just return the string (default = true)    
        
        $checked = checked( $selected_option === $value, true, false ); // Not echoing but returning
        
        echo '<input id="arcustomlogin_option_'. $id .'" name="arcustomlogin_options['. $id .']" type="radio" value="'. $value .'" ' . $checked . '>';
        echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label><br/>';
    }
}

// Call back: textarea field
function arcustomlogin_callback_field_textarea() {
    echo 'This will be a textarea field';
}

// Call back: checkbox field
function arcustomlogin_callback_field_checkbox() {
    echo 'This will be a checkbox field';
}

// Call back: select field
function arcustomlogin_callback_field_select() {
    echo 'This will be a select field';
}