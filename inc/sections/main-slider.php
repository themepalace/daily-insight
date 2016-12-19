<?php

/**
 * Main Slider section
 *
 * This is the template for the content of Main Slider section.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_add_main_slider_section' ) ) :
    /**
     * Add Main Slider section
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_main_slider_section() {

        // Check if Main SLider is enabled on frontpage
        $options = daily_insight_get_theme_options(); 

        $main_slider_enable = apply_filters( 'daily_insight_section_status', true, 'enable_main_slider' );
        if ( true !== $main_slider_enable ) {
            return false;
        }
        // Get Main SLider section details
        $section_details = array();
        $section_details = apply_filters( 'daily_insight_filter_main_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Main SLider section .
        daily_insight_render_main_slider_section( $section_details );
    }
endif;
add_action( 'daily_insight_content_start_action', 'daily_insight_add_main_slider_section', 40 );


if ( ! function_exists( 'daily_insight_get_main_slider_section_details' ) ) :
    /**
     * Main SLider section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Main SLider section details.
     */
    function daily_insight_get_main_slider_section_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Main SLider type
        $main_slider_content_type = $options['main_slider_type'];
        $no_of_posts = 3;

        $content = array();

        switch ( $main_slider_content_type ) {

            case 'category':
                $categories = array();
                $categories = !empty( $options['main_slider_category_type'] ) ? $options['main_slider_category_type'] : array();
                $category = array_filter( $categories );
                
                if ( ! empty( $category ) ) {
                
                    $args = array(
                        'category__in'      => $category,
                        'posts_per_page'    => $no_of_posts,
                    );
                }
            break;

            default:
            break;          
        }
            
        if( ! empty ( $args ) ) :
            $custom_posts = get_posts( $args );
    
            $i = 0;
            foreach ( $custom_posts as $key => $custom_post ) {
                $img_array = null;

                if ( has_post_thumbnail( $custom_post->ID ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-main-slider' );
                } else {
                        $img_array = array ( get_template_directory_uri() . '/assets/uploads/no-featured-image-1280x500.jpg' );
                }

                if ( isset( $img_array ) ) {
                    $content[$i]['img_array'] = $img_array;
                }

                $year  = get_the_time('Y', $custom_post->ID );
                $month = get_the_time('m', $custom_post->ID );
                $day   = get_the_time('d', $custom_post->ID );

                $content[$i]['date_link'] = get_day_link( $year, $month, $day );
                $content[$i]['url']      = get_permalink( $custom_post->ID );
                $content[$i]['title']    = get_the_title( $custom_post->ID );
                $content[$i]['terms']    = get_the_category( $custom_post->ID );
                $content[$i]['date']     = get_the_date( '', $custom_post->ID );
            $i++;
            }
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
    return $input; 
    }
endif;
// Main SLider section content details.
add_filter( 'daily_insight_filter_main_slider_section_details', 'daily_insight_get_main_slider_section_details' );

if ( ! function_exists( 'daily_insight_render_main_slider_section' ) ) :
    /**
     * Start section Main SLider
     *
     * @return string Main SLider content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_main_slider_section( $content_details = array() ) {
        //get theme options
        $options = daily_insight_get_theme_options();
       
        if ( empty( $content_details ) ) {
            return;
        } ?>
        <section id="main-slider" class="page-section container" data-effect="cubic-bezier(0.250, 0.100, 0.250, 1.000)" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": false, "arrows":true, "autoplay": true, "fade": false }' >
            <?php foreach( $content_details as $content ) : 
                if( !empty ($content['img_array'] ) ) : ?>
                    <div class="slider-item">
                        <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                        <div class="overlay"></div></a>
                        <div class="main-slider-contents">
                            <h2 class="title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            <?php $post_categories = $content['terms'];
                            if( !empty ( $post_categories ) ) :
                            
                                foreach ( $post_categories as $post_category ) {
                                    $category_id   = $post_category->term_id;
                                    $category_name = $post_category->name;
                                    $category_url  = get_category_link( $category_id );
                                ?>
                                <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                <?php } ?>
                                <a href="<?php echo esc_url( $content['date_link'] ); ?>"><time><?php echo esc_html( $content['date'] ); ?></time></a>
                                <?php 
                            endif; ?> 
                        </div><!-- .main-slider-contents -->
                    </div><!-- .slider-item -->
                <?php endif; 
            endforeach; ?>
        </section><!-- #main-slider -->
<?php
    }
endif;