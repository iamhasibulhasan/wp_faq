<?php
/**
 * Customizer Colors
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/*-------------------------------------------------------*/
/* General Colors
/*-------------------------------------------------------*/

// Primary color
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_primary_color',
	'label'       => esc_html__( 'Primary', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $primary_color,
	'output' => array(
		array(
			'element'  => $selectors['primary_color'],
			'property' => 'color',
		),
		array(
			'element'  => isset( $selectors['shop_primary_color'] ) ? $selectors['shop_primary_color'] : null,
			'property' => 'color',
		),
		array(
			'element'  => '.wp-block-pullquote::before',
			'property' => 'color',
			'context' => array( 'editor' ),
		),
		array(
			'element'  => $selectors['primary_background_color'],
			'property' => 'background-color',
		),
		array(
			'element'  => isset( $selectors['shop_primary_background_color'] ) ? $selectors['shop_primary_background_color'] : null,
			'property' => 'background-color',
		),
		array(
			'element'  => isset( $selectors['shop_primary_border_color'] ) ? $selectors['shop_primary_border_color'] : null,
			'property' => 'border-color',
		),
		array(
			'element'  => $selectors['primary_border_color'],
			'property' => 'border-color',
		),
		array(
			'element'  => $selectors['primary_border_left_color'],
			'property' => 'border-color',
			'context' => array( 'editor', 'front' ),
		),		
		array(
			'element'  => $selectors['primary_border_top_color'],
			'property' => 'border-top-color',
		),
		array(
			'element' => $selectors['buttons_color_editor'],
			'property' => 'background-color',
			'context' => array( 'editor' ),
		),
		array(
			'element'  => isset( $selectors['shop_buttons_color'] ) ? $selectors['shop_buttons_color'] : null,
			'property' => 'background-color',
		),
	),
	'transport' => 'auto',
) );


// Secondary color
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_secondary_color',
	'label'       => esc_html__( 'Secondary', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $secondary_color,
	'output' => array(
		array(
			'element'  => isset( $selectors['shop_secondary_color'] ) ? $selectors['shop_secondary_color'] : null,
			'property' => 'color',
		),
		array(
			'element'  => isset( $selectors['shop_secondary_background_color'] ) ? $selectors['shop_secondary_background_color'] : null,
			'property' => 'background-color',
		),
	),
	'transport' => 'auto',
) );


// Headings colors
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_headings_color',
	'label'       => esc_html__( 'Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $heading_color,
	'output' => array(
		array(
			'element'  => $selectors['headings_color'],
			'property' => 'color',
		),
		array(
			'element'  => isset( $selectors['shop_headings_color'] ) ? $selectors['shop_headings_color'] : null,
			'property' => 'color',
		),
		array(
			'element'  => '.nav__icon-toggle-bar',
			'property' => 'background-color',
		),
		array(
			'element' => '.edit-post-visual-editor .editor-post-title__block .editor-post-title__input,
			.edit-post-visual-editor h1.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h2.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h3.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h4.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h5.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h6.wp-block[data-type="core/heading"]',
			'property' => 'color',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
) );

// Text color
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_text_color',
	'label'       => esc_html__( 'Text', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $text_color,
	'output' => array(
		array(
			'element'  => $selectors['text_color'],
			'property' => 'color',
		),
		array(
			'element'  => isset( $selectors['shop_text_color'] ) ? $selectors['shop_text_color'] : null,
			'property' => 'color',
		),
		array(
			'element'  => 'input::-webkit-input-placeholder',
			'property' => 'color',
			'context' => array( 'front' ),
		),
		array(
			'element'  => 'input:-moz-placeholder, input::-moz-placeholder',
			'property' => 'color',
			'context' => array( 'front' ),
		),
		array(
			'element'  => 'input:-ms-input-placeholder',
			'property' => 'color',
			'context' => array( 'front' ),
		),
		array(
			'element' => '.edit-post-visual-editor .editor-styles-wrapper',
			'property' => 'color',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
) );


// Borders color
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_borders_color',
	'label'       => esc_html__( 'Borders', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $border_color,
	'output' => array(
		array(
			'element' => $selectors['border_color'],
			'property' => 'border-color',
		),
		array(
			'element'  => isset( $selectors['shop_border_color'] ) ? $selectors['shop_border_color'] : null,
			'property' => 'border-color',
		),
		array(
			'element'     => '.nav__menu li a',
			'property'    => 'border-bottom-color',
			'media_query' => $bp_lg_down,
		),
	),
	'transport' => 'auto',
) );


// Background light
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'color',
	'settings'    => 'arendelle_settings_background_light_color',
	'label'       => esc_html__( 'Background light', 'arendelle' ),
	'section'     => 'arendelle_settings_colors',
	'default'     => $bg_light,
	'output' => array(
		array(
			'element'  => '.page-title-regular_pages, .footer',
			'property' => 'background-color',
		),
	),
	'transport' => 'auto',
) );








// // Buttons background color hover
// Kirki::add_field( 'arendelle_settings_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'arendelle_settings_buttons_background_color_hover',
// 	'label'       => esc_html__( 'Buttons hover background color', 'arendelle' ),
// 	'section'     => 'arendelle_settings_form_elements_colors',
// 	'default'     => $primary_color,
// 	'choices'     => array(
// 		'alpha' => true,
// 	),
// 	'output' => array(
// 		array(
// 			'element' => $selectors['buttons_background_color_hover'],
// 			'property' => 'background-color',
// 		),
// 		array(
// 			'element'  => isset( $selectors['shop_buttons_background_color_hover'] ) ? $selectors['shop_buttons_background_color_hover'] : null,
// 			'property' => 'background-color',
// 		),
// 	),
// 	'transport' => 'auto',
// ) );

// // Buttons text color hover
// Kirki::add_field( 'arendelle_settings_config', array(
// 	'type'        => 'color',
// 	'settings'    => 'arendelle_settings_buttons_text_color_hover',
// 	'label'       => esc_html__( 'Buttons hover text color', 'arendelle' ),
// 	'section'     => 'arendelle_settings_form_elements_colors',
// 	'default'     => '#ffffff',
// 	'choices'     => array(
// 		'alpha' => true,
// 	),
// 	'output' => array(
// 		array(
// 			'element' => $selectors['buttons_background_color_hover'],
// 			'property' => 'color',
// 		),
// 		array(
// 			'element'  => isset( $selectors['shop_buttons_color_hover'] ) ? $selectors['shop_buttons_color_hover'] : null,
// 			'property' => 'color',
// 		),
// 	),
// 	'transport' => 'auto',
// ) );