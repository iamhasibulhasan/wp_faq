<?php
/**
 * Elementor Compatibility File.
 *
 * @package Arendelle
 */

namespace Elementor;

if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Arendelle Elementor Compatibility
 */
if ( ! class_exists( 'Arendelle_Elementor' ) ) :

	/**
	 * Arendelle Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Arendelle_Elementor {

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
			if ( arendelle_is_woocommerce_activated() ) {

				// On Editor - Register WooCommerce frontend hooks before the Editor init.
				// Priority = 5, in order to allow plugins remove/add their wc hooks on init.
				if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) { //phpcs:ignore
					add_action( 'init', array( $this, 'register_wc_hooks' ), 5 );
				}

				add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'maybe_init_cart' ) );

			}
		
		}


		/**
		* Rgister wc hookes for elementor preview mode
		*/
		public function register_wc_hooks() {
			wc()->frontend_includes();
		}

		/**
		* Init cart in elementor preview mode
		*/
		public function maybe_init_cart() {

			$has_cart = is_a( WC()->cart, 'WC_Cart' );

			if ( ! $has_cart ) {
				$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
				WC()->session  = new $session_class();
				WC()->session->init();
				WC()->cart     = new \WC_Cart();
				WC()->customer = new \WC_Customer( get_current_user_id(), true );
			}
		}

	}

endif;

Arendelle_Elementor::get_instance();