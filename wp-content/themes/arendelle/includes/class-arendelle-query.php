<?php
/**
 * Arendelle Query.
 * 
 * The class responsible for queries.
 * 
 * @author  	 DeoThemes
 * @copyright  (c) Copyright by DeoThemes
 * @link       https://deothemes.com
 * @package 	 Arendelle
 * @since 		 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! class_exists( 'Arendelle_Query' ) ) :

	/**
	 * Arendelle_Query
	 */
	class Arendelle_Query {

		/**
		 * Instance
		 *
		 * @var $Arendelle_Query
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			// Query
			add_action( 'arendelle_primary_content_query', array( $this, 'content_query_markup' ) );

			// Template Parts
			add_action( 'arendelle_template_parts_content', array( $this, 'template_parts_content' ) );
			add_action( 'arendelle_template_parts_content', array( $this, 'template_parts_comments' ), 15 );

			// Template None.
			add_action( 'arendelle_template_parts_content_none', array( $this, 'template_parts_content_none' ) );

		}


		/**
		 * Template part content
		 *
		 * @since 1.0.0
		 */
		public function template_parts_content(  ) {
			if ( ! is_page() || ! is_404() || ! is_single() ) {
				get_template_part( 'template-parts/content', get_post_format() );
			}
		}


		/**
		* Template part comments
		*
		* @since 1.0.0
		*/
		public function template_parts_comments() {
			if ( is_single() || is_page() ) {
				if ( comments_open() || get_comments_number() ) : ?>
					<div class="col-lg-12">
						<?php comments_template(); ?>
					</div>
				<?php endif;
			}
		}

		/**
		 * Query markup content
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function content_query_markup() {

			if ( have_posts() ) :
				?>
			
				<div class="row row-40 masonry-grid" id="masonry-grid">

					<?php while ( have_posts() ) : the_post(); ?>					
						<div class="<?php echo esc_attr( $this->get_columns() ); ?> col-md-6 masonry-item">
							<?php do_action( 'arendelle_template_parts_content' ); ?>							
						</div>

					<?php endwhile; ?>
				
				</div> <!-- .row -->
				
				<?php else :
					do_action( 'arendelle_template_parts_content_none' );

			endif;
		}

		
		/**
		* Get columns number.
		*
		* @since 1.0.0
		*/
		public function get_columns() {
			$columns = '';
			$blog_columns = get_theme_mod( 'arendelle_settings_blog_columns', 'col-lg-12' );
			$archive_columns = get_theme_mod( 'arendelle_settings_archive_columns', 'col-lg-4' );
			$search_columns = get_theme_mod( 'arendelle_settings_search_results_columns', 'col-lg-4' );

			if ( is_home() ) {
				$columns = $blog_columns;
			}

			if ( is_archive() ) {
				$columns = $archive_columns;
			}

			if ( is_search() ) {
				$columns = $search_columns;
			}

			return $columns;
		}


		/**
		* Template part content none
		*
		* @since 1.0.0
		*/
		public function template_parts_content_none() {
			if ( is_archive() || is_search() ) {
				get_template_part( 'template-parts/content', 'none' );
			}
		}

	}

	/**
	* Initialize class object with 'get_instance()' method
	*/
	Arendelle_Query::get_instance();

endif;