<?php
if( ! function_exists( 'make_excerpt' ) ) {
	
	//CUSTOM EXCERPT FUNCTION
	function make_excerpt( $content, $length, $append = "..." ) {
		$content = strip_tags( $content );
		if( strlen( $content ) > $length ){
			$content = substr( $content, 0, $length ) . $append;
		}
		return $content;
	}
	
}