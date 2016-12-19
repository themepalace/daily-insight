<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

// Add excerpt section
$wp_customize->add_section( 'daily_insight_excerpt_section', array(
	'title'             => __('Excerpt','daily-insight'),
	'description'       => __( 'Excerpt section options.', 'daily-insight' ),
	'panel'             => 'daily_insight_theme_options_panel'
) );


// Archive content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[archive_content_type]', array(
	'sanitize_callback' => 'daily_insight_sanitize_select',
	'default'			=> $options['archive_content_type']
) );

$wp_customize->add_control( 'daily_insight_theme_options[archive_content_type]', array(
	'label'       => __( 'Select Archive Content Type', 'daily-insight' ),
	'section'     => 'daily_insight_excerpt_section',
	'type'        => 'select',
	'choices'	  => array(
		'full'			=> __( 'Full Content','daily-insight'),
		'excerpt'		=> __( 'Excerpt Content', 'daily-insight' ),	
	)
) );