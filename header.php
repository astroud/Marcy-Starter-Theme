<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1'/>
	<meta http-equiv='content-type' content='<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>' />
	<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<link rel='stylesheet' type='text/css' href='<?php echo get_stylesheet_uri(); ?>' />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php echo stripslashes( get_option( 'google_analytics' ) ); ?>
	
	<nav id='mobile_nav'>
		<div id='nav_button'>
			<span id='icon_holder'></span>
		</div>
		<div id='menu_scroll'>
			<?php wp_nav_menu( [
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'mobile_menu',
                'menu_id' => 'mobile_menu',
                'depth' => 0
            ] ); ?>
		</div>
	</nav>
	
	<header id='main_header'>
		<section class='content_wrap'>
			<div id='logo'>
                <a href='<?php echo home_url(); ?>'>
                    <?php 
                    $header_logo = get_option( 'header_logo' ); 
                    if ( $header_logo ) {
                    ?>
                        <img src='<?php echo get_option( 'header_logo' ); ?>' alt='<?php bloginfo( 'name' ); ?>'/>
                    <?php } else { ?>
                        <h1><?php bloginfo( 'name' ); ?></h1>
                    <?php } ?>
				</a>	
			</div>
			
			<nav id='main_nav'>
				<?php wp_nav_menu( [ 
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'menu',
                    'menu_id' => 'menu',
                    'depth' => 0
                ] ); ?>
			</nav>
			
		</section>
	</header>
	<section id='container'>