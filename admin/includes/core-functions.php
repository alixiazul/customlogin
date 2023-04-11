<?php // Custom Login - Core functionality

// Exit if file is called directly
if ( ! defined( 'ABSPATH') ) {
    exit;
}

// Custom login logo url
function arcustomlogin_custom_login_logo_url( $url ) {

    $options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );

    if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
        $url = esc_url( $options['custom_url'] );
    }

    return $url;    
}

add_filter( 'login_headerurl', 'arcustomlogin_custom_login_logo_url' );

// Custom login logo title
function arcustomlogin_custom_login_title( $title ) {

    $options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );

    if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
        $title = esc_attr( $options['custom_title'] );
    }

    return $title;
}

add_filter( 'login_headertext', 'arcustomlogin_custom_login_title' );

// // Custom login styles
// function arcustomlogin_custom_login_styles() {
   
//     $options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );

//     $styles = false;

//     if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {
//         $styles = sanitize_text_field( $options['custom_style'] );
//     }

//     if ( 'enable' === $styles ) {  // In a Yoda condition, if you accidentally use a single = instead of ===, it will result in a syntax error, since you cannot assign a value to a string literal
// 		/*
		
// 		wp_enqueue_style( 
// 			string           $handle, 
// 			string           $src = '', 
// 			array            $deps = array(), 
// 			string|bool|null $ver = false, 
// 			string           $media = 'all' 
// 		)
		
// 		wp_enqueue_script( 
// 			string           $handle, 
// 			string           $src = '', 
// 			array            $deps = array(), 
// 			string|bool|null $ver = false, 
// 			bool             $in_footer = false 
// 		)
		
// 		*/

//         wp_enqueue_style( 'arcustomlogin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/customlogin.css', array(), null, 'screen' );

//         //wp_enqueue_script( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/myplugin-login.js', array(), null, true );
		
//     }
// }

// add_action( 'login_enqueue_scripts', ' arcustomlogin_custom_login_styles', 10 );


// custom login message
function arcustomlogin_custom_login_message( $message ) {
	
	$options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );
	
	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {		
		$message = wp_kses_post( $options['custom_message'] ) . $message;
		
	}
	
	return $message;
	
}
add_filter( 'login_message', 'arcustomlogin_custom_login_message' );


// custom admin footer
function arcustomlogin_custom_admin_footer( $message ) {
	
	$options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );
	
	if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {		
		$message = sanitize_text_field( $options['custom_footer'] );
		
	}
	
	return $message;
	
}
add_filter( 'admin_footer_text', 'arcustomlogin_custom_admin_footer' );


// custom toolbar items
function arcustomlogin_custom_admin_toolbar() {
	
	$toolbar = false;
	
	$options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );
	
	if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {		
		$toolbar = (bool) $options['custom_toolbar'];
		
	}
	
	if ( $toolbar ) {		
		global $wp_admin_bar;		
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-content' );		
	}
	
}
add_action( 'wp_before_admin_bar_render', 'arcustomlogin_custom_admin_toolbar', 999 );

// custom admin color scheme
function arcustomlogin_custom_admin_scheme( $user_id ) {
	
	$scheme = 'default';
	
	$options = get_option( 'arcustomlogin_options', arcustomlogin_default_options() );
	
	if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {
		
		$scheme = sanitize_text_field( $options['custom_scheme'] );
		
	}
	
	$args = array( 'ID' => $user_id, 'admin_color' => $scheme );
	
	wp_update_user( $args );
	
}
add_action( 'user_register', 'arcustomlogin_custom_admin_scheme' );