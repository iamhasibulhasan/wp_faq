<?php

/**
 * Theme Customizer
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
function arendelle_customize_register( $wp_customize )
{
    // Customize Background Settings
    $wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background Styles', 'arendelle' );
    $wp_customize->get_control( 'background_color' )->section = 'background_image';
    // Remove Custom Header Section
    $wp_customize->remove_section( 'colors' );
}

add_action( 'customize_register', 'arendelle_customize_register' );
// Check if Kirki is installed

if ( class_exists( 'Kirki' ) ) {
    function arendelle_customizer_options()
    {
        // Selector Vars
        $selectors = array(
            'primary_color'             => 'a,
				.breadcrumbs a:hover,
				.breadcrumbs a:focus,
				.loader,
				.comment-edit-link,
				.entry__title a:focus,
				.entry__title a:hover,
				.entry__meta-item .entry__category-item,
				.entry__meta a:focus,
				.entry__meta a:hover,
				.entry-navigation__title a:focus,
				.entry-navigation__title a:hover,
				.footer .widget.widget_calendar a,
				.widget_rss .rsswidget:hover,
				.widget-popular-posts__entry-title a:hover,
				.widget_recent_entries a:hover,
				.footer__nav-menu li a:hover,
				.footer__widgets .widget a:hover,
				.copyright a:hover,
				.copyright a:focus,
				.link-underline:hover,
				.link-underline:focus,
				.related-posts__entry-title:hover a,
				.wp-block-pullquote:before,
				.nav__right-item .arendelle-menu-search__trigger:hover,
				.arendelle-header .nav__menu > li > a:hover,
				.arendelle-header .nav__menu > li > a:focus,
				.arendelle-header .nav__menu > li.active > a,
				.arendelle-header .nav__menu > .current_page_parent > a,
				.arendelle-header .nav__menu .current-menu-item > a,
				.arendelle-header .nav__dropdown-menu > li > a:hover,
				.arendelle-header .nav__dropdown-menu > li > a:focus,
				.widget_archive li a,
				.widget_categories li a,
				.widget_meta li a,
				.widget_nav_menu li a,
				.widget_pages li a,
				.nav__right-item a:hover,
				.nav__right-item button:hover',
            'primary_background_color'  => '.top-bar,
				.nav__icon-toggle:focus .nav__icon-toggle-bar,
				.nav__icon-toggle:hover .nav__icon-toggle-bar,
				#back-to-top:hover,
				.widget_tag_cloud a:hover,
				.entry__tags a:hover,
				.widget_product_tag_cloud a:hover,
				.pagination a.current,
				.pagination span.current,
				.pagination a:not(span):hover,
				.pagination span:not(span):hover,
				.post-page-numbers.current,
				.post-page-numbers:not(span):hover,
				.link-underline:after,
				.comment-author__post-author-label,
				a.cc-btn.cc-dismiss,
				.social:focus,
				.social:hover,
				.entry__tags a:hover,
				.widget_product_tag_cloud a:hover,
				.widget_tag_cloud .tagcloud a:hover,
				
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				.elementor-widget-button .elementor-button,
				.mc4wp-form-fields input[type=submit]:focus,
				.btn:hover,
				.btn:focus,
				.btn--color,
				.button,
				.button:hover,
				.button:focus	

				',
            'primary_border_color'      => 'input:focus,
				textarea:focus',
            'primary_border_top_color'  => '.elementor-widget-tabs .elementor-tab-title.elementor-active',
            'primary_border_left_color' => 'blockquote, .edit-post-visual-editor .wp-block-quote',
            'border_color'              => 'input,
				select,
				textarea,
				.pagination a,
				.pagination span,
				.elementor-widget-sidebar .widget,
				.sidebar .widget,
				.entry,
				table>tbody>tr>td,
				table>tbody>tr>th,
				table>tfoot>tr>td,
				table>tfoot>tr>th,
				table>thead>tr>td,
				table>thead>tr>th',
            'headings_color'            => 'h1,h2,h3,h4,h5,h6,
				label,
				a:hover,
				a:focus,
				.comment-author__name,
				.entry__category-item:hover,
				.entry__category-item:focus,
				.arendelle-header .nav__menu > li > a,
				.arendelle-header .arendelle-menu-cart__url,
				.arendelle-header .arendelle-menu-search__trigger,
				.widget-title,
				table tbody tr th,
				table thead tr th',
            'text_color'                => 'body,
				input,
				figcaption,
				.comment-form-cookies-consent label,
				.pagination span,
				.pagination a,
				.search-button,
				.search-form__button,
				.widget-search-button,
				.widget a,
				.footer,
				.footer__nav-menu li a,
				.footer .widget_recent_entries a,
				.footer .widget_recent_comments a,
				.footer .widget_nav_menu a,
				.footer .widget_categories a,
				.footer .widget_pages a,
				.footer .widget_archive a,
				.footer .widget_meta a,

				.elementor-widget-wp-widget-pages-archives a,
				.elementor-widget-categories a,
				.elementor-widget-wp-widget-pages a,
				.elementor-widget-wp-widget-nav_menu a,
				.elementor-widget-wp-widget-meta a,

				.arendelle-header .nav__dropdown-menu > li > a',
            'post_links_color'          => '.single-post__entry-article p a, .single-post__entry-article li:not(.wp-social-link) a',
            'post_meta_color'           => '.entry__meta-item, .entry__meta li, .entry__meta a, .comment-date',
            'headings'                  => 'h1,h2,h3,h4,h5,h6',
            'h1'                        => 'h1, .h1',
            'h2'                        => 'h2, .h2',
            'h3'                        => 'h3, .h3',
            'h4'                        => 'h4, .h4',
            'h5'                        => 'h5, .h5',
            'h6'                        => 'h6, .h6',
            'base_font'                 => 'body',
            'secondary_font'            => 'label,
				.top-bar__message,
				.nav__menu li a,
				.eversor-nav-menu__list li a,
				.eversor-nav-menu__item,
				.search-input,
				.eversor-countdown__number,
				.breadcrumbs,
				.filter,
				.entry__meta-item,
				.comment-date,
				.comment-edit-link,
				.comment-author
				',
            'buttons'                   => 'input[type="button"],
				input[type="reset"],
				input[type="submit"],
				button,
				.btn,
				.button,
				.elementor-button,
				.elementor-button.elementor-size-md,
				.elementor-button.elementor-size-lg,
				.elementor-button.elementor-size-xl,
				.wp-block-button .wp-block-button__link,
				.added_to_cart',
            'buttons_color'             => 'input[type="button"],
				input[type="reset"],
				input[type="submit"],
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				.elementor-widget-button .elementor-button,
				.mc4wp-form-fields input[type=submit]:focus,
				.btn:hover,
				.btn:focus,
				.btn--color,
				.button,
				.button:hover,
				.button:focus',
            'buttons_color_editor'      => '.wp-block-button__link:not(.has-background),
				.wp-block-button__link:not(.has-background):active,
				.wp-block-button__link:not(.has-background):focus,
				.wp-block-button__link:not(.has-background):hover,
				.wp-block-button__link:not(.has-background):visited
				',
        );
        
        if ( arendelle_is_woocommerce_activated() ) {
            $selectors['shop_primary_color'] = '.woocommerce ul.products li.product a.woocommerce-loop-product__link:hover,
				.woocommerce ul.products li.product a.woocommerce-loop-product__link:focus,
				.widget_product_categories li a:hover,
				.widget_rating_filter li a:hover,
				.woocommerce-widget-layered-nav-list li a:hover,
				.woocommerce-product-rating a:hover,
				.woocommerce .woocommerce-breadcrumb a:hover,
				.woocommerce .woocommerce-breadcrumb a:focus,
				.woocommerce-page .woocommerce-breadcrumb a:hover,
				.woocommerce-page .woocommerce-breadcrumb a:focus,
				.woocommerce table.shop_table .product-name a:hover,
				.woocommerce-MyAccount-navigation-link.is-active a,
				.woocommerce-MyAccount-navigation li a:hover,
				.woocommerce .products .add_to_wishlist:focus i,
				.woocommerce .products .add_to_wishlist:hover i,
				.woocommerce .products .wishlist-url:focus i,
				.woocommerce .products .wishlist-url:hover i,
				.arendelle-product__actions div>a.button:focus,
				.arendelle-product__actions div>a.button:hover,
				.product_list_widget a:hover';
            $selectors['shop_primary_background_color'] = '.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce nav.woocommerce-pagination ul li a.current,
				.woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce nav.woocommerce-pagination ul li a:not(span):hover,
				.woocommerce nav.woocommerce-pagination ul li span:not(span):hover,
				.arendelle-item-counter,
				.arendelle-product__actions div>a.button,
				.eversor-products-slider .elementor-swiper-button:focus,
				.eversor-products-slider .elementor-swiper-button:hover,
				.select2-container--default .select2-results__option--highlighted[aria-selected],
				.select2-container--default .select2-results__option--highlighted[data-selected]';
            $selectors['shop_secondary_color'] = '.woocommerce .products .yith-wcwl-icon';
            $selectors['shop_secondary_background_color'] = '.woocommerce .product .onsale,
				.woocommerce ul.products li.product .onsale';
            $selectors['shop_buttons_color'] = '.woocommerce #respond input#submit,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button,
				.woocommerce a.button.alt,
				.woocommerce button.button,
				.woocommerce button.button.alt,
				.woocommerce input.button,
				.woocommerce input.button.alt,
				.woocommerce button.button.alt.disabled,
				.woocommerce #respond input#submit.alt:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce .coupon button.button:hover,
				.woocommerce .woocommerce-mini-cart__buttons>a:first-child:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button.alt:hover,
				.woocommerce input.button:hover,
				.woocommerce table.shop_table .actions>button.button:disabled:hover';
            $selectors['shop_primary_border_color'] = '#add_payment_method table.cart td.actions .coupon .input-text:focus,
				.woocommerce-cart #content table.cart td.actions .coupon .input-text:focus,
				.woocommerce-checkout table.cart td.actions .coupon .input-text:focus';
            $selectors['shop_buttons_color_hover'] = '.woocommerce #respond input#submit:hover,
				.woocommerce #respond input#submit.alt:hover,
				.woocommerce a.button:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce button.button:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button:hover,
				.woocommerce input.button.alt:hover,
				.woocommerce button.button.alt.disabled:hover';
            $selectors['shop_border_color'] = '.woocommerce nav.woocommerce-pagination ul li a,
				.woocommerce nav.woocommerce-pagination ul li span,
				.woocommerce div.product .woocommerce-tabs ul.tabs li,
				.woocommerce div.product .woocommerce-tabs .panel,
				.woocommerce div.product .woocommerce-tabs ul.tabs::before,
				.woocommerce .product-share,
				.woocommerce .quantity,
				.select2-container--default .select2-selection--single,
				.select2-dropdown,
				.select2-container--default .select2-search--dropdown .select2-search__field,
				.woocommerce #reviews #comments ol.commentlist li .comment-text,
				.woocommerce table.shop_table,
				.woocommerce table.shop_attributes,
				.woocommerce table.shop_attributes th,
				.woocommerce table.shop_attributes td,
				.woocommerce table.shop_table td,
				.woocommerce table.shop_table th,
				.woocommerce table.shop_table tbody th,
				.woocommerce table.shop_table tfoot td,
				.woocommerce table.shop_table tfoot th,
				#add_payment_method #payment,
				.woocommerce-cart #payment,
				.woocommerce-checkout #payment,
				#add_payment_method table.cart td.actions .coupon .input-text,
				.woocommerce-cart #content table.cart td.actions .coupon .input-text,
				.woocommerce-checkout table.cart td.actions .coupon .input-text,
				.wc_payment_methods li
				';
            $selectors['shop_headings_color'] = '.woocommerce div.product p.price,
				.woocommerce div.product span.price,
				.woocommerce #reviews #comments ol.commentlist li .meta .woocommerce-review__author,
				#add_payment_method #payment div.payment_box,
				.woocommerce-cart #payment div.payment_box,
				.woocommerce-checkout #payment div.payment_box,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
				.woocommerce-Price-amount,
				.comment-reply-title
			';
            $selectors['shop_text_color'] = '.woocommerce-product-search button[type=submit],
				.woocommerce div.product .woocommerce-tabs ul.tabs li a';
            $selectors['shop_secondary_font'] = '.woocommerce-mini-cart-item,
				.woocommerce-mini-cart__total,
				.product_list_widget li,
				.arendelle-item-counter,
				.yith-wcwl-add-to-wishlist,
				.woocommerce .product .onsale,
				.woocommerce ul.products li.product .onsale,
				.woocommerce table.shop_table,
				.woocommerce div.product .woocommerce-tabs ul.tabs li,
				.woocommerce .price,
				.woocommerce-breadcrumb,
				.woocommerce-review-link,
				.product_meta,
				.product-title,
				.woocommerce-mini-cart__empty-message,
				.woocommerce-error,
				.woocommerce-info,
				.woocommerce-message,
				#review_form .comment-reply-title,
				.woocommerce table.shop_attributes th,
				.arendelle-back-to-cart,
				.woocommerce-grouped-product-list-item__price,
				.item-details-table,
				.additional-info,
				.pswp__caption__center,
				.woocommerce div.product .out-of-stock,
				.product-share__label,
				.woocommerce-review__author,
				.woocommerce-review__published-date
				';
            $selectors['shop_sale_badge_background_color'] = '.woocommerce span.onsale';
            $selectors['shop_sale_badge_text_color'] = '.woocommerce span.onsale';
        }
        
        if ( function_exists( 'arendelle_get_typekit_fonts' ) ) {
            $typekit_fonts = arendelle_get_typekit_fonts();
        }
        $heading_font = ( isset( $typekit_fonts ) && !empty($typekit_fonts && isset( $typekit_fonts[1] )) ? $typekit_fonts[1] : 'Jost' );
        $body_font = ( isset( $typekit_fonts ) && !empty($typekit_fonts && isset( $typekit_fonts[0] )) ? $typekit_fonts[0] : 'PT Serif' );
        $heading_color = '#1D1D1D';
        $text_color = '#555555';
        $meta_color = '#555555';
        $primary_color = '#024E82';
        $secondary_color = '#d6763c';
        $border_color = '#ebebeb';
        $mobile_menu_dividers_color = '#eaeaea';
        $bg_light = '#FBFBFB';
        $bg_dark = '#242424';
        $bp_xl_up = '@media (min-width: 1400px)';
        $bp_xl_down = '@media (min-width: 1399px)';
        $bp_lg_up = '@media (min-width: 1025px)';
        $bp_lg_down = '@media (max-width: 1024px)';
        // Kirki
        Kirki::add_config( 'arendelle_settings_config', array(
            'capability'  => 'edit_theme_options',
            'option_type' => 'theme_mod',
            'option_name' => 'arendelle_settings_config',
        ) );
        /**
         * SECTIONS / PANELS
         **/
        $priority = 20;
        $uniqid = 1;
        // 1. GENERAL PANEL
        Kirki::add_panel( 'arendelle_settings_general', array(
            'title'    => esc_attr__( 'General', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // Form Elements
        Kirki::add_section( 'arendelle_settings_general_form_elements', array(
            'title' => esc_html__( 'Form Elements', 'arendelle' ),
            'panel' => 'arendelle_settings_general',
        ) );
        // Preloader
        Kirki::add_section( 'arendelle_settings_preloader', array(
            'title' => esc_html__( 'Preloader', 'arendelle' ),
            'panel' => 'arendelle_settings_general',
        ) );
        // Back to Top
        Kirki::add_section( 'arendelle_settings_back_to_top', array(
            'title' => esc_html__( 'Back to Top', 'arendelle' ),
            'panel' => 'arendelle_settings_general',
        ) );
        // 2. HEADER PANEL
        Kirki::add_panel( 'arendelle_settings_header', array(
            'title'    => esc_html__( 'Header & Logo', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // Default Header
        Kirki::add_section( 'arendelle_settings_default_header', array(
            'title' => esc_html__( 'Default Header', 'arendelle' ),
            'panel' => 'arendelle_settings_header',
        ) );
        // Mobile Header
        Kirki::add_section( 'arendelle_settings_mobile_header', array(
            'title' => esc_html__( 'Mobile Header', 'arendelle' ),
            'panel' => 'arendelle_settings_header',
        ) );
        // Logo
        Kirki::add_section( 'arendelle_settings_logo', array(
            'title' => esc_html__( 'Logo', 'arendelle' ),
            'panel' => 'arendelle_settings_header',
        ) );
        // Primary Menu
        Kirki::add_section( 'arendelle_settings_primary_menu', array(
            'title' => esc_html__( 'Primary Menu', 'arendelle' ),
            'panel' => 'arendelle_settings_header',
        ) );
        // Top Bar
        Kirki::add_section( 'arendelle_settings_top_bar', array(
            'title' => esc_html__( 'Top Bar', 'arendelle' ),
            'panel' => 'arendelle_settings_header',
        ) );
        // 3. FOOTER
        Kirki::add_section( 'arendelle_settings_footer', array(
            'title'    => esc_html__( 'Footer', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // 4. LAYOUT PANEL
        Kirki::add_panel( 'arendelle_settings_layout', array(
            'title'    => esc_html__( 'Layout', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // Content
        Kirki::add_section( 'arendelle_settings_content_layout', array(
            'title' => esc_html__( 'Content', 'arendelle' ),
            'panel' => 'arendelle_settings_layout',
        ) );
        // Blog Layout
        Kirki::add_section( 'arendelle_settings_blog_layout', array(
            'title'       => esc_html__( 'Blog', 'arendelle' ),
            'description' => esc_html__( 'Layout options for the blog pages', 'arendelle' ),
            'panel'       => 'arendelle_settings_layout',
        ) );
        // Page Layout
        Kirki::add_section( 'arendelle_settings_page_layout', array(
            'title'       => esc_html__( 'Page', 'arendelle' ),
            'description' => esc_html__( 'Layout options for the regular pages', 'arendelle' ),
            'panel'       => 'arendelle_settings_layout',
        ) );
        // Archive Layout
        Kirki::add_section( 'arendelle_settings_archive_layout', array(
            'title'       => esc_html__( 'Archive', 'arendelle' ),
            'description' => esc_html__( 'Layout options for archive and categories pages', 'arendelle' ),
            'panel'       => 'arendelle_settings_layout',
        ) );
        if ( arendelle_is_woocommerce_activated() ) {
            // Shop Layout
            Kirki::add_section( 'arendelle_settings_shop_layout', array(
                'title'       => esc_html__( 'Shop', 'arendelle' ),
                'description' => esc_html__( 'Layout options for shop catalog pages', 'arendelle' ),
                'panel'       => 'arendelle_settings_layout',
            ) );
        }
        // Search Results Layout
        Kirki::add_section( 'arendelle_settings_search_results_layout', array(
            'title'       => esc_html__( 'Search Results', 'arendelle' ),
            'description' => esc_html__( 'Layout options for search result page', 'arendelle' ),
            'panel'       => 'arendelle_settings_layout',
        ) );
        // 5. COLORS
        Kirki::add_section( 'arendelle_settings_colors', array(
            'title'    => esc_html__( 'Colors', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // 6. TYPOGRAPHY
        Kirki::add_section( 'arendelle_settings_typography', array(
            'title'    => esc_html__( 'Typography', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // 7. BLOG PANEL
        Kirki::add_panel( 'arendelle_settings_blog', array(
            'title'    => esc_html__( 'Blog', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // Post Meta
        Kirki::add_section( 'arendelle_settings_post_meta', array(
            'title'       => esc_html__( 'Post Meta', 'arendelle' ),
            'description' => esc_html__( 'These options will apply to the default WordPress posts. Customize Elementor widgets post meta via Elementor.', 'arendelle' ),
            'panel'       => 'arendelle_settings_blog',
        ) );
        // Single Post
        Kirki::add_section( 'arendelle_settings_single_post', array(
            'title' => esc_html__( 'Single Post', 'arendelle' ),
            'panel' => 'arendelle_settings_blog',
        ) );
        // Social Share
        Kirki::add_section( 'arendelle_settings_social_share', array(
            'title' => esc_html__( 'Social Share Buttons', 'arendelle' ),
            'panel' => 'arendelle_settings_blog',
        ) );
        // Read More
        Kirki::add_section( 'arendelle_settings_read_more', array(
            'title' => esc_html__( 'Read More', 'arendelle' ),
            'panel' => 'arendelle_settings_blog',
        ) );
        // 8. PAGE TITLE
        Kirki::add_section( 'arendelle_settings_page_title', array(
            'title'    => esc_html__( 'Page Title', 'arendelle' ),
            'priority' => $priority++,
        ) );
        // 11. PAGE 404
        Kirki::add_section( 'arendelle_settings_page_404', array(
            'title'       => esc_html__( 'Page 404', 'arendelle' ),
            'description' => esc_html__( 'Settings for page 404', 'arendelle' ),
            'priority'    => $priority++,
        ) );
        // Load modules
        require_once ARENDELLE_DIR . '/includes/customizer/modules/general.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/header.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/footer.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/layout.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/page-title.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/blog.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/colors.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/typography.php';
        require_once ARENDELLE_DIR . '/includes/customizer/modules/page-404.php';
        if ( arendelle_is_woocommerce_activated() ) {
            require_once ARENDELLE_DIR . '/includes/customizer/modules/woocommerce.php';
        }
    }
    
    arendelle_customizer_options();
}

// endif Kirki check