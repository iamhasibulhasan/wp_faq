<?php
/**
 * WooCommerce Theme Functions.
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
 * Product image back on hover
 */
if ( ! function_exists( 'arendelle_hover_shop_loop_image' ) ) {
	function arendelle_hover_shop_loop_image() {
		$image_id = isset( wc_get_product()->get_gallery_image_ids()[0] ) ? wc_get_product()->get_gallery_image_ids()[0] : null; 

		if ( $image_id ) {
			echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', '', [ 'class' => 'arendelle-product-image-back'] ) ;
		}
	}
}


/**
 * Wislist count
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'arendelle_wishlist_count' ) ) {
	function arendelle_wishlist_count() {
		ob_start(); ?>
		<span class="yith-wcwl-items-count">
			<?php echo esc_html( yith_wcwl_count_all_products() ); ?>
		</span>
		<?php return ob_get_clean();
	}
}

/**
 * Wislist Ajax update
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'arendelle_wishlist_ajax_update_count' ) ) {
	function arendelle_wishlist_ajax_update_count() {
		wp_send_json( array(
			'count' => yith_wcwl_count_all_products()
		) );
	}
	add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'arendelle_wishlist_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'arendelle_wishlist_ajax_update_count' );
}

/**
 * Wislist JS
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'arendelle_wishlist_enqueue_script' ) ) {
 function arendelle_wishlist_enqueue_script() {
  wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
							if ( 0 === data.count ) {
								$('.arendelle-menu-wishlist__count').addClass('d-none');								
							} else {
								$('.arendelle-menu-wishlist__count').removeClass('d-none')
							}
							$('.yith-wcwl-items-count').html( data.count );           
            } );
          } );
        } );
      "
  );
 }
 add_action( 'wp_enqueue_scripts', 'arendelle_wishlist_enqueue_script', 20 );
 }


/**
 * WooCommerce cart
 */
if ( ! function_exists( 'arendelle_woo_cart_icon' ) ) {
	function arendelle_woo_cart_icon( $minicart_show = 'false', $id = '' ) {

		if ( ! arendelle_is_woocommerce_activated() ) {
			return;
		}

		$count = WC()->cart->get_cart_contents_count();
		$minicart_show = $minicart_show === 'true' ? true : false;
		?>

		<div class="arendelle-menu-cart woocommerce">
			<a class="arendelle-menu-cart__url arendelle-offcanvas-js-trigger <?php if ( ! empty( $id ) && $minicart_show ) echo 'arendelle-offcanvas-js-trigger-' . esc_attr( $id ); ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View my shopping cart', 'arendelle' ); ?>">
				<span class="arendelle-menu-cart__icon-holder">
					<i class="arendelle-icon-cart arendelle-menu-cart__icon" aria-hidden="true"></i>
					<span class="arendelle-menu-cart__count arendelle-item-counter <?php if ( 0 === $count ) 'd-none' ?>"><?php echo esc_html( $count ); ?></span>
				</span>
			</a>

			<?php if ( $minicart_show ) : ?>

				<div class="arendelle-offcanvas <?php if ( ! empty( $id ) ) echo 'arendelle-offcanvas-' . esc_attr( $id ); ?>">
					<div class="arendelle-offcanvas__panel">
						<div class="arendelle-offcanvas__panel-header">
							<h6 class="arendelle-offcanvas__panel-header-title"><?php echo esc_html__( 'Cart', 'arendelle' ); ?></h6>
							<button class="arendelle-offcanvas__close">
								<span class="screen-reader-text"><?php echo esc_html__( 'Close offcanvas panel', 'arendelle' ); ?></span>
								<svg class="arendelle-offcanvas__close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
							</button>
						</div>
						
						<div class="arendelle-offcanvas__mini-cart">
							<?php if ( 0 === $count ) {
								echo '<div class="arendelle-offcanvas__mini-cart-empty">';
									echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>';
							} ?>

							<?php woocommerce_mini_cart(); ?>

							<?php if ( 0 === $count ) {
								echo '</div>';
							} ?>

						</div>
					</div>
					<div class="arendelle-offcanvas__overlay elementor-clickable"></div>
				</div>

			<?php endif; ?>

		</div>
		<?php

	}
}

