<?php
/**
 * Template for post content
 */
?>
<article <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-3">
			<div class="sidebar-left">
				<div class="sidebar-wrapper">
					<span><?php the_category( ', ' ); ?></span>
					<span class="post-category-icon"></span>
				</div>
				<span><?php the_date(); ?></span>
			</div>
		</div>
		<div class="col-sm-9">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-9">
			<div class="article-nav">
				<a href="/">
					<div class="teaser-arrow">
						<img src="<?php echo get_theme_file_uri('dist/img/Pfeil.svg'); ?>" alt="Pfeil" />
					</div>
					<span class="articel-nav-text">Zurück zur Artikelübersicht</span>
				</a>
			</div>
		</div>
	</div>
</article>
