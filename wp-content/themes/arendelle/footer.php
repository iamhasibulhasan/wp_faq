<?php
/**
 * The template for displaying the footer.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

	<?php arendelle_footer_before(); ?>

	<?php arendelle_footer(); ?>		
	
	<?php arendelle_footer_after(); ?>

	<?php arendelle_back_to_top(); ?>

	<?php arendelle_content_bottom(); ?>

	</div> <!-- #content -->

	<?php arendelle_content_after(); ?>

</div> <!-- .main-wrapper -->

<?php arendelle_body_bottom(); ?>

<?php wp_footer(); ?>
</body>
</html>