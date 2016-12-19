<?php

/**
 * Latest Post section
 *
 * This is the template for the content of Latest Post section.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_add_latest_post_section' ) ) :
    /**
     * Add Latest Post section
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_latest_post_section() {

        // Check if Latest Post is enabled on frontpage
        $options = daily_insight_get_theme_options(); 

        $latest_post_enable = apply_filters( 'daily_insight_section_status', true, 'enable_latest_post' );
        if ( true !== $latest_post_enable ) {
            return false;
        }
        // Get Latest Post section details
        $section_details = array();
        $section_details = apply_filters( 'daily_insight_filter_latest_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Latest Post section .
        daily_insight_render_latest_post_section( $section_details );
    }
endif;
add_action( 'daily_insight_content_start_action', 'daily_insight_add_latest_post_section', 50 );


if ( ! function_exists( 'daily_insight_get_latest_post_section_details' ) ) :
    /**
     * Latest Post section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Latest Post section details.
     */
    function daily_insight_get_latest_post_section_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Latest Post type
        $latest_post_content_type    = $options['latest_post_type'];

        $content = array();

        switch ( $latest_post_content_type ) {

            case 'recent-post':

                $args = array(
                    'posts_per_page'      => 3,
                    'ignore_sticky_posts' => true,
                );

                $custom_posts = get_posts( $args );

                    $index = 0;
                    foreach ( $custom_posts as $key => $custom_post ) {

                        if ( has_post_thumbnail( $custom_post->ID ) ) {
                            $img_array            = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-latest-post' );
                            $content[$index]['img_array'] = $img_array;
                        }

                        $year  = get_the_time('Y', $custom_post->ID );
                        $month = get_the_time('m', $custom_post->ID );
                        $day   = get_the_time('d', $custom_post->ID );

                        $content[$index]['date_link'] = get_day_link( $year, $month, $day );
                        $content[$index]['date']  = get_the_date( '' , $custom_post );
                        $content[$index]['title'] = get_the_title( $custom_post->ID );
                        $content[$index]['url']   = get_the_permalink( $custom_post->ID );
                        $content[$index]['terms'] = get_the_category( $custom_post->ID ); 
                        $index++;
                    }
            break;

            default:
            break;
        }
        if ( ! empty( $content ) ) {
            $input = $content;
        }
    return $input; 
    }
endif;
// Latest Post section content details.
add_filter( 'daily_insight_filter_latest_post_section_details', 'daily_insight_get_latest_post_section_details' );

if ( ! function_exists( 'daily_insight_render_latest_post_section' ) ) :
    /**
     * Start section Latest Post
     *
     * @return string Latest Post content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_latest_post_section( $content_details = array() ) {

        $options         = daily_insight_get_theme_options();
        $content_type    = $options['latest_post_type'];
        $blog_posts      = get_option( 'page_for_posts' );
        $blog_posts_link = get_permalink( $blog_posts );

        if ( empty( $content_details ) ) {
            return;
        } 

        if( 'disabled' == $options['enable_main_slider'] || ( 'disabled' == $options['enable_main_slider'] && !$options['enable_breaking_news'] ) ){
            $section_class = 'margin-top-30';
        } else {
            $section_class = '';
        }
        ?>
        <section id="latest-posts" class="page-section container  bg-white three-columns <?php echo esc_attr( $section_class );?>">
            <?php 
            $section_title = !empty( $options['latest_post_title'] ) ? $options['latest_post_title'] : '';
            $section_link = $blog_posts_link;
            if( ! empty ( $section_title ) ):?>
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo esc_html( $section_title ); ?></h2>  
                    <a href="<?php echo esc_url( $section_link ); ?>" class="view-more"><?php _e( 'View more', 'daily-insight' ); ?></a>
                </header><!-- .entry-header -->
            <?php endif; ?>

            <div class="entry-content">
                <div class="row">
                    <?php foreach( $content_details as $content ) : 
                    $post_categories = $content['terms']; ?>
                    <div class="column-wrapper">
                        
                        <?php if( !empty ( $content['img_array'] ) ) : ?>
                        <div class="image-wrapper">
                            <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                            <div class="overlay"></div></a>
                        </div><!-- .image-wrapper -->
                        <?php endif; ?>
                        
                        <?php if( !empty ( $content['title'] ) ) : ?>

                        <div class="post-wrapper">
                            <div class="post-title">
                                <h5><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h5>

                                <?php if( !empty ( $post_categories ) ) :
                              
                                    foreach ( $post_categories as $post_category ) {
                                        $category_id   = $post_category->term_id;
                                        $category_name = $post_category->name;
                                        $category_url  = get_category_link( $category_id );
                                        ?>
                                         <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a> 
                                         <?php

                                        } ?>                                   
                                    <a href="<?php echo esc_url( $content['date_link'] ); ?>"><time><?php echo esc_html( $content['date'] ); ?></time></a>
                                <?php endif; ?>
                            </div><!-- .post-title -->
                        </div><!-- .post-wrapper -->
                        <?php endif; ?>
                    </div><!-- .column-wrapper -->
                    <?php endforeach; ?>
                </div><!-- .row -->
            </div><!-- .entry-content -->
        </section><!-- #latest-posts -->
<?php
    }
endif;