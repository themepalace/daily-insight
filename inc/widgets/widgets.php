<?php
/**
 * Daily Insight widgets inclusion
 *
 * This is the template that includes all custom widgets of Daily Insight
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function daily_insight_register_sidebars() {

	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'daily-insight' ),
		'id'            => 'header_ad_image_widget',

		'description'   => esc_html__( 'This is the header right widget area. This widget area is not equipped to display any widget, and works best with a search form, social icons widget, Advertisement Widget or possibly a text widget.', 'daily-insight' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	for ($i=1; $i <= 4 ; $i++) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer %s', 'daily-insight' ), $i ),
			'id'            => 'footer-'.$i,
			'description'   => sprintf( esc_html__( 'Footer %s widget area.', 'daily-insight' ), $i ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'daily_insight_register_sidebars' );

/*
 * Add custom category widget
 */
require get_template_directory() . '/inc/widgets/custom-category-widget.php';
