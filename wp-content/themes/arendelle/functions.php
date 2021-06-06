<?php

/**
 * Theme functions and definitions.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
// Set the content width based on the theme's design and stylesheet.

if ( !isset( $content_width ) ) {
    $content_width = 1260;
    /* pixels */
}

// Constants
define( 'ARENDELLE_VERSION', '1.0.8' );
define( 'ARENDELLE_DIR', get_template_directory() );
define( 'ARENDELLE_URI', get_template_directory_uri() );
define( 'ARENDELLE_ENVATO_PURCHASE', false );

if ( !function_exists( 'arendelle_fs' ) ) {
    // Create a helper function for easy SDK access.
    function arendelle_fs()
    {
        global  $arendelle_fs ;
        
        if ( !isset( $arendelle_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $arendelle_fs = fs_dynamic_init( array(
                'id'             => '8285',
                'slug'           => 'arendelle',
                'premium_slug'   => 'arendelle-pro',
                'type'           => 'theme',
                'public_key'     => 'pk_0bed4831c2338e39c38272f6e94df',
                'is_premium'     => false,
                'premium_suffix' => 'Pro',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'    => 'arendelle-theme',
                'support' => false,
                'parent'  => array(
                'slug' => 'themes.php',
            ),
            ),
                'is_live'        => true,
            ) );
        }
        
        return $arendelle_fs;
    }
    
    // Init Freemius.
    arendelle_fs();
    // Signal that SDK was initiated.
    do_action( 'arendelle_fs_loaded' );
}

/**
 * Includes
 */
require_once ARENDELLE_DIR . '/includes/admin/theme-admin.php';
require_once ARENDELLE_DIR . '/includes/theme-setup.php';
require_once ARENDELLE_DIR . '/includes/theme-functions.php';
require_once ARENDELLE_DIR . '/includes/theme-hooks.php';
require_once ARENDELLE_DIR . '/includes/template-tags.php';
require_once ARENDELLE_DIR . '/includes/template-parts.php';
require_once ARENDELLE_DIR . '/includes/class-arendelle-breadcrumb-trail.php';
require_once ARENDELLE_DIR . '/includes/class-arendelle-query.php';
require_once ARENDELLE_DIR . '/includes/class-arendelle-walker-nav-menu.php';
require_once ARENDELLE_DIR . '/includes/class-arendelle-walker-comment.php';
require_once ARENDELLE_DIR . '/includes/customizer/customizer.php';
/**
 * Update theme
 */
require_once ARENDELLE_DIR . '/includes/theme-update/class-arendelle-theme-update.php';
/**
* TGM plugins activation.
*/
require_once ARENDELLE_DIR . '/includes/tgmpa/tgm-plugin-activation.php';
/**
* Demo Import.
*/
require_once ARENDELLE_DIR . '/includes/theme-demo-import.php';
/**
* Themely functions.
*/
require_once ARENDELLE_DIR . '/includes/themely.php';
/**
 * Compatibility
 */

if ( arendelle_is_woocommerce_activated() ) {
    require_once ARENDELLE_DIR . '/includes/compatibility/woocommerce/class-arendelle-woocommerce.php';
    require_once ARENDELLE_DIR . '/includes/compatibility/woocommerce/woocommerce-theme-functions.php';
    require_once ARENDELLE_DIR . '/includes/compatibility/woocommerce/woocommerce-theme-hooks.php';
    
    if ( class_exists( 'YITH_WCQV' ) ) {
        // Remove a tag from product and replace it with div
        add_action( 'yith_wcqv_init', 'remove_quickview' );
        function remove_quickview()
        {
            remove_action( 'woocommerce_after_shop_loop_item', 'yith_add_quick_view_button', 9999 );
        }
    
    }

}

if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
    require_once ARENDELLE_DIR . '/includes/compatibility/class-arendelle-elementor.php';
}
/**
 * Theme styles.
 */
