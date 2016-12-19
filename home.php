<?php
/**
 * The Home template file.
 *
 * This template file works when we select static frontpage as latest-posts and also 
 * for blog page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 */

get_header(); ?>

	<div class="page-section container">
        <div id="primary" class="content-area os-animation" style="opacity: 1;">
          	<main id="main" class="site-main" role="main">
	    		<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;
	               		wp_reset_postdata();

					else :

					get_template_part( 'template-parts/content', 'none' );

					endif; 
					do_action( 'daily_insight_action_pagination' ); ?>
			</main><!-- #main -->		
		</div><!-- .primary -->

<?php
if ( daily_insight_is_sidebar_enable() ) {
	get_sidebar();
}
 ?>
	</div><!-- .page-section -->

<?php get_footer();