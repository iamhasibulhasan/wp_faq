<?php
/**
 * Theme setup.
 *
 * @package Arendelle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


if ( ! function_exists( 'arendelle_setup' ) ) :
	/**
	* Sets up theme defaults and registers support for various WordPress features.
	*
	* Note that this function is hooked into the after_setup_theme hook, which
	* runs before the init hook. The init hook is too late for some features, such
	* as indicating support for post thumbnails.
	*/
	function arendelle_setup() {

		global $pagenow;
		
		load_theme_textdomain( 'arendelle', ARENDELLE_DIR . '/languages' );

		// Enable theme support
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'navigation-widgets', 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background', apply_filters( 'arendelle_custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		if ( arendelle_is_woocommerce_activated() ) {
			add_theme_support( 'woocommerce', array(
				'thumbnail_image_width' => 295,
				'gallery_thumbnail_image_width' => 120,
				'single_image_width' => 694,
				'product_grid'      => array(
					'default_columns' => 3,
					'default_rows'    => 3,
				),
			) );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

		// Gutenberg
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_editor_style();

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'blue', 'arendelle' ),
				'slug' => 'blue',
				'color' => '#024E82',
			),
			array(
				'name' => esc_html__( 'orange', 'arendelle' ),
				'slug' => 'orange',
				'color' => '#D6763C',
			),
			array(
				'name' => esc_html__( 'dark', 'arendelle' ),
				'slug' => 'dark',
				'color' => '#0c0c0c',
			),
			array(
				'name' => esc_html__( 'silver', 'arendelle' ),
				'slug' => 'silver',
				'color' => '#FBFBFB',
			),
			array(
				'name' => esc_html__( 'white', 'arendelle' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
			array(
				'name' => esc_html__( 'black', 'arendelle' ),
				'slug' => 'black',
				'color' => '#000000',
			),

		) );

		// Redirect on theme activation
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			wp_redirect( admin_url( 'themes.php?page=arendelle-theme' ) );
		}


		// Thumbnails
		add_image_size( 'arendelle_featured_medium', 914, 0, false );
		add_image_size( 'arendelle_featured_large', 1240, 0, false );

		// Nav menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'arendelle' ),
			'footer-bottom-menu' => esc_html__( 'Footer Bottom Menu', 'arendelle' ),
		) );
		
		// Disable WooCommerce wizard redirect
		add_filter('woocommerce_enable_setup_wizard', '__return_false');
		add_filter('woocommerce_show_admin_notice', '__return_false');
		add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_false');

		// Disable Kirki telemetry
		add_filter( 'kirki_telemetry', '__return_false' );

		// Remove admin notices for Instagram Feed
		update_option( 'sbi_rating_notice', 'dismissed' );
		remove_action( 'admin_notices', 'sbi_usage_tracking' );
		remove_action( 'admin_notices', 'sbi_usage_opt_in' );
		remove_action( 'admin_notices', 'sbi_notices_html' );

	}
endif; // theme_setup
add_action( 'after_setup_theme', 'arendelle_setup' );


// Update Elementor Defaults
if ( 1 != get_option( 'arendelle_elementor_defaults', 0 ) ) {
	add_option( 'arendelle_elementor_defaults', 0 );
}

/**
* Update Elementor defaults.
*/
function arendelle_update_elementor_defaults() {
	if ( 1 != get_option( 'arendelle_elementor_defaults' ) ) {
		update_option( 'elementor_cpt_support', array(
			'post',
			'page',
			'theme_template'
		) );
		
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'arendelle_elementor_defaults', 1 );
	}
}
add_action( 'init', 'arendelle_update_elementor_defaults' );


/**
* Disable Elementor redirect.
*/
add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );


/**
* Register widget areas.
*/
function arendelle_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'arendelle' ),
		'id'            => 'arendelle-blog-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'arendelle' ),
		'id'            => 'arendelle-page-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( arendelle_is_woocommerce_activated() ) {

		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'arendelle' ),
			'id'            => 'arendelle-shop-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	}

	register_sidebar( array(
		'name'          => esc_html__( 'Newsletter', 'arendelle' ),
		'id'            => 'arendelle-newsletter',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'arendelle' ),
		'id'            => 'arendelle-footer-col-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'arendelle' ),
		'id'            => 'arendelle-footer-col-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'arendelle' ),
		'id'            => 'arendelle-footer-col-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'arendelle' ),
		'id'            => 'arendelle-footer-col-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arendelle_widgets_init' );