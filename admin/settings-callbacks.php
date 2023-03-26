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

// Call back: field text
function arcustomlogin_callback_field_text() {
    echo 'This will be a text field';
}

// Call back: radio field
function arcustomlogin_callback_field_radio() {
    echo 'This will be a radio field';
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