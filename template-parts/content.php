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
	<div class="post_thumbnail">
		<?php 
		if (has_post_thumbnail()) { //如果设置了特色头像 默认用设置过了的		 
			 the_post_thumbnail(array(680, 460, ' uk-overlay-scale')); 
			} else if ($images = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image'))) { //如果没设置判断是否有图片
			   $image = current($images);
			   $image = wp_get_attachment_image_src($image->ID, array(680, 460)); //图片的宽高
			   echo '<img class="uk-overlay-scale" src="' . $image[0] . '" />';
			}
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
			<?php tanx_v1_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php


			$content = get_the_content();
			$trimmed_content = wp_trim_words( $content, 120, '<a href="'. get_permalink() .'"> ...阅读更多</a>' );
			echo $trimmed_content;
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
