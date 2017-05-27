<?php
/**
 * Template for post teaser
 */

if ( get_field('teaser_image')) : ?>
	<article <?php post_class( 'teaser' ); ?> style="background-image: url('<?php get_field('teaser_image'); ?>');">
<?php else: ?>
	<article <?php post_class( 'teaser' ); ?>>
<?php endif; ?>
	<div class="teaser-inner">
		<?php // Title ?>
		<h2><a href="<?php the_permalink(); ?>"><?php get_field('teaser_title') ? the_field('teaser_title') : the_title(); ?></a></h2>

		<?php // Topic ?>
		<?php get_field('teaser_content') ? the_field('teaser_content') : the_excerpt(); ?>

		<?php /*Category */ ?>
			<span class="teaser-category-icon"></span><span class="teaser-category"><?php the_category( ', ' ); ?></span>

		<?php // Link ?>
		<a href="<?php the_permalink(); ?>" class="teaser-link">
			<span class="teaser-link-icon"></span> Mehr
			<?php ?>
			<div class="teaser-arrow"><img src="<?php echo get_theme_file_uri('dist/img/Pfeil.svg'); ?>" alt="Pfeil"></div>
		</a>
	</div>

	<a href="<?php the_permalink(); ?>" class="teaser-link-full"></a>
</article>