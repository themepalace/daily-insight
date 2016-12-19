<?php
/**
 * Breaking News Customizer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


// Add Breaking News enable section
$wp_customize->add_section( 'daily_insight_breaking_news_section', array(
	'title'             => __('Breaking News','daily-insight'),
	'description'       => __( 'Breaking News section options.', 'daily-insight' ),
	'priority'			=> '10',
	'panel'             => 'daily_insight_sections_panel'
) );

// Add Breaking News enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[enable_breaking_news]', array(
	'default'           => $options['enable_breaking_news'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox'
) );

$wp_customize->add_control( 'daily_insight_theme_options[enable_breaking_news]', array(
	'label'             => __( 'Check To Enable', 'daily-insight' ),
	'section'           => 'daily_insight_breaking_news_section',
	'type'              => 'checkbox',
) );

// Add Breaking News content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[breaking_news_type]', array(
	'default'           => $options['breaking_news_type'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[breaking_news_type]', array(
	'label'           	=> __( 'Content Type', 'daily-insight' ),
	'section'         	=> 'daily_insight_breaking_news_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'daily_insight_is_breaking_news_active',
	'choices'         	=> array(
		'category'		=> __( 'Category', 'daily-insight' ),	
	)
) );

// Add Breaking News title setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[breaking_news_title]', array(
	'default'           => $options['breaking_news_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[breaking_news_title]', array(
	'label'             => __( 'Breaking News Title', 'daily-insight' ),
	'section'           => 'daily_insight_breaking_news_section',
	'active_callback' 	=> 'daily_insight_is_breaking_news_category_type_active',
	'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'daily_insight_theme_options[breaking_news_title]', array(
		'selector'            => '#breaking-news .color-white h2.entry-title',
		'render_callback'     => 'daily_insight_customize_partial_breaking_news_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}


// Add Breaking News category drop-down setting and control
$wp_customize->add_setting( 'daily_insight_theme_options[breaking_news_category_type]', array(
	'default'			=> $options['breaking_news_category_type'],			
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( new daily_insight_Dropdown_Taxonomies_Control( $wp_customize, 'daily_insight_theme_options[breaking_news_category_type]', array(
	'active_callback' 	=> 'daily_insight_is_breaking_news_category_type_active',
	'label'           	=> __('Select Category', 'daily-insight' ),
	'section'         	=> 'daily_insight_breaking_news_section',
	'type'            	=> 'dropdown-taxonomies',
 ) ) );

