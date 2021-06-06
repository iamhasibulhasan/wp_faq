<?php

/**
 * Customizer Header
 *
 * @package Arendelle
 * @since 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
// Logo
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'image',
    'settings' => 'arendelle_settings_logo_dark',
    'label'    => esc_html__( 'Upload logo', 'arendelle' ),
    'section'  => 'arendelle_settings_logo',
) );
// Logo retina
Kirki::add_field( 'arendelle_settings_config', array(
    'type'        => 'image',
    'settings'    => 'arendelle_settings_logo_dark_retina',
    'label'       => esc_html__( 'Upload retina logo', 'arendelle' ),
    'description' => esc_html__( 'Logo 2x bigger size', 'arendelle' ),
    'section'     => 'arendelle_settings_logo',
) );
// Show default header
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'toggle',
    'settings' => 'arendelle_settings_header_show',
    'label'    => esc_html__( 'Show default header', 'arendelle' ),
    'section'  => 'arendelle_settings_default_header',
    'default'  => true,
) );
// Sticky header
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'toggle',
    'settings'        => 'arendelle_settings_sticky_header_show',
    'label'           => esc_html__( 'Sticky header', 'arendelle' ),
    'description'     => esc_html__( 'Will apply only on big screens', 'arendelle' ),
    'section'         => 'arendelle_settings_default_header',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Header container width
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'slider',
    'settings'        => 'arendelle_settings_header_container_width',
    'label'           => esc_attr__( 'Header container width', 'arendelle' ),
    'section'         => 'arendelle_settings_default_header',
    'default'         => 1260,
    'choices'         => array(
    'min'  => '400',
    'max'  => '1920',
    'step' => '1',
),
    'output'          => array( array(
    'element'     => '.nav__container.container',
    'property'    => 'max-width',
    'units'       => 'px',
    'media_query' => $bp_xl_up,
) ),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
    'transport'       => 'auto',
) );
// Header height
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'slider',
    'settings'        => 'arendelle_settings_header_height',
    'label'           => esc_attr__( 'Header height', 'arendelle' ),
    'section'         => 'arendelle_settings_default_header',
    'default'         => 88,
    'choices'         => array(
    'min'  => '40',
    'max'  => '200',
    'step' => '1',
),
    'output'          => array( array(
    'element'     => '.arendelle-header-layout-1 .nav__flex-parent, .arendelle-header-layout-2 .nav__header, .arendelle-header-layout-3 .nav__flex-parent',
    'property'    => 'height',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
), array(
    'element'     => '.arendelle-header-layout-1, .arendelle-header-layout-3',
    'property'    => 'min-height',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
), array(
    'element'     => '.arendelle-header-layout-1 .nav__menu > li > a, .arendelle-header-layout-3 .nav__menu > li > a',
    'property'    => 'line-height',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
) ),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
    'transport'       => 'auto',
) );
// Header sticky height
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'slider',
    'settings'        => 'arendelle_settings_header_sticky_height',
    'label'           => esc_attr__( 'Header sticky height', 'arendelle' ),
    'section'         => 'arendelle_settings_default_header',
    'default'         => 60,
    'choices'         => array(
    'min'  => '40',
    'max'  => '200',
    'step' => '1',
),
    'output'          => array( array(
    'element'     => '.arendelle-header-layout-1 .nav--sticky.sticky .nav__flex-parent, .arendelle-header-layout-2 .nav--sticky.sticky .nav__header, .arendelle-header-layout-3 .nav--sticky.sticky .nav__flex-parent',
    'property'    => 'height',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
), array(
    'element'     => '.arendelle-header-layout-1 .nav--sticky.sticky .nav__menu > li > a, .arendelle-header-layout-3 .nav--sticky.sticky .nav__menu > li > a',
    'property'    => 'line-height',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
) ),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
    'transport'       => 'auto',
) );
// Header mobile height
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'slider',
    'settings'        => 'arendelle_settings_header_mobile_height',
    'label'           => esc_attr__( 'Header mobile height', 'arendelle' ),
    'section'         => 'arendelle_settings_mobile_header',
    'default'         => 60,
    'choices'         => array(
    'min'  => '40',
    'max'  => '200',
    'step' => '1',
),
    'output'          => array( array(
    'element'     => '.nav__header',
    'property'    => 'height',
    'units'       => 'px',
    'media_query' => $bp_lg_down,
), array(
    'element'     => '.nav',
    'property'    => 'min-height',
    'units'       => 'px',
    'media_query' => $bp_lg_down,
) ),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
    'transport'       => 'auto',
) );
// Logo width
Kirki::add_field( 'arendelle_settings_config', array(
    'type'      => 'slider',
    'settings'  => 'arendelle_settings_header_logo_width',
    'label'     => esc_attr__( 'Header logo width', 'arendelle' ),
    'section'   => 'arendelle_settings_logo',
    'default'   => 161,
    'choices'   => array(
    'min'  => '0',
    'max'  => '600',
    'step' => '1',
),
    'output'    => array( array(
    'element'  => '.nav__header .logo',
    'property' => 'max-width',
    'units'    => 'px',
) ),
    'transport' => 'auto',
) );
// Logo sticky width
Kirki::add_field( 'arendelle_settings_config', array(
    'type'      => 'slider',
    'settings'  => 'arendelle_settings_header_logo_sticky_width',
    'label'     => esc_attr__( 'Header logo sticky width', 'arendelle' ),
    'section'   => 'arendelle_settings_logo',
    'default'   => 161,
    'choices'   => array(
    'min'  => '0',
    'max'  => '600',
    'step' => '1',
),
    'output'    => array( array(
    'element'  => '.nav--sticky.sticky .nav__header .logo',
    'property' => 'max-width',
    'units'    => 'px',
) ),
    'transport' => 'auto',
) );
// Menu items horizontal spacing
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'slider',
    'settings'        => 'arendelle_settings_header_text_links_horizontal_spacing',
    'label'           => esc_attr__( 'Menu text links horizontal spacing', 'arendelle' ),
    'section'         => 'arendelle_settings_primary_menu',
    'default'         => 17,
    'choices'         => array(
    'min'  => '0',
    'max'  => '60',
    'step' => '1',
),
    'output'          => array( array(
    'element'     => '.nav__menu > li',
    'property'    => 'padding-left',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
), array(
    'element'     => '.nav__menu > li',
    'property'    => 'padding-right',
    'units'       => 'px',
    'media_query' => $bp_lg_up,
) ),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_show',
    'operator' => '==',
    'value'    => true,
) ),
    'transport'       => 'auto',
) );
// Last Menu Item Title
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'custom',
    'settings' => 'separator-' . $uniqid++,
    'section'  => 'arendelle_settings_primary_menu',
    'default'  => '<h3 class="customizer-title">' . esc_attr__( 'Last menu item', 'arendelle' ) . '</h3>',
) );
// Last Item: Search
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'checkbox',
    'settings' => 'arendelle_settings_header_last_menu_item_search',
    'label'    => esc_html__( 'Search', 'arendelle' ),
    'section'  => 'arendelle_settings_primary_menu',
    'default'  => true,
) );

if ( arendelle_is_woocommerce_activated() ) {
    // Last Item: Shopping cart
    Kirki::add_field( 'arendelle_settings_config', array(
        'type'     => 'checkbox',
        'settings' => 'arendelle_settings_header_last_menu_item_shopping_cart',
        'label'    => esc_html__( 'Shopping Cart', 'arendelle' ),
        'section'  => 'arendelle_settings_primary_menu',
        'default'  => true,
    ) );
    // Last Item: Account
    Kirki::add_field( 'arendelle_settings_config', array(
        'type'     => 'checkbox',
        'settings' => 'arendelle_settings_header_last_menu_item_account',
        'label'    => esc_html__( 'Account', 'arendelle' ),
        'section'  => 'arendelle_settings_primary_menu',
        'default'  => true,
    ) );
}

// Last Item: HTML
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'checkbox',
    'settings' => 'arendelle_settings_header_last_menu_item_html',
    'label'    => esc_html__( 'HTML', 'arendelle' ),
    'section'  => 'arendelle_settings_primary_menu',
    'default'  => false,
) );
// Last Item: Text / HTML
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'code',
    'settings'        => 'arendelle_settings_header_last_menu_item_text_html',
    'label'           => esc_html__( 'Text / HTML / Shortcode', 'arendelle' ),
    'section'         => 'arendelle_settings_primary_menu',
    'choices'         => array(
    'language' => 'html',
),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_header_last_menu_item_html',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Hide last menu item on mobile
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'toggle',
    'settings' => 'arendelle_settings_header_last_menu_item_hide',
    'label'    => esc_attr__( 'Hide last menu item on mobile', 'arendelle' ),
    'section'  => 'arendelle_settings_primary_menu',
    'default'  => false,
) );
// Show top bar
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'toggle',
    'settings' => 'arendelle_settings_top_bar_show',
    'label'    => esc_html__( 'Show top bar', 'arendelle' ),
    'section'  => 'arendelle_settings_top_bar',
    'default'  => false,
) );
// Top bar message
Kirki::add_field( 'arendelle_settings_config', array(
    'type'              => 'text',
    'settings'          => 'arendelle_settings_top_bar_message',
    'section'           => 'arendelle_settings_top_bar',
    'label'             => esc_html__( 'Top bar meesage', 'arendelle' ),
    'description'       => esc_html__( 'Allowed HTML: a, img, span, i, em, strong', 'arendelle' ),
    'default'           => esc_html__( 'Free Shipping & Returns On All US Orders', 'arendelle' ),
    'sanitize_callback' => 'wp_kses_post',
    'active_callback'   => array( array(
    'setting'  => 'arendelle_settings_top_bar_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Top bar URL
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'url',
    'settings'        => 'arendelle_settings_top_bar_url',
    'section'         => 'arendelle_settings_top_bar',
    'label'           => esc_html__( 'Top bar URL', 'arendelle' ),
    'default'         => '#',
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_top_bar_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Vertical Header

if ( class_exists( 'Arendelle_Core_Theme_Templates' ) ) {
    $custom_headers = \Arendelle_Core_Theme_Templates::get_theme_headers();
    $header_vertical = false;
    foreach ( $custom_headers as $key => $value ) {
        $location = get_post_meta( $key, '_arendelle_template_location', true );
        if ( 'header-vertical' === $location ) {
            $header_vertical = true;
        }
    }
    
    if ( $header_vertical ) {
        // Header width
        Kirki::add_field( 'arendelle_settings_config', array(
            'type'        => 'slider',
            'settings'    => 'arendelle_settings_vertical_header_width',
            'label'       => esc_html__( 'Vertical header width', 'arendelle' ),
            'description' => esc_html__( 'Applies above 1200px breakpoint.', 'arendelle' ),
            'section'     => 'arendelle_settings_vertical_header',
            'default'     => 270,
            'choices'     => array(
            'min'  => '100',
            'max'  => '800',
            'step' => '1',
        ),
            'output'      => array( array(
            'element'     => '.eversor-header-vertical--left',
            'property'    => 'margin-left',
            'units'       => 'px',
            'media_query' => $bp_xl_down,
        ), array(
            'element'     => '.eversor-header-vertical--right',
            'property'    => 'margin-right',
            'units'       => 'px',
            'media_query' => $bp_xl_down,
        ), array(
            'element'     => '.eversor-header--vertical',
            'property'    => 'width',
            'units'       => 'px',
            'media_query' => $bp_xl_down,
        ) ),
            'transport'   => 'auto',
        ) );
        // Header position
        Kirki::add_field( 'arendelle_settings_config', array(
            'type'     => 'select',
            'settings' => 'arendelle_settings_vertical_header_position',
            'label'    => esc_html__( 'Vertical header position', 'arendelle' ),
            'section'  => 'arendelle_settings_vertical_header',
            'default'  => 'left',
            'choices'  => array(
            'left'  => esc_html__( 'Left', 'arendelle' ),
            'right' => esc_html__( 'Right', 'arendelle' ),
        ),
        ) );
    }

}
