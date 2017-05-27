<?php
/**
 * Template for 404
 */
get_header(); ?>
	<section class="content">
		<?php if ( have_posts() ):
			while ( have_posts() ):the_post();
				get_template_part( 'partials/content/content', '404' );
			endwhile;
		endif; ?>
	</section>
<?php get_sidebar(); ?>
<?php get_footer();