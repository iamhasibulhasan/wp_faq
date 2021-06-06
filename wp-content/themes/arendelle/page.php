<?php
/**
 * The template for displaying all pages.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
	<?php
		// Check if the page built with Elementor
		if ( arendelle_is_elementor_page() ) : ?>

			<?php arendelle_primary_content_top(); ?>

			<main class="elementor-main-content site-main" role="main">

				<?php arendelle_primary_content_before(); ?>

				<?php the_content(); ?>

				<?php arendelle_primary_content_after(); ?>

			</main>

			<?php arendelle_comments(); ?>

			<?php arendelle_primary_content_bottom(); ?>

		<?php else : ?>			

			<?php
				// Page Title
				get_template_part( 'template-parts/page-title/page-title' );
			?>

			<div class="page-section pb-56">
				<div class="container">
					<div class="row">

						<?php arendelle_primary_content_top(); ?>

						<div id="primary" class="content page-content col-lg mb-32">
							<main class="site-main" role="main">

								<?php arendelle_primary_content_before(); ?>

								<div class="entry__article clearfix">
									<?php the_content(); ?>
								</div>

								<?php arendelle_multi_page_pagination(); ?>
								
								<?php arendelle_comments(); ?>

								<?php arendelle_primary_content_after(); ?>

							</main>
						</div> <!-- .page-content -->

						<?php arendelle_primary_content_bottom(); ?>

						<?php
							// Sidebar
							if ( arendelle_is_woocommerce_activated() ) {
								if ( is_cart() || is_checkout() || is_account_page() ) {
									if ( 'fullwidth' !== arendelle_layout_type( 'shop_pages' ) && is_active_sidebar( 'arendelle-shop-sidebar' ) ) {
										arendelle_sidebar( 'arendelle-shop-sidebar' );
									}
								}
							} else {
								if ( arendelle_is_active_sidebar( 'page', 'page' ) ) {
									arendelle_sidebar( 'arendelle-page-sidebar' );
								}
							}							
						?>					

					</div> <!-- .row -->
				</div> <!-- .container -->			
			</div> <!-- .page-section -->

	<?php endif; ?> <!-- elementor check -->	
<?php endwhile; endif; ?>

<?php get_footer(); ?>