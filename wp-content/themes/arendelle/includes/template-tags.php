<?php
/**
 * Custom template tags for this theme.
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! function_exists( 'arendelle_meta_category' ) ) {
	/**
	* Post category meta
	*
	* @since 1.0.0
	*/
	function arendelle_meta_category( $echo = true ) {
		$categories = get_the_category();
		$separator = '';
		$categories_output = '';
		$output = '';

		if ( ! empty( $categories ) ):
			foreach( $categories as $index => $category ):
				if ($index > 0) : $categories_output .= $separator; endif;
				$categories_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="entry__category-item">' . esc_html( $category->name ) . '</a>';
			endforeach;
		endif;

		if ( 'post' == get_post_type() && ! empty( $categories_output ) ) :
			$output .= '<div class="entry__meta-item entry__category">' . $categories_output . '</div>';
		endif;

		if ( $echo ) {
			echo html_entity_decode( esc_html( $output ) );
		} else {
			return $output;
		}

	}
}


if ( ! function_exists( 'arendelle_meta_date' ) ) {

	/**
	* Prints HTML with meta information for the current post-date/time.
	*/
	function arendelle_meta_date() {

		if ( is_single() ) {

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);
			
		} else {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">' .
										'<span class="entry-date__month-day">%2$s</span>' .
										'<span class="entry-date__month">%3$s</span></time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">' .
				'<span class="entry-date__month-day">%2$s</span>' .
				'<span class="entry-date__month">%3$s</span>' .
				'</time><time class="updated" datetime="%4$s">%5$s</time>';
			}
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date( 'd' ) ),
				esc_html( get_the_date( 'M' ) ),
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);
		}		

		echo '<span class="entry__meta-item entry__meta-date">' . html_entity_decode( esc_html( $time_string ) ) . '</span>';
	}

}


