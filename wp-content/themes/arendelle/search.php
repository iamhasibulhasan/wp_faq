<?php
/**
 * The template for displaying search results pages.
 *
 * @package Arendelle
 */

get_header(); ?>

<?php
	// Page Title
	get_template_part( 'template-parts/page-title/page-title-search' );
?>

<div class="search-results-section pb-56">
	<div class="container">
		<div class="row">

			<?php arendelle_primary_content_top(); ?>

			<div id="primary" class="content blog__content mb-32 col-lg">
				<main class="site-main" role="main">

					<?php arendelle_primary_content_before(); ?>

					<?php arendelle_primary_content_query(); ?>

					<?php arendelle_post_pagination(); ?>

					<?php arendelle_primary_content_after(); ?>
					
				</main>
			</div> <!-- #primary -->

			<?php
				// Sidebar
				if ( 'fullwidth' !== arendelle_layout_type( 'search_results', 'fullwidth' ) && is_active_sidebar( 'arendelle-blog-sidebar' ) ) {
					arendelle_sidebar();
				}
			?>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div>
<?php get_footer(); ?>