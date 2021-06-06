<?php

/**
 * Customizer Footer
 *
 * @package Arendelle
 * @since 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
// Show footer
Kirki::add_field( 'arendelle_settings_config', array(
    'type'     => 'toggle',
    'settings' => 'arendelle_settings_footer_show',
    'label'    => esc_html__( 'Show default footer', 'arendelle' ),
    'section'  => 'arendelle_settings_footer',
    'default'  => true,
) );
// Show footer widgets
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'toggle',
    'settings'        => 'arendelle_settings_footer_widgets_show',
    'label'           => esc_html__( 'Show footer widgets', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Footer columns
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'select',
    'settings'        => 'arendelle_settings_footer_columns',
    'label'           => esc_html__( 'Number of columns', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => 'footer-col-4',
    'choices'         => array(
    'footer-col-1' => esc_html__( '1 Column', 'arendelle' ),
    'footer-col-2' => esc_html__( '2 Columns', 'arendelle' ),
    'footer-col-3' => esc_html__( '3 Columns', 'arendelle' ),
    'footer-col-4' => esc_html__( '4 Columns', 'arendelle' ),
),
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Show footer bottom menu
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'toggle',
    'settings'        => 'arendelle_settings_footer_bottom_menu_show',
    'label'           => esc_html__( 'Show bottom footer menu', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Bottom footer text
Kirki::add_field( 'arendelle_settings_config', array(
    'type'              => 'textarea',
    'settings'          => 'arendelle_settings_footer_bottom_text',
    'section'           => 'arendelle_settings_footer',
    'label'             => esc_html__( 'Bottom footer text', 'arendelle' ),
    'description'       => esc_html__( 'Allowed HTML: a, span, i, em, strong', 'arendelle' ),
    'sanitize_callback' => 'wp_kses_post',
    'default'           => sprintf(
    esc_html__( 'Copyright &copy; [current_year] %1$s | Made by %2$sDeoThemes%3$s', 'arendelle' ),
    get_bloginfo( 'name' ),
    '<a href="' . esc_url( 'https://deothemes.com' ) . '">',
    '</a>'
),
    'active_callback'   => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Show footer payment icons
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'toggle',
    'settings'        => 'arendelle_settings_footer_payment_icons_show',
    'label'           => esc_html__( 'Show footer payment icons', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Visa
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_visa',
    'label'           => esc_html__( 'Visa', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Paypal
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_paypal',
    'label'           => esc_html__( 'Paypal', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Mastercard
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_mastercard',
    'label'           => esc_html__( 'Mastercard', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Stripe
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_stripe',
    'label'           => esc_html__( 'Stripe', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Discover
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_discover',
    'label'           => esc_html__( 'Discover', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// American Express
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_amex',
    'label'           => esc_html__( 'Americal Express', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => true,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Diners
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_diners',
    'label'           => esc_html__( 'Diners', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// JCB
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_jcb',
    'label'           => esc_html__( 'JCB', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Apple Pay
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_apple_pay',
    'label'           => esc_html__( 'Apple Pay', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Google Pay
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_google_pay',
    'label'           => esc_html__( 'Google Pay', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// Amazon Pay
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_amazon_pay',
    'label'           => esc_html__( 'Amazon Pay', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );
// AliPay
Kirki::add_field( 'arendelle_settings_config', array(
    'type'            => 'checkbox',
    'settings'        => 'arendelle_settings_footer_payment_icon_alipay',
    'label'           => esc_html__( 'Alipay', 'arendelle' ),
    'section'         => 'arendelle_settings_footer',
    'default'         => false,
    'active_callback' => array( array(
    'setting'  => 'arendelle_settings_footer_show',
    'operator' => '==',
    'value'    => true,
), array(
    'setting'  => 'arendelle_settings_footer_payment_icons_show',
    'operator' => '==',
    'value'    => true,
) ),
) );