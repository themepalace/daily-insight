<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function daily_insight_jetpack_setup() {

	$options = daily_insight_get_theme_options();

	$pagination_type	= isset( $options['pagination_type'] ) ? $options['pagination_type'] : '';
	$type = '';
	
	if ( in_array( $pagination_type, array( 'infinite-click', 'infinite-scroll' ) ) ) {
		if ( 'infinite-click' == $pagination_type ) {
			$type = 'click';
		} elseif( 'infinite-scroll' == $pagination_type ){
			$type = 'scroll';
		}

		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'type'		=> $type,
			'container' => 'main',
			'render'    => 'daily_insight_infinite_scroll_render',
			'footer'    => 'page',
		) );
	}
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'daily_insight_jetpack_setup' );


/**
 * Custom render function for Infinite Scroll.
 */
function daily_insight_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}