if ( ! function_exists( 'arendelle_meta_author' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function arendelle_meta_author() {
		?>
		<span class="entry__meta-item entry__meta-author">
			<a class="entry__meta-author-url" rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
			<span><?php echo esc_html_x( 'by', 'post author', 'arendelle' ) ?></span>			
			<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="entry__meta-author-name">
				<?php echo esc_html( get_the_author() ); ?>
			</span>
			</a>
		</span>
		<?php
	}
}


if ( ! function_exists( 'arendelle_meta_comments' ) ) {
	/**
	* Post comments meta
	*
	* @since 1.0.0
	*/
	function arendelle_meta_comments() {

		$comments_num = get_comments_number();
		$output = '';

		if ( comments_open() ) {
			if( $comments_num == 0 ) {
				$comments = esc_html__( '0 Comments', 'arendelle' );
			} elseif ( $comments_num > 1 ) {
				$comments = $comments_num . esc_html__(' Comments', 'arendelle');
			} else {
				$comments = esc_html__('1 Comment', 'arendelle');
			}
			$comments = sprintf('<a href="%1$s">%2$s</a>', get_comments_link(), $comments );
		} else {
			$comments = esc_html__('Comments are closed', 'arendelle');
		}

		$output .= '<span class="entry__meta-item">' . $comments . '</span>';

		echo html_entity_decode( esc_html( $output ) );

	}
}


if ( ! function_exists( 'arendelle_related_posts' ) ) {
	/**
	 * Related Posts
	 */
	function arendelle_related_posts() {

		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$author_id = get_the_author_meta( 'ID' );
		$related_by = get_theme_mod( 'arendelle_settings_related_posts_relation', 'category' );

		$args = array(
			'post_type'=>'post',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'post__not_in' => array( get_the_ID() ),
			'ignore_sticky_posts' => true,
		);

		if ( $tags && 'tag' === $related_by ) {
			$tag_ids = array();
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}

			$args['tag__in'] = $tag_ids;

		} elseif ( 'category' === $related_by ) {
			$args['category__in'] = wp_get_post_categories( get_the_ID() );
		} elseif ( 'author' === $related_by ) {        
			$args['author'] = $author_id;
		}

		$query = new WP_Query( $args ); ?>

		<?php if ( $query->have_posts() ) : ?>

			<section class="related-posts">
				<h2 class="h4 mb-24"><?php echo esc_html__( 'You might also like', 'arendelle'); ?></h2>
				<div class="row">

					<?php while( $query->have_posts() ) : $query->the_post(); ?>

						<div class="col-md-4 col-sm-6">
							<article <?php post_class( 'entry related-posts__entry' ); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="related-posts__entry-img-holder">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail( 'arendelle_featured_medium', array('class' => 'related-posts__entry-img img-fullwidth' ) ); ?>
										</a>
									</figure>
								<?php endif; ?>

								<?php the_title( sprintf( '<h3 class="related-posts__entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

							</article><!-- #post-## -->
						</div>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div> <!-- .row -->
			</section> <!-- .related-posts -->
		<?php endif;
	}
}


if ( ! function_exists( 'arendelle_multi_page_pagination' ) ) {
	/**
	* Multi-page pagination
	*
	* @since 1.0.0
	*/
	function arendelle_multi_page_pagination() {
		$defaults = array(
			'before'           => '<nav class="post-pagination" role="navigation" aria-label="' . esc_attr__( 'Page pagination', 'arendelle' ) . '"><span>' . esc_html__( 'Pages:', 'arendelle' ) . '</span>',
			'after'            => '</nav>',
			'link_before'      => '<span class="post-pagination__number"><span class="screen-reader-text">' . esc_html__( 'Page', 'arendelle' ) . '</span> ',
			'link_after'       => '</span>',
			'separator'        => ' ',
			'pagelink'         => '%',
			'echo'             => 1
		);

		wp_link_pages( $defaults );
	}
}


if ( ! function_exists( 'arendelle_post_pagination' ) ) {
	/**
	* Post pagination
	*
	* @since 1.0.0
	*/
	function arendelle_post_pagination() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$prev_text = sprintf(
			'<span class="screen-reader-text">%s</span><i class="arendelle-icon-chevron-left" aria-hidden="true"></i>',
			__( 'Previous Page', 'arendelle' )
		);

		$next_text = sprintf(
			'<span class="screen-reader-text">%s</span><i class="arendelle-icon-chevron-right" aria-hidden="true"></i>',
			__( 'Next Page', 'arendelle' )
		);
		
		?>

		<!-- Pagination Numbers -->
		<nav class="pagination clearfix" role="navigation" aria-label="<?php esc_attr_e( 'Posts pagination', 'arendelle' ); ?>">
			<?php $args = array(
				'prev_next'  => true,
				'prev_text'  => $prev_text,
				'next_text'  => $next_text,
				'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'arendelle' ) . '</span> '
			); ?>
			<?php echo paginate_links( $args ); ?>
		</nav>

		<?php
	}
}


if ( ! function_exists( 'arendelle_post_nav' ) ) :
	/**
	* Display navigation to next/previous post when applicable.
	*
	* @since 1.0.0
	*/
	function arendelle_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$get_next_post = get_next_post();
		$get_previous_post = get_previous_post();

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		
		<nav class="entry-navigation" role="navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope>
			<h5 class="screen-reader-text"><?php echo esc_html__( 'Post navigation', 'arendelle' ); ?></h5>
			<div class="entry-navigation__row clearfix">

				<?php if ( ! empty( $get_next_post ) ) : ?>
					<div class="entry-navigation__col entry-navigation--left">
						<div class="entry-navigation__item">
							<div class="entry-navigation__body">
								<?php
									printf( '<i class="arendelle-icon-chevron-left"></i><span class="entry-navigation__label">%s</span>', esc_html__('Previous Post', 'arendelle') );
									next_post_link( '<h6 class="entry-navigation__title">%link</h6>', _x( '%title', 'Next post link', 'arendelle' ) );
								?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $get_previous_post ) ) : ?>
					<div class="entry-navigation__col entry-navigation--right">
						<div class="entry-navigation__item">
							<div class="entry-navigation__body">
								<?php
									printf( '<span class="entry-navigation__label">%s</span><i class="arendelle-icon-chevron-right"></i>', esc_html__('Next Post', 'arendelle') );
									previous_post_link( '<h6 class="entry-navigation__title">%link</h6>', _x( '%title', 'Previous post link', 'arendelle' ) );  
								?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div> <!-- .entry-navigation__row -->
		</nav>
		<?php
	}
endif;


