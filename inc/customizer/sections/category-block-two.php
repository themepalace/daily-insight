<?php
/**
 * Category Block Seven Customizer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


// Add Category Block Seven enable section
$wp_customize->add_section( 'daily_insight_category_block_seven_section', array(
	'title'             => __('Category Block Two','daily-insight'),
	'description'       => __( 'Category Block Two section options.', 'daily-insight' ),
	'priority'			=> '10',
	'panel'             => 'daily_insight_sections_panel'
) );

// Add Category Block Seven enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[enable_category_block_seven]', array(
	'default'           => $options['enable_category_block_seven'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox'
) );

$wp_customize->add_control( 'daily_insight_theme_options[enable_category_block_seven]', array(
	'label'             => __( 'Check To Enable', 'daily-insight' ),
	'section'           => 'daily_insight_category_block_seven_section',
	'type'              => 'checkbox',
) );

// Add Category Block Seven content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_seven_type]', array(
	'default'           => $options['category_block_seven_type'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_seven_type]', array(
	'label'           	=> __( 'Content Type', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_seven_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'daily_insight_is_category_block_seven_active',
	'choices'         	=> array(
		'category'		=> __( 'Category', 'daily-insight' ),
	)
) );

// Add Category Block Seven title setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_seven_title]', array(
	'default'           => $options['category_block_seven_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_seven_title]', array(
	'label'             => __( 'Category Block Two Title', 'daily-insight' ),
	'section'           => 'daily_insight_category_block_seven_section',
	'active_callback' 	=> 'daily_insight_is_category_block_seven_active',
	'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'daily_insight_theme_options[category_block_seven_title]', array(
		'selector'            => '#trending-news-slider h2.entry-title',
		'render_callback'     => 'daily_insight_customize_partial_category_block_seven_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add Category Block Seven category drop-down setting and control
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_seven_category_type]', array(
	'default'			=> $options['category_block_seven_category_type'],			
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( new daily_insight_Dropdown_Taxonomies_Control( $wp_customize, 'daily_insight_theme_options[category_block_seven_category_type]', array(
	'active_callback' 	=> 'daily_insight_is_category_block_seven_active',
	'label'           	=> __('Select Category', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_seven_section',
	'type'            	=> 'dropdown-taxonomies',
 ) ) );