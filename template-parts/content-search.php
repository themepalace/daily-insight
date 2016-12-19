<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 */
$options = daily_insight_get_theme_options();  // get theme options 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->
	
	<?php if ( 'post' === get_post_type() ) : 
		do_action( 'daily_insight_entry_meta' );
	endif; ?>

	<div class="entry-content">
		<?php the_excerpt(); 

		if( !empty( $options['readmore_text'] ) ) : ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"><?php echo esc_html( $options['readmore_text'] ); ?></a>
		<?php endif; ?>
		
	</div><!-- .entry-content -->
</article><!-- #post-## -->
