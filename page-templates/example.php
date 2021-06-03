<?php /* Template Name: Example */ ?>
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
</div>
<?php get_footer(); ?>