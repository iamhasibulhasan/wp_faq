<?php
/**
 * Customizer Page Title
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/*-------------------------------------------------------*/
/* Regular Pages
/*-------------------------------------------------------*/

// Show regular pages page title
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_regular_pages_page_title_show',
	'label'       => esc_html__( 'Show page title', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );

// Show regular pages breadcrumbs
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_regular_pages_breadcrumbs_show',
	'label'       => esc_html__( 'Show breadcrumbs on regular pages', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );

// Show archive breadcrumbs
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_archives_breadcrumbs_show',
	'label'       => esc_html__( 'Show breadcrumbs on archives', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );

// Show search results breadcrumbs
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_search_results_breadcrumbs_show',
	'label'       => esc_html__( 'Show breadcrumbs on search results', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );

// Show single post breadcrumbs
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_post_breadcrumbs_show',
	'label'       => esc_html__( 'Show breadcrumbs on single post', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );

// Show shop breadcrumbs
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_shop_breadcrumbs_show',
	'label'       => esc_html__( 'Show breadcrumbs on shop pages', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => true,
) );


// Page title padding
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'dimensions',
	'settings'    => 'arendelle_settings_page_title_padding',
	'label'       => esc_html__( 'Page title top/bottom padding', 'arendelle' ),
	'section'     => 'arendelle_settings_page_title',
	'default'     => [
		'padding-top'    => '34px',
		'padding-bottom' => '34px',
	],
	'output' => array(
		array(
			'element' => '.page-title',
		),
	),
	'transport' => 'auto',
) );