<?php
/**
 * WooCommerce theme hooks
 *
 * @package Arendelle
 */

/**
 * Layout
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
add_action( 'woocommerce_before_main_content', 'arendelle_shop_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'arendelle_shop_after_content', 9 );
add_action( 'arendelle_shop_sidebar', 'arendelle_shop_get_sidebar', 10 );


/**
 * Products
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'arendelle_product_markup_open' );
add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_hover_shop_loop_image' ); 

// Add to cart / Quickview / Wishlist
add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_before_add_to_cart' );

if ( class_exists( 'YITH_WCWL' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_add_to_wishlist' );
}

add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_actions_open' );

if ( class_exists( 'YITH_WCQV' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_quickview' );
}

add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_add_to_cart' );

add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_actions_close' );

add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_after_add_to_cart' );

if ( function_exists( 'YITH_WCQV_Frontend' ) ) {
	remove_action( 'init', array( YITH_WCQV_Frontend(), 'add_button' ) );
}


// Image holder close
add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_image_holder_close' );

// Product link
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open' );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close' );

// Outer close
add_action( 'woocommerce_before_shop_loop_item_title', 'arendelle_product_outer_close' );

// Product title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
add_action( 'woocommerce_shop_loop_item_title', 'arendelle_product_title' );
add_action( 'woocommerce_after_shop_loop_item_title', 'arendelle_after_product_price', 10 );


/**
 * Single Product
 */
add_action( 'woocommerce_share', 'arendelle_product_share' );


/**
 * Widgets
 */
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'arendelle_shop_tag_cloud_widget' );


/**
 * Breadcrumbs
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'arendelle_shop_breadcrumbs', 'woocommerce_breadcrumb', 10 );
add_action( 'woocommerce_single_product_summary', 'arendelle_shop_breadcrumbs', 4 );
add_filter( 'woocommerce_breadcrumb_defaults', 'arendelle_shop_breadcrumb_delimiter' );


/**
 * Page Title
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );


/**
 * AJAX Cart
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'arendelle_woo_cart_ajax_count' );



/**
 * Quantity buttons
 */
add_action( 'woocommerce_after_quantity_input_field', 'arendelle_quantity_plus_sign' ); 
function arendelle_quantity_plus_sign() {
	echo '<span class="quantity__button quantity__plus"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>';
}
 
add_action( 'woocommerce_before_quantity_input_field', 'arendelle_quantity_minus_sign' );
function arendelle_quantity_minus_sign() {
	echo '<span class="quantity__button quantity__minus"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>';
}

add_action( 'wp_footer', 'arendelle_quantity_plus_minus' ); 
function arendelle_quantity_plus_minus() {

   ?>
		<script type="text/javascript">
						
			jQuery(document).ready(function($) {   
					
				var forms = jQuery('.woocommerce-cart-form, form.cart');
						forms.find('.quantity.hidden').prev( '.quantity__button' ).hide();
						forms.find('.quantity.hidden').next( '.quantity__button' ).hide();

				$(document).on( 'click', 'form.cart .quantity__button, .woocommerce-cart-form .quantity__button', function() {

					var $this = $(this);					

					// Get current quantity values
					var qty = $this.closest( '.quantity' ).find( '.qty' );
					var val = ( qty.val() == '' ) ? 0 : parseFloat(qty.val());
					var max = parseFloat(qty.attr( 'max' ));
					var min = parseFloat(qty.attr( 'min' ));
					var step = parseFloat(qty.attr( 'step' ));

					// Change the value if plus or minus
					if ( $this.is( '.quantity__plus' ) ) {
						if ( max && ( max <= val ) ) {
							qty.val( max ).change();
						} 
						else {
							qty.val( val + step ).change();
						}
					} 
					else {
						if ( min && ( min >= val ) ) {
							qty.val( min ).change();
						} 
						else if ( val >= 1 ) {
							qty.val( val - step ).change();
						}
					}							
				});          
			});
						
		</script>
   <?php
}



