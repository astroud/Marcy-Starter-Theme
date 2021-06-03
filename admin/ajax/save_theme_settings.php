<?php
//This script handles the AJAX login form data

function save_theme_settings() {

    check_ajax_referer( 'md-ajax-nonce', 'nonce' );

	$exclude = array( 'action' );
	
	foreach ( $_POST AS $key => $value ) {
		if ( ! in_array( $key, $exclude ) ) {
			update_option( $key, $value );
		}
	}
	
	echo json_encode( [
        'message' => 'Theme options saved.',
        'type' => 'good'
    ] );
	exit;
}
 
add_action( 'wp_ajax_save_theme_settings', 'save_theme_settings' );
//add_action( 'wp_ajax_nopriv_save_theme_settings', 'save_theme_settings' );