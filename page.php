
<?php
//Check if beaver builder is installed and active on this page. If not, use default WP page template.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( is_plugin_active( 'bb-plugin/fl-builder.php' ) && FLBuilderModel::is_builder_enabled() ) {
?>

    <?php get_header(); ?>
        <?php while ( have_posts() ) : the_post() ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php get_footer(); ?>

<?php } else { ?>

    <?php get_header(); ?>
    <div class="content_wrap">
        <div id="content">
            <?php while ( have_posts() ) : the_post() ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title"><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php get_sidebar(); ?>
        <div class="clear"></div>
    </div>
    <?php get_footer(); ?>

<?php } ?>