/**
 * WooCommerce Ajax cart contents update
 */
function arendelle_woo_cart_ajax_count( $fragments ) {
	if ( ! arendelle_is_woocommerce_activated() ) {
		return;
	}

	$count = WC()->cart->get_cart_contents_count();

	// count
	if ( 0 === $count ) {
		$fragments['.arendelle-menu-cart__count'] = '<span class="arendelle-menu-cart__count arendelle-item-counter d-none">' . esc_html( $count ) . '</span>';
	} else {
		$fragments['.arendelle-menu-cart__count'] = '<span class="arendelle-menu-cart__count arendelle-item-counter">' . esc_html( $count ) . '</span>';
	}	

	// mini-cart
	ob_start();
	echo '<div class="arendelle-offcanvas__mini-cart">';
		if ( 0 === $count ) {
			echo '<div class="arendelle-offcanvas__mini-cart-empty">';
				echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>';
		}

		woocommerce_mini_cart();

		if ( 0 === $count ) {
			echo '</div>';
		}

	echo '</div>';

	$fragments['.arendelle-offcanvas__mini-cart'] = ob_get_clean();
	
	return $fragments;
}



if ( ! function_exists( 'arendelle_shop_before_content' ) ) {
	/**
	* Archives layout before
	*/
	function arendelle_shop_before_content() {
		?>
			<?php arendelle_shop_page_title(); ?>

			<div class="shop-section main-content-shop">
				<div class="container">

					<div class="row">
	
						<div class="shop-content content col-lg">
		<?php
	}
}


