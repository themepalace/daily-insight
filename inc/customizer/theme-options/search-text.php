<?php
/**
 * Search text options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

// Add Search text section
$wp_customize->add_section( 'daily_insight_search_section', array(
	'title'             => __('Search Options','daily-insight'),
	'description'       => __( 'Search section options.', 'daily-insight' ),
	'panel'             => 'daily_insight_theme_options_panel'
) );

// Search text setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[search_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['search_text']
) );

$wp_customize->add_control( 'daily_insight_theme_options[search_text]', array(
	'label'       		=> __( 'Search Text.', 'daily-insight' ),
	'section'     		=> 'daily_insight_search_section',
	'type'        		=> 'text',
) );