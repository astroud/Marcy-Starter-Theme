<?php
if( ! function_exists( 'year_func' ) ) {
	
	//YEAR SHORTCODE (FROM CUSTOM THEME OPTIONS)
	function year_func( $atts ) {
		return date( 'Y' );
	}
	add_shortcode( 'year', 'year_func' );
	
}