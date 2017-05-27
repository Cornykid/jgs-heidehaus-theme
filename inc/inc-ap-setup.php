<?php
/**
 * Remove some head links and tags in.
 *
 * @since 1.0
 *
 */
// Remove link to the Really Simple Discovery service endpoint
remove_action( 'wp_head', 'rsd_link' );

// Remove link to the Windows Live Writer manifest file
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove WordPress version meta tag
remove_action( 'wp_head', 'wp_generator' );

// If not needed or desired: Remove REST API link tag
remove_action( 'wp_head', 'rest_output_link_wp_head' );

// If not needed or desired: Remove oEmbed discovery links
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

/**
 * Disable emojis.
 *
 * @since 1.0
 *
 */
function ap_disable_wp_emojicons() {

	// All actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

}

add_action( 'init', 'ap_disable_wp_emojicons' );

// Remove emojis from tiny mce
function ap_disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

add_filter( 'tiny_mce_plugins', 'ap_disable_emojicons_tinymce' );

/**
 * Set jpeg quality.
 * Default is 82.
 *
 * @return int
 */
function ap_jpeg_quality() {
	return 100;
}

add_filter( 'jpeg_quality', 'lmg_jpeg_quality' );