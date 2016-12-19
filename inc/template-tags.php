<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function daily_insight_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'daily_insight_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'daily_insight_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so daily_insight_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so daily_insight_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'daily_insight_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function daily_insight_entry_footer() {

	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'daily-insight' ) ); //get tags lists

	if( !empty( $tags_list ) ){
		echo '<div class="tag-list">
		  		<span class="screen-reader-text">'. __( 'Tagged', 'daily-insight') .' </span>';
		printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'daily-insight' ) . '</span>', $tags_list );
		echo '</div>';
	}
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'daily-insight' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'daily-insight' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Flush out the transients used in daily_insight_categorized_blog.
 */
function daily_insight_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'daily_insight_categories' );
}
add_action( 'edit_category', 'daily_insight_category_transient_flusher' );
add_action( 'save_post',     'daily_insight_category_transient_flusher' );

/**
 * Prints HTML with meta information for post and page containing author meta, posted date, views, comment number.
 */
function daily_insight_get_entry_meta(){ 
	global $post;
	$author_profile_avatar =  get_avatar( get_the_author_meta( 'ID' ), 32 ); //get author profile avatar
	$author_name = get_the_author(); // get author name
	$author_profile_link = get_author_posts_url( get_the_author_meta( 'ID' ) ); // get author profile link
 	

 	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '<span class="posted-on-text">Posted on</span> %s', 'post date', 'daily-insight' ),
		'<a href="'.  esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) .'" rel="bookmark">'. $time_string .'</a>'
	);

	// Get comment number
	$comment_no = get_comments_number();
	?>

	<div class="entry-meta">
	    <div class="pull-left">
	        <span class="byline">
	            <span class="author vcard"><?php echo $author_profile_avatar; ?>
	            	<span class="screen-reader-text"><?php _e( 'Author', 'daily-insight' ); ?></span> 
	                <a class="url fn n" href="<?php echo esc_url( $author_profile_link ); ?> "><?php echo esc_html( $author_name ); ?></a>
	            </span>
	        </span><!-- .byline -->

	        <span class="posted-on">
	            <span class="screen-reader-text"><?php _e( 'Posted on', 'daily-insight' ); ?></span>
	            <?php echo $posted_on; ?></span><!-- .posted-on -->
	    </div><!-- .pull-left -->


	    <div class="pull-right">
	        <div class="comments pull-left"><i class="fa fa-comments"></i><span><?php echo absint( $comment_no ); ?></span></div><!-- .comments -->
	    </div><!-- .pull-right -->
	</div>
<?php
}
add_action( 'daily_insight_entry_meta', 'daily_insight_get_entry_meta' );

if ( ! function_exists( 'daily_insight_post_thumbnail' ) ) :
/**
 * Displays an post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own daily_insight_post_thumbnail() function to override in a child theme.
 *
 * @since Daily Insight 0.1
 */
function daily_insight_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
	?>
		<div class="image-wrapper">
			<?php the_post_thumbnail( 'full' ); ?>
		<div class="overlay"></div></div>
	<?php
	} else { 
	?>
	<div class="image-wrapper">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>
	<div class="overlay"></div></div>
	<?php } 
}
endif;

if ( ! function_exists( 'daily_insight_blog_post_thumbnail' ) ) :
/**
 * Displays an post thumbnail for blog.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own daily_insight_blog_post_thumbnail() function to override in a child theme.
 *
 * @since Daily Insight 0.1
 */
function daily_insight_blog_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	} ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
          	<div class="image-wrapper">
            	<?php the_post_thumbnail( 'full' ); ?>  
            <div class="overlay"></div>
          </div><!-- .image-wrapper -->
        </a><!-- end .post-thumbnail -->
<?php }
endif;