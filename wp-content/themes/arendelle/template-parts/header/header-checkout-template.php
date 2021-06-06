<?php
/**
 * The checkout header template file
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} ?>

<header class="arendelle-header nav arendelle-header-layout-1" role="banner" itemtype="https://schema.org/WPHeader" itemscope="itemscope">
	<div class="nav__holder">
		<div class="nav__container container">
			<div class="nav__flex-parent flex-parent">

				<div class="nav__header">

					<!-- Logo -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-url logo-dark" itemtype="https://schema.org/Organization" itemscope="itemscope">
						<?php if ( get_theme_mod( 'arendelle_settings_logo_dark' ) || get_theme_mod( 'arendelle_settings_logo_dark_retina' ) ) : ?>
							<img src="<?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark' ) ) ?>" srcset="<?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark' ) ) . ' 1x' ?>, <?php echo esc_attr( get_theme_mod( 'arendelle_settings_logo_dark_retina' ) ) . ' 2x' ?>" class="logo logo--dark" alt="<?php bloginfo( 'name' ) ?>">
						<?php else : ?>
							<span class="site-title site-title--dark"><?php bloginfo( 'name' ) ?></span>
						<?php endif; ?>
					</a>

				</div>

				<!-- Back to cart -->
				<div class="arendelle-back-to-cart">
					<i class="arendelle-icon-chevron-left" aria-hidden="true"></i>
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php echo esc_html__( 'Back to Cart', 'arendelle' ); ?></a>
				</div>

			</div> <!-- .flex-parent -->
		</div> <!-- .nav__container -->
	</div> <!-- .nav__holder -->
</header> <!-- .arendelle-header -->