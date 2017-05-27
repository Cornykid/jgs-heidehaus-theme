<?php
/**
 * Template for page content.
 */
?>
<article <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
</article>