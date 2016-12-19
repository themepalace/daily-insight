<?php
/**
 * Daily Insight woocommerce compatibility.
 *
 * This is the template that makes theme WooCommerce ready.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


/**
 * Make theme WooCommerce ready
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'daily_insight_front_page_container_start', 10);
add_action('woocommerce_after_main_content', 'daily_insight_front_page_container_end', 10);

