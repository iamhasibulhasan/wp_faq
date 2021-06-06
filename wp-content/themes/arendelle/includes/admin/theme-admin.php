<?php

/**
 * Theme admin functions.
 *
 * @package Arendelle
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
* Add admin menu
*
* @since 1.0.0
*/
function arendelle_theme_admin_menu()
{
    add_theme_page(
        __( 'Arendelle Getting Started', 'arendelle' ),
        __( 'Arendelle', 'arendelle' ),
        'manage_options',
        'arendelle-theme',
        'arendelle_admin_page_content',
        30
    );
}

add_action( 'admin_menu', 'arendelle_theme_admin_menu' );
/**
* Add admin page content
*
* @since 1.0.0
*/
function arendelle_admin_page_content()
{
    $docs_url = 'https://docs.deothemes.com/arendelle/knowledgebase/';
    $urls = array(
        'docs'                  => 'https://docs.deothemes.com/arendelle',
        'video-tutorials'       => 'https://www.youtube.com/watch?v=R9tPDGK1q-Q&list=PLaPNmyRO67T0BsLPlGdrXO0T_5SxM5A4-&ab_channel=DeoThemes',
        'header-footer-builder' => $docs_url . 'header-footer-builder',
        'product-builder'       => $docs_url . 'product-builder',
        'mega-menu-builder'     => $docs_url . 'mega-menu-builder',
        'page-layout'           => $docs_url . 'page-layout',
        'gdpr'                  => $docs_url . 'gdpr',
        'home-page-demos'       => $docs_url . 'home-page-demos',
    );
    $buttons = array(
        'logo'          => array(
        'link_url'  => admin_url( 'customize.php?autofocus[section]=arendelle_settings_logo' ),
        'link_text' => __( 'Logo', 'arendelle' ),
        'icon'      => 'dashicons dashicons-format-image',
    ),
        'header'        => array(
        'link_url'  => admin_url( 'customize.php?autofocus[panel]=arendelle_settings_header' ),
        'link_text' => __( 'Header', 'arendelle' ),
        'icon'      => 'dashicons dashicons-align-center',
    ),
        'footer'        => array(
        'link_url'  => admin_url( 'customize.php?autofocus[section]=arendelle_settings_footer' ),
        'link_text' => __( 'Footer', 'arendelle' ),
        'icon'      => 'dashicons dashicons-align-full-width',
    ),
        'layout'        => array(
        'link_url'  => admin_url( 'customize.php?autofocus[panel]=arendelle_settings_layout' ),
        'link_text' => __( 'Layout', 'arendelle' ),
        'icon'      => 'dashicons dashicons-layout',
    ),
        'colors'        => array(
        'link_url'  => admin_url( 'customize.php?autofocus[section]=arendelle_settings_colors' ),
        'link_text' => __( 'Colors', 'arendelle' ),
        'icon'      => 'dashicons dashicons-admin-appearance',
    ),
        'typography'    => array(
        'link_url'  => admin_url( 'customize.php?autofocus[section]=arendelle_settings_typography' ),
        'link_text' => __( 'Typography', 'arendelle' ),
        'icon'      => 'dashicons dashicons-editor-textcolor',
    ),
        'customizer'    => array(
        'link_url'  => admin_url( 'customize.php' ),
        'link_text' => __( 'Customizer', 'arendelle' ),
        'icon'      => 'dashicons dashicons-admin-generic',
    ),
        'documentation' => array(
        'link_url'  => 'https://docs.deothemes.com/arendelle',
        'link_text' => __( 'Documentation', 'arendelle' ),
        'icon'      => 'dashicons dashicons-book-alt',
    ),
        'support'       => array(
        'link_url'  => admin_url( 'themes.php?page=arendelle-theme-contact' ),
        'link_text' => __( 'Support', 'arendelle' ),
        'icon'      => 'dashicons dashicons-sos',
    ),
    );
    
    if ( arendelle_fs()->can_use_premium_code__premium_only() && defined( 'ARENDELLE_CORE_VERSION' ) ) {
        $buttons['theme_templates'] = array(
            'link_url'  => admin_url( 'edit.php?post_type=theme_template' ),
            'link_text' => __( 'Theme Templates', 'arendelle' ),
            'icon'      => 'dashicons dashicons-table-row-after',
        );
        $buttons['adobe_fonts'] = array(
            'link_url'  => admin_url( 'admin.php?page=arendelle-core-custom-typekit-fonts' ),
            'link_text' => __( 'Adobe Fonts', 'arendelle' ),
            'icon'      => 'dashicons dashicons-editor-spellcheck',
        );
        $buttons['integrations'] = array(
            'link_url'  => admin_url( 'admin.php?page=arendelle-core-integrations' ),
            'link_text' => __( 'Google Map', 'arendelle' ),
            'icon'      => 'dashicons dashicons-location-alt',
        );
    }
    
    $videos = array(
        'theme-installation' => array(
        'links' => array( array(
        'link_url'     => 'https://www.youtube.com/watch?v=R9tPDGK1q-Q&list=PLaPNmyRO67T0BsLPlGdrXO0T_5SxM5A4-&ab_channel=DeoThemes',
        'link_text'    => __( 'Theme Installation', 'arendelle' ),
        'link_img_src' => ARENDELLE_URI . '/assets/admin/img/videos/arendelle_video_demo_import.jpg',
    ) ),
    ),
        'color-editing'      => array(
        'links' => array( array(
        'link_url'     => 'https://www.youtube.com/watch?v=MpjPEHzWti8&list=PLaPNmyRO67T0BsLPlGdrXO0T_5SxM5A4-&index=3&ab_channel=DeoThemes',
        'link_text'    => __( 'Color Editing', 'arendelle' ),
        'link_img_src' => ARENDELLE_URI . '/assets/admin/img/videos/arendelle_video_colors_editing.jpg',
    ) ),
    ),
        'product-builder'    => array(
        'links' => array( array(
        'link_url'     => 'https://www.youtube.com/watch?v=2zUr4KWO6rQ&list=PLaPNmyRO67T0BsLPlGdrXO0T_5SxM5A4-&index=2&ab_channel=DeoThemes',
        'link_text'    => __( 'Product Builder', 'arendelle' ),
        'link_img_src' => ARENDELLE_URI . '/assets/admin/img/videos/arendelle_video_product_builder.jpg',
    ) ),
    ),
    );
    $info = array(
        'home-page-demos'       => array(
        'title'     => esc_html__( '6 Home Page Demos', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['home-page-demos'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['home-page-demos'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
        'header-footer-builder' => array(
        'title'     => esc_html__( 'Header / Footer Builder', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['header-footer-builder'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['header-footer-builder'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
        'product-builder'       => array(
        'title'     => esc_html__( 'Product Builder', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['product-builder'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['product-builder'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
        'mega-menu-builder'     => array(
        'title'     => esc_html__( 'Mega Menu Builder', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['mega-menu-builder'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['mega-menu-builder'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
        'page-layouts'          => array(
        'title'     => esc_html__( 'Page Layout', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['page-layout'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['page-layout'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
        'gdpr'                  => array(
        'title'     => esc_html__( 'GDPR Tools', 'arendelle' ),
        'class'     => 'arendelle-addon-list-item',
        'title_url' => $urls['gdpr'],
        'links'     => array( array(
        'link_class'   => 'arendelle-learn-more',
        'link_url'     => $urls['gdpr'],
        'link_text'    => esc_html__( 'Learn More &#187;', 'arendelle' ),
        'target_blank' => true,
    ) ),
    ),
    );
    ?>

		<div class="arendelle-page-header">
			<div class="arendelle-page-header__container">
				<div class="arendelle-page-header__branding">
					<img src="<?php 
    echo  esc_url( ARENDELLE_URI . '/assets/admin/img/arendelle_logo.png' ) ;
    ?>" class="arendelle-page-header__logo" alt="<?php 
    echo  esc_attr__( 'Arendelle', 'arendelle' ) ;
    ?>">
					<span class="arendelle-theme-version"><?php 
    echo  esc_html( ARENDELLE_VERSION ) ;
    ?></span>
				</div>
				<div class="arendelle-page-header__tagline">
					<span class="arendelle-page-header__tagline-text"><?php 
    echo  esc_html__( 'Modern eCommerce Theme', 'arendelle' ) ;
    ?></span>					
				</div>				
			</div>
		</div>

		<div class="wrap arendelle-container">
			<div class="arendelle-grid">

				<div class="arendelle-grid-content">
					<div class="arendelle-body">

						<h1 class="arendelle-title"><?php 
    esc_html_e( 'Getting Started', 'arendelle' );
    ?></h1>
						<p class="arendelle-intro-text">
							<?php 
    echo  esc_html__( 'Arendelle is now installed and ready to use. Get ready to build something beautiful. To get started check the links below. We hope you enjoy it!', 'arendelle' ) ;
    ?>
						</p>

						<h3><?php 
    echo  esc_html__( 'What is next?', 'arendelle' ) ;
    ?></h3>
						<ol>
							<li><?php 
    printf( esc_html__( 'Install and activate all the %1$s', 'arendelle' ), sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ), esc_html__( 'required plugins', 'arendelle' ) ) );
    ?></li>					
							<li>
								<?php 
    
    if ( class_exists( 'OCDI_Plugin' ) ) {
        ?>
									<a href="<?php 
        echo  esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ) ;
        ?>">
								<?php 
    } else {
        ?>
									<a href="<?php 
        echo  esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) ;
        ?>">
								<?php 
    }
    
    ?>
										<?php 
    echo  esc_html__( 'Import demo content', 'arendelle' ) ;
    ?>
									</a>								
							</li>
						</ol>

						<!-- Buttons -->
						<ul class="arendelle-navigation-buttons">
							<?php 
    foreach ( $buttons as $button => $link ) {
        echo  '<li class="arendelle-navigation-buttons__item">' ;
        echo  '<a href="' . esc_url( $link['link_url'] ) . '" class="arendelle-navigation-buttons__url">' ;
        echo  '<span class="arendelle-navigation-buttons__icon ' . esc_attr( $link['icon'] ) . '"></span>' ;
        echo  '<span class="arendelle-navigation-buttons__label">' . esc_html( $link['link_text'] ) . '</span>' ;
        echo  '</a>' ;
        echo  '</li>' ;
    }
    ?>							
						</ul>						

						<!-- Import Content -->
						<h3><?php 
    echo  esc_html__( 'Import Demo Content', 'arendelle' ) ;
    ?></h3>							
						<?php 
    
    if ( class_exists( 'OCDI_Plugin' ) ) {
        ?>
							<p>
								<?php 
        /* translators: %1$s: OCDI demo import URL. */
        printf( esc_html__( 'Make sure all plugins are installed and activated, then %1$s', 'arendelle' ), sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ), esc_html__( 'Import Demo Content.', 'arendelle' ) ) );
        ?>
							</p>
						<?php 
    } else {
        ?>
							<p>
								<?php 
        /* translators: %1$s: OCDI plugin install URL. */
        printf( esc_html__( 'Install and activate %1$s plugin.', 'arendelle' ), sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ), esc_html__( 'One Click Demo Import', 'arendelle' ) ) );
        ?>
							</p>
						<?php 
    }
    
    ?>

						<?php 
    ?>	

					</div> <!-- .body -->

				</div> <!-- .content -->
				
				<aside class="arendelle-grid-sidebar">
					<div class="arendelle-grid-sidebar-widget-area">

						<div class="arendelle-widget arendelle-widget-video-tutorials">
							<h2 class="arendelle-widget-title"><?php 
    esc_html_e( 'Video Tutorials', 'arendelle' );
    ?></h2>
							<ul class="arendelle-video-tutorials">
								<?php 
    foreach ( (array) $videos as $video_items => $video ) {
        echo  '<li class="arendelle-video-tutorials__item">' ;
        foreach ( $video['links'] as $key => $link ) {
            echo  '<a href="' . esc_url( $link['link_url'] ) . '" class="arendelle-video-tutorials__url" target="_blank" rel="noopener">' ;
            echo  '<img src="' . esc_url( $link['link_img_src'] ) . '" alt="' . esc_html( $link['link_text'] ) . '" class="arendelle-video-tutorials__img" />' ;
            echo  '<span class="arendelle-video-tutorials__label">' . esc_html( $link['link_text'] ) . '</span>' ;
            echo  '</a>' ;
        }
        echo  '</li>' ;
    }
    ?>
							</ul>
							<div class="arendelle-widget-video-tutorials__more-videos">
								<a href="<?php 
    echo  esc_url( $urls['video-tutorials'] ) ;
    ?>" class="button" target="_blank"><?php 
    esc_html_e( 'More Videos', 'arendelle' );
    ?></a>
							</div>												
						</div>

						<div class="arendelle-widget">
							<?php 
    ?>
								<h2 class="arendelle-widget-title"><?php 
    echo  esc_html__( 'Arendelle Pro Features', 'arendelle' ) ;
    ?></h2>
							<?php 
    ?>

							<ul class="arendelle-addon-list">
								<?php 
    foreach ( (array) $info as $addon => $info ) {
        $title_url = ( isset( $info['title_url'] ) && !empty($info['title_url']) ? 'href="' . esc_url( $info['title_url'] ) . '"' : '' );
        $anchor_target = ( isset( $info['title_url'] ) && !empty($info['title_url']) ? "rel='noopener'" : '' );
        echo  '<li class="' . esc_attr( $info['class'] ) . '"><a class="arendelle-addon-item-title" target="_blank"' . $title_url . $anchor_target . ' >' . esc_html( $info['title'] ) . '</a></li>' ;
    }
    ?>
							</ul>
						</div>

					</div>					
				</aside>	

			</div> <!-- .grid -->

		</div>
	<?php 
}

/**
* Change theme icon
*
* @since 1.0.0
*/
function arendelle_fs_custom_icon()
{
    return ARENDELLE_DIR . '/assets/admin/img/theme-icon.png';
}

arendelle_fs()->add_filter( 'plugin_icon', 'arendelle_fs_custom_icon' );
/**
 * Add extra permissions to Freemius
 */
function arendelle_freemius_extra_permissions( $permissions )
{
    $permissions['newsletter'] = array(
        'icon-class' => 'dashicons dashicons-email-alt',
        'label'      => arendelle_fs()->get_text_inline( 'Newsletter', 'arendelle' ),
        'desc'       => arendelle_fs()->get_text_inline( 'Your email is added to our newsletter. Updates, announcements, marketing, no spam. Unsubscribe anytime.', 'arendelle' ),
        'priority'   => 15,
    );
    return $permissions;
}

arendelle_fs()->add_filter( 'permission_list', 'arendelle_freemius_extra_permissions' );
/**
* Adds an admin notice upon successful activation.
*/
function arendelle_activation_admin_notice()
{
    global  $current_user ;
    global  $current_screen ;
    // Don't show on Arendelle main admin page
    if ( $current_screen->id === 'appearance_page_arendelle-theme' || $current_screen->id === 'toplevel_page_arendelle' ) {
        return;
    }
    
    if ( is_admin() ) {
        $current_theme = wp_get_theme();
        $welcome_dismissed = get_user_meta( $current_user->ID, 'arendelle_wizard_admin_notice' );
        if ( $current_theme->get( 'Name' ) == "Arendelle" && !$welcome_dismissed ) {
            add_action( 'admin_notices', 'arendelle_wizard_admin_notice', 99 );
        }
        wp_enqueue_style( 'arendelle-wizard-notice-css', get_template_directory_uri() . '/assets/admin/css/wizard-notice.css' );
    }

}

add_action( 'current_screen', 'arendelle_activation_admin_notice' );
/**
* Adds a button to dismiss the notice
*/
function arendelle_dismiss_wizard_notice()
{
    global  $current_user ;
    $user_id = $current_user->ID;
    if ( isset( $_GET['arendelle_wizard_dismiss'] ) && $_GET['arendelle_wizard_dismiss'] == '1' ) {
        add_user_meta(
            $user_id,
            'arendelle_wizard_admin_notice',
            'true',
            true
        );
    }
}

add_action( 'admin_init', 'arendelle_dismiss_wizard_notice', 1 );
/**
* Display an admin notice linking to the wizard screen
*/
function arendelle_wizard_admin_notice()
{
    
    if ( current_user_can( 'customize' ) ) {
        ?>
		<div class="notice theme-notice welcome-panel">
			<div class="theme-notice-logo"><span></span></div>
			<div class="theme-notice-message wp-theme-fresh">
				<h2><?php 
        esc_html_e( 'Thank you for choosing Arendelle!', 'arendelle' );
        ?></h2>
				<?php 
        
        if ( class_exists( 'Merlin' ) ) {
            ?>
					<p class="about-description"><?php 
            esc_html_e( 'Run the Setup Wizard to configure your new theme and begin customizing your site.', 'arendelle' );
            ?></p>
				<?php 
        } else {
            ?>
					<p class="about-description"><?php 
            esc_html_e( 'Follow the steps to configure your new theme and begin customizing your site.', 'arendelle' );
            ?></p>
				<?php 
        }
        
        ?>
			</div>
			<div class="theme-notice-cta">
				<?php 
        
        if ( class_exists( 'Merlin' ) ) {
            ?>
					<a href="<?php 
            echo  esc_url( admin_url( 'themes.php?page=theme-setup-wizard' ) ) ;
            ?>" class="button button-primary button-hero" style="text-decoration: none;"><?php 
            esc_html_e( 'Run Setup Wizard', 'arendelle' );
            ?></a>
				<?php 
        } else {
            ?>
					<a href="<?php 
            echo  esc_url( admin_url( 'themes.php?page=arendelle-theme' ) ) ;
            ?>" class="button button-primary button-hero" style="text-decoration: none;"><?php 
            esc_html_e( 'Setup Instructions', 'arendelle' );
            ?></a>
				<?php 
        }
        
        ?>
				<a href="<?php 
        echo  esc_url( wp_nonce_url( add_query_arg( 'arendelle_wizard_dismiss', '1' ) ) ) ;
        ?>" class="notice-dismiss" target="_parent"></a>
			</div>
		</div>
	<?php 
    }

}
