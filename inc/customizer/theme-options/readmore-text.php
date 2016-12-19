<?php
/**
 * Read More text options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

// Add Read More text section
$wp_customize->add_section( 'daily_insight_readmore_section', array(
	'title'             => __('Read More Options','daily-insight'),
	'description'       => __( 'Read More Section Options.Its value changes for those section whose content type is not selected as Demo.', 'daily-insight' ),
	'panel'             => 'daily_insight_theme_options_panel'
) );

// Read More text setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[readmore_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['readmore_text']
) );

$wp_customize->add_control( 'daily_insight_theme_options[readmore_text]', array(
	'label'       		=> __( 'Read More Text.', 'daily-insight' ),
	'section'     		=> 'daily_insight_readmore_section',
	'type'        		=> 'text',
) );