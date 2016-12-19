<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 */

get_header(); ?>
<div class="page-section container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

		endwhile; // End of the loop.

		/**
		* Hook daily_insight_action_post_pagination
		*  
		* @hooked daily_insight_post_pagination 
		*/
		do_action( 'daily_insight_action_post_pagination' );

		/**
		* Custom Author Box in support.
		*/
	    if( class_exists('Wp_Author_Profile_Box_Lite_Front') || class_exists('Wp_Author_Profile_Box_Front') ):
	        $author = '';
	        $author = apply_filters( 'custom_author', $author);
	        echo $author;

	    else:
	    	/**
			 * Hook daily_insight_author_profile
			 *  
			 * @hooked daily_insight_get_author_profile 
			 */
			 do_action( 'daily_insight_author_profile' );
	    endif;

		/**
		* Custom author box end!!!!
		*/

		/**
		* Hook daily_insight_related_posts
		*  
		* @hooked daily_insight_get_related_posts 
		*/
		do_action( 'daily_insight_related_posts' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php
if ( daily_insight_is_sidebar_enable() ) {
	get_sidebar();
}
?>
</div><!-- .page-section -->
<?php
get_footer();
