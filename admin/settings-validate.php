<?php // Custom Login - Validate Settings

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