<?php
/**
* Custom css
* @package Theme Palace
* @subpackage Daily Insight
* @since Daily Insight 0.1
*/

// custom css section
$wp_customize->add_section( 'daily_insight_custom_css', array(
	'title'             	=> __('Custom CSS','daily-insight'),
	'panel'             	=> 'daily_insight_theme_options_panel',
	'priority'   			=> 900,
) );

// Setting custom_css.
$wp_customize->add_setting( 'daily_insight_theme_options[custom_css]',
	array(
	'sanitize_callback'    	=> 'wp_strip_all_tags',
	'sanitize_js_callback' 	=> 'wp_strip_all_tags',
	)
);
$wp_customize->add_control( 'daily_insight_theme_options[custom_css]',
	array(
	'label'    				=> __( 'Custom CSS', 'daily-insight' ),
	'section'  				=> 'daily_insight_custom_css',
	'type'     				=> 'textarea',
	)
);
