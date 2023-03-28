<?php // Custom Login - Settings callbacks

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

// Call back: Validate plugin options in settings
function arcustomlogin_validate_options( $input ) {

    // sanitize_text_field --> when there is a need to sanitize simple text input without any HTML formatting
    // wp_kses_post        --> when there is a need to sanitize input that contains HTML content while preserving the allowed formatting

    // Custom url ---------------------------------------------
    if ( isset( $input['custom_url'] ) ) {

        // Sanitising the url 
        $input['custom_url'] = esc_url( $input['custom_url'] ); 
    }

    // Custom title -------------------------------------------
    if ( isset( $input['custom_title'] ) ) {

        // Sanitising the title
        $input['custom_title'] = sanitize_text_field( $input['custom_title'] );
    }

    // Custom style -------------------------------------------
    $radio_options = array(
        'enable'    => 'Enable custom styles',
        'disable'   => 'Disable custom styles'
    );

    // 1 - Checking if the option exists or is set
    if ( ! isset( $input['custom_style'] ) ) {
        $input['custom_style'] = null;
    }

    // 2 - Checking if the value of the option is defined in the array of radio_options, they should match
    if ( ! array_key_exists( $input['custom_style'], $radio_options ) ) {
        $input['custom_style'] = null;
    }


    // Custom message -----------------------------------------
    if ( isset( $input['custom_message'] ) ) {

        // Sanitising the message
        $input['custom_message'] = wp_kses_post( $input['custom_message'] );
    }

    // Custom footer ------------------------------------------
    if ( isset( $input['custom_footer'] ) ) {

        // Sanitising the footer
        $input['custom_footer'] = sanitize_text_field( $input['custom_footer'] );
    }

    // Custom toolbar ------------------------------------------
    
    // Checking if the option exists or is set
    if ( ! isset( $input['custom_toolbar'] ) ) {
        $input['custom_toolbar'] = null;
    }

    // Custom scheme -------------------------------------------

    $select_options = array(
        'default'   => 'Default',
        'light'     => 'Light',
        'blue'      => 'Blue',
        'coffee'    => 'Coffee',
        'ectoplasm' => 'Ectoplasm',
        'midnight'  => 'Midnight',
        'ocean'     => 'Ocean',
        'sunrise'   => 'Sunrise'
    );

    // 1 - Checking if the option exists or is set
    if ( ! isset( $input['custom_scheme'] ) ) {        
        $input['custom_scheme'] = null;
    }

    // 2 - Checking if the value of the option is defined in the array of select_options, they should match
    if ( ! array_key_exists( $input['custom_scheme'], $select_options ) ) {
        $input['custom_scheme'] = null;
    }

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
    echo '<input id="arcustomlogin_options_'. $id .'" name="arcustomlogin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
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
        
        echo '<input id="arcustomlogin_options_'. $id .'" name="arcustomlogin_options['. $id .']" type="radio" value="'. $value .'" ' . $checked . '>';
        echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label><br/>';
    }
}

// Call back: textarea field
function arcustomlogin_callback_field_textarea( $args ) {
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

    $allowed_html_tags = wp_kses_allowed_html( 'post' ); // Gives an array of allowed HTML tags

    // This field enables the user to add basic markup (html) to the field, that's why we need filtering and cleaning to sanitise the value.
    // wp_kses              = filters text content and strips out disallowed HTML
    // stripslashes_deep    = removes slashes from the values
    $value  = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_html_tags ) : '';  

    // ------------------------------------------------------------------

    // 2: Output the text area markup
    echo '<textarea id="arcustomlogin_options_'. $id .'" name="arcustomlogin_options['. $id .']" rows="5" cols="50">' . $value . '</textarea><br/>';
    echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label>';
}

// Call back: checkbox field
function arcustomlogin_callback_field_checkbox( $args) {

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

    $checked = isset($options[$id]) ? checked( $options[$id], 1, false ) : ''; // Not echoing but returning
        
    // ------------------------------------------------------------------

    // 2: Output the checkbox field markup
    echo '<input id="arcustomlogin_options_'. $id .'" name="arcustomlogin_options['. $id .']" type="checkbox" value="1" ' . $checked . '>';
    echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label><br/>';      
}

// Call back: select field
function arcustomlogin_callback_field_select( $args ) {

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

    $select_options = array(
        // value    => label
        'default'   => 'Default',
        'light'     => 'Light',
        'blue'      => 'Blue',
        'coffee'    => 'Coffee',
        'ectoplasm' => 'Ectoplasm',
        'midnight'  => 'Midnight',
        'ocean'     => 'Ocean',
        'sunrise'   => 'Sunrise'
    );

    // ------------------------------------------------------------------

    // 2: Output the select field markup
    echo '<select id="arcustomlogin_options_'. $id .'" name="arcustomlogin_options['. $id .']">';

    foreach( $select_options as $value => $option ) {
        // selected ( $selected, $current, $echo)
        // $selected = one of the values to compare
        // $current = the other value to compare (default = true)
        // $echo    = whether to echo the result or just return the string (default = true)    
        
        $selected = selected( $selected_option === $value, true, false ); // Not echoing but returning
        
        echo '<option value="' . $value . '" ' . $selected . '>' . $option . '</option>';
    }

    echo '</select><br/>';
    echo '<label for="arcustomlogin_options_'. $id .'">'. $label .'</label><br/>';  
}