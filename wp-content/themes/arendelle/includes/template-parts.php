<?php
/**
 * Template parts.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

add_action( 'arendelle_header_before', 'arendelle_top_bar' );
add_action( 'arendelle_header', 'arendelle_header_markup' );
add_action( 'arendelle_masthead', 'arendelle_masthead_template' );
add_action( 'arendelle_menu_after', 'arendelle_last_menu_item' );
add_action( 'arendelle_footer', 'arendelle_footer_template' );
add_action( 'arendelle_comments', 'arendelle_comments_template' );
add_action( 'arendelle_page_title_after', 'arendelle_breadcrumbs' );
add_action( 'arendelle_entry_section_before', 'arendelle_breadcrumbs' );
add_action( 'arendelle_entry_featured_image', 'arendelle_featured_image_markup' );


/**
 * Get site Header
 */
if ( ! function_exists( 'arendelle_header_markup' ) ) {
	function arendelle_header_markup() {
		if ( ! get_theme_mod( 'arendelle_settings_header_show', true ) ) {
			return;
		}

		if ( arendelle_is_woocommerce_activated() ) {
			if ( is_checkout() && get_theme_mod( 'arendelle_settings_woocommerce_distraction_free_checkout', true ) ) {
				return;
			}
		}

		$header_classes = array( 'arendelle-header', 'nav' );
		$header_sticky = ( get_theme_mod( 'arendelle_settings_sticky_header_show', true ) ) ? 'nav--sticky ' : '';
		$header_layout = get_theme_mod( 'arendelle_settings_header_layout', 'header-layout-1' );

		switch ( $header_layout ) {
			case 'header-layout-1':
				$header_classes[] = 'arendelle-header-layout-1';
				break;

			case 'header-layout-2':
				$header_classes[] = 'arendelle-header-layout-2';
				break;

			case 'header-layout-3':
				$header_classes[] = 'arendelle-header-layout-3';
				break;
		}

		$header_classes = implode( ' ', $header_classes );
		?>	

		<header class="<?php echo esc_attr( $header_classes ); ?>" role="banner" itemtype="https://schema.org/WPHeader" itemscope="itemscope">
			<div class="nav__holder <?php echo esc_attr( $header_sticky ); ?>">
				<div class="nav__container container">
					<div class="nav__flex-parent flex-parent">

						<?php arendelle_masthead(); ?>

					</div> <!-- .flex-parent -->
				</div> <!-- .nav__container -->
			</div> <!-- .nav__holder -->
		</header> <!-- .arendelle-header -->		
		
		<?php
	}
}


/**
 * Header main template
 */
if ( ! function_exists( 'arendelle_masthead_template' ) ) {
	function arendelle_masthead_template() {
		get_template_part( 'template-parts/header/header-main-template' );
	}
}


/**
 * Header last item in menu
 */
if ( ! function_exists( 'arendelle_last_menu_item' ) ) {
	function arendelle_last_menu_item( $is_mobile = false ) {
		$text_html = get_theme_mod( 'arendelle_settings_header_last_menu_item_text_html' );
		$hide_on_mobile = get_theme_mod( 'arendelle_settings_header_last_menu_item_hide', false );

		$search = get_theme_mod( 'arendelle_settings_header_last_menu_item_search', true );
		$cart = get_theme_mod( 'arendelle_settings_header_last_menu_item_shopping_cart', true );
		$account = get_theme_mod( 'arendelle_settings_header_last_menu_item_account', true );		
		$html = get_theme_mod( 'arendelle_settings_header_last_menu_item_html', false );

		if ( $hide_on_mobile ) {
			return;
		}

		if ( false === $search && false === $cart && false === $account && false === $html ) {
			return;
		}

		if ( ! $is_mobile ) {
			echo '<div class="nav__right d-lg-flex d-none">';
		}		

			if ( $search ) { ?>
				<div class="nav__right-item">
					<div class="arendelle-menu-search">
						<button type="button" class="arendelle-menu-search__trigger" title="<?php echo esc_attr__( 'Open Search', 'arendelle' ); ?>">
							<i class="arendelle-icon-search arendelle-menu-search__icon" aria-hidden="true"></i>
						</button>
						<div class="arendelle-menu-search-modal" tabindex="-1" aria-hidden="true" aria-label="<?php echo esc_attr( 'Search Modal', 'arendelle' ); ?>">
							<div class="arendelle-menu-search-modal__inner">
								<div class="container">
									<form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
										<label>
											<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'arendelle' ); ?></span>
											<input type="search" class="search-input" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'arendelle' ); ?>" value="<?php the_search_query(); ?>" name="s" />
										</label>
										<button type="button" class="arendelle-menu-search-modal__close" aria-label="<?php echo esc_attr( 'Close Search', 'arendelle' ); ?>">
											<span aria-hidden="true">
												<i class="arendelle-icon-close arendelle-menu-search-modal__close-icon"></i>
											</span>
										</button>	
									</form>
								</div>				
							</div>
						</div>
					</div>
				</div>				
				<?php
			}
			
			if ( $account && arendelle_is_woocommerce_activated() ) { ?>
				<div class="nav__right-item arendelle-menu-account">		
					<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="arendelle-menu-account__url">
						<i class="arendelle-icon-user arendelle-menu-account__icon" aria-hidden="true"></i>
					</a>
				</div>
				<?php					
			}

			if ( $cart && arendelle_is_woocommerce_activated() ) {
				echo '<div class="nav__right-item">';
					arendelle_woo_cart_icon();
				echo '</div>';
			}

			if ( $html ) {
				echo '<div class="nav__right-item">';
					// We don't escape output here, so user can enter any HTML
					echo do_shortcode( $text_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</div>';
			}

		if ( ! $is_mobile ) {
			echo '</div>';
		}

	}
}


/**
 * Top bar
 */
if ( ! function_exists( 'arendelle_top_bar' ) ) {
	function arendelle_top_bar() {
		if ( class_exists( 'woocommerce' ) ) {
			if ( is_checkout() && get_theme_mod( 'arendelle_settings_woocommerce_distraction_free_checkout', true ) ) {
				return;
			}
		}

		$message = get_theme_mod( 'arendelle_settings_top_bar_message', esc_html__( 'Free Shipping & Returns On All US Orders', 'arendelle' ) );
		$url = get_theme_mod( 'arendelle_settings_top_bar_url', '#' );
		
		$customizer = get_theme_mod( 'arendelle_settings_top_bar_show', false );
		$meta = get_post_meta( get_the_ID(), '_arendelle_top_bar_hide', true );

		if ( is_archive() || is_404() || is_search() || is_home() ) {
			$meta = '';
		}

		if ( $customizer && $meta != '1' ) {
			?>
			<div class="top-bar">
				<div class="container">
					<a href="<?php echo esc_url( $url ); ?>" class="top-bar__url">
						<p class="top-bar__message"><?php echo esc_html( $message ); ?></p>
					</a>				
				</div>
			</div>
			<?php
		}
	}
}


/**
 * Mobile menu
 */
