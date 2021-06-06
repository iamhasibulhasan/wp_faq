<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Arendelle
 */

get_header();

$image = get_theme_mod( 'arendelle_settings_page_404_image', ARENDELLE_URI . '/assets/img/404/arendelle_404-min.png' );
$title = get_theme_mod( 'arendelle_settings_page_404_title', __( 'Page Not Found', 'arendelle' ) );
$description = get_theme_mod( 'arendelle_settings_page_404_description', __( 'You can go back to homepage or use search.', 'arendelle' ) );
$button_text = get_theme_mod( 'arendelle_settings_page_404_button_text', __( 'Back to Home', 'arendelle' ) );

?>

<div class="page-404-section">

	<div class="container text-center">
		<div class="row justify-content-center">
			<div class="col-md-7">
				<main class="site-main" role="main">

					<?php if ( $image ) : ?>
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( '404 Page Not Found', 'arendelle' ) ?>" class="page-404__img">
					<?php endif; ?>

					<!-- Page Title -->
					<h1 class="page-404__title mt-48 mb-16"><?php echo esc_html( $title ); ?></h1>
					<p class="page-404__text mb-32"><?php echo esc_html( $description ); ?></p>

					<?php echo get_search_form(); ?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--lg btn--color btn--icon">
						<span><?php echo esc_html( $button_text ); ?></span>
					</a>

				</main>
			</div>
		</div>				
	</div>

</div>
<?php get_footer(); ?>