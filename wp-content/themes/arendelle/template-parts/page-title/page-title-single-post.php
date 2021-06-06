<?php
/**
 * Page title for single post.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! get_theme_mod( 'arendelle_settings_single_post_page_title_show', true ) ) {
	return;
}

add_action( 'arendelle_entry_header', 'arendelle_entry_header_markup' );

if ( ! function_exists( 'arendelle_entry_header_markup' ) ) {
	/**
	* Single entry header markup
	*
	* @since 1.0.0
	*/
	function arendelle_entry_header_markup() {

		arendelle_entry_header_before(); ?>

		<header class="single-post__entry-header">
			<?php if ( get_theme_mod( 'arendelle_settings_single_category_show', true ) ) : ?>
				<div class="entry__meta-categories">
					<?php arendelle_meta_category(); ?>
				</div>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'arendelle_settings_single_post_title_show', true ) ) : ?>				
				<h1 class="single-post__entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'arendelle_settings_single_date_show', true ) || get_theme_mod( 'arendelle_settings_single_author_show', true ) || get_theme_mod( 'arendelle_settings_single_comments_show', true ) ) : ?>
				<div class="entry__meta">

					<?php if ( get_theme_mod( 'arendelle_settings_single_date_show', true ) ) : ?>
						<?php arendelle_meta_date(); ?>
					<?php endif; ?>

					<?php if ( get_theme_mod( 'arendelle_settings_single_author_show', true ) ) : ?>
						<?php arendelle_meta_author(); ?>
					<?php endif; ?>						

					<?php if ( get_theme_mod( 'arendelle_settings_single_comments_show', true ) ) : ?>
						<?php arendelle_meta_comments(); ?>
					<?php endif; ?>

				</div>
			<?php endif; ?>

		</header>

		<?php arendelle_entry_header_after();	

		arendelle_entry_featured_image();

	}
}

