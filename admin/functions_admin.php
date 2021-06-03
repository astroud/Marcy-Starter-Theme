<?php
//Include all AJAX functions
foreach( glob( TEMPLATEPATH . '/admin/ajax/*.php' ) as $filename ) {
	require $filename;
}

add_action( 'admin_menu', function() {
	add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'theme_options', 'dashicons-welcome-widgets-menus', 4 );
} );

function theme_options() {
	wp_enqueue_media();
	include( 'theme_options.php' );
}

add_action( 'admin_init', function() {
    wp_enqueue_style( 'md-admin-style', get_template_directory_uri() . '/admin/css/admin.css' );
	wp_enqueue_script( 'md-admin-scripts', get_template_directory_uri() . '/admin/js/admin.js', array( 'jquery' ) );
    
    wp_localize_script( 'md-admin-scripts', 'wp_info', array(
        'home_url' => home_url(),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'md-ajax-nonce' )
    ) );

} );

?>