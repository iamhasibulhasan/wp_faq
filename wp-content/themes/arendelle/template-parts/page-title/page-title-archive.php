<?php
/**
 * Page title for archive pages.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! get_theme_mod( 'arendelle_settings_archives_page_title_show', true ) ) {
	return;
}

$archive_title    	 = get_the_archive_title();
$archive_description = get_the_archive_description();
?>

<?php if ( $archive_title || $archive_description ) : ?>	

	<!-- Page Title -->
	<div <?php arendelle_page_title_atts( 'archives' ); ?>>
		<div class="container">
			<div class="page-title__holder">
				<?php arendelle_page_title_before(); ?>

					<?php if ( $archive_title ) : ?>
						
						<h1 class="page-title__title">
							<?php
								if ( is_category() || is_tag() ) :
									single_cat_title();

								else :
									echo wp_kses_post( $archive_title );
								endif;
							?>
						</h1>

					<?php endif; ?>
			
				<?php arendelle_page_title_after(); ?>

			</div>
		</div>
	</div> <!-- .page-title -->

<?php endif; ?>