function arendelle_theme_styles()
{
    wp_enqueue_style(
        'arendelle-styles',
        ARENDELLE_URI . '/style.min.css',
        array(),
        ARENDELLE_VERSION,
        'all'
    );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    // WooCommerce styles
    
    if ( arendelle_is_woocommerce_activated() ) {
        wp_register_style(
            'arendelle-woocommerce',
            ARENDELLE_URI . '/assets/css/compatibility/woocommerce/woocommerce.min.css',
            array(),
            ARENDELLE_VERSION
        );
        wp_enqueue_style( 'arendelle-woocommerce' );
    }
    
    // YITH Wishlist styles
    
    if ( defined( 'YITH_WCWL' ) && arendelle_is_woocommerce_activated() ) {
        function yith_wcwl_dequeue_font_awesome_styles()
        {
            wp_deregister_style( 'woocommerce_prettyPhoto_css' );
            wp_deregister_style( 'jquery-selectBox' );
            wp_deregister_style( 'yith-wcwl-font-awesome' );
            wp_deregister_style( 'yith-wcwl-main' );
            $assets_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
            wp_register_style(
                'jquery-selectBox',
                YITH_WCWL_URL . 'assets/css/jquery.selectBox.css',
                array(),
                '1.2.0'
            );
            wp_register_style( 'woocommerce_prettyPhoto_css', $assets_path . 'css/prettyPhoto.css' );
            wp_register_style(
                'yith-wcwl-main',
                YITH_WCWL_URL . 'assets/css/style.css',
                array( 'jquery-selectBox' ),
                '1.0.0'
            );
        }
        
        add_action( 'wp_enqueue_scripts', 'yith_wcwl_dequeue_font_awesome_styles', 11 );
    }
    
    // Cookies bar styles
    if ( get_theme_mod( 'arendelle_settings_cookies_bar_show', false ) ) {
        wp_enqueue_style( 'cookieconsent', ARENDELLE_URI . '/assets/css/cookieconsent.min.css' );
    }
    // Fonts
    if ( !class_exists( 'Kirki' ) ) {
        wp_enqueue_style( 'arendelle-google-fonts', '//fonts.googleapis.com/css2?family=PT+Serif:ital@0;1&family=Jost:wght@400;500&display=swap' );
    }
}

add_action( 'wp_enqueue_scripts', 'arendelle_theme_styles' );
/**
 * Block editor styles.
 */
function arendelle_block_assets()
{
    wp_enqueue_style( 'arendelle-block-editor-styles', get_theme_file_uri( '/assets/css/editor.min.css' ), false );
    if ( function_exists( 'arendelle_get_typekit_fonts' ) ) {
        $typekit_fonts = arendelle_get_typekit_fonts();
    }
    
    if ( !empty($typekit_fonts) ) {
        $typekit_info = get_option( 'arendelle-typekit-fonts' );
        $typekit_id = $typekit_info['custom-typekit-font-id'];
        if ( !empty($typekit_id) ) {
            wp_enqueue_style( 'arendelle-typekit-fonts', '//use.typekit.net/' . $typekit_id . '.css' );
        }
    }
    
    if ( !class_exists( 'Kirki' ) || empty($typekit_fonts) ) {
        wp_enqueue_style( 'arendelle-block-editor-google-fonts', '//fonts.googleapis.com/css2?family=PT+Serif:ital@0;1&family=Jost:wght@400;500&display=swap' );
    }
}

add_action( 'enqueue_block_editor_assets', 'arendelle_block_assets' );
/**
 * Theme scripts.
 */
function arendelle_theme_scripts()
{
    
    if ( is_archive() || is_search() || is_home() ) {
        wp_enqueue_script( 'masonry' );
        wp_enqueue_script( 'imagesloaded' );
    }
    
    wp_enqueue_script(
        'arendelle-vendor-scripts',
        ARENDELLE_URI . '/assets/js/vendors.min.js',
        array(),
        ARENDELLE_VERSION,
        true
    );
    wp_register_script(
        'arendelle-scripts',
        ARENDELLE_URI . '/assets/js/scripts.min.js',
        array( 'arendelle-vendor-scripts' ),
        ARENDELLE_VERSION,
        true
    );
    wp_enqueue_script( 'arendelle-scripts' );
    $Arendelle_Data = array(
        'home_url'   => esc_url( home_url( '/' ) ),
        'theme_path' => ARENDELLE_URI,
    );
    wp_localize_script( 'arendelle-scripts', 'Arendelle_Data', $Arendelle_Data );
}

add_action( 'wp_enqueue_scripts', 'arendelle_theme_scripts' );
/**
 * Theme admin scripts and styles.
 */
function arendelle_admin_scripts()
{
    $screen = get_current_screen();
    wp_enqueue_style( 'arendelle-admin-styles', ARENDELLE_URI . '/assets/admin/css/arendelle-admin-styles.css' );
    
    if ( $screen->id === 'appearance_page_one-click-demo-import' ) {
        wp_register_script(
            'arendelle-admin-scripts',
            ARENDELLE_URI . '/assets/admin/js/arendelle-admin-scripts.js',
            array( 'jquery-core' ),
            false,
            true
        );
        wp_enqueue_script( 'arendelle-admin-scripts' );
    }

}

add_action( 'admin_enqueue_scripts', 'arendelle_admin_scripts' );
function arendelle_envato_freemius()
{
    if ( !ARENDELLE_ENVATO_PURCHASE ) {
        return;
    }
    echo  '<style>
    .fs-license-key-container a.show-license-resend-modal { display:none; }
  </style>' ;
}

add_action( 'admin_head', 'arendelle_envato_freemius' );
/**
 * Theme WP Customizer scripts and styles.
 */
function arendelle_customizer_scripts()
{
    wp_enqueue_style( 'arendelle-customizer-styles', ARENDELLE_URI . '/assets/css/customizer/customizer.css' );
}

add_action( 'customize_controls_enqueue_scripts', 'arendelle_customizer_scripts' );