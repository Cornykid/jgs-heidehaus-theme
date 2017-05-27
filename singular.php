<?php
/**
 * Template for single post/page
 */
get_header(); ?>
    <section class="content">
        <?php if ( have_posts() ):
            while ( have_posts() ):the_post();
                get_template_part( 'partials/content/content', get_post_type() );
            endwhile;
        endif; ?>
    </section>
<?php get_footer();