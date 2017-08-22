<?php
/**
 * aviator functions and definitions
 *
 * @package aviator
 */

include get_template_directory() . '/extras/webfonts/webfonts.php';
include get_template_directory() . '/extras/settings/settings.php';

define( 'SITEORIGIN_THEME_VERSION' , '1.0' );

if ( ! function_exists( 'aviator_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aviator_setup() {

	siteorigin_settings_init();

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on aviator, use a find and replace
	 * to change 'aviator' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aviator', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded title tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aviator' ),
		'secondary' => __( 'Secondary Menu', 'aviator' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aviator_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'siteorigin-panels', array(
		'home-page' => true,
		'home-page-default' => 'default-home',
		'home-demo-template' => 'home-panels.php',
	) );

	if( !function_exists('siteorigin_panels_render') ) {
		// Lite version of Page Builder for basic rendering.
		include get_template_directory() . '/inc/panels-lite/panels-lite.php';
	}

	// Add Maven Pro, the logo font
	siteorigin_webfonts_add_font( 'Raleway', array(300) );
}
endif; // aviator_setup
add_action( 'after_setup_theme', 'aviator_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aviator_content_width() {
	global $content_width;
	$content_width = apply_filters( 'aviator_content_width', 694 );
}
add_action( 'after_setup_theme', 'aviator_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aviator_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'aviator' ),
		'id'            => 'sidebar-main',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'aviator' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'aviator_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aviator_scripts() {
	$js_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'aviator-style', get_stylesheet_uri(), array(), SITEORIGIN_THEME_VERSION );

	wp_enqueue_script( 'aviator-navigation', get_template_directory_uri() . '/js/navigation' . $js_suffix . '.js', array(), SITEORIGIN_THEME_VERSION, true );

	wp_enqueue_script( 'aviator-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $js_suffix . '.js', array(), SITEORIGIN_THEME_VERSION, true );

	wp_enqueue_script( 'aviator-sticky', get_template_directory_uri() . '/js/jquery.sticky' . $js_suffix . '.js', array('jquery'), SITEORIGIN_THEME_VERSION, true );
	wp_enqueue_script( 'aviator-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . $js_suffix . '.js', array('jquery'), SITEORIGIN_THEME_VERSION, true );
	wp_enqueue_script( 'aviator-theme', get_template_directory_uri() . '/js/theme' . $js_suffix . '.js', array('jquery'), SITEORIGIN_THEME_VERSION, true );

	wp_localize_script( 'aviator-theme', 'aviator', array(
		'navSticky' => siteorigin_setting('navigation_sticky_menu')
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aviator_scripts' );

/**
 * Add custom body classes.
 *
 * @param $classes
 *
 * @return array
 * @package aviator
 * @since 1.0
 */
function aviator_body_class($classes){

	$classes[] = !is_active_sidebar('sidebar-main') ? 'no-sidebar' : 'has-sidebar';

	if( wp_is_mobile() ) {
		$classes[] = 'mobile-device';
	}

	return $classes;
}
add_filter('body_class', 'aviator_body_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizations .
 */
require get_template_directory() . '/inc/comments.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page Builder compatibility files.
 */
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/panels-missing-widgets.php';

/**
 * Theme settings configurations.
 */
include get_template_directory() . '/inc/settings.php';