<?php
/**
 * Custom Category Widget
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! class_exists( 'daily_insight_Custom_Category_Widget' ) ) :
/**
 * Custom Category Class
 *
 * @since 1.0
 *
 * @see WP_Widget
 */
class daily_insight_Custom_Category_Widget extends WP_Widget {

	/**
	 * Sets up a new custom category instance.
	 *
	 * @since 1.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_popular_category',
			'description'                 => __( 'Shows Your site&#8217;s categories.','daily-insight' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tp-widget-custom-category', __( 'TP: Custom Category Widget', 'daily-insight' ), $widget_ops );
		$this->alt_option_name = 'widget_features';
	}

	/**
	 * Outputs the content for the custom category instance.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the custom category instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		$title          = ( !empty( $instance['title'] ) ) ? $instance['title'] : '';
		
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title          = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$no_of_category = isset( $instance['no_of_category'] ) ? absint( $instance['no_of_category'] ) : 10;
		$order          = !empty( $instance['order'] ) ? $instance['order'] : 'ASC';
		$order_by       = !empty( $instance['order_by'] ) ? $instance['order_by'] : 'name';
		$show_count     = isset( $instance['show_count'] ) ? $instance['show_count'] : true;

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}	
		$arguments = array( 
						'depth'               => 1,
						'title_li'            => '',
						'hide_title_if_empty' => 1,
						'show_count'          => $show_count,
						'order'               => $order,
						'orderby'             => $order_by,
						'number'              => $no_of_category,
						'echo'                => 0,
						'hide_empty'		  => 1,
						'hierarchical'		  => false,
					);

		$categories = wp_list_categories( $arguments );
		$categories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="category-number">\\1</span></a>', $categories );

		echo '<div class="widget-wrap">
				<ul>';
		echo $categories;			
        echo '</ul>
        </div><!-- .widget-wrap -->';
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the custom category instance.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['no_of_category'] = absint( $new_instance['no_of_category'] );
		$instance['order'] 			= in_array( $new_instance['order'], array( 'ASC', 'DESC' ) ) ? $new_instance['order'] : '';
		$instance['order_by'] 		= in_array( $new_instance['order_by'], array( 'name', 'count' ) ) ? $new_instance['order_by'] : '';
		$instance['show_count'] 	= daily_insight_sanitize_checkbox( $new_instance['show_count'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the custom category.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$defaults = array( 'title' => '', 'no_of_category' => 10 , 'show_count' => true, 'order' => 'ASC', 'order_by' => 'name' );
		$instance = wp_parse_args ( $instance , $defaults );
		extract( $instance );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'daily-insight' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_category' ) ); ?>"><?php _e( 'Number of Category Visible:', 'daily-insight' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'no_of_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_of_category' ) ); ?>" type="number" step="1" min="0" value="<?php echo absint( $no_of_category ); ?>"/>
			<br><span><b><?php  _e( 'Enter 0 to show all category', 'daily-insight'); ?></b> </span>
		</p> 

		<p><?php _e('Order:', 'daily-insight'); ?>
		
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e( 'Ascending:', 'daily-insight' ); ?></label>
			<input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'order') ); ?>_ASC" name="<?php echo esc_attr( $this->get_field_name( 'order') ); ?>" type="radio" value="ASC" <?php if (isset( $order ) ){ checked( 'ASC', $order, true ); } ?> />
		
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e( 'Descending:', 'daily-insight' ); ?></label>
			<input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'order') ); ?>_DESC" name="<?php echo esc_attr( $this->get_field_name( 'order') ); ?>" type="radio" value="DESC" <?php if ( isset( $order ) ){ checked( 'DESC', $order, true ); } ?>/>
		</p>

		<p>		
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php _e( 'Order By:', 'daily-insight' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>" class="widefat" style="width:100%;">
				<option value="name" <?php if ( 'name' == $order_by ) echo 'selected="selected"'; ?>><?php _e( 'Category Name', 'daily-insight' ); ?></option>
				<option value="count" <?php if ( 'count' == $order_by ) echo 'selected="selected"'; ?>><?php _e( 'Post Count', 'daily-insight' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count') ); ?>"><?php _e( 'Show Count:', 'daily-insight' ); ?></label>
			<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count') ); ?>" type="checkbox" <?php checked( $show_count ); ?>/>
		</p>
		<?php
	}
}
endif;
/*
 * Function to register custom category widget
 *
 * Since 1.0
 */
function daily_insight_register_custom_category_widget(){
	register_widget( 'daily_insight_Custom_Category_Widget' );
}
add_action( 'widgets_init', 'daily_insight_register_custom_category_widget' );