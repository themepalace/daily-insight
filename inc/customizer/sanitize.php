<?php
/**
 * Daily Insight customizer sanitization functions
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Sanitize select, radio.
 *
 * @since Daily Insight 0.1
 *
 * @param mixed                $input The value to sanitize.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 * @return mixed Sanitized value.
 */
function daily_insight_sanitize_select( $input, $setting ) {
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function daily_insight_sanitize_number_range( $number, $setting ) {
	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/**
 * Sanitize checkbox.
 *
 * @since Daily Insight 0.1
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function daily_insight_sanitize_checkbox( $checked ) {

	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitizes category list
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Daily Insight 0.1
 */
function daily_insight_sanitize_category_list( $input ) {
	if ( $input != '' ) {
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					);

		$categories = ( get_categories( $args ) );

		$category_list 	=	array();

		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    }
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}


/**
 * Text field with allowed tag anchor sanitization callback example.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param string  $input  
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The input with only allowed tag i.e. anchor
 */
function daily_insight_santize_allow_tag( $input, $setting ) {
	$input = wp_kses( $input, array(
		'br',
		'a' => array(
			'target' => array(),
			'href' => array(),
			)
		) );

	return $input;
}
