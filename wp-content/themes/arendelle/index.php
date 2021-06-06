<?php
/**
 * The main template file.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();
?>

<div class="blog-section pb-56">

	<?php arendelle_primary_content_markup_top(); ?>

		<?php arendelle_primary_content_top(); ?>

		<!-- blog content -->
		<div id="primary" class="content blog__content col-lg mb-32">
			<main class="site-main" role="main">

				<?php arendelle_primary_content_before(); ?>

				<?php arendelle_primary_content_query(); ?>

				<?php arendelle_post_pagination(); ?>

				<?php arendelle_primary_content_after(); ?>

			</main>
		</div> <!-- .blog__content -->

		<?php
			// Sidebar
			if ( arendelle_is_active_sidebar( 'blog', 'blog', 'right-sidebar' ) ) {
				arendelle_sidebar( 'arendelle-blog-sidebar' );
			}
		?>

		<?php arendelle_primary_content_bottom(); ?>

	<?php arendelle_primary_content_markup_bottom(); ?>

</div> <!-- .blog-section -->

<?php get_footer(); ?>