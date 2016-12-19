<?php
/**
 * Daily Insight Theme Customizer.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

//load upgrade-to-pro section
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function daily_insight_customize_register( $wp_customize ) {
	$options = daily_insight_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add panel for common theme options
	$wp_customize->add_panel( 'daily_insight_theme_options_panel' , array(
	    'title'      => __( 'Theme Options','daily-insight' ),
	    'description'=> __( 'Daily Insight Theme Options.', 'daily-insight' ),
	    'priority'   => 150,
	) );

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load search-text option
	require get_template_directory() . '/inc/customizer/theme-options/search-text.php';

	// load readmore-text option
	require get_template_directory() . '/inc/customizer/theme-options/readmore-text.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		// load custom-css option
		require get_template_directory() . '/inc/customizer/theme-options/custom-css.php';
	}
	/**
	* Theme Options for sections
	*/
	// Add panel for different sections
	$wp_customize->add_panel( 'daily_insight_sections_panel' , array(
	    'title'      => __('Sections','daily-insight'),
	    'description'=> __( 'Daily Insight available sections.', 'daily-insight' ),
	    'priority'   => 130,
	) );

	//load breaking-news section
	require get_template_directory() . '/inc/customizer/sections/breaking-news.php';

	//load main slider section
	require get_template_directory() . '/inc/customizer/sections/main-slider.php';

	//load latest post section
	require get_template_directory() . '/inc/customizer/sections/latest-post.php';

	//load category block one section
	require get_template_directory() . '/inc/customizer/sections/category-block-one.php';

	//load category block two section
	require get_template_directory() . '/inc/customizer/sections/category-block-two.php';
}
add_action( 'customize_register', 'daily_insight_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function daily_insight_customize_preview_js() {
	wp_enqueue_script( 'daily_insight_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'daily_insight_customize_preview_js' );


if ( !function_exists( 'daily_insight_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Daily Insight 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function daily_insight_reset_options() {
		$options = daily_insight_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'daily_insight_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'daily_insight_reset_options' );


if ( ! function_exists( 'daily_insight_inline_css' ) ) :
	// Add Custom Css
	function daily_insight_inline_css() {
		$options = daily_insight_get_theme_options();

		$daily_insight_custom_css = '';
		$css = '';

		// Check if the custom CSS feature of 4.7 exists
		if ( function_exists( 'wp_update_custom_css_post' ) ) {
		    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
		    if( !empty( $options['custom_css'] ) )
		    	$css = $options['custom_css'];
		    
		    if ( $css ) {
		        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
		        $return = wp_update_custom_css_post( $core_css . $css );
				
		        if ( ! is_wp_error( $return ) ) {
		            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
		   			$options['custom_css'] = '';
					set_theme_mod( 'daily_insight_theme_options', $options );
		        }
		    }
		} else {
		    // Back-compat for WordPress < 4.7.
			if ( isset( $options['custom_css'] ) ) {
				$daily_insight_custom_css = $options['custom_css'];
			}
		}
		
		$css = $daily_insight_custom_css;
		wp_add_inline_style( 'daily-insight-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'daily_insight_inline_css', 10 );