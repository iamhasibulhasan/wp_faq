<?php
/**
 * Single post
 *
 * @package Arendelle
 */
?>

<?php 
	$tags_show = get_theme_mod( 'arendelle_settings_post_tags_show', true );
?>

<div class="single-post__content">
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry single-post__entry' ); ?>>	
	<div class="entry__article-wrap">
	
		<?php if ( function_exists( 'arendelle_social_sharing_buttons' ) && get_theme_mod( 'arendelle_settings_post_share_buttons_show', true ) ) : ?>
			<!-- Share -->
			<div class="entry__share">
				<div class="sticky-col">
					<?php echo arendelle_social_sharing_buttons( 'socials--colored entry__share-socials' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="entry__article-content">

			<?php arendelle_entry_content_top(); ?>

			<div class="entry__article single-post__entry-article clearfix">
				<?php the_content(); ?>
			</div>

			<?php arendelle_multi_page_pagination(); ?>

			<?php arendelle_entry_content_bottom(); ?>

		</div> <!-- .entry__article-content -->	
	</div>
</article><!-- #post-## -->

<?php if ( $tags_show && has_tag() ) : ?>
	<div class="row">
		<div class="col-lg-12">		
			<!-- Tags -->
			<div class="entry__tags">
				<?php the_tags( '', '', '' ); ?>
			</div> <!-- end tags -->
		</div>
	</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'arendelle-newsletter' ) && get_theme_mod( 'arendelle_settings_post_newsletter_box_show', false ) ) : ?>
	<div class="newsletter newsletter__single-post">
		<div class="newsletter__form">
			<?php dynamic_sidebar( 'arendelle-newsletter' ); ?>
		</div> 
	</div>
<?php endif; ?>

<?php if ( get_theme_mod( 'arendelle_settings_author_box_show', true ) ) {
	arendelle_author_box();
} ?>

<?php if ( get_theme_mod( 'arendelle_settings_post_navigation_show', true ) ) {	
	arendelle_post_nav();
} ?>

<?php if ( get_theme_mod( 'arendelle_settings_related_posts_show', true ) ) {
	arendelle_related_posts();
} ?>

<?php
	// Comments
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
?>

</div> <!-- .single-post__content -->