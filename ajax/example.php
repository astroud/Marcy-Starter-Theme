<?php

function ajax_example() {

    //Verify nonce
    check_ajax_referer( 'md-ajax-nonce', 'nonce' );
 
	echo json_encode( [
        "message" => "Example Message.",
        "type" => "bad"
    ] );
	exit;
}
 
add_action( 'wp_ajax_ajax_example', 'ajax_example' );
add_action( 'wp_ajax_nopriv_ajax_example', 'ajax_example' );