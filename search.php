<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 */

get_header(); ?>

<div class="page-section container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'daily-insight' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 

		/**
		* Hook - daily_insight_action_pagination.
		*
		* @hooked daily_insight_default_pagination 
		* @hooked daily_insight_numeric_pagination 
		*/
		do_action( 'daily_insight_action_pagination' ); 
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( daily_insight_is_sidebar_enable() ) {
	get_sidebar();
} ?>
</div><!-- .page-section -->
<?php get_footer();
