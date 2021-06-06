<?php
/**
 * Page title for shop pages.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! get_theme_mod( 'arendelle_settings_shop_page_title_show', true ) ) {
	return;
}

?>

<!-- Page Title -->
<div <?php arendelle_page_title_atts( 'shop' ); ?>>
	<div class="container">
		<div class="page-title__holder">
			<?php arendelle_page_title_before(); ?>
				<h1 class="page-title__title"><?php woocommerce_page_title(); ?></h1>
			<?php arendelle_page_title_after(); ?>
		</div>
	</div>
</div> <!-- .page-title -->