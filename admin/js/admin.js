var loading_icon = '<div class="md-loading-mask"><div class="md-loading-spinner"></div></div>';

jQuery( function( $ ) {
	//TAB NAVIGATION
	jQuery( '.nav-tab' ).click( function() {
		jQuery( '.nav-tab-active' ).removeClass( 'nav-tab-active' );
		jQuery( '.content_tab_active' ).removeClass( 'content_tab_active' );
		jQuery( this ).addClass( 'nav-tab-active' );
		jQuery( '#content_' + jQuery( this ).attr( 'id' )).addClass( 'content_tab_active' );
	} );


	//HANDLES FILE UPLOADS
	var file_frame;
	jQuery( '.media_upload_button' ).click( function( event ) {
		event.preventDefault();
		var button = jQuery( this );
		file_frame = wp.media.frames.file_frame = wp.media( {
			title: jQuery( this ).data( 'uploader_title' ),
			button: { text: jQuery( this ).data( 'uploader_button_text' ),
			}, multiple: false
		} );
		file_frame.on( 'select',function() {
			attachment = file_frame.state().get( 'selection' ).first().toJSON();
			button.prev().val( attachment.url );
		});
		file_frame.open();
	} );
	jQuery( '.add_media' ).on( 'click', function() {
		file_frame.remove();
    } );
    
    theme_settings_init();
});

function goToByScroll( id ) {
    jQuery( 'html, body' ).animate( { scrollTop: ( jQuery( '#' + id ).offset().top-300 ) }, 200 );
}

function admin_show_message( message, type ) {
	admin_hide_message();
	goToByScroll( 'message' );
	if ( type === 'bad' ) {
		jQuery( '#message' ).removeClass( 'updated' );
		jQuery( '#message' ).addClass( 'error' );
	}else if(type=='good' ){
		jQuery( '#message' ).removeClass( 'error' );
		jQuery( '#message' ).addClass( 'updated' );
	}else{
		jQuery( '#message' ).removeClass( 'error' );
		jQuery( '#message' ).addClass( 'updated' );
	}
	jQuery( '#message p' ).html( message + ' &nbsp; <a onclick="admin_hide_message()" class="hide_message">Hide</a>' );
	jQuery( '#message' ).fadeIn( 100 );
}

function admin_hide_message() {
	jQuery( '#message' ).hide();
	jQuery( '#message p' ).html( '' );
}

function theme_settings_init() {

    jQuery( '#md_theme_settings' ).on( 'submit',function( e ) {

        e.preventDefault();

        jQuery( this ).append( loading_icon );
        
        //Get form data and add necessary values
        var form_data = jQuery( this ).serializeArray();
        form_data.push( {
            name: 'action',
            value: 'save_theme_settings'
        } );
        form_data.push( {
            name: 'nonce',
            value: wp_info.nonce
        } );
        
        jQuery.post( wp_info.ajax_url, form_data, function( data ) {
            admin_show_message( data.message, data.type );
            jQuery( '#md_theme_settings .md-loading-mask' ).remove();
        }, 'json' );

        return false;
    } );
     

}

