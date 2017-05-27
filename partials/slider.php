<?php
/**
 * Template for slider
 */

$slider = get_slider();
?>

<?php if ( $slider->have_posts() ):
    while ( $slider->have_posts() ): $slider->the_post();
        if( have_rows('slides') ): ?>
            <div class="header-slider">
                <?php while ( have_rows('slides') ) : the_row();
                    // Set background attribute content
                    $background_attr = 'background-image: url( ' . get_sub_field('slide_image') . ' );';

                    if( get_sub_field('slide_bg_color') ) {
                        $background_attr .= 'background-color: ' . get_sub_field('slide_bg_color') . ';';
                    } ?>

                    <div class="header-slide item<?php echo (get_sub_field('slide_bg_position')) ? ' ' . get_sub_field('slide_bg_position') : ''; ?>" style="<?php echo $background_attr ?>">
                        <?php if( get_sub_field('slide_content') === 'title-text' ) : ?>
                            <div class="slide-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>" alt="<?php the_sub_field('slide_content_title'); ?>" width="160" height="36" class="slide-img-logo" />
                            </div>
                            <div class="slide-content">
                                <?php $color_class = '';

                                if( get_sub_field('slide_content_title_color') ):
                                    $color_class = ' class="color-' . get_sub_field('slide_content_title_color') . '"';
                                endif; ?>

                                <h2<?php echo $color_class ?>><?php the_sub_field('slide_content_title'); ?></h2>
                                <?php the_sub_field('slide_content_text'); ?>
                            </div>
                        <?php else : ?>
                            <div class="slide-logo-slogan">
                                <img src="<?php echo get_template_directory_uri(); ?>" width="400" height="137"alt="Slogan" class="slide-img-logo-slogan" />
                            </div>
                        <?php endif; ?>

                        <?php //@todo: rs: use hidden slide title for seo reasons ?>
                        <?php //the_sub_field('slide_title'); ?>

                        <?php if( get_sub_field('slide_link')) : ?>
                            <a href="<?php the_sub_field('slide_link'); ?>" class="slide-link"></a>
                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;
    endwhile;
endif; ?>