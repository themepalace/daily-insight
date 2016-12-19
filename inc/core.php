<?php
/**
 * Daily Insight core file.
 *
 * This is the template that includes all the other files for core featured of Daily Insight
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */
/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Daily Insight 0.1
 */
function daily_insight_get_theme_options() {
  $daily_insight_default_options = daily_insight_get_default_theme_options();

  return array_merge( $daily_insight_default_options , get_theme_mod( 'daily_insight_theme_options', $daily_insight_default_options ) ) ;
}

/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Daily Insight 0.1
*/
function daily_insight_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'post' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
    return $content .= '<p><b>' . __( 'Note', 'daily-insight' ) . ':</b>' . __( ' The recommended size for image is 1280px by 500px while using it for slider', 'daily-insight' ) . '</p>';
  } 
   return $content;
}
add_filter( 'admin_post_thumbnail_html', 'daily_insight_slider_image_instruction', 10, 2);

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Sections additions.
 */
require get_template_directory() . '/inc/sections/sections.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
* WooCommerce Compability additions.
*/
require get_template_directory() . '/inc/woocommerce.php';

