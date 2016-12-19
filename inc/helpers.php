<?php
/**
 * Daily Insight custom helper funtions
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if( ! function_exists( 'daily_insight_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Daily Insight 0.1
	 */
  	function daily_insight_check_enable_status( $input, $content_enable ){
		 $options = daily_insight_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'daily_insight_section_status', 'daily_insight_check_enable_status', 10, 2 );


if ( ! function_exists( 'daily_insight_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_is_sidebar_enable() {

		if( is_404() ){
			return false;
		}
		elseif ( is_active_sidebar( 'sidebar-1' )) {
			return true;
		} else {
			return false;
		}

	}
endif;

if ( ! function_exists( 'daily_insight_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 *
	 * @link: https://gist.github.com/melissacabral/4032941
	 *
	 * @param  array $args Arguments
	 */
	function daily_insight_simple_breadcrumb( $args = array() ) {

		$args = wp_parse_args( (array) $args, array(
			'separator' => '&gt;',
		) );

		/* === OPTIONS === */
		$text['home']     = get_bloginfo( 'name' ); // text for the 'Home' link
		$text['category'] = __( 'Archive for <em>%s</em>', 'daily-insight' ); // text for a category page
		$text['tax']      = __( 'Archive for <em>%s</em>', 'daily-insight' ); // text for a taxonomy page
		$text['search']   = __( 'Search results for: <em>%s</em>', 'daily-insight' ); // text for a search results page
		$text['tag']      = __( 'Posts tagged <em>%s</em>', 'daily-insight' ); // text for a tag page
		$text['author']   = __( 'View all posts by <em>%s</em>', 'daily-insight' ); // text for an author page
		$text['404']      = __( 'Error 404', 'daily-insight' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = ' ' . $args['separator'] . ' '; // delimiter between crumbs
		$before      = '<span class="current">'; // tag before the current crumb
		$after       = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink   = esc_url( home_url( '/' ) );
		$linkBefore = '<span typeof="v:Breadcrumb">';
		$linkAfter  = '</span>';
		$linkAttr   = ' rel="v:url" property="v:title"';
		$link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if ( is_home() || is_front_page() ) {

			if ( $showOnHome == 1 ) { echo '<div id="crumbs"><a href="' . esc_url( $homeLink ) . '">' . esc_html( $text['home'] ) . '</a></div>'; }
		} else {

			echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf( $link, esc_url( $homeLink ), esc_html( $text['home'] ) ) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, true, $delimiter );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
				}
				echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;

			} elseif ( is_tax() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, true, $delimiter );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
				}
				echo $before . sprintf( $text['tax'], single_cat_title( '', false ) ) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf( $text['search'], esc_html( get_search_query() ) ) . $after;

			} elseif ( is_day() ) {
				echo sprintf( $link, esc_url( get_year_link( get_the_time( 'Y' ) ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo sprintf( $link, esc_url( get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ) ), get_the_time( 'F' ) ) . $delimiter;
				echo $before . get_the_time( 'd' ) . $after;

			} elseif ( is_month() ) {
				echo sprintf( $link, esc_url( get_year_link( get_the_time( 'Y' ) ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo $before . get_the_time( 'F' ) . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time( 'Y' ) . $after;

			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug = $post_type->rewrite;
					printf( $link, $homeLink . '/' . $slug['slug'] . '/', esc_html( $post_type->labels->singular_name ) );
					if ( $showCurrent == 1 ) { echo $delimiter . $before . esc_html( get_the_title() ) . $after; }
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					$cats = get_category_parents( $cat, true, $delimiter );
					if ( $showCurrent == 0 ) { $cats = preg_replace( "#^(.+)$delimiter$#", '$1', $cats ); }
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
					if ( $showCurrent == 1 ) { echo $before . esc_html( get_the_title() ) . $after; }
				}
			} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $before . esc_html( $post_type->labels->singular_name ) . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat = get_the_category( $parent->ID );
				$cat = $cat[0];
				$cats = get_category_parents( $cat, true, $delimiter );
				$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
				echo $cats;
				printf( $link, esc_url( get_permalink( $parent ) ), esc_html( $parent->post_title ) );
				if ( $showCurrent == 1 ) { echo $delimiter . $before . esc_html( get_the_title() ) . $after; }
			} elseif ( is_page() && ! $post->post_parent ) {
				if ( $showCurrent == 1 ) { echo $before . esc_html( get_the_title() ) . $after; }
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$breadcrumbs[] = sprintf( $link, esc_url( get_permalink( $page->ID ) ), esc_html( get_the_title( $page->ID ) ) );
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[ $i ];
					if ( $i != count( $breadcrumbs ) -1 ) { echo $delimiter; }
				}
				if ( $showCurrent == 1 ) { echo $delimiter . $before . esc_html( get_the_title() ) . $after; }
			} elseif ( is_tag() ) {
				echo $before . sprintf( $text['tag'], esc_html( single_tag_title( '', false ) ) ) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo $before . sprintf( $text['author'], esc_html( $userdata->display_name ) ) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ' ('; }
				echo __( 'Page', 'daily-insight' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ')'; }
			}

					echo '</div>';

		}

	}

endif;


add_action( 'daily_insight_action_pagination', 'daily_insight_pagination', 10 );
if ( ! function_exists( 'daily_insight_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_pagination() {
		$options = daily_insight_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation( );
			elseif ( $pagination == 'numeric' ) :
				the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => __( 'Previous Posts', 'daily-insight' ),
				    'next_text' => __( 'Next Posts', 'daily-insight' ),
				) );
			endif;
		}
	}

endif;


add_action( 'daily_insight_action_post_pagination', 'daily_insight_post_pagination', 10 );
if ( ! function_exists( 'daily_insight_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_post_pagination() {
		the_post_navigation( array( 
			'prev_text' => __( 'Previous article', 'daily-insight'), 
			'next_text' => __( 'Next article', 'daily-insight')
			)
		);
	}
endif;



add_action( 'customize_save_after', 'daily_insight_reset_options' );
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


if ( ! function_exists( 'daily_insight_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_footer_sidebar_class() {
		$data = array();
		$active_id = array();
		$count = 0;

		if ( is_active_sidebar( 'footer-1' ) ) {
			$active_id[] = '1';
		  $count++;
		}

		if ( is_active_sidebar( 'footer-2' ) ){
			$active_id[] = '2';
		  $count++;
		}

		if ( is_active_sidebar( 'footer-3' ) ){
			$active_id[] = '3';
		  $count++;
		}

		if ( is_active_sidebar( 'footer-4' ) ){
			$active_id[] = '4';
		  $count++;
		}

		$class = '';

		switch ( $count ) {
			case '1':
		    $class = 'one';
		    break;
			case '2':
		    $class = 'two';
		    break;
			case '3':
		    $class = 'three';
		    break;
		    case '4':
		    $class = 'four';
		    break;
		}

		$data['active_id'] = $active_id;
		$data['class']     = $class;

		return $data;
	}
endif;


/**
 * custom excerpt function
 * 
 * @since Daily Insight 0.1
 * @return  no of words to display
 */
function daily_insight_trim_content( $length = 40, $post_obj = null ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}

	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}

	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}

	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );

   return apply_filters( 'daily_insight_trim_content', $trimmed_content );
}

if ( ! function_exists( 'daily_insight_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_custom_content_width() {

		global $content_width;
		$sidebar_enable  = daily_insight_is_sidebar_enable();
		$sidebar_position = ( true == $sidebar_enable ) ? 'right-sidebar' : 'no-sidebar';
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
	}
endif;
add_action( 'template_redirect', 'daily_insight_custom_content_width' );