<?php
/**
 * The header for this theme.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php arendelle_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php arendelle_head_bottom(); ?>
	<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?> data-no-jquery itemscope itemtype="https://schema.org/WebPage">

	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to Content', 'arendelle' ) ?></a>

	<?php arendelle_body_top(); ?>

	<?php arendelle_preloader() ?>
	
	<div class="main-wrapper">

		<?php arendelle_header_before(); ?>

		<?php arendelle_header(); ?>
		
		<?php arendelle_header_after(); ?>

		<?php arendelle_content_before(); ?>

		<div id="content" class="site-content">

			<?php arendelle_content_top(); ?>