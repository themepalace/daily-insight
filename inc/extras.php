<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function daily_insight_body_classes( $classes ) {
	$options = daily_insight_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for typography
	$classes[] = 'default';

	// Add a class for layout
	$classes[] = 'wide';

	// Add a class for sidebar
	if ( is_active_sidebar( 'sidebar-1' ) && !is_404() ) {
		$classes[] = 'right-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
    
    // Add display none class to prevent stack of html content
    $classes[] = 'display-none'; 

	return $classes;
}
add_filter( 'body_class', 'daily_insight_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function daily_insight_single_page_class( $classes ) {
    global $post;
    if( is_single() || is_archive() || is_search() ){
        $classes[] = 'blog-post';
    }
    if( is_home() ){
        $classes[] = 'blog-post';
    }
    return $classes;
}
add_filter( 'post_class', 'daily_insight_single_page_class' );


if ( ! function_exists( 'daily_insight_mobile_nav_menu' ) ) :

    /**
     * Add mobile menuin responsive mode       
     */

    function daily_insight_mobile_nav_menu() { ?>
        <!-- Mobile Menu -->
        <nav id="sidr-left-top" class="mobile-menu sidr left">
            <?php

            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array( 'theme_location' => 'primary','container' => false,
                    'depth' => 3, ) );
            }
            ?>
        </nav><!-- end left-menu -->

        <a id="sidr-left-top-button" class="menu-button right" href="#sidr-left-top"><i class="fa fa-bars"></i></a>
        <?php
    }
endif;
add_action( 'daily_insight_header_action','daily_insight_mobile_nav_menu', 60 );

/*
 * Function to get related posts
 */           
function daily_insight_get_related_posts(){
    global $post;

    $options = daily_insight_get_theme_options(); // get theme options

    $post_categories = get_the_category( $post->ID ); // get category object
    $category_ids = array(); // set an empty array

    foreach ( $post_categories as $post_category ) {
      $category_ids[] = $post_category->term_id;
    }

    if( empty( $category_ids ) ) return;

    $qargs = array(
        'posts_per_page'  => 3,
        'category__in'    => $category_ids,
        'post__not_in'    => array( $post->ID ),
        'order'           => 'ASC',
        'orderby'         => 'rand'
    );

    $related_posts = get_posts( $qargs ); // custom posts
    ?>
    <section id="related-articles" class="page-section three-columns">
        <header class="entry-header">
            <h2 class="entry-title category-title"><?php _e( 'Related articles', 'daily-insight' ); ?></h2> 
        </header>

        <div class="entry-content row">
        <?php foreach ($related_posts as $related_post ) {

            if ( has_post_thumbnail( $related_post->ID ) ) {
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID ), 'daily-insight-category' );
            } else {
                $img_array = array( get_template_directory_uri() . '/assets/uploads/no-featured-image-500x375.jpg' );
            }
            $post_title = get_the_title( $related_post->ID );
            $post_url   = get_permalink( $related_post->ID );
            $post_date  = get_the_date( '', $related_post->ID);
            $posts_categories = get_the_category( $related_post->ID );
        ?>
            <div class="column-wrapper">
                <a href="<?php echo esc_url( $post_url );?>"><img src="<?php echo esc_url( $img_array[0] ); ?>" alt="<?php echo esc_html( $post_title ); ?>"></a>
                <div class="related-articles-contents">
                    <span class="tag">
                    <?php $count = 1;
                    foreach ($posts_categories as $category ) {
                        echo '<a class="category" href="'. esc_url( get_category_link( $category->term_id ) ) .'">'. esc_html( $category->name ) .'</a>';

                        $count ++;
                        if( $count == 3 ) break; // terminate loop count= 3 
                    }
                    ?></span>
                    <div class="related-article-title">
                        <h6><a href="<?php echo esc_url( $post_url );?>"><?php echo esc_html( $post_title ); ?></a></h6>
                    </div><!-- .related-article-title -->
                </div><!-- .end .related-articles-contents -->
            </div><!-- .column-wrapper -->
         <?php } ?>       
        </div><!-- .entry-content-->
    </section><!-- #related-articles -->
<?php   
}
add_action( 'daily_insight_related_posts', 'daily_insight_get_related_posts' );


/*
 * Function to get author profile
 */           
function daily_insight_get_author_profile(){
    $author_url = !empty( get_the_author_meta( 'user_url' ) ) ? get_the_author_meta( 'user_url' ) : '#' ;
    ?>
    <article id="about-author">
        <div class="entry-content">
            <div class="about-author">
                <div class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 );  ?>
                </div><!-- .author-image -->
                <div class="author-content">
                    <div class="author-name clear">
                      <h6><?php the_author_posts_link(); ?></h6>
                    </div>
                    <?php if( !empty( get_the_author_meta ('user_email') ) ) : ?>
                    <a href="mailto:<?php echo esc_attr( get_the_author_meta ('user_email') ); ?>" class="author-email"><?php echo esc_html( get_the_author_meta ('user_email') ); ?></a>
                    <?php endif; ?>
                    <?php if( !empty(  get_the_author_meta( 'description') ) ) : ?>
                    <p><?php the_author_meta( 'description'); ?></p>
                    <?php endif; ?>

                </div><!-- .author-content -->
            </div><!-- .about-author -->
        </div><!-- .entry-content -->
    </article>
    <?php
}
add_action( 'daily_insight_author_profile', 'daily_insight_get_author_profile' );