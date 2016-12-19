<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Daily Insight 
 * @since Daily Insight 0.1
 */

$options = daily_insight_get_theme_options();
?>

<form action="<?php echo esc_url( home_url('/') ); ?>">
	<input type="text" name="s" placeholder="<?php echo esc_attr($options['search_text']);?>" value="<?php echo esc_attr( get_search_query() ); ?>" >
	<button type="submit"><i class="fa fa-search"></i></button>
	
</form>