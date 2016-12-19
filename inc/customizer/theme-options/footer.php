<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/*Footer Section*/
$wp_customize->add_section( 'daily_insight_section_footer',
	array(
		'title'      			=> __( 'Footer Options', 'daily-insight' ),
		'priority'   			=> 900,
		'panel'      			=> 'daily_insight_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'daily_insight_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'daily_insight_santize_allow_tag',
	)
);

$wp_customize->add_control( 'daily_insight_theme_options[copyright_text]',
    array(
		'label'      			=> __( 'Footer Text', 'daily-insight' ),
		'section'    			=> 'daily_insight_section_footer',
		'type'		 			=> 'textarea',
    )
);