<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Palace
 */

get_header(); ?>
<div class="page-section container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<h1 class="title-404"><?php esc_html_e( '404', 'daily-insight' );?></h1>
					<h2><?php esc_html_e( 'You have some problems', 'daily-insight' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'daily-insight' ); ?></p>
					<?php get_search_form(); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn fill btn-js"><?php _e( 'Go Home', 'daily-insight' ); ?></a>
				</div>
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .page-section-->

<?php
get_footer();
