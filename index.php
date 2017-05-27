<?php
/**
 * Template for index pages.
 */
get_header();

if ( have_posts() ):
	while ( have_posts() ):the_post();
		get_template_part( 'partials/content/content', 'teaser' );
	endwhile;
endif;

get_footer();