<?php
/**
 * Daily Insight customizer default options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


/**
 * Returns the default options for Daily Insight.
 *
 * @since Daily Insight 0.1
 * @return array An array of default values
 */
function daily_insight_get_default_theme_options() {
	$theme_data  = wp_get_theme(); // get theme data
	$daily_insight_default_options = array(

		//breaking-news
		'enable_breaking_news'			=> false,
		'breaking_news_type'			=> 'category',
		'breaking_news_title'			=> __( 'Breaking News','daily-insight' ),
		'breaking_news_category_type'	=> '',

		//main-slider
		'enable_main_slider'			=> 'disabled',
		'main_slider_type'				=> 'category',
		'main_slider_category_type'		=> '',
	
		//latest-post
		'enable_latest_post'			=> 'static-frontpage',
		'latest_post_type'				=> 'recent-post',
		'latest_post_title'				=> __( 'Latest Post','daily-insight' ),

		//category block three
		'enable_category_block_three'		=> false,
		'category_block_three_type'			=> 'category',
		'category_block_three_icon'			=> 'fa-plane',
		'category_block_three_category_type'=> '',

		//category block seven
		'enable_category_block_seven'		=> false,
		'category_block_seven_type'			=> 'category',
		'category_block_seven_title'		=> __( 'Trending News','daily-insight' ),
		'category_block_seven_no_of_posts'  => 5,
		'category_block_seven_category_type'=> '',
		
		// Theme Options
		'pagination_enable'         	=> false,
		'pagination_type'         		=> 'default',
		'copyright_text'           		=> sprintf( __( 'Copyright &copy; . All Rights Reserved','daily-insight' ) ),
		'reset_options'      			=> false,
		'search_text'					=> __( 'Search..','daily-insight' ),
		'readmore_text'					=> __( 'Read More','daily-insight' ),
		
		// archive content type
		'archive_content_type'			=> 'excerpt',	

	);

	$output = apply_filters( 'daily_insight_default_theme_options', $daily_insight_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}