<?php
/**
 * The main footer template file
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} ?>

<?php
	$footer_bottom_text = get_theme_mod( 'arendelle_settings_footer_bottom_text', sprintf(
		esc_html__( 'Copyright &copy; [current_year] %1$s | Made by %2$sDeoThemes%3$s' , 'arendelle' ),
		get_bloginfo( 'name' ),
		'<a href="'. esc_url( 'https://deothemes.com' ) . '">',
		'</a>'
	) );
?>

<?php if ( get_theme_mod( 'arendelle_settings_footer_show', true ) ) : ?>

	<!-- Footer -->
	<footer class="footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">

		<div class="container">

			<?php if ( is_active_sidebar( 'arendelle-footer-col-1' ) || is_active_sidebar( 'arendelle-footer-col-2' ) || is_active_sidebar( 'arendelle-footer-col-3' ) || is_active_sidebar( 'arendelle-footer-col-4' ) ) : ?>
				<?php if ( get_theme_mod( 'arendelle_settings_footer_widgets_show', true ) ) : ?>

					<div class="footer__widgets">
						<div class="row">

							<!-- 4 Columns -->           
							<?php if ( get_theme_mod( 'arendelle_settings_footer_columns', 'footer-col-4' ) == 'footer-col-4' ) : ?>                

								<?php if ( is_active_sidebar( 'arendelle-footer-col-1' ) ) : ?>
									<div class="col-lg-3 col-md-6 footer__col-1">
										<?php dynamic_sidebar( 'arendelle-footer-col-1' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-2' ) ) : ?>
									<div class="col-lg-3 col-md-6 footer__col-2">
										<?php dynamic_sidebar( 'arendelle-footer-col-2' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-3' ) ) : ?>
									<div class="col-lg-3 col-md-6 footer__col-3">
										<?php dynamic_sidebar( 'arendelle-footer-col-3' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-4' ) ) : ?>
									<div class="col-lg-3 col-md-6 footer__col-4">
										<?php dynamic_sidebar( 'arendelle-footer-col-4' ); ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

							<!-- 3 Columns -->
							<?php if ( get_theme_mod( 'arendelle_settings_footer_columns', 'footer-col-4' ) == 'footer-col-3' ) : ?>                

								<?php if ( is_active_sidebar( 'arendelle-footer-col-1' ) ) : ?>
									<div class="col-lg-4 col-md-6 footer__col-1">
										<?php dynamic_sidebar( 'arendelle-footer-col-1' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-2' ) ) : ?>
									<div class="col-lg-4 col-md-6 footer__col-2">
										<?php dynamic_sidebar( 'arendelle-footer-col-2' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-3' ) ) : ?>
									<div class="col-lg-4 col-md-6 footer__col-3">
										<?php dynamic_sidebar( 'arendelle-footer-col-3' ); ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

							<!-- 2 Columns -->
							<?php if ( get_theme_mod( 'arendelle_settings_footer_columns', 'footer-col-4' ) == 'footer-col-2' ) : ?>                

								<?php if ( is_active_sidebar( 'arendelle-footer-col-1' ) ) : ?>
									<div class="col-lg-6 footer__col-1">
										<?php dynamic_sidebar( 'arendelle-footer-col-1' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( is_active_sidebar( 'arendelle-footer-col-2' ) ) : ?>
									<div class="col-lg-6 footer__col-2">
										<?php dynamic_sidebar( 'arendelle-footer-col-2' ); ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

							<!-- 1 Column -->
							<?php if ( get_theme_mod( 'arendelle_settings_footer_columns', 'footer-col-4' ) == 'footer-col-1' ) : ?>                

								<?php if ( is_active_sidebar( 'arendelle-footer-col-1' ) ) : ?>
									<div class="col-md-12 footer__col-1">
										<?php dynamic_sidebar( 'arendelle-footer-col-1' ); ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

						</div>
					</div> <!-- end footer widgets -->
				<?php endif; ?>
			<?php endif; ?> <!-- if widgets are empty -->				
		</div> <!-- end container -->

		<?php if ( get_theme_mod( 'arendelle_settings_footer_bottom_show', true ) ) : ?>
			<div class="footer__bottom">
				<div class="container">
					<div class="row">						
					
						<?php if ( $footer_bottom_text ) : ?>
							<div class="col-md-6">
								<div class="footer__bottom-copyright">									
									<span class="copyright">
										<?php arendelle_footer_bottom_text(); ?>
									</span>
								</div>
								<?php if ( has_nav_menu( 'footer-bottom-menu' ) && get_theme_mod( 'arendelle_settings_footer_bottom_menu_show', true ) ) : ?>
									<nav class="footer__nav-menu-container" role="navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" aria-label="<?php echo esc_attr__( 'Secondary menu', 'arendelle' ); ?>">
										<?php
											wp_nav_menu( array(
												'theme_location'  => 'footer-bottom-menu',
												'menu_class'      => 'footer__nav-menu',
												'container'			  => false,
												'depth'           => 1,
											) );
										?>
									</nav>
								<?php endif; ?>
							</div>
						<?php endif; ?>						

						<?php if ( get_theme_mod( 'arendelle_settings_footer_payment_icons_show', false ) ) : ?>
							<div class="col-md-6">
								<?php arendelle_footer_payment_icons(); ?>
							</div>
						<?php endif; ?>

					</div> <!-- .row -->
				</div> <!-- .container -->
			</div> <!-- .footer__bottom -->
		<?php endif; ?> <!-- if footer bottom show -->

	</footer>

<?php endif; ?>	