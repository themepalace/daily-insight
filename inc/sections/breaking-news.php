<?php
/**
 * Breaking News section
 *
 * This is the template for the content of Breaking News section.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */
if ( ! function_exists( 'daily_insight_add_breaking_news_section' ) ) :
    /**
     * Add Breaking News section
     *
     * @since Daily Insight 0.1
     */
    function daily_insight_add_breaking_news_section() {

        // Check if Breaking News is enabled on frontpage
        $options = daily_insight_get_theme_options(); 

        $breaking_news_enable = (bool)( $options['enable_breaking_news'] );
        if ( true !== $breaking_news_enable ) {
            return false;
        }
        // Get Breaking News section details
        $section_details = array();
        $section_details = apply_filters( 'daily_insight_filter_breaking_news_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Breaking News section .
        daily_insight_render_breaking_news_section( $section_details );
    }
endif;
add_action( 'daily_insight_content_start_action', 'daily_insight_add_breaking_news_section', 20 );


if ( ! function_exists( 'daily_insight_get_breaking_news_section_details' ) ) :
    /**
     * Breaking News section details.
     *
     * @since Daily Insight 0.1
     *
     * @param array $input Breaking News section details.
     */
    function daily_insight_get_breaking_news_section_details( $input ) {
        $options = daily_insight_get_theme_options(); 

        // Breaking News type
        $breaking_news_content_type    = $options['breaking_news_type'];

        $content = array();

        switch ( $breaking_news_content_type ) {

            case 'category':
            
                $no_of_posts = 3;               
                $category = !empty( $options['breaking_news_category_type'] ) ? absint( $options['breaking_news_category_type'] ) : '';

                if ( ! empty( $category ) ) {

                $args = array(
                    'cat'                 => $category,
                    'posts_per_page'      => $no_of_posts,
                );

                $custom_posts = get_posts( $args );

                    $i = 0;
                    foreach ( $custom_posts as $key => $custom_post ) {

                        $year  = get_the_time('Y', $custom_post->ID );
                        $month = get_the_time('m', $custom_post->ID );
                        $day   = get_the_time('d', $custom_post->ID );

                        $content[$i]['date']          = get_the_date( '' , $custom_post );
                        $content[$i]['date_link']     = get_day_link( $year, $month, $day );
                        $content[$i]['title']         = get_the_title( $custom_post->ID );
                        $content[$i]['url']           = get_the_permalink( $custom_post->ID );
                    $i++;
                    }
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
// Breaking News section content details.
add_filter( 'daily_insight_filter_breaking_news_section_details', 'daily_insight_get_breaking_news_section_details' );

if ( ! function_exists( 'daily_insight_render_breaking_news_section' ) ) :
    /**
     * Start section Breaking news
     *
     * @return string Breaking News content
     * @since Daily Insight 0.1
     *      
     */
    function daily_insight_render_breaking_news_section( $content_details = array() ) {

        $options = daily_insight_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <section id="breaking-news" class="page-section bg-white">
            <div class="container">
                <?php 
                    $section_title = $options['breaking_news_title']; 
                if( ! empty ( $section_title ) ):?>
                    <header class="entry-header color-white">
                        <h2 class="entry-title"><?php echo esc_html( $section_title ); ?></h2>  
                    </header><!-- .entry-header -->
                <?php endif;?>

                <div class="entry-content regular" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": false, "arrows":false, "autoplay": true, "fade": false }'>
                    <?php foreach( $content_details as $content ) : 
                        if( !empty ($content['title'] ) ) : ?>
                            <div class="slider-item">
                                <div class="breaking-news-wrapper">
                                    <div class="posted-on">
                                        <a href="<?php echo esc_url( $content['date_link'] ); ?>"><span class="time"><?php echo esc_html( $content['date'] );?></span></a>
                                    </div><!-- .posted-on -->
                                    <div class="breaking-news-title">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>"><h6><?php echo esc_html( $content['title'] );?></h6></a>
                                    </div>
                                </div>
                            </div><!-- .slider-item -->
                        <?php endif; 
                    endforeach; ?>
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </section><!-- #recent-courses-slider -->
<?php
    }
endif;