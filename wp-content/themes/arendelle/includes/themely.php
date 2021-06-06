<?php
/**
* Themely Onboarding
*/
if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
* MerlinWP Config
*/
$wizard = new Merlin(

	$config = array(
		'merlin_url'           => 'theme-setup-wizard', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => false, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => esc_url(get_home_url()), // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup Wizard', 'arendelle' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup Wizard for %3$s%4$s', 'arendelle' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'arendelle' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'arendelle' ),

		'btn-skip'                 => esc_html__( 'Skip', 'arendelle' ),
		'btn-next'                 => esc_html__( 'Next', 'arendelle' ),
		'btn-start'                => esc_html__( 'Start', 'arendelle' ),
		'btn-no'                   => esc_html__( 'Cancel', 'arendelle' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'arendelle' ),
		'btn-child-install'        => esc_html__( 'Install', 'arendelle' ),
		'btn-content-install'      => esc_html__( 'Install', 'arendelle' ),
		'btn-import'               => esc_html__( 'Import', 'arendelle' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'arendelle' ),
		'btn-license-skip'         => esc_html__( 'Later', 'arendelle' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'arendelle' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'arendelle' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'arendelle' ),
		'license-label'            => esc_html__( 'License key', 'arendelle' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'arendelle' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'arendelle' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'arendelle' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'arendelle' ),
		'welcome-header-success%s' => esc_html__( 'Hi! Welcome back', 'arendelle' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'arendelle' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'arendelle' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'arendelle' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'arendelle' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'arendelle' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'arendelle' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'arendelle' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'arendelle' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'arendelle' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'arendelle' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'arendelle' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'arendelle' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'arendelle' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'arendelle' ),

		'import-header'            => esc_html__( 'Import Content', 'arendelle' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'arendelle' ),
		'import-action-link'       => esc_html__( 'Advanced', 'arendelle' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'arendelle' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'arendelle' ),
		'ready-action-link'        => esc_html__( 'Extras', 'arendelle' ),
		'ready-big-button'         => esc_html__( 'View Your Website', 'arendelle' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://support.themely.com/section/serenity-theme-documentation/', esc_html__( 'Theme Documentation', 'arendelle' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'http://support.themely.com/forums/forum/theme-support/arendelle/', esc_html__( 'Support Forum', 'arendelle' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', esc_url(wp_customize_url()), esc_html__( 'Customize Your Website', 'arendelle' ) ),
	)
);

/**
* Merlin WP Filters.
*/
// Define your demo content import files.
function arendelle_merlin_local_import_files() {
	return array(
		array(
			'import_file_name'           => 'Arendelle Free Demo',
			'import_file_url'            => 'https://arendelle-free.deothemes.com/import/demo-content.xml',
			'import_widget_file_urk'     => 'https://arendelle-free.deothemes.com/import/widgets.wie',
			'import_customizer_file_url' => 'https://arendelle-free.deothemes.com/import/customizer.dat',
		),
	);
}
add_filter( 'merlin_import_files', 'arendelle_merlin_local_import_files' );

// Execute custom code after the whole import has finished.
function arendelle_merlin_after_import_setup() {

	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Bottom Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $primary_menu->term_id,
			'footer-bottom-menu' => $footer_menu->term_id,
		)
	);

	update_option( 'woocommerce_shop_page_id', 2146 );
	update_option( 'woocommerce_cart_page_id', 2147 );
	update_option( 'woocommerce_checkout_page_id', 2148 );
	update_option( 'woocommerce_myaccount_page_id', 2149 );

	// Assign front page based on demo import
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'show_on_front', 'page' );
	update_option( 'page_for_posts', $blog_page_id->ID );

	update_option( 'elementor_active_kit', 1333 );
	flush_rewrite_rules();

}
add_action( 'merlin_after_all_import', 'arendelle_merlin_after_import_setup' );

// Remove child theme step.
add_filter( wp_get_theme( )->template . '_merlin_steps', function( $steps ) {
	unset( $steps['child'] );
	return $steps;
});

/**
* TGMPA Config
*/
add_action( 'tgmpa_register', 'arendelle_register_required_plugins' );
function arendelle_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'Kirki',
			'slug'      => 'kirki',
			'required'  => false,
		),

		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
		),

		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),

		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),		

		array(
			'name'      => 'Smash Balloon Social Photo Feed',
			'slug'      => 'instagram-feed',
			'required'  => false,
		),

		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'      => 'YITH WooCommerce Quick View',
			'slug'      => 'yith-woocommerce-quick-view',
			'required'  => false,
		),

		array(
			'name'      => 'YITH WooCommerce Wishlist',
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => false,
		),

	);

	$config = array(
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',					   // Not sure what this is for??
	);

	tgmpa($plugins, $config);
}