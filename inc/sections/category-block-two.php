<?php

/**
 * Category Block Seven section
 *
 * This is the template for the content of Category Block Seven section.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_add_category_block_seven' ) ) :
    /**
     * Add Category Block Seven section
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_category_block_seven() { 

        // Check if Category Block Seven is enabled on frontpage
        $options = daily_insight_get_theme_options(); 

        $category_block_seven_enable = (bool)( $options['enable_category_block_seven'] );
        if ( true !== $category_block_seven_enable ) {
            return false;
        }
        // Get Category Block Seven section details
        $section_details = array();
        $section_details = apply_filters( 'daily_insight_filter_category_block_seven_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Category Block Seven section .
        daily_insight_render_category_block_seven_section( $section_details );        
    }
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_add_category_block_seven', 90 );


if ( ! function_exists( 'daily_insight_get_category_block_seven_section_details' ) ) :
    /**
     * Category Block Seven section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Category Block Seven section details.
     */
    function daily_insight_get_category_block_seven_section_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Category Block Seven type
        $category_block_seven_content_type    = $options['category_block_seven_type'];
        $no_of_posts = 5;
        $content = array();

        switch ( $category_block_seven_content_type ) {

            case 'category':
              
                $category = !empty( $options['category_block_seven_category_type'] ) ? absint( $options['category_block_seven_category_type'] ) : '';

                if ( ! empty( $category ) ) {

                    $args = array(
                        'cat'            => $category,
                        'posts_per_page' => $no_of_posts,
                    );
                }
            break;

            default:
            break;
                
        }
            if( !empty( $args ) ) :

                $custom_posts = get_posts( $args );

                $index = 0;
                foreach ( $custom_posts as $key => $custom_post ) {

                    if ( has_post_thumbnail( $custom_post->ID ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-category' );
                    } else {
                        $img_array = array ( get_template_directory_uri() . '/assets/uploads/no-featured-image-500x375.jpg' );
                    }

                    if ( isset( $img_array ) ) {
                        $content[$index]['img_array'] = $img_array;
                    }

                    $content[$index]['title'] = get_the_title( $custom_post->ID );
                    $content[$index]['url']   = get_the_permalink( $custom_post->ID );
                    $content[$index]['terms'] = get_the_category( $custom_post->ID );
                    $index++;
                }
            endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
    return $input; 
    }
endif;
// Category Block Seven section content details.
add_filter( 'daily_insight_filter_category_block_seven_section_details', 'daily_insight_get_category_block_seven_section_details' );

if ( ! function_exists( 'daily_insight_render_category_block_seven_section' ) ) :
    /**
     * Start section Category Block Seven
     *
     * @return string Category Block Seven content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_category_block_seven_section( $content_details = array() ) {

        $options = daily_insight_get_theme_options();
        $section_title = !empty( $options['category_block_seven_title'] ) ? $options['category_block_seven_title'] : '';
        $content_type = $options['category_block_seven_type'];

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <section id="trending-news-slider" class="container page-section">
            <?php if( !empty( $section_title ) ) : ?>
            <header class="entry-header">
                <h2 class="entry-title category-title"><?php echo esc_html( $section_title ); ?></h2>
            </header>
            <?php endif; ?>

            <div class="entry-content regular row" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "speed": "800", "dots": false, "arrows": true, "infinite": true, "autoplay": true}'>
            <?php foreach ( $content_details as $content ) { ?>
                
                <div class="slider-item">
                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                    <div class="trending-contents-wrapper">
                        <?php $post_categories = $content['terms'];
                        if( !empty ( $post_categories ) ) :
            
                                foreach ( $post_categories as $post_category ) {
                                    $category_id   = $post_category->term_id;
                                    $category_name = $post_category->name;
                                    $category_url  = get_category_link( $category_id );
                                } ?>
                                <span class="tag"><a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a></span>
                        <?php endif; ?>
                        <div class="slider-title">
                            <h6><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h6>
                        </div><!-- .slider-title -->
                    </div><!-- .end .trending-contents-wrapper -->
                </div><!-- .slider-item -->
            <?php } ?>          
            </div><!-- .entry-content-->
        </section><!-- #trending-news-slider -->
    <?php }
endif;