<?php
/**
 * Daily Insight functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 */

if ( ! function_exists( 'daily_insight_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function daily_insight_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Daily Insight, use a find and replace
	 * to change 'daily-insight' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'daily-insight', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'daily-insight' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery'
	) );

	// custom image size
	add_image_size( 'daily-insight-latest-post', 525, 350, true );
	add_image_size( 'daily-insight-main-slider', 1280, 500, true );
	add_image_size( 'daily-insight-travel-long', 780, 390, true );
	add_image_size( 'daily-insight-category', 500, 375, true );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'daily_insight_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// This setup supports logo, site-title & site-description
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 120,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.min.css' ) );

	// Make theme woocommerce ready
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'daily_insight_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function daily_insight_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'daily_insight_content_width', 640 );
}
add_action( 'after_setup_theme', 'daily_insight_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function daily_insight_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'daily-insight' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'daily-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'daily_insight_widgets_init' );


if ( ! function_exists( 'daily_insight_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function daily_insight_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Montserrat Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Droid Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Droid Serif font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Droid Serif:400';
	}

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Courgette font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Courgette:400';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Roboto:400,500,300';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Raleway:400,100,300,500,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'daily-insight' ) ) {
		$fonts[] = 'Poppins:400,500,600';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function daily_insight_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'daily-insight-fonts', daily_insight_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/css/font-awesome.min.css', array(), '4.6.3', false );

	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/css/slick.min.css', array(), '1.6.0', false );

	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/css/slick-theme.min.css', array(), '1.6.0', false );

	wp_enqueue_style( 'jquery-sidr-light', get_template_directory_uri() . '/assets/plugins/css/jquery.sidr.light.min.css', array(), '2.2.1', false );

	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/assets/plugins/css/prettyPhoto.min.css', array(), '3.1.6', false );

	wp_enqueue_style( 'daily-insight-style', get_stylesheet_uri() );

	wp_enqueue_script( 'daily-insight-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'daily-insight-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'sidr', get_template_directory_uri() . '/assets/plugins/js/jquery.sidr.min.js', array('jquery'), '2.2.1', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/plugins/js/slick.min.js', array(), '1.6.0', true );

	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/assets/plugins/js/jquery.prettyPhoto.min.js', array('jquery'), '3.1.6', true );

	// Custom js
	wp_enqueue_script( 'daily-insight-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'daily_insight_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';

/**
 * filter hook to modify wp author profile box lite plugin hook
 */
if(class_exists('Wp_Author_Profile_Box_Lite_Front') || class_exists('Wp_Author_Profile_Box_Front') ):
function daily_insight_custom_filter_hook_author() {
    return 'custom_author';    
}
add_filter( 'author_box_filter', 'daily_insight_custom_filter_hook_author');
endif;
