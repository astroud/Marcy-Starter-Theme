<?php get_header(); ?>
<div class="content_wrap">
	
    <h2 class="entry-title">404 - Page Not Found</h2>

    <h4>We couldn't find the page you were looking for. Please click a link below to browse the site.</h4>

    <?php wp_nav_menu( [
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => '404_menu',
        'menu_id' => '404_menu',
        'depth' => 0
    ] ); ?>

</div>
<?php get_footer(); ?>