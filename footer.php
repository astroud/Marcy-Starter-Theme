<div class="clear"></div>
	</section>
	<footer id="main_footer">
		<section class="content_wrap">
			
			<nav id="footer_nav">
				<?php wp_nav_menu( [
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'footer_menu',
                    'menu_id' => 'footer_menu',
                    'depth' => 0
                ] ); ?>
			</nav>
		
			<section id="footer_content">
				<?php echo apply_filters( 'the_content', stripslashes( get_option( 'footer_content' ) ) );?>
			</section>
			
			<section class="theme_sn">
				<?php 
				global $social_networks; 
				foreach ( $social_networks AS $id => $network ) { 
					$this_option = get_option( $id );
					if ( $this_option ) {
						if ( $id === "email" ) {
							$link = "mailto:" . $this_option;
						} else {
							$link = $this_option;
						}
				?>
						<a href="<?php echo $link; ?>" title="<?php echo $network[ 'name']; ?>" target="_blank" style="background-color:<?php echo $network[ 'color' ]; ?>"><?php echo $network[ 'icon' ]; ?><span class="sr_text"><?php echo $network[ 'name' ]; ?></span></a>
					<?php } ?>
				<?php } ?>
			</section>
			
		</section>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>