<?php
/**
 * Search form
 *
 * @package Arendelle
 */
?>

<?php $unique_id = uniqid( 'search-form-' ); ?>

<form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'arendelle' ); ?></span>
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-input" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'arendelle' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-button" aria-label="<?php esc_attr_e( 'search button', 'arendelle' ) ?>"><i class="arendelle-icon-search search-icon" aria-hidden="true"></i></button>
</form>