if ( ! function_exists( 'arendelle_shop_after_content' ) ) {
	/**
	* Archives layout after
	*/
	function arendelle_shop_after_content() {
		?>
						</div> <!-- .col -->
		
						<?php if ( 'fullwidth' !== arendelle_layout_type( 'shop', 'left-sidebar' ) && ! is_product() ) {
							do_action( 'arendelle_shop_sidebar' );
						} ?>

					</div> <!-- .row -->
				</div> <!-- .container -->
			</div> <!-- .main-content -->
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_markup_open' ) ) {
	/**
	* Product markup open
	*/
	function arendelle_product_markup_open() {
		?>
			<div class="arendelle-product">
				<div class="arendelle-product__image-holder">
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_before_add_to_cart' ) ) {
	/**
	* Product before add to cart
	*/
	function arendelle_product_before_add_to_cart() {
		?>
			<div class="arendelle-product__overlay">
		<?php
	}
}


if ( ! function_exists( 'arendelle_product_actions_open' ) ) {
	/**
	* Product actions open
	*/
	function arendelle_product_actions_open() {
		?>
			<div class="arendelle-product__actions">
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_quickview' ) ) {
	/**
	* Product quickview
	*/
	function arendelle_product_quickview() {
		if ( class_exists( 'YITH_WCQV' ) ) {
			echo '<div class="arendelle-product__quickview-button">';
				echo do_shortcode( '[yith_quick_view]' );
			echo '</div> <!-- .arendelle-product__quickview-button -->';
		}
	}
}

if ( ! function_exists( 'arendelle_product_add_to_cart' ) ) {
	/**
	* Product actions open
	*/
	function arendelle_product_add_to_cart() {
		echo '<div class="arendelle-product__add-to-cart">';
			echo woocommerce_template_loop_add_to_cart();
		echo '</div>';
	}
}


if ( ! function_exists( 'arendelle_product_actions_close' ) ) {
	/**
	* Product actions close
	*/
	function arendelle_product_actions_close() {
		?>
			</div> <!-- .arendelle-product__actions -->
		<?php
	}
}


if ( ! function_exists( 'arendelle_product_add_to_wishlist' ) ) {
	/**
	* Product add to wishlisht
	*/
	function arendelle_product_add_to_wishlist() {
		if ( class_exists( 'YITH_WCWL' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist icon="fa-heart-o"]' );
		}
	}
}


if ( ! function_exists( 'arendelle_product_after_add_to_cart' ) ) {
	/**
	* Product after add to cart
	*/
	function arendelle_product_after_add_to_cart() {
		?>
			</div> <!-- .arendelle-product__overlay -->
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_image_holder_close' ) ) {
	/**
	* Product image holder close
	*/
	function arendelle_product_image_holder_close() {
		?>
			</div> <!-- .arendelle-product__image-holder -->
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_outer_close' ) ) {
	/**
	* Product after link close
	*/
	function arendelle_product_outer_close() {
		?>
			</div> <!-- .arendelle-product -->
			<div class="arendelle-product-body">
		<?php
	}
}

if ( ! function_exists( 'arendelle_product_title' ) ) {
	/**
	* Product title
	*/
	function arendelle_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">';
			woocommerce_template_loop_product_link_open();
				echo get_the_title(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			woocommerce_template_loop_product_link_close();
		echo '</h2>';
	}
}

if ( ! function_exists( 'arendelle_after_product_price' ) ) {
	/**
	* Product after price
	*/
	function arendelle_after_product_price() {
		echo '</div> <!-- .arendelle-product-body -->';
	}
}

if ( ! function_exists( 'arendelle_product_share' ) ) {
	/**
	* Product share
	*/
	function arendelle_product_share() {
		if ( ! get_theme_mod( 'arendelle_settings_product_share_buttons_show', true ) ) {
			return;
		}

		if ( function_exists( 'arendelle_social_sharing_buttons' ) ) : ?>
			<div class="product-share">
				<?php
					echo '<span class="product-share__label">' . esc_html__( 'Share', 'arendelle' ) . '</span>';
					echo arendelle_social_sharing_buttons( 'socials--no-base', 'product' );
				?>
			</div>
		<?php endif;
	}
}


if ( ! function_exists( 'arendelle_shop_page_title' ) ) {
	/**
	* Shop page title
	*/
	function arendelle_shop_page_title() {
		
		if ( is_woocommerce() && ! is_product() ) {
			get_template_part( 'template-parts/page-title/page-title-shop' );
		}

	}
}


if ( ! function_exists( 'arendelle_shop_get_sidebar' ) ) {
	/**
	 * Display shop sidebar
	 *
	 * @uses arendelle_sidebar()
	 * @since 1.0.0
	 */
	function arendelle_shop_get_sidebar() {
		if ( is_active_sidebar( 'arendelle-shop-sidebar' ) ) {
			arendelle_sidebar( 'arendelle-shop-sidebar' );
		}
	}
}


if ( ! function_exists( 'arendelle_shop_breadcrumbs' ) ) {
	/**
	* WooCommerce breadcrumbs
	*/
	function arendelle_shop_breadcrumbs() {
		if ( ! get_theme_mod( 'arendelle_settings_shop_breadcrumbs_show', true ) ) {
			return;
		}
		woocommerce_breadcrumb();
	}
}


if ( ! function_exists( 'arendelle_shop_breadcrumb_delimiter' ) ) {
	/**
	* Change the breadcrumb separator
	*/
	function arendelle_shop_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = ( is_rtl() ) ? '<i class="arendelle-icon-chevron-left woocommerce-breadcrumb__separator"></i>' : '<i class="arendelle-icon-chevron-right woocommerce-breadcrumb__separator"></i>';
		return $defaults;
	}
}


if ( ! function_exists( 'arendelle_shop_tag_cloud_widget' ) ) {
	/**
	* Tag cloud font size
	*/
	function arendelle_shop_tag_cloud_widget( $args ) {
		$args = array(
			'smallest' => 10, 
			'largest' => 10,
			'taxonomy' => 'product_tag'
		);
		return $args;
	}
}