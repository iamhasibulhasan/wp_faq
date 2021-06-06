<?php
/**
 * Customizer Page 404
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

// Page 404 Image
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'image',
	'settings'    => 'arendelle_settings_page_404_image',
	'label'       => esc_html__( 'Page 404 image', 'arendelle' ),
	'section'     => 'arendelle_settings_page_404',
	'default'     => ARENDELLE_URI . '/assets/img/404/arendelle_404-min.png'
) );

// Title
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_page_404_title',
	'label'       => esc_html__( 'Page 404 title', 'arendelle' ),
	'section'     => 'arendelle_settings_page_404',
	'default'     => esc_html__( 'Page Not Found', 'arendelle' ),
) );

// Description text
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_page_404_description',
	'label'       => esc_html__( 'Page 404 description text', 'arendelle' ),
	'section'     => 'arendelle_settings_page_404',
	'default'     => esc_html__( 'Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'arendelle' ),
) );

// Button text
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_page_404_button_text',
	'label'       => esc_html__( 'Page 404 button text', 'arendelle' ),
	'section'     => 'arendelle_settings_page_404',
	'default'     => esc_html__( 'Take Me Back Home', 'arendelle' ),
) );