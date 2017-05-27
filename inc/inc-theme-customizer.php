<?php
/**
 * Theme customizer options
 *
 * @param WP_Customize_Manager $wp_customize Theme customizer
 */
function jgs_customize_register( $wp_customize ) {
	
	// Footer copyright
	$wp_customize->add_setting(
		'jgs_footer_copyright',
		array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'jgs_footer_copyright', [
			'type' => 'text',
			'label' => 'Copyright',
			'section' => 'title_tagline',
		]
	);
	
}
add_action( 'customize_register', 'jgs_customize_register' );