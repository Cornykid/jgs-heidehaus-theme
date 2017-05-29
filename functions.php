<?php
/**
 * jgs-heidehaus-theme functions and definitions
 *
 * @package WordPress
 * @subpackage jgs-heidehaus-theme
 * @since jgs 1.0
 */

/**
 * Include:  setup standards.
 */
require_once 'inc/inc-ap-setup.php';

/**
 * Include:  security standards.
 */
require_once 'inc/inc-ap-security.php';

/**
 * Include: theme setup.
 */
require_once 'inc/inc-setup.php';

/**
 * Include: copyright option for theme customizer
 */
include 'inc/inc-theme-customizer.php';

/**
 * Include: copyright option for theme customizer
 */
include 'inc/custom-post-types.php';


/**
 * Enqueue scripts.
 *
 * Includes minified stylesheets and js files or non-minified
 * versions if SCRIPT_DEBUG was set to true in wp-config.php
 */
function jgs_enqueue_scripts() {



	// Main
    wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/js/main.min.js' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/dist/css/main.min.css' );


}

add_action( 'wp_enqueue_scripts', 'jgs_enqueue_scripts' );

/**
 * Custom excerpt length
 *
 * @param $length
 *
 * @return int
 */
function custom_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Custom excerpt more
 *
 * @param $more
 *
 * @return string
 */
function custom_excerpt_more( $more ) {
	return '...';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * Determine teaser type in loop
 *
 * @return string
 */
function get_teaser_type() {
	$teaser_type = '';
	$post_type   = get_post_type();

	if ( $post_type === 'teaser' ) :
		if ( have_rows( 'teaser_content_type' ) ):
			while ( have_rows( 'teaser_content_type' ) ) : the_row();
				if ( get_row_layout() == 'teaser_content_type_basic' ):
					$teaser_type = 'basic';
                elseif ( get_row_layout() == 'teaser_content_type_cites' ):
					$teaser_type = 'cites';
				endif;
			endwhile;
		else:
			$teaser_type = 'banner';
		endif;
    elseif ( $post_type === 'post' ) :
		$teaser_type = 'post';
    elseif ( $post_type === 'page' ) :
		$teaser_type = 'page';
	endif;

	return $teaser_type;
}

/**
 * Add page slug to body class, love this
 * Credit: Starkers Wordpress Theme
 *
 * @param $classes
 *
 * @return array
 */
function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > - 1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

/**
 * Adjust body class
 *
 * @param $classes
 *
 * @return mixed
 */
function change_body_class( $classes ) {
	global $post;

	if ( is_page() ) {
		$classes[] = 'page-' . $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'change_body_class' );

/**
 * Adjust post class
 *
 * @param $classes
 *
 * @return array
 */
function change_post_class( $classes ) {
	global $post;

	$post_type            = get_post_type();
	$supported_post_types = [ 'post', 'page' ];

	// Add teaser class
	if ( in_array( $post_type, $supported_post_types ) ) {
		$teaser_color = get_field( 'teaser_color', $post->ID );
		$teaser_type  = get_teaser_type();

		if ( $teaser_color ) {
			$classes[] = 'teaser-theme-' . $teaser_color;
		}

		if ( $teaser_type ) {
			$classes[] = 'teaser-' . $teaser_type;
		}
	}

	if ( is_page() ) {
		$classes[] = 'page-' . $post->post_name;
	}

	return $classes;
}

add_filter( 'post_class', 'change_post_class' );
/**
 * Get slider
 *
 * @return WP_Query
 */
function get_slider() {
    // Default gets the latest slider as fallback
    $args = [
        'post_type'      => 'slider',
        'posts_per_page' => 1,
    ];

    if ( is_home() || is_front_page() ) :
        // Get default slider for home page
        $args['meta_key']   = 'slider_default_for';
        $args['meta_value'] = 'home';
    elseif ( is_page() ) :
        if ( get_field( 'page_slider' ) ) :
            // Get special slider for page
            $args['p'] = get_field( 'page_slider' );
        else :
            // Get default slider for page
            $args['meta_key']   = 'slider_default_for';
            $args['meta_value'] = 'page';
        endif;
    endif;

    return new WP_Query( $args );
}

/**
 * Display teaser for post or page
 */
function display_teaser() {
	global $post;

	$teaser = get_field( 'page_teaser', $post->ID );

	// Get teaser for news page
	if ( is_home() || ( is_single() && get_post_type() === 'post' ) ) {
		$news_page_id = (int) get_option( 'page_for_posts' );

		if ( $news_page_id > 0 ) {
			$teaser = get_field( 'page_teaser', $news_page_id );
		}
	}

	if ( $teaser ):
		foreach ( $teaser as $post ):
			setup_postdata( $post );
			get_template_part( 'partials/content/content', 'teaser');
		endforeach;

		wp_reset_postdata();
	endif;
}

/**
 * Accordion shortcode
 */
function jgs_accordion_shortcode() {
    ob_start();

    if( have_rows('accordion_sections') ): $section = 1; ?>
        <div class="panel-group panel-group-accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php while ( have_rows('accordion_sections') ) : the_row(); ?>
                <div class="panel">
                    <div class="panel-heading" role="tab" id="heading<?php echo $section; ?>">
                        <div class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" class="collapsed"
                               href="#collapse<?php echo $section; ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?php the_sub_field('accordion_section_titel'); ?>
                            </a>
                        </div>
                    </div>
                    <div id="collapse<?php echo $section; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $section; ?>">
                        <div class="panel-body">
                            <?php the_sub_field('accordion_section_content'); ?>
                        </div>
                    </div>
                </div>
                <?php $section++;

            endwhile; ?>
        </div>
    <?php endif; ?>

    <?php return ob_get_clean();
}

add_shortcode( 'akkordeon', 'jgs_accordion_shortcode' );