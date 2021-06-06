<?php
/**
 * Customizer Blog
 *
 * @package Arendelle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
* Meta
*/

// Meta category
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_meta_category_show',
	'label'       => esc_html__( 'Show meta category', 'arendelle' ),
	'section'     => 'arendelle_settings_post_meta',
	'default'     => true,
) );

// Meta date
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_meta_date_show',
	'label'       => esc_html__( 'Show meta date', 'arendelle' ),
	'section'     => 'arendelle_settings_post_meta',
	'default'     => true,
) );

// Meta author
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_meta_author_show',
	'label'       => esc_html__( 'Show meta author', 'arendelle' ),
	'section'     => 'arendelle_settings_post_meta',
	'default'     => true,
) );


// Post excerpt
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_post_excerpt_show',
	'label'       => esc_html__( 'Show post excerpt', 'arendelle' ),
	'section'     => 'arendelle_settings_post_meta',
	'default'     => true,
) );


/**
* Single Post
*/

// Post title
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_post_title_show',
	'label'       => esc_html__( 'Show post title', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Featured Image
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_featured_image_show',
	'label'       => esc_html__( 'Show featured image', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Meta category
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_category_show',
	'label'       => esc_html__( 'Show category', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Meta date
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_date_show',
	'label'       => esc_html__( 'Show date', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Meta author
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_author_show',
	'label'       => esc_html__( 'Show author', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Meta comments
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_single_comments_show',
	'label'       => esc_html__( 'Show comments', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Post tags
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_post_tags_show',
	'label'       => esc_html__( 'Show tags', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Post author box
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_author_box_show',
	'label'       => esc_html__( 'Show author box', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

if ( defined( 'MC4WP_VERSION' ) ) {
	// Newsletter
	Kirki::add_field( 'arendelle_settings_config', array(
		'type'        => 'toggle',
		'settings'    => 'arendelle_settings_post_newsletter_box_show',
		'label'       => esc_html__( 'Show newsletter box', 'arendelle' ),
		'section'     => 'arendelle_settings_single_post',
		'default'     => false,
	) );
}

// Post navigation
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_post_navigation_show',
	'label'       => esc_html__( 'Show post navigation', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Related posts heading
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'custom',
	'settings'    => 'separator-' . $uniqid++,
	'section'     => 'arendelle_settings_single_post',
	'default'     => '<h3 class="customizer-title">' . esc_html__( 'Related Posts', 'arendelle' ) . '</h3>',
) );

// Related posts
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_related_posts_show',
	'label'       => esc_html__( 'Show related posts', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => true,
) );

// Related by
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'select',
	'settings'    => 'arendelle_settings_related_posts_relation',
	'label'       => esc_html__( 'Related by', 'arendelle' ),
	'section'     => 'arendelle_settings_single_post',
	'default'     => 'category',
	'choices'     => array(
		'category' => esc_html__( 'Category', 'arendelle' ),
		'tag' => esc_html__( 'Tag', 'arendelle' ),
		'author' => esc_html__( 'Author', 'arendelle' ),
	),
) );


/**
* Socials Share Buttons
*/

// Social Share Buttons
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_post_share_buttons_show',
	'label'       => esc_html__( 'Show share buttons', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => true,
) );

// Facebook Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_facebook',
	'label'       => esc_html__( 'Facebook', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => true,
) );

// Twitter Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_twitter',
	'label'       => esc_html__( 'Twitter', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => true,
) );

// Linkedin Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_linkedin',
	'label'       => esc_html__( 'Linkedin', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => true,
) );

// Pinterest Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_pinterest',
	'label'       => esc_html__( 'Pinterest', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Pocket Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_pocket',
	'label'       => esc_html__( 'Pocket', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Facebook Messenger Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_facebook_messenger',
	'label'       => esc_html__( 'Facebook Messenger', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Whatsapp Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_whatsapp',
	'label'       => esc_html__( 'Whatsapp', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Viber Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_viber',
	'label'       => esc_html__( 'Viber', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Telegram Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_telegram',
	'label'       => esc_html__( 'Telegram', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Reddit Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_reddit',
	'label'       => esc_html__( 'Reddit', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );

// Email Share
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'checkbox',
	'settings'    => 'arendelle_settings_post_share_email',
	'label'       => esc_html__( 'Email', 'arendelle' ),
	'section'     => 'arendelle_settings_social_share',
	'default'     => false,
) );


/**
* Read More
*/

// Read More Show
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'toggle',
	'settings'    => 'arendelle_settings_read_more_show',
	'label'       => esc_html__( 'Show read more', 'arendelle' ),
	'section'     => 'arendelle_settings_read_more',
	'default'     => true,
) );

// Read More Text
Kirki::add_field( 'arendelle_settings_config', array(
	'type'        => 'text',
	'settings'    => 'arendelle_settings_read_more_text',
	'label'       => esc_html__( 'Read more text', 'arendelle' ),
	'section'     => 'arendelle_settings_read_more',
	'default'     => esc_html__( 'Read More', 'arendelle' ),
) );