<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TanX_V1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('uk-panel uk-panel-box'); ?>>
	<?php if (is_single()) {

	} else {
		tanx_v1_post_thumbnail();
	}
	//echo get_post_format();
	
	 ?>
	<div class="post_cat">
		<span></span>
		<?php 
			the_category( ' ' );
		?>
	</div>
	<header class="entry-header">

		<?php

		if ( is_single() ) :
			the_title( '<h1 class="entry-title h3">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php //tanx_v1_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php


			$content = get_the_content();
			$trimmed_content = wp_trim_words( $content, 120, '...' );
			
			if ( is_single() ) :
				echo $content;
			else :
				echo $trimmed_content;
			endif;
			// the_content( sprintf(
			// 	/* translators: %s: Name of current post. */
			// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tanx_v1' ), array( 'span' => array( 'class' => array() ) ) ),
			// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
			// ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tanx_v1' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php tanx_v1_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
