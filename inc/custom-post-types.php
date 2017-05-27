<?php
/**
 * Register custom post types and taxonomies
 */

// Slider
function register_slider_post_type() {
	$labels = array(
		'name'           => 'Slider',
		'singular_name'  => 'Slider',
		'menu_name'      => 'Slider',
		'name_admin_bar' => 'Slider',
		'add_new_item'   => 'Neuen Slider erstellen',
		'new_item'       => 'Neuen Slider erstellen',
		'edit_item'      => 'Slider bearbeiten',
		'view_item'      => 'Slider anschauen',
		'all_items'      => 'Alle Slider',
		'not_found'      => 'Keine Slider gefunden.',
	);

	$args = array(
		'labels'          => $labels,
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-slides',
		'query_var'       => true,
		'rewrite'         => array( 'slug' => 'page_slider' ),
		'capability_type' => 'post',
		'has_archive'     => false,
		'hierarchical'    => false,
		'supports'        => array( 'title', 'author' ),
	);

	register_post_type( 'slider', $args );
}

add_action( 'init', 'register_slider_post_type' );

// Category for Pages
function add_taxonomies_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'add_taxonomies_to_pages' );