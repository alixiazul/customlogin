<?php // Custom Login - Admin menu

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

function arcustomlogin_add_sublevel_menu() {

    /*	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);	
	*/

    add_submenu_page(
        'options-general.php',
        'Custom Login Settings',
        'Custom Login',
        'manage_options',
        'arcustomlogin',
        'arcustomlogin_display_settings_page'
    );
}

// Registration of the function with the "admin_menu" action hook
add_action( 'admin_menu', 'arcustomlogin_add_sublevel_menu' );

// // Add top-level administrative menu
// function arcustomlogin_add_toplevel_menu() {
//     /* 
// 		add_menu_page(
// 			string   $page_title, 
// 			string   $menu_title, 
// 			string   $capability, 
// 			string   $menu_slug, 
// 			callable $function = '', 
// 			string   $icon_url = '', 
// 			int      $position = null 
// 		);
// 	*/

//     add_menu_page(
//         'Custom Login Settings',
//         'Custom Login',
//         'manage_options',
//         'arcustomlogin',
//         'arcustomlogin_display_settings_page',
//         'dashicons-admin-generic',
//         null // to avoid clashes with other plugins
//     );	
// }

// // Registration of the function with the "admin_menu" action hook
// add_action( 'admin_menu', 'arcustomlogin_add_toplevel_menu' );
