<?php
/**
 * Template for index pages.
 */
get_header();
$i = 0;

if ( have_posts() ):
     while (have_posts() && $i < 3) :the_post();
		get_template_part( 'partials/content/content', 'teaser' );
     $i++;
	endwhile;
endif;

get_footer();