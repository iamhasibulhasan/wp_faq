<?php
/**
 * Customizer General
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


// Preloader
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_preloader_show',
	'label'       => esc_html__( 'Enable/Disable theme preloader', 'arendelle' ),
	'section'     => 'arendelle_settings_preloader',
	'default'     => false,
) );

// Back to top
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_back_to_top_show',
	'label'       => esc_html__( 'Back to top arrow', 'arendelle' ),
	'section'     => 'arendelle_settings_back_to_top',
	'default'     => true,
) );

// Newsletter Popup
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_newsletter_popup_show',
	'label'       => esc_html__( 'Show newsletter pop-up', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => false,
) );

// Action after pop-up close
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'radio',
	'settings'    => 'arendelle_settings_newsletter_popup_storage',
	'label'       => esc_html__( 'Action after pop-up close', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => 'session',
	'choices'     => array(
		'session'   => esc_html__( 'Show on every visit (session)', 'arendelle' ),
		'cookies' => esc_html__( 'Do not show on every visit (cookies)', 'arendelle' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'arendelle_settings_newsletter_popup_show',
			'operator' => '==',
			'value'    => true,
		)
	),
) );

// Cookies age
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'number',
	'settings'    => 'arendelle_settings_newsletter_popup_cookies_age',
	'label'       => esc_html__( 'Expiration (days)', 'arendelle' ),
	'description' => esc_html__( 'How many days to store cookies', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => 7,
	'choices'     => array(
		'min'  => 0,
		'max'  => 365,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'arendelle_settings_newsletter_popup_storage',
			'operator' => '==',
			'value'    => 'cookies',
		)
	),
) );


// Newsletter Popup Image
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'image',
	'settings'    => 'arendelle_settings_newsletter_popup_image',
	'label'       => esc_html__( 'Image', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => ARENDELLE_URI . '/assets/img/newsletter/arendelle_newsletter_popup-min.jpg',
	'choices'     => [
		'save_as' => 'array',
	],
) );

// Title
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_newsletter_popup_title',
	'label'       => esc_html__( 'Title', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => esc_html__( 'Join our newsletter and	get 20% discount', 'arendelle' ),
) );

// Text
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_newsletter_popup_text',
	'label'       => esc_html__( 'Text', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => esc_html__( 'We promise we won\'t write to you often, only for the fun stuff.', 'arendelle' ),
) );

// Form
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_newsletter_popup_form',
	'label'       => esc_html__( 'Form shortcode', 'arendelle' ),
	'section'     => 'arendelle_settings_newsletter_popup',
	'default'     => '[mc4wp_form id="581"]',
) );


/* Form Elements
/*-------------------------------------------------------*/

Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'custom',
	'settings'    => 'separator-' . $uniqid++,
	'section'     => 'arendelle_settings_general_form_elements',
	'default'     => '<h3 class="customizer-title">' . esc_attr__( 'Buttons', 'arendelle' ) . '</h3>',
) );

// Buttons padding
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'dimensions',
	'settings'    => 'arendelle_settings_buttons_padding',
	'label'       => esc_attr__( 'Padding', 'arendelle' ),
	'section'     => 'arendelle_settings_general_form_elements',
	'default'     => array(
		'padding-top'    => '17px',
		'padding-right'  => '24px',
		'padding-bottom' => '17px',
		'padding-left' 	 => '24px',
	),
	'output' => array(
		array(
			'element'  => 'input[type="button"],
			input[type="reset"],
			input[type="submit"],
			button,
			.btn--lg,
			.button,
			.wp-block-button .wp-block-button__link',
		),
		array(
			'element'  => isset( $selectors['shop_buttons_background_color'] ) ? $selectors['shop_buttons_background_color'] : null,
		),
	),
	'transport' => 'auto',
) );

// Buttons border radius
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'slider',
	'settings'    => 'arendelle_settings_buttons_border_radius',
	'label'       => esc_attr__( 'Border radius', 'arendelle' ),
	'section'     => 'arendelle_settings_general_form_elements',
	'default'     => 0,
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
	'output'       => array(
		array(
			'element'   => $selectors['buttons'],
			'property'  => 'border-radius',
			'units'     => 'px',
		),
		array(
			'element'  => isset( $selectors['shop_buttons_background_color'] ) ? $selectors['shop_buttons_background_color'] : null,
			'property' => 'border-radius',
			'units'    => 'px',
		),		
	),
	'transport' => 'auto',
) );


// Buttons shadow
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_buttons_shadow',
	'label'       => esc_attr__( 'Buttons shadow', 'arendelle' ),
	'section'     => 'arendelle_settings_general_form_elements',
	'default'			=> false,
) );


// Buttons shadow color
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_buttons_shadow_color',
	'label'       => esc_html__( 'Buttons shadow color', 'arendelle' ),
	'section'     => 'arendelle_settings_general_form_elements',
	'choices'     => array(
		'alpha' => true,
	),
	'default' => 'rgba(59.999999999999936, 45.999999999999986, 116, 0.2)',
	'output' => array(
		array(
			'element'   		=> $selectors['buttons'],
			'property'    	=> 'box-shadow',
			'value_pattern' => '0px 3px 10px 0px $',
		),
		array(
			'element'  => isset( $selectors['shop_buttons_background_color'] ) ? $selectors['shop_buttons_background_color'] : null,
			'property' => 'box-shadow',
			'value_pattern' => '0px 3px 10px 0px $',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'arendelle_settings_buttons_shadow',
			'operator' => '==',
			'value'    => true,
		)
	),
	'transport' => 'auto',
) );