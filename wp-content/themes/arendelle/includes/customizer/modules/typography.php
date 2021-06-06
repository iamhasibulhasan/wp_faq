<?php
/**
 * Customizer Typography
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Add custom choice
 */
if ( ! function_exists( 'arendelle_add_custom_choice' ) ) {
	function arendelle_add_custom_choice() {
		return array(
			'fonts' => apply_filters( 'arendelle_kirki_font_choices', array() ),
			'variant' => array( 'regular', 'italic' )
		);
	}
}


// Base font
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_base_font',
	'label'       => esc_html__( 'Base font', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $body_font,
		'font-size'      => '16px',
		'line-height'    => '1.5',
		'letter-spacing' => 'normal',
		'variant' => 'regular',
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['base_font'],
		),
		array(
			'element' => '.edit-post-visual-editor .editor-styles-wrapper',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));


// Secondary font
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_secondary_font',
	'label'       => esc_html__( 'Secondary font', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $heading_font,
		'font-weight' 	 => '500',
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['secondary_font'],
		),
		array(
			'element'  => isset( $selectors['shop_secondary_font'] ) ? $selectors['shop_secondary_font'] : null,
		),
		array(
			'element' => '',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));


/*-------------------------------------------------------*/
/* Headings font
/*-------------------------------------------------------*/

// Headings
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_font',
	'label'       => esc_html__( 'Headings font', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $heading_font,
		'font-weight' 	 => '500',
		'line-height' 	 => '1.3',
		'letter-spacing' => 'normal',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['headings'],
		),
		array(
			'element' => '.edit-post-visual-editor h1.wp-block[data-type="core/heading"],
			.edit-post-visual-editor .editor-post-title__block .editor-post-title__input,
			.edit-post-visual-editor h2.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h3.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h4.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h5.wp-block[data-type="core/heading"],
			.edit-post-visual-editor h6.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));


// H1
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h1',
	'label'       => esc_html__( 'H1 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '42px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['h1'],
		),
		array(
			'element' => '.edit-post-visual-editor h1.wp-block[data-type="core/heading"],
			.edit-post-visual-editor .editor-post-title__block .editor-post-title__input',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));

// H2
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h2',
	'label'       => esc_html__( 'H2 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '34px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['h2'],
		),
		array(
			'element' => '.edit-post-visual-editor h2.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));

// H3
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h3',
	'label'       => esc_html__( 'H3 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '28px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['h3'],
		),
		array(
			'element' => '.edit-post-visual-editor h3.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));

// H4
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h4',
	'label'       => esc_html__( 'H4 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '24px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['h4'],
		),
		array(
			'element' => '.edit-post-visual-editor h4.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));

// H5
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h5',
	'label'       => esc_html__( 'H5 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '20px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['h5'],
		),
		array(
			'element' => '.edit-post-visual-editor h5.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));

// H6
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_headings_h6',
	'label'       => esc_html__( 'H6 Headings', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'   	 => '16px',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => 'h6',
		),
		array(
			'element' => '.edit-post-visual-editor h6.wp-block[data-type="core/heading"]',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));


// Post typography
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_post_typography',
	'label'       => esc_html__( 'Post article text', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-size'      => '18px',
		'line-height'    => '1.8',
		'letter-spacing' => 'normal',
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => '.entry__article',
		),
		array(
			'element' => '.edit-post-visual-editor .editor-styles-wrapper',
			'context' => array( 'editor' ),
		)
	),
	'transport' => 'auto',
));


/*-------------------------------------------------------*/
/* Forms
/*-------------------------------------------------------*/

// Buttons typography
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_buttons_typography',
	'label'       => esc_html__( 'Buttons', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $heading_font,
		'font-weight'		 => '600',
		'letter-spacing' => 'normal',
		'text-transform' => 'uppercase'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => $selectors['buttons'],
		),
		array(
			'element' => '.wp-block-button .wp-block-button__link',
			'context' => array( 'editor' ),			
		)
	),
	'transport' => 'auto',
));


/*-------------------------------------------------------*/
/* Header
/*-------------------------------------------------------*/

// Menu Links typography
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_menu_links_typography',
	'label'       => esc_html__( 'Menu links', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $heading_font,
		'font-weight' 	 => '500',
		'font-size'			 => '12px',
		'letter-spacing' => 'normal',
		'text-transform' => 'uppercase'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => '.nav__menu > li > a',
		),
	),
	'transport' => 'auto',
));

// Dropdown menu Links typography
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'typography',
	'settings'    => 'arendelle_settings_dropdown_menu_links_typography',
	'label'       => esc_html__( 'Dropdown menu links', 'arendelle' ),
	'section'     => 'arendelle_settings_typography',
	'default'     => array(
		'font-family'    => $heading_font,
		'variant' 			 => '400',
		'font-size'			 => '15px',
		'letter-spacing' => 'normal',
		'text-transform' => 'none'
	),
	'choices'  => arendelle_add_custom_choice(),
	'output' => array(
		array(
			'element' => '.nav__dropdown-menu li a',
		),
	),
	'transport' => 'auto',
));