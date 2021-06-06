<?php
/**
 * The main header template file
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} ?>

<div class="nav__header">

	<?php arendelle_logo(); ?>

	<?php arendelle_menu_mobile(); ?>

</div> <!-- .nav__header -->

<?php if ( 'header-layout-2' === get_theme_mod( 'arendelle_settings_header_layout', 'header-layout-1' ) ) : ?>
	<div class="nav__navbar-holder">
<?php endif; ?>

	<?php arendelle_menu_before(); ?>

	<?php if ( has_nav_menu('primary-menu') ) : ?>
		<!-- Navbar -->
		<nav class="nav__wrap collapse navbar-collapse" id="navbar-collapse" role="navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" aria-label="<?php echo esc_attr__( 'Primary menu', 'arendelle' ); ?>">		
			<?php			
				wp_nav_menu( array(
					'theme_location'  => 'primary-menu',
					'fallback_cb'			=> '__return_false',
					'container'       => false,
					'menu_class'      => 'nav__menu',
					'walker'          => new Arendelle_Walker_Nav_Menu()
				) );
			?>

			<?php arendelle_last_menu_item_after(); ?>

		</nav> <!-- end nav__wrap -->
	<?php endif; ?>

	<?php arendelle_menu_after(); ?>

<?php if ( 'header-layout-2' === get_theme_mod( 'arendelle_settings_header_layout', 'header-layout-1' ) ) : ?>
	</div> <!-- end nav__navbar-holder -->
<?php endif; ?>