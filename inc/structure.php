<?php
/**
 * Daily Insight basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

$options = daily_insight_get_theme_options();


if ( ! function_exists( 'daily_insight_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Daily Insight 0.1
	 */
	function daily_insight_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'daily_insight_doctype', 'daily_insight_doctype', 10 );


if ( ! function_exists( 'daily_insight_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'daily_insight_before_wp_head', 'daily_insight_head', 10 );

if ( ! function_exists( 'daily_insight_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'daily-insight' ); ?></a>

		<?php
	}
endif;

add_action( 'daily_insight_page_start_action', 'daily_insight_page_start', 10 );

if ( ! function_exists( 'daily_insight_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'daily_insight_page_end_action', 'daily_insight_page_end', 10 );

if ( ! function_exists( 'daily_insight_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_header_start() {
		$options = daily_insight_get_theme_options();
		$class = $options['enable_breaking_news'];
		if( $options['enable_breaking_news'] == true )
			$class = '';
		else
			$class = ' margin-bottom';
		?>
		<header id="masthead" class="site-header<?php echo $class; ?>" role="banner">
		<?php
	}
endif;
add_action( 'daily_insight_header_action', 'daily_insight_header_start', 10 );

if ( ! function_exists( 'daily_insight_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_site_branding() {
		?>
		<div class="container">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo">
            		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_custom_logo(); ?></a>
          		</div>
          		<?php endif; ?>
          		<div id="site-header">
				<?php
				if ( is_front_page() || is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html( $description );  /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
				</div><!-- #site-header -->
			</div><!-- .site-branding -->
			<?php if ( is_active_sidebar( 'header_ad_image_widget' ) ) { ?>
			<div class="google-ad">
          		<a href="#">
          			<?php dynamic_sidebar( 'header_ad_image_widget' ); ?>
          		</a>
        	</div>
			<?php } ?>
		</div><!-- .container -->
		<?php
	}
endif;
add_action( 'daily_insight_header_action', 'daily_insight_site_branding', 20 );

if ( ! function_exists( 'daily_insight_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_site_navigation() {
		if( has_nav_menu( 'primary' ) ) { ?>
			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'menu nav-menu container','container' => false, ) ); ?>
			</nav><!-- #site-navigation -->
		<?php }
	}
endif;
add_action( 'daily_insight_header_action', 'daily_insight_site_navigation', 30 );


if ( ! function_exists( 'daily_insight_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'daily_insight_header_action', 'daily_insight_header_end', 50 );

if ( ! function_exists( 'daily_insight_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'daily_insight_content_start_action', 'daily_insight_content_start', 10 );

if ( ! function_exists( 'daily_insight_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'daily_insight_content_end_action', 'daily_insight_content_end', 10 );

if ( ! function_exists( 'daily_insight_front_page_container_start' ) ) :
	/**
	 * Site Front Page Container Start Codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_front_page_container_start() {
		?>
		<div class="container page-section">
	        <div id="primary" class="content-area os-animation" style="opacity: 1;">
	          	<main id="main" class="site-main" role="main">
		<?php
	}
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_front_page_container_start', 10 );

if ( ! function_exists( 'daily_insight_front_page' ) ) :
	/**
	 * Site Front Page Codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_front_page() {
		if ( true === apply_filters( 'daily_insight_filter_frontpage_content_enable', true ) ) : 
			if ( have_posts() ) :			

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'page' );
				
				endwhile;
				wp_reset_postdata();

			else :

				get_template_part( 'template-parts/content', 'none' ); 

			endif; 
		endif;
	}
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_front_page', 70 );


if ( ! function_exists( 'daily_insight_front_page_container_end' ) ) :
	/**
	 * Site Front Page Container End Codes
	 *
	 * @since Daily Insight 0.1
	 *
	 */
	function daily_insight_front_page_container_end() {
		?>
				</main><!-- #main -->		
			</div><!-- .primary -->
		
			<?php 
				if ( daily_insight_is_sidebar_enable() ) {
					get_sidebar();
			}
			?>
		</div><!-- .container -->
		<?php
	}
endif;
add_action( 'daily_insight_front_page_container_action', 'daily_insight_front_page_container_end', 80 );