if ( ! function_exists( 'arendelle_menu_mobile' ) ) {
	function arendelle_menu_mobile() { ?>
		<div class="nav__mobile d-lg-none">

			<?php arendelle_last_menu_item( true ); ?>

			<?php if ( has_nav_menu('primary-menu') ) : ?>
				<!-- Mobile toggle -->
				<button type="button" class="nav__icon-toggle" id="nav__icon-toggle" data-bs-toggle="collapse" data-bs-target="#navbar-collapse">
					<span class="visually-hidden"><?php esc_html_e( 'Toggle navigation', 'arendelle' ); ?></span>
					<span class="nav__icon-toggle-bar"></span>
					<span class="nav__icon-toggle-bar"></span>
					<span class="nav__icon-toggle-bar"></span>
				</button>
			<?php endif; ?>

		</div>
		<?php
	}
}


/**
 * Logo
 */
if ( ! function_exists( 'arendelle_logo' ) ) {
	function arendelle_logo() {
		$width = get_theme_mod( 'arendelle_settings_header_logo_width' );
		$logo_id = attachment_url_to_postid( get_theme_mod( 'arendelle_settings_logo_dark' ) );
		$size = ( is_customize_preview() ) ? 'full' : [ $width, 0 ];
		$logo = wp_get_attachment_image_src( $logo_id, $size );
		?>

		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-url logo-dark" itemtype="https://schema.org/Organization" itemscope="itemscope">
			<?php if ( get_theme_mod( 'arendelle_settings_logo_dark' ) || get_theme_mod( 'arendelle_settings_logo_dark_retina' ) ) : ?>
				<img src="<?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark' ) ) ?>" srcset="<?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark' ) ) . ' 1x' ?>, <?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark_retina' ) ) . ' 2x' ?>"
				class="logo logo--dark"
				width="<?php echo esc_attr( $logo[1] ); ?>"
				height="<?php echo esc_attr( $logo[2] ); ?>"
				alt="<?php bloginfo( 'name' ) ?>">
			<?php else : ?>
				<span class="site-title site-title--dark"><?php bloginfo( 'name' ) ?></span>
				<?php $tagline = get_bloginfo( 'description', 'display' ); ?>
				<p class="site-tagline"><?php echo esc_html( $tagline ); ?></p>
			<?php endif; ?>
		</a>

		<?php
	}
}


/**
 * Footer main template
 */
if ( ! function_exists( 'arendelle_footer_template' ) ) {
	function arendelle_footer_template() {
		if ( class_exists( 'woocommerce' ) ) {
			if ( is_checkout() && get_theme_mod( 'arendelle_settings_woocommerce_distraction_free_checkout', true ) ) {
				return;
			}
		}
		get_template_part( 'template-parts/footer/footer-main-template' );
	}
}


/**
 * Comments template
 */
if ( ! function_exists( 'arendelle_comments_template' ) ) {
	function arendelle_comments_template() {
	
		if ( comments_open() || get_comments_number() ) : ?>
			<!-- Comments -->
			<?php if ( arendelle_is_elementor_page() ) : ?>
				<div class="container">
			<?php else: ?>
				<div class="comments-wrap">
			<?php endif; ?>
				<?php comments_template(); ?>
			</div>
		<?php endif;
	}
}


/**
 * Preloader
 */
if ( ! function_exists( 'arendelle_preloader' ) ) {
	function arendelle_preloader() {
		if ( get_theme_mod( 'arendelle_settings_preloader_show', false ) ) : ?>
			<div class="loader-mask">
				<div class="loader">
					<div></div>
				</div>
			</div>
		<?php endif;
	}
}

/**
 * Back to top
 */
if ( ! function_exists( 'arendelle_back_to_top' ) ) {
	function arendelle_back_to_top() {
		if ( get_theme_mod( 'arendelle_settings_back_to_top_show', true ) ) : ?>
			<!-- Back to top -->
			<div id="back-to-top">
				<a href="#top" aria-label="<?php echo esc_attr__( 'Back to top', 'arendelle' )?>"><i class="arendelle-icon-chevron-up" aria-hidden="true"></i></a>
			</div>
		<?php endif; 
	}
}

/**
 * Content markup top
 */
if ( ! function_exists( 'arendelle_primary_content_markup_top' ) ) {
	function arendelle_primary_content_markup_top() {
		?>
			<div class="container">
				<div class="row">
		<?php
	}
}


/**
 * Content markup bottom
 */
if ( ! function_exists( 'arendelle_primary_content_markup_bottom' ) ) {
	function arendelle_primary_content_markup_bottom() {
		?>
				</div>
			</div>
		<?php
	}
}


if ( ! function_exists( 'arendelle_page_title_atts' ) ) {
	/**
	* Page title attributes
	*
	* @since 1.0.0
	*/
	function arendelle_page_title_atts( $template ) {
		$atts = '';
		$layout = get_theme_mod( 'arendelle_settings_' . $template . '_page_title_layout', 'page-title-layout-1' );
		$image = get_theme_mod( 'arendelle_settings_' . $template . '_page_title_image' );

		$classes = array(
			'page-title',
			$layout,
			'page-title-' . $template
		);

		if ( 'page-title-layout-2' === $layout ) {
			$classes[] = 'bg-overlay';
			$classes[] = 'bg-overlay--dark';

			if ( is_page() || is_single() && has_post_thumbnail() ) {
				$background_image = 'background-image: url(' . get_the_post_thumbnail_url() . ')';
			}

			if ( ! empty( $image ) ) {
				if ( is_home() || is_archive() || is_search() ) {
					$background_image = 'background-image: url(' . esc_url( $image ) . ')';
				}
			}
		}


		$classes = array_map( 'esc_attr', $classes );

		$classes = implode( ' ', $classes );

		$atts = 'class="' . esc_attr( $classes ) . '"';

		if ( isset( $background_image ) ) {
			$atts .= ' style="' . esc_attr( $background_image ) . '"'; 
		}		

		echo html_entity_decode( esc_attr( $atts ) );
	}
}

if ( ! function_exists( 'arendelle_breadcrumbs' ) ) {
	/**
	* Breadcrumbs
	*
	* @since 1.0.0
	*/
	function arendelle_breadcrumbs() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			return;
		}

		if ( is_archive() && ! is_search() && get_theme_mod( 'arendelle_settings_archives_breadcrumbs_show', true ) ) {
			
			if ( arendelle_is_woocommerce_activated() ) {
				if ( is_shop() ) {
					return;
				}				
			}

			breadcrumb_trail( array(
				'show_browse' => false,
			) );
		}

		if ( arendelle_is_woocommerce_activated() ) {
			if ( is_shop() && get_theme_mod( 'arendelle_settings_shop_breadcrumbs_show', true ) ) {
				breadcrumb_trail( array(
					'show_browse' => false,
				) );
			}
		}

		if ( is_search() && get_theme_mod( 'arendelle_settings_search_results_breadcrumbs_show', true ) ) {
			breadcrumb_trail( array(
				'show_browse' => false,
			) );
		}

		if ( is_page() || is_home() && get_theme_mod( 'arendelle_settings_regular_pages_breadcrumbs_show', true ) ) {

			if ( arendelle_is_woocommerce_activated() ) {
				if ( is_shop() ) {
					return;
				}				
			}

			breadcrumb_trail( array(
				'show_browse' => false,
			) );
		}
		
		if ( is_single() && get_theme_mod( 'arendelle_settings_single_post_breadcrumbs_show', true ) ) { ?>
			<div class="breadcrumbs-wrap">
				<div class="container">
					<?php breadcrumb_trail( array(
						'show_browse' => false,
					) ); ?>
				</div>
			</div>
			<?php
		}	
	}
}

