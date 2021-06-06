<?php

/**
 * Theme Demo Import.
 *
 * @package Arendelle
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/*
* Demo Import
*/
function arendelle_ocdi_import_files()
{
    return array( array(
        'import_file_name'           => 'Demo Import Free',
        'categories'                 => array( 'Category 1', 'Category 2' ),
        'import_file_url'            => 'https://arendelle-free.deothemes.com/import/demo-content.xml',
        'import_widget_file_url'     => 'https://arendelle-free.deothemes.com/import/widgets.wie',
        'import_customizer_file_url' => 'https://arendelle-free.deothemes.com/import/customizer.dat',
    ) );
}

add_filter( 'pt-ocdi/import_files', 'arendelle_ocdi_import_files' );
/*
* OCDI plugins
*/
function arendelle_ocdi_register_plugins( $plugins )
{
    $plugins = [
        [
        'name'     => 'Kirki',
        'slug'     => 'kirki',
        'required' => true,
    ],
        [
        'name'     => 'Elementor',
        'slug'     => 'elementor',
        'required' => true,
    ],
        [
        'name'     => 'WooCommerce',
        'slug'     => 'woocommerce',
        'required' => true,
    ],
        [
        'name'     => 'Contact Form 7',
        'slug'     => 'contact-form-7',
        'required' => false,
    ],
        [
        'name'     => 'Smash Balloon Social Photo Feed',
        'slug'     => 'instagram-feed',
        'required' => false,
    ],
        [
        'name'     => 'MailChimp for WordPress',
        'slug'     => 'mailchimp-for-wp',
        'required' => false,
    ],
        [
        'name'     => 'YITH WooCommerce Quick View',
        'slug'     => 'yith-woocommerce-quick-view',
        'required' => false,
    ],
        [
        'name'     => 'YITH WooCommerce Wishlist',
        'slug'     => 'yith-woocommerce-wishlist',
        'required' => false,
    ]
    ];
    return $plugins;
}

add_filter( 'ocdi/register_plugins', 'arendelle_ocdi_register_plugins' );
/**
* Rewrite permalinks before import.
*/
function arendelle_rewrite_permalinks()
{
    $permalinks = get_option( 'permalink_structure' );
    // Abort if already saved to something else
    if ( !$permalinks ) {
        return;
    }
    global  $wp_rewrite ;
    $wp_rewrite->set_permalink_structure( null );
    update_option( 'rewrite_rules', FALSE );
    $wp_rewrite->flush_rules( true );
}

add_action( 'pt-ocdi/before_content_import', 'arendelle_rewrite_permalinks' );
/**
* Assign menus and front page after demo import
*
* @param array $selected_import array with demo import data
*/
function arendelle_ocdi_after_import( $selected_import )
{
    // Assign menus to their locations.
    $primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Footer Bottom Menu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array(
        'primary-menu'       => $primary_menu->term_id,
        'footer-bottom-menu' => $footer_menu->term_id,
    ) );
    update_option( 'woocommerce_shop_page_id', 2146 );
    update_option( 'woocommerce_cart_page_id', 2147 );
    update_option( 'woocommerce_checkout_page_id', 2148 );
    update_option( 'woocommerce_myaccount_page_id', 2149 );
    // Assign front page based on demo import
    switch ( $selected_import['import_file_name'] ) {
        case 'Demo Import Pro':
            $front_page_id = get_page_by_title( 'Home Main' );
            $blog_page_id = get_page_by_title( 'Blog' );
            update_option( 'page_on_front', $front_page_id->ID );
            break;
        case 'Demo Import Free':
            $front_page_id = get_page_by_title( 'Home' );
            $blog_page_id = get_page_by_title( 'Blog' );
            update_option( 'page_on_front', $front_page_id->ID );
            break;
        default:
            break;
    }
    update_option( 'show_on_front', 'page' );
    update_option( 'page_for_posts', $blog_page_id->ID );
    update_option( 'elementor_active_kit', 1333 );
    flush_rewrite_rules();
}

add_action( 'pt-ocdi/after_import', 'arendelle_ocdi_after_import' );