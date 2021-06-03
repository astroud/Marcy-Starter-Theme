<?php
//Include the custom theme options pages
include( 'admin/functions_admin.php');

//Remove JQuery migrate
add_action( 'wp_default_scripts' , function ( $scripts ) {
	if ( !empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, ['jquery-migrate'] );
	}
});

//Hide admin bar for non-admins
if ( ! current_user_can( 'administrator' ) ) {
    show_admin_bar( false );
}

//Declare thumbnail support
add_theme_support( 'post-thumbnails' );

//Include all functions from the /functions directory
foreach( glob( TEMPLATEPATH . '/functions/*.php' ) as $filename ) {
	require $filename;
}

//Include all functions from the /ajax directory
foreach( glob ( TEMPLATEPATH . '/ajax/*.php' ) as $filename ) {
	require $filename;
}

//For each page template, check to see if there is an associated css/js file and load it
function load_page_scripts() {
	global $post;
	$page_template = get_page_template_slug( $post->ID );
	$template_directory = get_template_directory();

	if( $page_template ){
		$css_file = str_replace( '.php', '.css',explode( '/', $page_template )[1] );
		if( file_exists( $template_directory . '/page-templates/css/' . $css_file ) ) {
			wp_enqueue_style( $css_file, get_bloginfo( 'template_url' ) . '/page-templates/css/' . $css_file );
		}
		
		$js_file = str_replace( '.php', '.js', explode( '/', $page_template )[1] );
		if( file_exists( $template_directory . '/page-templates/js/' . $js_file ) ) {
			wp_enqueue_script( $js_file, get_bloginfo( 'template_url') . '/page-templates/js/' . $js_file, [ 'jquery' ] );
		}
	}
	
	return $post->ID;
}
add_action( 'wp_enqueue_scripts', 'load_page_scripts' );

//Remove the WP version meta tag from site header
remove_action( 'wp_head', 'wp_generator' );

//Register the primary sidebar
if( function_exists( 'register_sidebar' ) ) {
	register_sidebar( [
        'name' => 'Primary Sidebar',
        'id' => 'primary-widget-area',
        'before_widget' => '<li class="widget-container">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ] );
}

//Add menu functions to theme
add_theme_support( 'menus' );


add_action( 'init', function() {
	//Load jquery
	wp_enqueue_script( 'jquery' );

	//Load the FontAwsome library
	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/68eac1705f.js' );

	//Load the site function
	if( !is_admin() ) {
        wp_enqueue_script( 'md-site-functions', get_bloginfo( 'template_url' ) . '/js/site-functions.js', array( 'jquery' ) );
        
        //Localize JS
        wp_localize_script( 'md-site-functions', 'wp_info', array(
            'home_url' => home_url(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('md-ajax-nonce')
        ) );
	}

	//Register the navigation menus
	register_nav_menus( [ 'main-menu' => __('Main Navigation') ] );
    register_nav_menus( [ 'footer-menu' => __('Footer Navigation') ] );

    //Block non-admins from accessing the WP backend
	if ( is_admin() && !current_user_can( 'administrator' ) && !wp_doing_ajax() && $GLOBALS['pagenow'] !== 'wp-login.php') {
        $current_page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		wp_redirect( home_url()."/wp-login.php?redirect_to=".$current_page );
		exit;
	}
    
} );