<?php
/**
 * Core Theme Functions.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Checks if WooCommerce is activated
 * @return boolean
 */
if ( ! function_exists( 'arendelle_is_woocommerce_activated' ) ) {
	function arendelle_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}


/**
  * Shim for wp_body_open
  *
  * @since  1.0.0
  */
if ( ! function_exists( 'wp_body_open' ) ) {
  function wp_body_open() {
    do_action( 'wp_body_open' );
  }
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function arendelle_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'arendelle_skip_link_focus_fix' );



/**
	* Check if page built with Elementor
	*
	* @since  1.0.0
	*/
function arendelle_is_elementor_page() {
	$elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( is_search() || is_archive() ) {
		return false;
	}

	if ( (bool)$elementor_page ) {
		return true;
	} else {
		return false;
	}	
}

/**
* Gutenberg Check
*
* @since 1.0.0
*/
function arendelle_is_gutenberg() {
	return function_exists( 'register_block_type' ); 
}


/**
 * Allow shorcodes in text widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Custom excerpt length
 */
function arendelle_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return;
	}

	$excerpt_length = get_theme_mod( 'arendelle_settings_posts_excerpt_settings', 55 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'arendelle_custom_excerpt_length' );


if ( ! function_exists( 'arendelle_sidebar' ) ) {
	/**
	* Get sidebar
	*
	* @since 1.0.0
	*/
	function arendelle_sidebar( $sidebar = '' ) {
		?>
			<aside class="sidebar col-lg">
				<div itemtype="https://schema.org/WPSideBar" itemscope="itemscope" id="secondary" class="widget-area" role="complementary">
					<?php arendelle_sidebar_before(); ?>
					<?php dynamic_sidebar( $sidebar ); ?>
					<?php arendelle_sidebar_after(); ?>
				</div> <!-- #secondary -->
			</aside>
		<?php
	}
}


if ( ! function_exists( 'arendelle_is_active_sidebar' ) ) {
	/**
	* Check if sidebar is active
	* @param string sidebar name
	* @param string sidebar type
	* @param string default layout
	* @return bool
	* @since 1.0.0
	*/
	function arendelle_is_active_sidebar( $sidebar = '', $layout = '', $default = 'fullwidth' ) {
		if ( 'fullwidth' !== arendelle_layout_type( $layout, $default ) && is_active_sidebar( 'arendelle-' . $sidebar . '-sidebar' ) ) {
			return true;
		}
	}
}


if ( ! function_exists( 'arendelle_layout_type' ) ) {
	/**
	 * Check layout type based on customizer and meta settings
	 * @param string $type layout type
	 * @param string default layout
	 * @return string $type Layout type
	 */
	function arendelle_layout_type( $type, $default = 'fullwidth' ) {
		$layout = '';
		$meta = get_post_meta( get_the_ID(), '_arendelle_page_layout', true );
		$page_for_posts = get_option( 'page_for_posts' );

		if ( is_home() && $page_for_posts ) {
			$meta = get_post_meta( $page_for_posts, '_arendelle_page_layout', true );
		}

		if ( is_archive() || is_404() || is_search() || is_home() ) {
			$meta = '';
		}

		if ( 'left-sidebar' == get_theme_mod( 'arendelle_settings_' . $type .  '_layout_type', $default ) ) {
			$layout = ( $meta ) ? $meta : 'left-sidebar';		
		}

		if ( 'right-sidebar' == get_theme_mod( 'arendelle_settings_' . $type .  '_layout_type', $default ) ) {
			$layout = ( $meta ) ? $meta : 'right-sidebar';
		}

		if ( 'fullwidth' == get_theme_mod( 'arendelle_settings_' . $type .  '_layout_type', $default ) ) {			
			$layout = ( $meta ) ? $meta : 'fullwidth';
		}	

		return $layout;
	}
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function arendelle_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'arendelle-group-blog';
	}

	// Page Layout Class
	if ( is_page() ) {
		if ( arendelle_is_woocommerce_activated() ) {
			if ( is_front_page() ) {
				$classes[] = '';
			} elseif ( is_cart() || is_checkout() || is_account_page() ) {
				$classes[] = 'arendelle-' . arendelle_layout_type( 'shop_pages' );
			} else {
				$classes[] = 'arendelle-' . arendelle_layout_type( 'page' );
			}
		} else {
			$classes[] = 'arendelle-' . arendelle_layout_type( 'page' );
		}		
	}

	// Blog Layout Class
	if ( is_home() ) {
		$classes[] = 'arendelle-' . arendelle_layout_type( 'blog', 'right-sidebar' );
	}

	// Single Post Layout Class
	if ( is_single() ) {
		if ( arendelle_is_woocommerce_activated() && is_product() ) {
			$classes[] = '';
		} else {
			$classes[] = 'arendelle-' . arendelle_layout_type( 'single_post' );
		}
	}
    
	// Archives Layout Class
	if ( is_archive() ) {
		if ( arendelle_is_woocommerce_activated() && is_shop() ) {
			$classes[] = '';	
		} else {
			$classes[] = 'arendelle-' . arendelle_layout_type( 'archive' );
		}
	}

	// Search Layout Class
	if ( is_search() ) {
		$classes[] = 'arendelle-' . arendelle_layout_type( 'search_results' );	
	}

	// Shop Layout Class
	if ( arendelle_is_woocommerce_activated() ) {
		if ( ! is_product() && is_woocommerce() || is_shop() ) {
			$classes[] = 'arendelle-' . arendelle_layout_type( 'shop', 'left-sidebar' );
		}
	}

	$classes[] = '';

	return $classes;
}
add_filter( 'body_class', 'arendelle_body_classes' );


/**
 * Adds custom admin classes.
 *
 * @param string $classes Classes for the body element.
 * @return string
 */
function arendelle_admin_body_classes( $classes ) {

	$screen = get_current_screen();

	// Add single post layout class
	if ( $screen->id === "post" ) {
		$classes = 'arendelle-' . arendelle_layout_type( 'single_post' );
	}

	// Add page layout class
	if ( $screen->id === "page" ) {
		$classes = 'arendelle-' . arendelle_layout_type( 'page' );
	}
	
	return $classes;
}
add_filter( 'admin_body_class', 'arendelle_admin_body_classes' );