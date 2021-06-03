<?php get_header(); ?>
<div class="content_wrap">
	<div id="content">
		<?php the_post(); ?>
		<h2 class="entry-title">Category Archives for <?php single_cat_title() ?></h2>
		<?php $categorydesc = category_description(); if ( !empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
		<?php rewind_posts(); ?>
		<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
			<div id="nav-above" class="navigation">
				<p class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> older articles')) ?></p>
				<p class="nav-next"><?php previous_posts_link(__( 'newer articles <span class="meta-nav">&raquo;</span>')) ?></p>
			</div>
		<?php } ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Read'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-meta">
					Published <?php the_time( get_option( 'date_format' ) ); ?>
				</div>
				<div class="entry-summary">
					<?php if( has_post_thumbnail() ) { ?>
						<div class="thumbnail" style="background:url(<?php the_post_thumbnail_url(); ?>) center center no-repeat; background-size:cover;"></div> 
					<?php } ?>
					<?php the_excerpt( __( 'continue reading <span class="meta-nav">&raquo;</span>')  ); ?>
				</div>
			</div>
		<?php endwhile; ?>
		<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
			<div id="nav-below" class="navigation">
				<p class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> older articles') ) ?></p>
				<p class="nav-next"><?php previous_posts_link( __( 'newer articles <span class="meta-nav">&raquo;</span>') ) ?></p>
			</div>
		<?php } ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>