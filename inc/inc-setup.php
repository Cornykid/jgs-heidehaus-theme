<?php
/**
 * Theme setup function
 */
if ( ! function_exists( 'jgs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Create your own mycustomtheme_setup() function to override in a child theme.
	 *
	 * @since MyCustomTheme 1.0
	 */
	function jgs_setup() {
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/*
		 * Post thumbnails.
		 */
		add_theme_support( 'post-thumbnails', [ 'post' ] );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', [
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		] );

		/*
		 * Register nav menus
		 */
		register_nav_menus( [
			'main'    => __( 'Main Menu', 'jgs' ),
			'sidebar' => __( 'Sidebar Menu', 'jgs' ),
			'footer'  => __( 'Footer Menu', 'jgs' ),
            'footer-legal'  => __( 'Footer Menu-legal', 'jgs' ),
			'social'  => __( 'Social Links Menu', 'jgs' ),
		] );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', [
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		] );
	}
endif;

add_action( 'after_setup_theme', 'jgs_setup' );