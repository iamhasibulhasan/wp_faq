<?php
/**
 * WooCommerce Compatibility File.
 *
 * @package Arendelle
 */


if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Arendelle WooCommerce Compatibility
 */
if ( ! class_exists( 'Arendelle_WooCommerce' ) ) :

	/**
	 * Arendelle WooCommerce Compatibility
	 *
	 * @since 1.0.0
	 */
	class Arendelle_WooCommerce {

		/**
		* Instance
		*
		* @var object instance
		*/
		private static $instance;

		/**
		* Get instance
		*
		* Ensures only one instance of the class is loaded or can be loaded.
		*/
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		* Constructor
		*/
		public function __construct() {
			add_action( 'wp', [ $this, 'product_catalog_customization' ], 5 );
		}


		/**
		* Product catalog customization.
		*
		* @return void
		*/
		public function product_catalog_customization() {			

			// Hide Sale badge
			if ( ! get_theme_mod( 'arendelle_settings_woocommerce_product_sale_badge_show', true ) ) {
				remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			}

			// Show title
			if ( ! get_theme_mod( 'arendelle_settings_woocommerce_product_title_show', true ) ) {
				remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			}
			
			// Show rating
			if ( ! get_theme_mod( 'arendelle_settings_woocommerce_product_rating_show', true ) ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			}

			// Show price
			if ( ! get_theme_mod( 'arendelle_settings_woocommerce_product_price_show', true ) ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			}

			// Hide Add to Cart button
			if ( ! get_theme_mod( 'arendelle_settings_woocommerce_product_catalog_button_show', true ) ) {
				remove_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_add_to_cart', 10 );
			}

		}	

	}

endif;

Arendelle_WooCommerce::get_instance();