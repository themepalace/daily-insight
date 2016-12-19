<?php
/**
 * Latest Post Customizer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


// Add Latest Post section
$wp_customize->add_section( 'daily_insight_latest_post_section', array(
	'title'             => __('Latest Post','daily-insight'),
	'description'       => __( 'Latest Post section options.', 'daily-insight' ),
	'priority'			=> '10',
	'panel'             => 'daily_insight_sections_panel'
) );

// Add Latest Post enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[enable_latest_post]', array(
	'default'           => $options['enable_latest_post'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[enable_latest_post]', array(
	'label'             => __( 'Enable On', 'daily-insight' ),
	'section'           => 'daily_insight_latest_post_section',
	'choices'			=> daily_insight_enable_disable_options(),
	'type'              => 'select',
) );

// Add Latest Post content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[latest_post_type]', array(
	'default'           => $options['latest_post_type'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[latest_post_type]', array(
	'label'           	=> __( 'Content Type', 'daily-insight' ),
	'section'         	=> 'daily_insight_latest_post_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'daily_insight_is_latest_post_active',
	'choices'         	=> array(
		'recent-post'	=> __( 'Recent Posts', 'daily-insight' ),	
	)
) );

// Add Latest Post title setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[latest_post_title]', array(
	'default'           => $options['latest_post_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[latest_post_title]', array(
	'label'             => __( 'Latest Post Title', 'daily-insight' ),
	'section'           => 'daily_insight_latest_post_section',
	'active_callback' 	=> 'daily_insight_is_latest_post_active',
	'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'daily_insight_theme_options[latest_post_title]', array(
		'selector'            => '#latest-posts .entry-header h2.entry-title',
		'render_callback'     => 'daily_insight_customize_partial_latest_post_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

