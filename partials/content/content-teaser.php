<?php
/**
 * Template for post teaser
 */

if ( get_field('teaser_image')) : ?>
	<article <?php post_class( 'teaser col-md-4' ); ?> style="background-image: url('<?php get_field('teaser_image'); ?>');">
<?php else: ?>
	<article <?php post_class( 'teaser col-md-4' ); ?>>
<?php endif; ?>
	<div class="teaser-inner">
		<?php // Title ?>
		<h2>
            <a href="<?php the_permalink(); ?>">
                <?php get_field('teaser_title') ? the_field('teaser_title') : the_title(); ?>
            </a>
        </h2>

		<?php // Topic ?>
		<?php get_field('teaser_content') ? the_field('teaser_content') : the_excerpt(); ?>

		<?php // Category ?>
        <span class="teaser-category">
            <?php the_category( ', ' ); ?>
        </span>

		<?php // Link ?>
        <span class="teaser-link">
            <a href="<?php the_permalink(); ?>" class="teaser-link">
                Mehr
            </a>
        </span>
        <div class="teaser-arrow">
            <img src="<?php echo get_theme_file_uri('dist/img/Pfeil.svg'); ?>" alt="Pfeil">
        </div>
	</div>
</article>