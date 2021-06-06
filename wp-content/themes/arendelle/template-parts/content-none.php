<?php
/**
 * If no content
 * 
 * @package Arendelle
 */
?>

<div class="row justify-content-center">
	<div class="col-md-6">
	
		<div class="text-center">
			<h4 class="mb-16"><?php esc_html_e( 'There is no content to display', 'arendelle' ); ?></h4>
			<p class="mb-24"><?php esc_html_e( 'Don\'t fret! Let\'s get you back on track. Perhaps searching can help', 'arendelle' ); ?></p>
			<?php get_search_form(); ?>
		</div>					

	</div>
</div>