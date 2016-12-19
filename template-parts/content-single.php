<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 */

global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="cat-links">
            <span class="screen-reader-text"><?php _e( 'Categories', 'daily-insight' ); ?> </span>

            <?php $categories = get_the_category( $post->ID ); // get categories assigned to a post
            
				foreach ( $categories as $category ) {
					echo '<a href="'. esc_url( get_category_link( $category->cat_ID ) ) .'" class="category" rel="category tag">'. esc_html( $category->name ) .'</a>';
				} 
			?> 
        </span>
		<?php 	
			if ( is_single() ) :
				the_title( '<h2 class="entry-title">', '</h2>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif; 
		?>
	</header><!-- .entry-header -->

	<?php 
		do_action( 'daily_insight_entry_meta' ); // get post meta 
		daily_insight_post_thumbnail(); // get post thumbnail
	?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'daily-insight' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'daily-insight' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php daily_insight_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
	<?php
	/**
	* Function to add rating option.
	* 
	*/
	if( function_exists('the_ratings')) { 
		echo '<div class="article-rating">
				<div class="star-rating">';
            the_ratings();
        echo '</div></div>';
    }
    ?>
</article><!-- #post-## -->
