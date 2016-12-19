<?php

/**
 * Category Block Three section
 *
 * This is the template for the content of Category Block Three section.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

if ( ! function_exists( 'daily_insight_add_category_block_three' ) ) :
    /**
     * Add Category Block Three section
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_category_block_three() { 

        // Check if Category Block Three is enabled on frontpage
        $options = daily_insight_get_theme_options(); 

        $category_block_three_enable = (bool)( $options['enable_category_block_three'] );
        if ( true !== $category_block_three_enable ) {
            return false;
        }
        // Get Category Block Three section details
        $section_details = array();
        $section_details = apply_filters( 'daily_insight_filter_category_block_three_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Category Block Three section .
        daily_insight_render_category_block_three_section( $section_details ); 
    }
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_add_category_block_three', 30 );


if ( ! function_exists( 'daily_insight_get_category_block_three_section_details' ) ) :
    /**
     * Category Block Three section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Category Block Three section details.
     */
    function daily_insight_get_category_block_three_section_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Category Block Three type
        $category_block_three_content_type    = $options['category_block_three_type'];
        $content = array();

        switch ( $category_block_three_content_type ) {

            case 'category':

                $category = !empty( $options['category_block_three_category_type'] ) ? absint( $options['category_block_three_category_type'] ) : '';

                if ( ! empty( $category ) ) {

                    $args = array(
                        'cat'                 => $category,
                        'posts_per_page'      => 3,
                    );
                }
                if( !empty( $args ) ) :

                    $custom_posts = get_posts( $args );

                    $index = 0;
                    foreach ( $custom_posts as $key => $custom_post ) {

                        if ( has_post_thumbnail( $custom_post->ID ) ) {
                            if ( $index == 0 ) {
                                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-travel-long' );
                            } else {
                                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'daily-insight-category' );
                            }
                        }
                        else {
                            if ( $index == 0 ) {
                                $img_array = array ( get_template_directory_uri() . '/assets/uploads/no-featured-image-780x390.jpg' );
                            }
                            else{
                                $img_array = array ( get_template_directory_uri() . '/assets/uploads/no-featured-image-500x375.jpg' );
                            }
                        }
                        if ( isset( $img_array ) ) {
                            $content[$index]['img_array'] = $img_array;
                        }

                        $year  = get_the_time('Y', $custom_post->ID );
                        $month = get_the_time('m', $custom_post->ID );
                        $day   = get_the_time('d', $custom_post->ID );
                        
                        $content[$index]['date_link'] = get_day_link( $year, $month, $day );

                        $content[$index]['date']     = get_the_date( '' , $custom_post );
                        $content[$index]['title']    = get_the_title( $custom_post->ID );
                        $content[$index]['url']      = get_the_permalink( $custom_post->ID );
                        $content[$index]['terms']    = get_the_category( $custom_post->ID ); 
                        $contetn[$index]['excerpt']  = daily_insight_trim_content( 25, $custom_post );
                        $index++;
                    }
                endif;
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
// Category Block Three section content details.
add_filter( 'daily_insight_filter_category_block_three_section_details', 'daily_insight_get_category_block_three_section_details' );

if ( ! function_exists( 'daily_insight_render_category_block_three_section' ) ) :
    /**
     * Start section Category Block Three
     *
     * @return string Category Block Three content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_category_block_three_section( $content_details = array() ) {

        $options       = daily_insight_get_theme_options();
        $section_title = get_cat_name( $options['category_block_three_category_type'] );
        $section_link  = get_category_link( $options['category_block_three_category_type'] );
        $index         = 0;
        $count         = count( $content_details );

        if ( empty( $content_details ) ) {
            return;
        } 

        if( 'disabled' == $options['enable_main_slider'] || ( 'disabled' == $options['enable_main_slider'] && !$options['enable_breaking_news'] ) ){
            $section_class = 'margin-top-30';
        } else {
             $section_class = '';
        } ?>

        <section id="travel-category" class="travel-section page-section">
        <?php
        $section_icon =  !empty( $options['category_block_three_icon'] ) ?  $options['category_block_three_icon'] : '';

            if( ! empty ( $section_title ) ) : ?>
            <header class="entry-header">
                <h2 class="entry-title category-title"><i class="fa <?php echo esc_attr( $section_icon ); ?>"></i><?php echo esc_html( $section_title ); ?></h2> 
                <a href="<?php echo esc_url( $section_link ); ?>" class="view-more"><?php _e('View more','daily-insight' ); ?></a> 
            </header>
            <?php endif; ?>

            <div class="entry-content no-margin-top bg-white">
            <?php foreach( $content_details as $content ) : 
                    if( $index == 0 ) { ?>
                        <div class="post-category">
                            <?php if( !empty ( $content['img_array'][0] ) ) : ?>
                            <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>" >
                            <div class="overlay"></div></a>
                            <?php endif; ?>
                            <div class="category-contents-wrapper">
                                <h2 class="title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                <?php $post_categories = $content['terms'];
                                if( !empty ( $post_categories ) ) :
                                    
                                    foreach ( $post_categories as $post_category ) {
                                        $category_id   = $post_category->term_id;
                                        $category_name = $post_category->name;
                                        $category_url  = get_category_link( $category_id );
                                    ?>
                                    <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                <?php }
                                endif; ?>
                                <a href="<?php echo esc_url( $content['date_link'] ); ?>"><time><?php echo esc_html( $content['date'] ); ?></time></a>
                            </div><!-- .category-contents-wrapper -->
                        </div><!-- .post-category -->
                    <?php  }
                    else { 
                        if( $index == 1 ) echo '<div class="row two-columns">'; ?>
                            <div class="column-wrapper">
                                <?php if( !empty ( $content['img_array'][0] ) ) : ?>
                                <div class="image-wrapper">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>" >
                                    <div class="overlay"></div></a>
                                </div><!-- .image-wrapper -->
                                <?php endif; ?>
                                <div class="post-wrapper">
                                    <div class="post-title">
                                        <h5><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h5>
                                    </div><!-- .post-title -->
                                    <div class="category-wrap">
                                    <?php $post_categories = $content['terms'];
                                    if( !empty ( $post_categories ) ) :
                                      
                                        foreach ( $post_categories as $post_category ) {
                                            $category_id   = $post_category->term_id;
                                            $category_name = $post_category->name;
                                            $category_url  = get_category_link( $category_id );
                                        ?>
                                        <a class="category" href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category_name ); ?></a>
                                    <?php }
                                    endif; ?>
                                    </div><!-- .category-wrap -->

                                    <?php if( !empty ( $content['excerpt'] ) ) : ?>
                                    <div class="post-desc">
                                        <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                    </div><!-- .post-desc -->
                                    <?php endif; 
                                    $readmore_text = !empty( $options['readmore_text'] ) ? $options['readmore_text'] : '';
                                    if( !empty( $readmore_text ) ) : ?>
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="view-more"><?php echo esc_html( $readmore_text ); ?></a>
                                    <?php endif; ?>
                                </div><!-- .post-wrapper -->
                            </div><!-- .column-wrapper -->
                        <?php if( $index == ( $count - 1 ) ) echo '</div><!-- .row -->'; 
                } $index++; endforeach; ?>
            </div><!-- .entry-content -->
        </section><!-- #travel-category -->
    <?php }
endif;