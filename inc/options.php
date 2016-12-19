<?php
/**
 * Daily Insight options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Pagination
 * @return array site pagination options
 */
function daily_insight_pagination_options() {
  $daily_insight_pagination_options = array(
    'numeric'         => __( 'Numeric', 'daily-insight' ),
    'default'         => __( 'Default(Older/Newer)', 'daily-insight' ),
    'infinite-scroll' => __( 'Infinite-Scroll', 'daily-insight' ),
    'infinite-click'  => __( 'Infinite-Click', 'daily-insight' ),
  );

  $output = apply_filters( 'daily_insight_pagination_options', $daily_insight_pagination_options );

  return $output;
}

/**
 * Slider
 * @return array slider options
 */
function daily_insight_enable_disable_options() {
  $daily_insight_enable_disable_options = array(
    'static-frontpage'  => __( 'Static Frontpage', 'daily-insight' ),
    'disabled'          => __( 'Disabled', 'daily-insight' ),
  );

  $output = apply_filters( 'daily_insight_enable_disable_options', $daily_insight_enable_disable_options );

  return $output;
}