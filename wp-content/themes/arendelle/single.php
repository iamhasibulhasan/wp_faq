<?php
/**
 * The template for displaying all single posts.
 *
 * @package Arendelle
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php arendelle_entry_section_before(); ?>

	<div class="section-wrap pt-72 pb-40">
		<div class="container">
			<div class="row <?php if ( 'fullwidth' == arendelle_layout_type( 'single_post', 'fullwidth' )  ) { echo esc_attr( 'justify-content-center' ); } ?>">

				<!-- blog content -->
				<div class="content blog__content mb-40 col-lg">
					<main class="site-main" role="main">
				
						<?php
							if ( function_exists( 'arendelle_save_post_views' ) ) {
								arendelle_save_post_views( get_the_ID() );
							}
							
							get_template_part( 'template-parts/page-title/page-title-single-post' );
							arendelle_entry_header();

							get_template_part( 'template-parts/content-single', get_post_format() );
						?>
						
					</main>
				</div> <!-- .blog__content -->

				<?php
					if ( arendelle_is_active_sidebar( 'blog', 'single_post', 'fullwidth' ) ) {
						arendelle_sidebar( 'arendelle-blog-sidebar' );
					}
				?>

			</div>
		</div>
	</div> <!-- .main-content -->

<?php endwhile; ?>

<?php get_footer(); ?>