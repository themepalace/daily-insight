<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		
		/**
		* Hook - daily_insight_action_pagination.
		*
		* @hooked daily_insight_pagination 
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
<?php
get_footer();
