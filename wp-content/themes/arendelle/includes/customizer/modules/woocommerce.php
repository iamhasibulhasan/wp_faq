<?php
/**
 * WooCommerce
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/*-------------------------------------------------------*/
/* WooCommerce
/*-------------------------------------------------------*/

// Product Social Share Buttons
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_product_share_buttons_show',
	'label'       => esc_html__( 'Show share buttons', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => true,
) );

// Facebook Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_facebook',
	'label'       => esc_html__( 'Facebook', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => true,
) );

// Twitter Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_twitter',
	'label'       => esc_html__( 'Twitter', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => true,
) );

// Linkedin Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_linkedin',
	'label'       => esc_html__( 'Linkedin', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Pinterest Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_pinterest',
	'label'       => esc_html__( 'Pinterest', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => true,
) );

// Pocket Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_pocket',
	'label'       => esc_html__( 'Pocket', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Facebook Messenger Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_facebook_messenger',
	'label'       => esc_html__( 'Facebook Messenger', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Whatsapp Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_whatsapp',
	'label'       => esc_html__( 'Whatsapp', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Viber Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_viber',
	'label'       => esc_html__( 'Viber', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Telegram Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_telegram',
	'label'       => esc_html__( 'Telegram', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Reddit Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_reddit',
	'label'       => esc_html__( 'Reddit', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => false,
) );

// Email Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_product_share_email',
	'label'       => esc_html__( 'Email', 'arendelle' ),
	'section'     => 'arendelle_settings_product_social_share',
	'default'     => true,
) );


Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'custom',
	'settings'    => 'separator-' . $uniqid++,
	'section'     => 'woocommerce_product_catalog',
	'default'     => '<h3 class="customizer-title">' . esc_html__( 'Display Product Elements', 'arendelle' ) . '</h3>',
) );

// Show product Sale badge
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_product_sale_badge_show',
	'label'       => esc_html__( 'Show sale badge', 'arendelle' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => true,
) );

// Show product title
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_product_title_show',
	'label'       => esc_html__( 'Show title', 'arendelle' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => true,
) );

// Show product rating
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_product_rating_show',
	'label'       => esc_html__( 'Show rating', 'arendelle' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => true,
) );

// Show product price
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_product_price_show',
	'label'       => esc_html__( 'Show price', 'arendelle' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => true,
) );

// Show product Add To Cart button
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_product_catalog_button_show',
	'label'       => esc_html__( 'Show add to cart button', 'arendelle' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => true,
) );


// Show distraction free checkout
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_woocommerce_distraction_free_checkout',
	'label'       => esc_html__( 'Distraction free checkout', 'arendelle' ),
	'section'     => 'woocommerce_checkout',
	'default'     => true,
	'priority'		=> 1
) );