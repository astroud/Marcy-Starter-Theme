<?php get_header(); ?>
<div class="content_wrap">
	<?php while ( have_posts() ) : the_post() ?>

		<h2 class="entry-title"><?php the_title(); ?></h2>
			
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; ?>

</div>
<?php get_footer(); ?>