<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 */

// Get the reading setting option
$show_on_front = get_option( 'show_on_front' );

// Check if "latest posts" is selected in reading setting
if ( 'posts' == $show_on_front ) {
	// Load home.php
	get_template_part( 'home' );
} 
else {
	// Load front page with additional sections
	get_header(); 

	/**
	 * daily_insight_front_page_container_action hook
	 *
	 * @hooked daily_insight_front_page_container_start -  10 
	 * @hooked daily_insight_add_category_block_three -  30
	 * @hooked daily_insight_front_page -  70
	 * @hooked daily_insight_front_page_container_end - 80
	 * @hooked daily_insight_add_category_block_seven -  90
	 */
	do_action( 'daily_insight_front_page_container_action' );
	
	get_footer();
	
}