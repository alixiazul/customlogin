<?php // Custom Login - Settings callbacks

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

// Call back: Login section
function arcustomlogin_callback_section_login() {
    echo '<p>' . esc_html__( 'These settings enable you to customize the WP Login screen.' , 'customlogin' ) . '</p>';
}

// Call back: Admin section
function arcustomlogin_callback_section_admin() {
    echo '<p>' . esc_html__( 'These settings enable you to customize the WP Admin Area.', 'customlogin' ) . '</p>';
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
        'enable'    => esc_html__( 'Enable custom styles', 'customlogin' ),
        'disable'   => esc_html__( 'Disable custom styles', 'customlogin' )
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
        'default'   => esc_html__( 'Default', 'customlogin' ),
        'light'     => esc_html__( 'Light', 'customlogin' ),
        'blue'      => esc_html__( 'Blue', 'customlogin' ),
        'coffee'    => esc_html__( 'Coffee', 'customlogin' ),
        'ectoplasm' => esc_html__( 'Ectoplasm', 'customlogin' ),
        'midnight'  => esc_html__( 'Midnight', 'customlogin' ),
        'ocean'     => esc_html__( 'Ocean', 'customlogin' ),
        'sunrise'   => esc_html__( 'Sunrise', 'customlogin' )
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