if ( ! function_exists( 'arendelle_featured_image_markup' ) ) {
	/**
	* Single Entry Featured Image
	*
	* @since 1.0.0
	*/
	function arendelle_featured_image_markup() {
		if ( has_post_thumbnail() && get_theme_mod( 'arendelle_settings_single_featured_image_show', true ) ) : ?>

			<!-- Featured Image -->
			<div class="single-post__featured-img">
				<figure class="single-post__featured-img-container">
					<?php the_post_thumbnail( 'arendelle_featured_large', array( 'class' => 'single-post__featured-img-image' )); ?>
				</figure>
			</div>

		<?php endif;
	}
}

if ( ! function_exists( 'arendelle_read_more' ) ) {
	/**
	* Read more
	*
	* @since 1.0.0
	*/
	function arendelle_read_more() {
		$text = get_theme_mod( 'arendelle_settings_read_more_text', __( 'Read More', 'arendelle' ) );

		if ( get_theme_mod( 'arendelle_settings_read_more_show', true ) ) : ?>
			<!-- Read More -->
			<div class="entry__read-more">			
				<a href="<?php the_permalink(); ?>" class="read-more">
					<?php if ( $text ) : ?>
						<span class="read-more__text">							
							<?php printf( '<span class="screen-reader-text">' . get_the_title() . '</span> ' . esc_html( $text ) ); ?>
						</span>						
					<?php endif; ?>
					<i class="read-more__icon arendelle-icon-chevron-right" aria-hidden="true"></i>
				</a>
			</div>
		<?php endif;
	}
}



/**
 * Footer bottom text
 */
if ( ! function_exists( 'arendelle_footer_bottom_text' ) ) {

	/**
	 * Footer bottom text
	 *
	 * @since 1.0.0
	 */
	function arendelle_footer_bottom_text() {
		$output = get_theme_mod( 'arendelle_settings_footer_bottom_text', sprintf(
			esc_html__( 'Copyright &copy; [current_year] %1$s | Made by %2$sDeoThemes%3$s' , 'arendelle' ),
			get_bloginfo( 'name' ),
			'<a href="'. esc_url( 'https://deothemes.com' ) . '">',
			'</a>'
		) );

		$output = str_replace( '[current_year]', date_i18n( 'Y' ), $output );

		echo do_shortcode( wp_kses_post( $output ) );
	}
}


/**
 * Footer payment icons
 */
