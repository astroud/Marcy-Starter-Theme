var loading_mask = '<div class="md-loading-mask"><div class="md-loading-spinner"></div></div>';

jQuery( function() {
	//Nav menu functions
	jQuery( '#nav_button' ).on( 'click' ,function() {
		jQuery( '#mobile_nav' ).toggleClass( 'open' );
	} );
	
	//Add mobile menu collapse icon
	jQuery( '#mobile_nav .menu-item-has-children' ).prepend( '<span class="submenu_toggle"><i class="fas fa-chevron-down"></i></span>' );
	
	jQuery( '.submenu_toggle' ).on( 'click' ,function() {
		jQuery( this ).toggleClass( 'open' );
		jQuery( this ).parent( '.menu-item' ).children( '.sub-menu' ).slideToggle( 300 );
	} );
	
	jQuery( document ).on( 'scroll', function() {
		var current_scroll = jQuery( document ).scrollTop();
		if ( ! current_scroll ) {
			//At the top of the page
			jQuery( 'body' ).removeClass( 'scrolling' );
		} else {
			//Scrolling down the page
			jQuery( 'body' ).addClass( 'scrolling' );
		}
	} );
	
	main_nav_init();

    vlb_init();
    
    //Check for lightbox messages in the url
    md_lightbox_message_check();
	
} );

//Checks for messages in the url
function md_lightbox_message_check() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams( queryString );

    const mc = urlParams.get( 'mc' );
    const mt = urlParams.get( 'mt' );

    if ( mc ) {
        md_lb_message( mc, mt );
    }
}

function main_nav_init(){
	jQuery( '#menu .menu-item-has-children' ).off( 'mouseenter mouseleave' ).on( 'mouseenter' ,function() {
		jQuery( this ).addClass( 'submenu_open' );
	}).on( 'mouseleave' ,function() {
		jQuery( this ).removeClass( 'submenu_open' );
	} );
	
	//Touch devices
	jQuery( '#menu .menu-item-has-children' ).off( 'touchstart touchend' ).on( 'touchstart', function( e ) {
		if ( ! jQuery( this ).hasClass( 'submenu_open' ) ) {
			e.preventDefault();
		}
        jQuery( this ).toggleClass( 'submenu_open');
    } );
}

function vlb_init(){
	jQuery( '[vlb_youtube_id]' ).off( 'click' ).on( 'click' ,function( e ){
		e.preventDefault();
		var youtube_video_id = jQuery( this ).attr( 'vlb_youtube_id' );
		
		vlb_open_lb_video( youtube_video_id );
		
		return false;
    } );
}