if ( ! function_exists( 'arendelle_author_box' ) ) {
	/**
	* Author Box
	*/
	function arendelle_author_box() {

		$socials = array(
			'facebook'  => get_the_author_meta( 'facebook' ),
			'twitter'   => get_the_author_meta( 'twitter' ),
			'linkedin'  => get_the_author_meta( 'linkedin' ),
			'instagram' => get_the_author_meta( 'instagram' ),
			'youtube'   => get_the_author_meta( 'youtube' ),
			'vimeo'     => get_the_author_meta( 'vimeo' ),			
			'github' 		=> get_the_author_meta( 'github' )	
		);

		$website = rtrim( get_the_author_meta( 'url' ), '/' );

		if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="entry-author entry-author--box clearfix">
				<figure itemscope itemprop="image" class="entry-author__img-holder">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, null, null, array( 'class' => array( 'entry-author__img' ) ) ); ?>
					</a>                
				</figure>
				<div class="entry-author__info">
					<h2 class="entry-author__name" itemprop="url" rel="author">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="name">
							<span itemprop="author" itemscope itemtype="https://schema.org/Person" class="entry-author__name">
								<?php the_author_meta( 'display_name' ); ?>
							</span>
						</a>
					</h2>
					<?php if ( ! empty( $website ) ) : ?>
						<a href="<?php echo esc_url( $website ); ?>" class="entry-author__website" rel="noopener nofollow" >
							<span class="entry-author__website-text"><?php echo esc_url( $website ); ?></span>
						</a>
					<?php endif; ?>
					<div class="entry-author__description"><?php the_author_meta( 'description' ); ?></div>
					
					<?php if ( function_exists( 'arendelle_user_socials' ) ) : ?>

						<?php if ( $socials['facebook'] || $socials['twitter'] || $socials['linkedin'] || $socials['instagram'] || $socials['youtube'] || $socials['vimeo'] || $socials['github'] ) : ?>

							<!-- Socials -->
							<div class="entry-author__socials socials socials--no-base">

								<?php if ( $socials['facebook'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['facebook'] ) ); ?>" class="social social-facebook" title="<?php echo esc_attr( $socials['facebook'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s Facebook (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['twitter'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['twitter'] ) ); ?>" class="social social-twitter" title="<?php echo esc_attr( $socials['twitter'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s Twitter (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['linkedin'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['linkedin'] ) ); ?>" class="social social-linkedin" title="<?php echo esc_attr( $socials['linkedin'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s LinkedIn (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['instagram'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['instagram'] ) ); ?>" class="social social-instagram" title="<?php echo esc_attr( $socials['instagram'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s Instagram (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['youtube'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['youtube'] ) ); ?>" class="social social-youtube" title="<?php echo esc_attr( $socials['youtube'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\' YouTube (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['vimeo'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['vimeo'] ) ); ?>" class="social social-vimeo" title="<?php echo esc_attr( $socials['vimeo'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s Vimeo (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M447.8 153.6c-2 43.6-32.4 103.3-91.4 179.1-60.9 79.2-112.4 118.8-154.6 118.8-26.1 0-48.2-24.1-66.3-72.3C100.3 250 85.3 174.3 56.2 174.3c-3.4 0-15.1 7.1-35.2 21.1L0 168.2c51.6-45.3 100.9-95.7 131.8-98.5 34.9-3.4 56.3 20.5 64.4 71.5 28.7 181.5 41.4 208.9 93.6 126.7 18.7-29.6 28.8-52.1 30.2-67.6 4.8-45.9-35.8-42.8-63.3-31 22-72.1 64.1-107.1 126.2-105.1 45.8 1.2 67.5 31.1 64.9 89.4z"/></svg>
									</a>
								<?php endif; ?>

								<?php if ( $socials['github'] ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $socials['github'] ) ); ?>" class="social social-github" title="<?php echo esc_attr( $socials['github'] ); ?>" rel="noopener nofollow" target="_blank" aria-label="<?php echo esc_attr__( 'Author\'s Github (opens in new window)', 'arendelle' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>
									</a>
								<?php endif; ?>

							</div>

						<?php endif; ?>

					<?php endif; ?>

				</div>
			</div>
		<?php endif;
	}
}


if ( ! function_exists( 'arendelle_term_description' ) ) {
	/**
	* Adds class to term description
	* @since 1.0.0
	*/
	function arendelle_term_description( $before = '', $after = '</div>' ) {
		$description = apply_filters( 'get_the_archive_description', wp_strip_all_tags( term_description() ) );
		if ( ! empty( $description ) ) {
			echo html_entity_decode( esc_html( $before . $description . $after ) );
		}
	}
}