if ( ! function_exists( 'arendelle_footer_payment_icons' ) ) {

	/**
	 * Footer payment icons
	 *
	 * @since 1.0.0
	 */
	function arendelle_footer_payment_icons() {
		?>
		<ul class="footer__payment-icons">
			<?php
				$icons = array(
					'visa' => get_theme_mod( 'arendelle_settings_footer_payment_icon_visa', true ),
					'paypal' => get_theme_mod( 'arendelle_settings_footer_payment_icon_paypal', true ),
					'mastercard' => get_theme_mod( 'arendelle_settings_footer_payment_icon_mastercard', true ),
					'stripe' => get_theme_mod( 'arendelle_settings_footer_payment_icon_stripe', true ),
					'discover' => get_theme_mod( 'arendelle_settings_footer_payment_icon_discover', true ),
					'amex' => get_theme_mod( 'arendelle_settings_footer_payment_icon_amex', true ),
					'diners' => get_theme_mod( 'arendelle_settings_footer_payment_icon_diners', false ),
					'jcb' => get_theme_mod( 'arendelle_settings_footer_payment_icon_jcb', false ),
					'apple-pay' => get_theme_mod( 'arendelle_settings_footer_payment_icon_apple_pay', false ),
					'google-pay' => get_theme_mod( 'arendelle_settings_footer_payment_icon_google_pay', false ),
					'amazon-pay' => get_theme_mod( 'arendelle_settings_footer_payment_icon_amazon_pay', false ),
					'alipay' => get_theme_mod( 'arendelle_settings_footer_payment_icon_alipay', false ),
				);

				if ( $icons['visa'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-visa" class="svg-inline--fa fa-cc-visa fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M470.1 231.3s7.6 37.2 9.3 45H446c3.3-8.9 16-43.5 16-43.5-.2.3 3.3-9.1 5.3-14.9l2.8 13.4zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM152.5 331.2L215.7 176h-42.5l-39.3 106-4.3-21.5-14-71.4c-2.3-9.9-9.4-12.7-18.2-13.1H32.7l-.7 3.1c15.8 4 29.9 9.8 42.2 17.1l35.8 135h42.5zm94.4.2L272.1 176h-40.2l-25.1 155.4h40.1zm139.9-50.8c.2-17.7-10.6-31.2-33.7-42.3-14.1-7.1-22.7-11.9-22.7-19.2.2-6.6 7.3-13.4 23.1-13.4 13.1-.3 22.7 2.8 29.9 5.9l3.6 1.7 5.5-33.6c-7.9-3.1-20.5-6.6-36-6.6-39.7 0-67.6 21.2-67.8 51.4-.3 22.3 20 34.7 35.2 42.2 15.5 7.6 20.8 12.6 20.8 19.3-.2 10.4-12.6 15.2-24.1 15.2-16 0-24.6-2.5-37.7-8.3l-5.3-2.5-5.6 34.9c9.4 4.3 26.8 8.1 44.8 8.3 42.2.1 69.7-20.8 70-53zM528 331.4L495.6 176h-31.1c-9.6 0-16.9 2.8-21 12.9l-59.7 142.5H426s6.9-19.2 8.4-23.3H486c1.2 5.5 4.8 23.3 4.8 23.3H528z"></path></svg>
					</li>
				<?php endif; ?>
				
				<?php if ( $icons['paypal'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-paypal" class="svg-inline--fa fa-cc-paypal fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M186.3 258.2c0 12.2-9.7 21.5-22 21.5-9.2 0-16-5.2-16-15 0-12.2 9.5-22 21.7-22 9.3 0 16.3 5.7 16.3 15.5zM80.5 209.7h-4.7c-1.5 0-3 1-3.2 2.7l-4.3 26.7 8.2-.3c11 0 19.5-1.5 21.5-14.2 2.3-13.4-6.2-14.9-17.5-14.9zm284 0H360c-1.8 0-3 1-3.2 2.7l-4.2 26.7 8-.3c13 0 22-3 22-18-.1-10.6-9.6-11.1-18.1-11.1zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM128.3 215.4c0-21-16.2-28-34.7-28h-40c-2.5 0-5 2-5.2 4.7L32 294.2c-.3 2 1.2 4 3.2 4h19c2.7 0 5.2-2.9 5.5-5.7l4.5-26.6c1-7.2 13.2-4.7 18-4.7 28.6 0 46.1-17 46.1-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.2 8.2-5.8-8.5-14.2-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9 0 20.2-4.9 26.5-11.9-.5 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H200c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm40.5 97.9l63.7-92.6c.5-.5.5-1 .5-1.7 0-1.7-1.5-3.5-3.2-3.5h-19.2c-1.7 0-3.5 1-4.5 2.5l-26.5 39-11-37.5c-.8-2.2-3-4-5.5-4h-18.7c-1.7 0-3.2 1.8-3.2 3.5 0 1.2 19.5 56.8 21.2 62.1-2.7 3.8-20.5 28.6-20.5 31.6 0 1.8 1.5 3.2 3.2 3.2h19.2c1.8-.1 3.5-1.1 4.5-2.6zm159.3-106.7c0-21-16.2-28-34.7-28h-39.7c-2.7 0-5.2 2-5.5 4.7l-16.2 102c-.2 2 1.3 4 3.2 4h20.5c2 0 3.5-1.5 4-3.2l4.5-29c1-7.2 13.2-4.7 18-4.7 28.4 0 45.9-17 45.9-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.3 8.2-5.5-8.5-14-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9.3 0 20.5-4.9 26.5-11.9-.3 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H484c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm47.5-33.3c0-2-1.5-3.5-3.2-3.5h-18.5c-1.5 0-3 1.2-3.2 2.7l-16.2 104-.3.5c0 1.8 1.5 3.5 3.5 3.5h16.5c2.5 0 5-2.9 5.2-5.7L544 191.2v-.3zm-90 51.8c-12.2 0-21.7 9.7-21.7 22 0 9.7 7 15 16.2 15 12 0 21.7-9.2 21.7-21.5.1-9.8-6.9-15.5-16.2-15.5z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['mastercard'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-mastercard" class="svg-inline--fa fa-cc-mastercard fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M482.9 410.3c0 6.8-4.6 11.7-11.2 11.7-6.8 0-11.2-5.2-11.2-11.7 0-6.5 4.4-11.7 11.2-11.7 6.6 0 11.2 5.2 11.2 11.7zm-310.8-11.7c-7.1 0-11.2 5.2-11.2 11.7 0 6.5 4.1 11.7 11.2 11.7 6.5 0 10.9-4.9 10.9-11.7-.1-6.5-4.4-11.7-10.9-11.7zm117.5-.3c-5.4 0-8.7 3.5-9.5 8.7h19.1c-.9-5.7-4.4-8.7-9.6-8.7zm107.8.3c-6.8 0-10.9 5.2-10.9 11.7 0 6.5 4.1 11.7 10.9 11.7 6.8 0 11.2-4.9 11.2-11.7 0-6.5-4.4-11.7-11.2-11.7zm105.9 26.1c0 .3.3.5.3 1.1 0 .3-.3.5-.3 1.1-.3.3-.3.5-.5.8-.3.3-.5.5-1.1.5-.3.3-.5.3-1.1.3-.3 0-.5 0-1.1-.3-.3 0-.5-.3-.8-.5-.3-.3-.5-.5-.5-.8-.3-.5-.3-.8-.3-1.1 0-.5 0-.8.3-1.1 0-.5.3-.8.5-1.1.3-.3.5-.3.8-.5.5-.3.8-.3 1.1-.3.5 0 .8 0 1.1.3.5.3.8.3 1.1.5s.2.6.5 1.1zm-2.2 1.4c.5 0 .5-.3.8-.3.3-.3.3-.5.3-.8 0-.3 0-.5-.3-.8-.3 0-.5-.3-1.1-.3h-1.6v3.5h.8V426h.3l1.1 1.4h.8l-1.1-1.3zM576 81v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V81c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM64 220.6c0 76.5 62.1 138.5 138.5 138.5 27.2 0 53.9-8.2 76.5-23.1-72.9-59.3-72.4-171.2 0-230.5-22.6-15-49.3-23.1-76.5-23.1-76.4-.1-138.5 62-138.5 138.2zm224 108.8c70.5-55 70.2-162.2 0-217.5-70.2 55.3-70.5 162.6 0 217.5zm-142.3 76.3c0-8.7-5.7-14.4-14.7-14.7-4.6 0-9.5 1.4-12.8 6.5-2.4-4.1-6.5-6.5-12.2-6.5-3.8 0-7.6 1.4-10.6 5.4V392h-8.2v36.7h8.2c0-18.9-2.5-30.2 9-30.2 10.2 0 8.2 10.2 8.2 30.2h7.9c0-18.3-2.5-30.2 9-30.2 10.2 0 8.2 10 8.2 30.2h8.2v-23zm44.9-13.7h-7.9v4.4c-2.7-3.3-6.5-5.4-11.7-5.4-10.3 0-18.2 8.2-18.2 19.3 0 11.2 7.9 19.3 18.2 19.3 5.2 0 9-1.9 11.7-5.4v4.6h7.9V392zm40.5 25.6c0-15-22.9-8.2-22.9-15.2 0-5.7 11.9-4.8 18.5-1.1l3.3-6.5c-9.4-6.1-30.2-6-30.2 8.2 0 14.3 22.9 8.3 22.9 15 0 6.3-13.5 5.8-20.7.8l-3.5 6.3c11.2 7.6 32.6 6 32.6-7.5zm35.4 9.3l-2.2-6.8c-3.8 2.1-12.2 4.4-12.2-4.1v-16.6h13.1V392h-13.1v-11.2h-8.2V392h-7.6v7.3h7.6V416c0 17.6 17.3 14.4 22.6 10.9zm13.3-13.4h27.5c0-16.2-7.4-22.6-17.4-22.6-10.6 0-18.2 7.9-18.2 19.3 0 20.5 22.6 23.9 33.8 14.2l-3.8-6c-7.8 6.4-19.6 5.8-21.9-4.9zm59.1-21.5c-4.6-2-11.6-1.8-15.2 4.4V392h-8.2v36.7h8.2V408c0-11.6 9.5-10.1 12.8-8.4l2.4-7.6zm10.6 18.3c0-11.4 11.6-15.1 20.7-8.4l3.8-6.5c-11.6-9.1-32.7-4.1-32.7 15 0 19.8 22.4 23.8 32.7 15l-3.8-6.5c-9.2 6.5-20.7 2.6-20.7-8.6zm66.7-18.3H408v4.4c-8.3-11-29.9-4.8-29.9 13.9 0 19.2 22.4 24.7 29.9 13.9v4.6h8.2V392zm33.7 0c-2.4-1.2-11-2.9-15.2 4.4V392h-7.9v36.7h7.9V408c0-11 9-10.3 12.8-8.4l2.4-7.6zm40.3-14.9h-7.9v19.3c-8.2-10.9-29.9-5.1-29.9 13.9 0 19.4 22.5 24.6 29.9 13.9v4.6h7.9v-51.7zm7.6-75.1v4.6h.8V302h1.9v-.8h-4.6v.8h1.9zm6.6 123.8c0-.5 0-1.1-.3-1.6-.3-.3-.5-.8-.8-1.1-.3-.3-.8-.5-1.1-.8-.5 0-1.1-.3-1.6-.3-.3 0-.8.3-1.4.3-.5.3-.8.5-1.1.8-.5.3-.8.8-.8 1.1-.3.5-.3 1.1-.3 1.6 0 .3 0 .8.3 1.4 0 .3.3.8.8 1.1.3.3.5.5 1.1.8.5.3 1.1.3 1.4.3.5 0 1.1 0 1.6-.3.3-.3.8-.5 1.1-.8.3-.3.5-.8.8-1.1.3-.6.3-1.1.3-1.4zm3.2-124.7h-1.4l-1.6 3.5-1.6-3.5h-1.4v5.4h.8v-4.1l1.6 3.5h1.1l1.4-3.5v4.1h1.1v-5.4zm4.4-80.5c0-76.2-62.1-138.3-138.5-138.3-27.2 0-53.9 8.2-76.5 23.1 72.1 59.3 73.2 171.5 0 230.5 22.6 15 49.5 23.1 76.5 23.1 76.4.1 138.5-61.9 138.5-138.4z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['stripe'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-stripe" class="svg-inline--fa fa-cc-stripe fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M492.4 220.8c-8.9 0-18.7 6.7-18.7 22.7h36.7c0-16-9.3-22.7-18-22.7zM375 223.4c-8.2 0-13.3 2.9-17 7l.2 52.8c3.5 3.7 8.5 6.7 16.8 6.7 13.1 0 21.9-14.3 21.9-33.4 0-18.6-9-33.2-21.9-33.1zM528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM122.2 281.1c0 25.6-20.3 40.1-49.9 40.3-12.2 0-25.6-2.4-38.8-8.1v-33.9c12 6.4 27.1 11.3 38.9 11.3 7.9 0 13.6-2.1 13.6-8.7 0-17-54-10.6-54-49.9 0-25.2 19.2-40.2 48-40.2 11.8 0 23.5 1.8 35.3 6.5v33.4c-10.8-5.8-24.5-9.1-35.3-9.1-7.5 0-12.1 2.2-12.1 7.7 0 16 54.3 8.4 54.3 50.7zm68.8-56.6h-27V275c0 20.9 22.5 14.4 27 12.6v28.9c-4.7 2.6-13.3 4.7-24.9 4.7-21.1 0-36.9-15.5-36.9-36.5l.2-113.9 34.7-7.4v30.8H191zm74 2.4c-4.5-1.5-18.7-3.6-27.1 7.4v84.4h-35.5V194.2h30.7l2.2 10.5c8.3-15.3 24.9-12.2 29.6-10.5h.1zm44.1 91.8h-35.7V194.2h35.7zm0-142.9l-35.7 7.6v-28.9l35.7-7.6zm74.1 145.5c-12.4 0-20-5.3-25.1-9l-.1 40.2-35.5 7.5V194.2h31.3l1.8 8.8c4.9-4.5 13.9-11.1 27.8-11.1 24.9 0 48.4 22.5 48.4 63.8 0 45.1-23.2 65.5-48.6 65.6zm160.4-51.5h-69.5c1.6 16.6 13.8 21.5 27.6 21.5 14.1 0 25.2-3 34.9-7.9V312c-9.7 5.3-22.4 9.2-39.4 9.2-34.6 0-58.8-21.7-58.8-64.5 0-36.2 20.5-64.9 54.3-64.9 33.7 0 51.3 28.7 51.3 65.1 0 3.5-.3 10.9-.4 12.9z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['discover'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-discover" class="svg-inline--fa fa-cc-discover fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M520.4 196.1c0-7.9-5.5-12.1-15.6-12.1h-4.9v24.9h4.7c10.3 0 15.8-4.4 15.8-12.8zM528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-44.1 138.9c22.6 0 52.9-4.1 52.9 24.4 0 12.6-6.6 20.7-18.7 23.2l25.8 34.4h-19.6l-22.2-32.8h-2.2v32.8h-16zm-55.9.1h45.3v14H444v18.2h28.3V217H444v22.2h29.3V253H428zm-68.7 0l21.9 55.2 22.2-55.2h17.5l-35.5 84.2h-8.6l-35-84.2zm-55.9-3c24.7 0 44.6 20 44.6 44.6 0 24.7-20 44.6-44.6 44.6-24.7 0-44.6-20-44.6-44.6 0-24.7 20-44.6 44.6-44.6zm-49.3 6.1v19c-20.1-20.1-46.8-4.7-46.8 19 0 25 27.5 38.5 46.8 19.2v19c-29.7 14.3-63.3-5.7-63.3-38.2 0-31.2 33.1-53 63.3-38zm-97.2 66.3c11.4 0 22.4-15.3-3.3-24.4-15-5.5-20.2-11.4-20.2-22.7 0-23.2 30.6-31.4 49.7-14.3l-8.4 10.8c-10.4-11.6-24.9-6.2-24.9 2.5 0 4.4 2.7 6.9 12.3 10.3 18.2 6.6 23.6 12.5 23.6 25.6 0 29.5-38.8 37.4-56.6 11.3l10.3-9.9c3.7 7.1 9.9 10.8 17.5 10.8zM55.4 253H32v-82h23.4c26.1 0 44.1 17 44.1 41.1 0 18.5-13.2 40.9-44.1 40.9zm67.5 0h-16v-82h16zM544 433c0 8.2-6.8 15-15 15H128c189.6-35.6 382.7-139.2 416-160zM74.1 191.6c-5.2-4.9-11.6-6.6-21.9-6.6H48v54.2h4.2c10.3 0 17-2 21.9-6.4 5.7-5.2 8.9-12.8 8.9-20.7s-3.2-15.5-8.9-20.5z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['amex'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-amex" class="svg-inline--fa fa-cc-amex fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M325.1 167.8c0-16.4-14.1-18.4-27.4-18.4l-39.1-.3v69.3H275v-25.1h18c18.4 0 14.5 10.3 14.8 25.1h16.6v-13.5c0-9.2-1.5-15.1-11-18.4 7.4-3 11.8-10.7 11.7-18.7zm-29.4 11.3H275v-15.3h21c5.1 0 10.7 1 10.7 7.4 0 6.6-5.3 7.9-11 7.9zM279 268.6h-52.7l-21 22.8-20.5-22.8h-66.5l-.1 69.3h65.4l21.3-23 20.4 23h32.2l.1-23.3c18.9 0 49.3 4.6 49.3-23.3 0-17.3-12.3-22.7-27.9-22.7zm-103.8 54.7h-40.6v-13.8h36.3v-14.1h-36.3v-12.5h41.7l17.9 20.2zm65.8 8.2l-25.3-28.1L241 276zm37.8-31h-21.2v-17.6h21.5c5.6 0 10.2 2.3 10.2 8.4 0 6.4-4.6 9.2-10.5 9.2zm-31.6-136.7v-14.6h-55.5v69.3h55.5v-14.3h-38.9v-13.8h37.8v-14.1h-37.8v-12.5zM576 255.4h-.2zm-194.6 31.9c0-16.4-14.1-18.7-27.1-18.7h-39.4l-.1 69.3h16.6l.1-25.3h17.6c11 0 14.8 2 14.8 13.8l-.1 11.5h16.6l.1-13.8c0-8.9-1.8-15.1-11-18.4 7.7-3.1 11.8-10.8 11.9-18.4zm-29.2 11.2h-20.7v-15.6h21c5.1 0 10.7 1 10.7 7.4 0 6.9-5.4 8.2-11 8.2zm-172.8-80v-69.3h-27.6l-19.7 47-21.7-47H83.3v65.7l-28.1-65.7H30.7L1 218.5h17.9l6.4-15.3h34.5l6.4 15.3H100v-54.2l24 54.2h14.6l24-54.2v54.2zM31.2 188.8l11.2-27.6 11.5 27.6zm477.4 158.9v-4.5c-10.8 5.6-3.9 4.5-156.7 4.5 0-25.2.1-23.9 0-25.2-1.7-.1-3.2-.1-9.4-.1 0 17.9-.1 6.8-.1 25.3h-39.6c0-12.1.1-15.3.1-29.2-10 6-22.8 6.4-34.3 6.2 0 14.7-.1 8.3-.1 23h-48.9c-5.1-5.7-2.7-3.1-15.4-17.4-3.2 3.5-12.8 13.9-16.1 17.4h-82v-92.3h83.1c5 5.6 2.8 3.1 15.5 17.2 3.2-3.5 12.2-13.4 15.7-17.2h58c9.8 0 18 1.9 24.3 5.6v-5.6c54.3 0 64.3-1.4 75.7 5.1v-5.1h78.2v5.2c11.4-6.9 19.6-5.2 64.9-5.2v5c10.3-5.9 16.6-5.2 54.3-5V80c0-26.5-21.5-48-48-48h-480c-26.5 0-48 21.5-48 48v109.8c9.4-21.9 19.7-46 23.1-53.9h39.7c4.3 10.1 1.6 3.7 9 21.1v-21.1h46c2.9 6.2 11.1 24 13.9 30 5.8-13.6 10.1-23.9 12.6-30h103c0-.1 11.5 0 11.6 0 43.7.2 53.6-.8 64.4 5.3v-5.3H363v9.3c7.6-6.1 17.9-9.3 30.7-9.3h27.6c0 .5 1.9.3 2.3.3H456c4.2 9.8 2.6 6 8.8 20.6v-20.6h43.3c4.9 8-1-1.8 11.2 18.4v-18.4h39.9v92h-41.6c-5.4-9-1.4-2.2-13.2-21.9v21.9h-52.8c-6.4-14.8-.1-.3-6.6-15.3h-19c-4.2 10-2.2 5.2-6.4 15.3h-26.8c-12.3 0-22.3-3-29.7-8.9v8.9h-66.5c-.3-13.9-.1-24.8-.1-24.8-1.8-.3-3.4-.2-9.8-.2v25.1H151.2v-11.4c-2.5 5.6-2.7 5.9-5.1 11.4h-29.5c-4-8.9-2.9-6.4-5.1-11.4v11.4H58.6c-4.2-10.1-2.2-5.3-6.4-15.3H33c-4.2 10-2.2 5.2-6.4 15.3H0V432c0 26.5 21.5 48 48 48h480.1c26.5 0 48-21.5 48-48v-90.4c-12.7 8.3-32.7 6.1-67.5 6.1zm36.3-64.5H575v-14.6h-32.9c-12.8 0-23.8 6.6-23.8 20.7 0 33 42.7 12.8 42.7 27.4 0 5.1-4.3 6.4-8.4 6.4h-32l-.1 14.8h32c8.4 0 17.6-1.8 22.5-8.9v-25.8c-10.5-13.8-39.3-1.3-39.3-13.5 0-5.8 4.6-6.5 9.2-6.5zm-57 39.8h-32.2l-.1 14.8h32.2c14.8 0 26.2-5.6 26.2-22 0-33.2-42.9-11.2-42.9-26.3 0-5.6 4.9-6.4 9.2-6.4h30.4v-14.6h-33.2c-12.8 0-23.5 6.6-23.5 20.7 0 33 42.7 12.5 42.7 27.4-.1 5.4-4.7 6.4-8.8 6.4zm-42.2-40.1v-14.3h-55.2l-.1 69.3h55.2l.1-14.3-38.6-.3v-13.8H445v-14.1h-37.8v-12.5zm-56.3-108.1c-.3.2-1.4 2.2-1.4 7.6 0 6 .9 7.7 1.1 7.9.2.1 1.1.5 3.4.5l7.3-16.9c-1.1 0-2.1-.1-3.1-.1-5.6 0-7 .7-7.3 1zm20.4-10.5h-.1zm-16.2-15.2c-23.5 0-34 12-34 35.3 0 22.2 10.2 34 33 34h19.2l6.4-15.3h34.3l6.6 15.3h33.7v-51.9l31.2 51.9h23.6v-69h-16.9v48.1l-29.1-48.1h-25.3v65.4l-27.9-65.4h-24.8l-23.5 54.5h-7.4c-13.3 0-16.1-8.1-16.1-19.9 0-23.8 15.7-20 33.1-19.7v-15.2zm42.1 12.1l11.2 27.6h-22.8zm-101.1-12v69.3h16.9v-69.3z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['diners'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-diners-club" class="svg-inline--fa fa-cc-diners-club fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M239.7 79.9c-96.9 0-175.8 78.6-175.8 175.8 0 96.9 78.9 175.8 175.8 175.8 97.2 0 175.8-78.9 175.8-175.8 0-97.2-78.6-175.8-175.8-175.8zm-39.9 279.6c-41.7-15.9-71.4-56.4-71.4-103.8s29.7-87.9 71.4-104.1v207.9zm79.8.3V151.6c41.7 16.2 71.4 56.7 71.4 104.1s-29.7 87.9-71.4 104.1zM528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM329.7 448h-90.3c-106.2 0-193.8-85.5-193.8-190.2C45.6 143.2 133.2 64 239.4 64h90.3c105 0 200.7 79.2 200.7 193.8 0 104.7-95.7 190.2-200.7 190.2z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['jcb'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-jcb" class="svg-inline--fa fa-cc-jcb fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M431.5 244.3V212c41.2 0 38.5.2 38.5.2 7.3 1.3 13.3 7.3 13.3 16 0 8.8-6 14.5-13.3 15.8-1.2.4-3.3.3-38.5.3zm42.8 20.2c-2.8-.7-3.3-.5-42.8-.5v35c39.6 0 40 .2 42.8-.5 7.5-1.5 13.5-8 13.5-17 0-8.7-6-15.5-13.5-17zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM182 192.3h-57c0 67.1 10.7 109.7-35.8 109.7-19.5 0-38.8-5.7-57.2-14.8v28c30 8.3 68 8.3 68 8.3 97.9 0 82-47.7 82-131.2zm178.5 4.5c-63.4-16-165-14.9-165 59.3 0 77.1 108.2 73.6 165 59.2V287C312.9 311.7 253 309 253 256s59.8-55.6 107.5-31.2v-28zM544 286.5c0-18.5-16.5-30.5-38-32v-.8c19.5-2.7 30.3-15.5 30.3-30.2 0-19-15.7-30-37-31 0 0 6.3-.3-120.3-.3v127.5h122.7c24.3.1 42.3-12.9 42.3-33.2z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['apple-pay'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-apple-pay" class="svg-inline--fa fa-cc-apple-pay fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M302.2 218.4c0 17.2-10.5 27.1-29 27.1h-24.3v-54.2h24.4c18.4 0 28.9 9.8 28.9 27.1zm47.5 62.6c0 8.3 7.2 13.7 18.5 13.7 14.4 0 25.2-9.1 25.2-21.9v-7.7l-23.5 1.5c-13.3.9-20.2 5.8-20.2 14.4zM576 79v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM127.8 197.2c8.4.7 16.8-4.2 22.1-10.4 5.2-6.4 8.6-15 7.7-23.7-7.4.3-16.6 4.9-21.9 11.3-4.8 5.5-8.9 14.4-7.9 22.8zm60.6 74.5c-.2-.2-19.6-7.6-19.8-30-.2-18.7 15.3-27.7 16-28.2-8.8-13-22.4-14.4-27.1-14.7-12.2-.7-22.6 6.9-28.4 6.9-5.9 0-14.7-6.6-24.3-6.4-12.5.2-24.2 7.3-30.5 18.6-13.1 22.6-3.4 56 9.3 74.4 6.2 9.1 13.7 19.1 23.5 18.7 9.3-.4 13-6 24.2-6 11.3 0 14.5 6 24.3 5.9 10.2-.2 16.5-9.1 22.8-18.2 6.9-10.4 9.8-20.4 10-21zm135.4-53.4c0-26.6-18.5-44.8-44.9-44.8h-51.2v136.4h21.2v-46.6h29.3c26.8 0 45.6-18.4 45.6-45zm90 23.7c0-19.7-15.8-32.4-40-32.4-22.5 0-39.1 12.9-39.7 30.5h19.1c1.6-8.4 9.4-13.9 20-13.9 13 0 20.2 6 20.2 17.2v7.5l-26.4 1.6c-24.6 1.5-37.9 11.6-37.9 29.1 0 17.7 13.7 29.4 33.4 29.4 13.3 0 25.6-6.7 31.2-17.4h.4V310h19.6v-68zM516 210.9h-21.5l-24.9 80.6h-.4l-24.9-80.6H422l35.9 99.3-1.9 6c-3.2 10.2-8.5 14.2-17.9 14.2-1.7 0-4.9-.2-6.2-.3v16.4c1.2.4 6.5.5 8.1.5 20.7 0 30.4-7.9 38.9-31.8L516 210.9z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['google-pay'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-pay" class="svg-inline--fa fa-google-pay fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M105.72,215v41.25h57.1a49.66,49.66,0,0,1-21.14,32.6c-9.54,6.55-21.72,10.28-36,10.28-27.6,0-50.93-18.91-59.3-44.22a65.61,65.61,0,0,1,0-41l0,0c8.37-25.46,31.7-44.37,59.3-44.37a56.43,56.43,0,0,1,40.51,16.08L176.47,155a101.24,101.24,0,0,0-70.75-27.84,105.55,105.55,0,0,0-94.38,59.11,107.64,107.64,0,0,0,0,96.18v.15a105.41,105.41,0,0,0,94.38,59c28.47,0,52.55-9.53,70-25.91,20-18.61,31.41-46.15,31.41-78.91A133.76,133.76,0,0,0,205.38,215Zm389.41-4c-10.13-9.38-23.93-14.14-41.39-14.14-22.46,0-39.34,8.34-50.5,24.86l20.85,13.26q11.45-17,31.26-17a34.05,34.05,0,0,1,22.75,8.79A28.14,28.14,0,0,1,487.79,248v5.51c-9.1-5.07-20.55-7.75-34.64-7.75-16.44,0-29.65,3.88-39.49,11.77s-14.82,18.31-14.82,31.56a39.74,39.74,0,0,0,13.94,31.27c9.25,8.34,21,12.51,34.79,12.51,16.29,0,29.21-7.3,39-21.89h1v17.72h22.61V250C510.25,233.45,505.26,220.34,495.13,211ZM475.9,300.3a37.32,37.32,0,0,1-26.57,11.16A28.61,28.61,0,0,1,431,305.21a19.41,19.41,0,0,1-7.77-15.63c0-7,3.22-12.81,9.54-17.42s14.53-7,24.07-7C470,265,480.3,268,487.64,273.94,487.64,284.07,483.68,292.85,475.9,300.3Zm-93.65-142A55.71,55.71,0,0,0,341.74,142H279.07V328.74H302.7V253.1h39c16,0,29.5-5.36,40.51-15.93.88-.89,1.76-1.79,2.65-2.68A54.45,54.45,0,0,0,382.25,158.26Zm-16.58,62.23a30.65,30.65,0,0,1-23.34,9.68H302.7V165h39.63a32,32,0,0,1,22.6,9.23A33.18,33.18,0,0,1,365.67,220.49ZM614.31,201,577.77,292.7h-.45L539.9,201H514.21L566,320.55l-29.35,64.32H561L640,201Z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['amazon-pay'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="cc-amazon-pay" class="svg-inline--fa fa-cc-amazon-pay fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M124.7 201.8c.1-11.8 0-23.5 0-35.3v-35.3c0-1.3.4-2 1.4-2.7 11.5-8 24.1-12.1 38.2-11.1 12.5.9 22.7 7 28.1 21.7 3.3 8.9 4.1 18.2 4.1 27.7 0 8.7-.7 17.3-3.4 25.6-5.7 17.8-18.7 24.7-35.7 23.9-11.7-.5-21.9-5-31.4-11.7-.9-.8-1.4-1.6-1.3-2.8zm154.9 14.6c4.6 1.8 9.3 2 14.1 1.5 11.6-1.2 21.9-5.7 31.3-12.5.9-.6 1.3-1.3 1.3-2.5-.1-3.9 0-7.9 0-11.8 0-4-.1-8 0-12 0-1.4-.4-2-1.8-2.2-7-.9-13.9-2.2-20.9-2.9-7-.6-14-.3-20.8 1.9-6.7 2.2-11.7 6.2-13.7 13.1-1.6 5.4-1.6 10.8.1 16.2 1.6 5.5 5.2 9.2 10.4 11.2zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zm-207.5 23.9c.4 1.7.9 3.4 1.6 5.1 16.5 40.6 32.9 81.3 49.5 121.9 1.4 3.5 1.7 6.4.2 9.9-2.8 6.2-4.9 12.6-7.8 18.7-2.6 5.5-6.7 9.5-12.7 11.2-4.2 1.1-8.5 1.3-12.9.9-2.1-.2-4.2-.7-6.3-.8-2.8-.2-4.2 1.1-4.3 4-.1 2.8-.1 5.6 0 8.3.1 4.6 1.6 6.7 6.2 7.5 4.7.8 9.4 1.6 14.2 1.7 14.3.3 25.7-5.4 33.1-17.9 2.9-4.9 5.6-10.1 7.7-15.4 19.8-50.1 39.5-100.3 59.2-150.5.6-1.5 1.1-3 1.3-4.6.4-2.4-.7-3.6-3.1-3.7-5.6-.1-11.1 0-16.7 0-3.1 0-5.3 1.4-6.4 4.3-.4 1.1-.9 2.3-1.3 3.4l-29.1 83.7c-2.1 6.1-4.2 12.1-6.5 18.6-.4-.9-.6-1.4-.8-1.9-10.8-29.9-21.6-59.9-32.4-89.8-1.7-4.7-3.5-9.5-5.3-14.2-.9-2.5-2.7-4-5.4-4-6.4-.1-12.8-.2-19.2-.1-2.2 0-3.3 1.6-2.8 3.7zM242.4 206c1.7 11.7 7.6 20.8 18 26.6 9.9 5.5 20.7 6.2 31.7 4.6 12.7-1.9 23.9-7.3 33.8-15.5.4-.3.8-.6 1.4-1 .5 3.2.9 6.2 1.5 9.2.5 2.6 2.1 4.3 4.5 4.4 4.6.1 9.1.1 13.7 0 2.3-.1 3.8-1.6 4-3.9.1-.8.1-1.6.1-2.3v-88.8c0-3.6-.2-7.2-.7-10.8-1.6-10.8-6.2-19.7-15.9-25.4-5.6-3.3-11.8-5-18.2-5.9-3-.4-6-.7-9.1-1.1h-10c-.8.1-1.6.3-2.5.3-8.2.4-16.3 1.4-24.2 3.5-5.1 1.3-10 3.2-15 4.9-3 1-4.5 3.2-4.4 6.5.1 2.8-.1 5.6 0 8.3.1 4.1 1.8 5.2 5.7 4.1 6.5-1.7 13.1-3.5 19.7-4.8 10.3-1.9 20.7-2.7 31.1-1.2 5.4.8 10.5 2.4 14.1 7 3.1 4 4.2 8.8 4.4 13.7.3 6.9.2 13.9.3 20.8 0 .4-.1.7-.2 1.2-.4 0-.8 0-1.1-.1-8.8-2.1-17.7-3.6-26.8-4.1-9.5-.5-18.9.1-27.9 3.2-10.8 3.8-19.5 10.3-24.6 20.8-4.1 8.3-4.6 17-3.4 25.8zM98.7 106.9v175.3c0 .8 0 1.7.1 2.5.2 2.5 1.7 4.1 4.1 4.2 5.9.1 11.8.1 17.7 0 2.5 0 4-1.7 4.1-4.1.1-.8.1-1.7.1-2.5v-60.7c.9.7 1.4 1.2 1.9 1.6 15 12.5 32.2 16.6 51.1 12.9 17.1-3.4 28.9-13.9 36.7-29.2 5.8-11.6 8.3-24.1 8.7-37 .5-14.3-1-28.4-6.8-41.7-7.1-16.4-18.9-27.3-36.7-30.9-2.7-.6-5.5-.8-8.2-1.2h-7c-1.2.2-2.4.3-3.6.5-11.7 1.4-22.3 5.8-31.8 12.7-2 1.4-3.9 3-5.9 4.5-.1-.5-.3-.8-.4-1.2-.4-2.3-.7-4.6-1.1-6.9-.6-3.9-2.5-5.5-6.4-5.6h-9.7c-5.9-.1-6.9 1-6.9 6.8zM493.6 339c-2.7-.7-5.1 0-7.6 1-43.9 18.4-89.5 30.2-136.8 35.8-14.5 1.7-29.1 2.8-43.7 3.2-26.6.7-53.2-.8-79.6-4.3-17.8-2.4-35.5-5.7-53-9.9-37-8.9-72.7-21.7-106.7-38.8-8.8-4.4-17.4-9.3-26.1-14-3.8-2.1-6.2-1.5-8.2 2.1v1.7c1.2 1.6 2.2 3.4 3.7 4.8 36 32.2 76.6 56.5 122 72.9 21.9 7.9 44.4 13.7 67.3 17.5 14 2.3 28 3.8 42.2 4.5 3 .1 6 .2 9 .4.7 0 1.4.2 2.1.3h17.7c.7-.1 1.4-.3 2.1-.3 14.9-.4 29.8-1.8 44.6-4 21.4-3.2 42.4-8.1 62.9-14.7 29.6-9.6 57.7-22.4 83.4-40.1 2.8-1.9 5.7-3.8 8-6.2 4.3-4.4 2.3-10.4-3.3-11.9zm50.4-27.7c-.8-4.2-4-5.8-7.6-7-5.7-1.9-11.6-2.8-17.6-3.3-11-.9-22-.4-32.8 1.6-12 2.2-23.4 6.1-33.5 13.1-1.2.8-2.4 1.8-3.1 3-.6.9-.7 2.3-.5 3.4.3 1.3 1.7 1.6 3 1.5.6 0 1.2 0 1.8-.1l19.5-2.1c9.6-.9 19.2-1.5 28.8-.8 4.1.3 8.1 1.2 12 2.2 4.3 1.1 6.2 4.4 6.4 8.7.3 6.7-1.2 13.1-2.9 19.5-3.5 12.9-8.3 25.4-13.3 37.8-.3.8-.7 1.7-.8 2.5-.4 2.5 1 4 3.4 3.5 1.4-.3 3-1.1 4-2.1 3.7-3.6 7.5-7.2 10.6-11.2 10.7-13.8 17-29.6 20.7-46.6.7-3 1.2-6.1 1.7-9.1.2-4.7.2-9.6.2-14.5z"></path></svg>
					</li>
				<?php endif; ?>

				<?php if ( $icons['alipay'] ) : ?>
					<li class="footer__payment-icons-item">
						<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="alipay" class="svg-inline--fa fa-alipay fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M377.74 32H70.26C31.41 32 0 63.41 0 102.26v307.48C0 448.59 31.41 480 70.26 480h307.48c38.52 0 69.76-31.08 70.26-69.6-45.96-25.62-110.59-60.34-171.6-88.44-32.07 43.97-84.14 81-148.62 81-70.59 0-93.73-45.3-97.04-76.37-3.97-39.01 14.88-81.5 99.52-81.5 35.38 0 79.35 10.25 127.13 24.96 16.53-30.09 26.45-60.34 26.45-60.34h-178.2v-16.7h92.08v-31.24H88.28v-19.01h109.44V92.34h50.92v50.42h109.44v19.01H248.63v31.24h88.77s-15.21 46.62-38.35 90.92c48.93 16.7 100.01 36.04 148.62 52.74V102.26C447.83 63.57 416.43 32 377.74 32zM47.28 322.95c.99 20.17 10.25 53.73 69.93 53.73 52.07 0 92.58-39.68 117.87-72.9-44.63-18.68-84.48-31.41-109.44-31.41-67.45 0-79.35 33.06-78.36 50.58z"></path></svg>
					</li>
				<?php endif; ?>

		</ul>
		<?php
	}
}