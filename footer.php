<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 */

/**
 * daily_insight_content_end_action hook
 *
 * @hooked daily_insight_content_end -  10
 *
 */
do_action( 'daily_insight_content_end_action' );
	
	$options			 = daily_insight_get_theme_options();
	$footer_sidebar_data = daily_insight_footer_sidebar_class();
	$active_id           = $footer_sidebar_data['active_id'];
	$class               = $footer_sidebar_data['class'];

?>
	<footer id="colophon" class="site-footer <?php echo esc_attr( $class );?>-columns" role="contentinfo">
		<div class="container">
			<?php  
		    for ( $i=0; $i < count( $active_id ); $i++ ) {
		       	if ( is_active_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' ) ) : ?>
					<div class="column-wrapper">
		            	<?php dynamic_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' ); ?>
		        	</div><!-- .column-wrapper -->
		        <?php endif;
		    } ?>
	        <div class="clear"></div>
	        <div class="bottom-footer">
				<div class="site-info">
					<?php if(! empty( $options['copyright_text'] ) ) { 
			       		echo wp_kses_post( $options['copyright_text'] ); 
			       	}
			        printf( esc_html__( ' Powered by %1$s | Daily Insight by %2$s', 'daily-insight'), '<a href="'.esc_url( 'https://wordpress.org/' ).'">WordPress</a>', '<a href="'. esc_url( 'http://www.yamchhetri.com/' ) .'">Yam Chhetri</a>' ); ?>
				</div><!-- .site-info -->
			</div><!-- .bottom-footer -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
	
<?php
/**
	 * daily_insight_page_end_action hook
	 *
	 * @hooked daily_insight_page_end -  10
	 *
	 */
	do_action( 'daily_insight_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