function vlb_open_lb_video( youtube_video_id ){

    var vlb_width = jQuery(window).width();
		
    //Make max width 1200 pixels
    if ( vlb_width >= 1200 ) {
        vlb_width = 1140;
    } else {
        vlb_width = vlb_width - 40;
    }

    //Maintain aspect ratio
    var vlb_height = vlb_width / 1.77;
    
    //Check if lightbox is already open
    if(!jQuery( '#vlb_lightbox' ).length){
        jQuery( 'body' ).prepend( '<div id="vlb_lightbox" style="width:' + vlb_width + 'px; height:' + vlb_height + 'px; margin:0 0 0 -' + ( vlb_width / 2 ) + 'px;"></div>' );
        jQuery( 'body' ).prepend( '<div id="vlb_lightbox_mask"></div>' );
    }
    
    jQuery( '#vlb_lightbox' ).empty().html( '<iframe width="' + vlb_width + '" height="' + vlb_height + '" src="https://www.youtube.com/embed/' + youtube_video_id + '?autoplay=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
    
    jQuery( '#vlb_lightbox' ).prepend( '<a id="vlb_lightbox_close"><i class="far fa-times-circle"></i></a>' );
    jQuery( '#vlb_lightbox_mask, #vlb_lightbox_close' ).on( 'click' ,vlb_hide_lightbox);
    
    jQuery( '#main_header, #container' ).addClass( 'lightbox_blur' );
    jQuery( '#vlb_lightbox_mask' ).fadeIn( 200 );
    jQuery( '#vlb_lightbox' ).addClass( 'open' );
    
    //Enable escape key
    jQuery( document ).keydown( function( e ) {
        switch( e.which ) {
            case 27:vlb_hide_lightbox()
            break;

            default:return;
        }
        e.preventDefault();
    } );
}

function vlb_hide_lightbox(){
	jQuery( '.lightbox_blur' ).removeClass( 'lightbox_blur' );
	jQuery( '#vlb_lightbox_mask' ).fadeOut( 200 );
	jQuery( '#vlb_lightbox' ).removeClass( 'open' );
	
	//Remove elements after css transition is completed
	setTimeout(function() {
		jQuery( '#vlb_lightbox_mask' ).remove();
		jQuery( '#vlb_lightbox' ).remove();
	},600);
}

function md_lightbox( content, width, height, auto_hide, allow_close ) {
	//console.log(height);
	if ( jQuery.type( width ) === 'undefined' ){ width = 500; }
	if ( jQuery.type( height ) === 'undefined' ){ height = "auto"; }
	if ( jQuery.type( auto_hide ) === 'undefined' ){ auto_hide = false; }
	if ( jQuery.type( allow_close ) === 'undefined' ){ allow_close = true; }
	
	//Make sure width is not wider than screen
	var window_width = jQuery( window ).width();
	if ( window_width < ( width + 40 ) ) {
		width = window_width - 50;
	}
	
	//Make sure height is not taller than screen
	var window_height = jQuery( window ).height();
	if ( window_height < ( height + 40 ) ) {
		height = window_height - 60;
		//console.log(height);
	}
	
	//Check if lightbox is already open
	if(!jQuery( '#md_lightbox' ).length){
		jQuery( 'body' ).prepend( '<div id="md_lightbox" style="width:' + width + 'px; height:' + height + 'px; margin:0 0 0 -' + ( width / 2 + 20 ) + 'px;">' + content + '</div>' );
		jQuery( 'body' ).prepend( '<div id="md_lightbox_mask"></div>' );
	}
	 
	jQuery( '#main_header, #container, #vehicle_search_wrap' ).addClass( 'lightbox_blur' );
	jQuery( '#md_lightbox_mask' ).fadeIn(200);
	jQuery( '#md_lightbox' ).addClass( 'open' );
	
	if ( allow_close ) {
		jQuery( '#md_lightbox' ).prepend( '<a id="lightbox_close"><i class="far fa-times-circle"></i></a>' );
		jQuery( '#md_lightbox_mask, #lightbox_close' ).on( 'click' ,md_hide_lightbox);
		
		jQuery( document ).keydown( function( e ) {
			switch ( e.which ) {
				case 27:md_hide_lightbox()
				break;

				default:return;
			}
			e.preventDefault();
		} );
	}
}

function md_hide_lightbox(){
	jQuery( '.lightbox_blur' ).removeClass( 'lightbox_blur' );
	jQuery( '#md_lightbox_mask' ).fadeOut( 200 );
	jQuery( '#md_lightbox' ).removeClass( 'open' );
	
	//Remove elements after css transition is completed
	setTimeout( function() {
		jQuery( '#md_lightbox_mask' ).remove();
		jQuery( '#md_lightbox' ).remove();
	}, 600 );
}

function md_lb_message( message, type ) {
	if ( type === 'bad' ) {
		var lb_content = "<i class='fas fa-exclamation-triangle' style='color:#ca0000;'></i><p>" + message + "</p><a onclick='md_hide_lightbox()' class='button'>Close</a>";
	} else if( type === 'good' ) {
		var lb_content = "<i class='fas fa-check-circle' style='color:green'></i><p>" + message + "</p><a onclick='md_hide_lightbox()' class='button'>Close</a>";
	} else {
		var lb_content = "<i class='fas fa-info-circle' style='color:#5488bf'></i><p>" + message + "</p><a onclick='md_hide_lightbox()' class='button'>Close</a>";
	}
	
	md_lightbox( lb_content, 300 );
	jQuery( '#md_lightbox' ).addClass( 'lb_message' );
}

function logout() {
	jQuery.post( wp_info.ajax_url, { action: "logout" }, function( data ) {
		window.location = home_url + "/login?mc=You are now logged out.&mt=good";
	}, 'json' );
}

function scroll_to_element( element ) {
	jQuery( 'html, body').animate( {
		scrollTop: jQuery( element ).offset().top - 100
	}, 500);
}