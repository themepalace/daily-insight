<?php 

/**
 * Customizer Partial Functions
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


if ( ! function_exists( 'daily_insight_customize_partial_breaking_news_title' ) ) :
	/**
	 * Render the breaking news title for the selective refresh partial.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @return string
	 */
	function daily_insight_customize_partial_breaking_news_title() {
		$options = daily_insight_get_theme_options();
		return esc_html( $options['breaking_news_title'] );
	}
endif;

if ( ! function_exists( 'daily_insight_customize_partial_latest_post_title' ) ) :
	/**
	 * Render the Latest Post title for the selective refresh partial.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @return string
	 */
	function daily_insight_customize_partial_latest_post_title() {
		$options = daily_insight_get_theme_options();
		return esc_html( $options['latest_post_title'] );
	}
endif;

if ( ! function_exists( 'daily_insight_customize_partial_category_block_seven_title' ) ) :
	/**
	 * Render the Category Block Seven title for the selective refresh partial.
	 *
	 * @since Daily Insight 0.1
	 *
	 * @return string
	 */
	function daily_insight_customize_partial_category_block_seven_title() {
		$options = daily_insight_get_theme_options();
		return esc_html( $options['category_block_seven_title'] );
	}
endif;