<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Daily Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'daily_insight_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'daily_insight_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Daily Insight 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'daily_insight_theme_options[pagination_enable]' )->value();
	}
endif;


if ( ! function_exists( 'daily_insight_is_breaking_news_active' ) ) :
	/**
	 * Check if Breaking News is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_breaking_news_active( $control ) {

		return $control->manager->get_setting( 'daily_insight_theme_options[enable_breaking_news]' )->value();
	}
endif;

if ( ! function_exists( 'daily_insight_is_breaking_news_category_type_active' ) ) :
	/**
	 * Check if Breaking News category type is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_breaking_news_category_type_active( $control ) {
		if ( ( daily_insight_is_breaking_news_active( $control ) ) && ( 'category' == $control->manager->get_setting( 'daily_insight_theme_options[breaking_news_type]' )->value() ) )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'daily_insight_is_latest_post_active' ) ) :
	/**
	 * Check if Latest Post is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_latest_post_active( $control ) {

		return ( 'static-frontpage' == $control->manager->get_setting( 'daily_insight_theme_options[enable_latest_post]' )->value() );
	}
endif;

if ( ! function_exists( 'daily_insight_is_latest_post_recent_active' ) ) :
	/**
	 * Check if Latest Post Select type is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_latest_post_recent_active( $control ) {
		if ( ( daily_insight_is_latest_post_active( $control ) ) && ( 'recent-post' == $control->manager->get_setting( 'daily_insight_theme_options[latest_post_type]' )->value() ) )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'daily_insight_is_main_slider_active' ) ) :
	/**
	 * Check if Main Slider is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_main_slider_active( $control ) {

		return ( 'static-frontpage' == $control->manager->get_setting( 'daily_insight_theme_options[enable_main_slider]' )->value() );
	}
endif;

if ( ! function_exists( 'daily_insight_is_category_block_three_active' ) ) :
	/**
	 * Check if Category Block three is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_category_block_three_active( $control ) {

		return $control->manager->get_setting( 'daily_insight_theme_options[enable_category_block_three]' )->value();
	}
endif;


if ( ! function_exists( 'daily_insight_is_category_block_three_content_as_category' ) ) :
	/**
	 * Check if Category Block three Category type is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_category_block_three_content_as_category( $control ) {
		if ( ( daily_insight_is_category_block_three_active( $control ) ) && ( 'category' == $control->manager->get_setting( 'daily_insight_theme_options[category_block_three_type]' )->value() ) )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'daily_insight_is_category_block_seven_active' ) ) :
	/**
	 * Check if Category Block seven is active.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function daily_insight_is_category_block_seven_active( $control ) {

		return $control->manager->get_setting( 'daily_insight_theme_options[enable_category_block_seven]' )->value();
	}
endif;

