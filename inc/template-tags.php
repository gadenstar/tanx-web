<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package TanX_V1
 */

if ( ! function_exists( 'tanx_v1_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tanx_v1_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'tanx_v1' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'tanx_v1' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'tanx_v1_post_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tanx_v1_post_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date(' Y-m-d') ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'tanx_v1' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'tanx_v1' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on"><i class=" uk-icon-clock-o"></i>' . $posted_on . '</span><span class="byline"><i class="uk-icon-user"></i> ' . $byline . '</span>'; 
	// edit_post_link('Edit',
	// 	'<span class="edit-link"><i class="uk-icon-edit"></i>',
	// 	'</span>'
	// );
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link uk-float-right"><i class="uk-icon-comment"></i>';
		comments_popup_link('0', '1', '%', 'comments-link', 'Comments are off for this post');
		echo '</span>';
		//echo '<button class="more-link uk-float-right "><a class="uk-button" href="' . esc_url( get_permalink() ) . '">阅读全文&raquo;</a></button>';
	}

}
endif;

if ( ! function_exists( 'tanx_v1_post_view' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tanx_v1_post_view() {
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'tanx_v1_post_view');
 
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  echo '<span class=""><i class="uk-icon-eye"></i>';
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
  echo "</span>";
}
endif;



if ( ! function_exists( 'tanx_v1_post_thumbnail' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tanx_v1_post_thumbnail() {

	if (has_post_thumbnail()) { 	 
		//the_post_thumbnail(array(680, 460, ' uk-overlay-scale'));
		$image = get_the_post_thumbnail_url( null, '680' );
	} else if ($images = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image'))) { //如果没设置判断是否有图片
		$image = current($images);
		$image = wp_get_attachment_image_src($image->ID, array(680, 460)); //图片的宽高
			   //echo '<img class="uk-overlay-scale" src="' . $image[0] . '" />';
		$image = $image[0];
	}
	if ($image == '') {
		echo '';
	}else if ($image != ''){
		echo '<div class="post_thumbnail uk-overlay uk-overlay-hover"><a class="" href="'.esc_url( get_permalink() ).'" rel="bookmark"><img class="uk-overlay-spin" src="' . $image . '" /></a></div>';
	}
}
endif;

if ( ! function_exists( 'tanx_v1_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function tanx_v1_entry_footer() {
	// // Hide category and tag text for pages.
	// if ( 'post' === get_post_type() ) {
	// 	/* translators: used between list items, there is a space after the comma */
	// 	$categories_list = get_the_category_list( esc_html__( ', ', 'tanx_v1' ) );
	// 	if ( $categories_list && tanx_v1_categorized_blog() ) {
	// 		printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tanx_v1' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	// 	}

	// 	/* translators: used between list items, there is a space after the comma */
	// 	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tanx_v1' ) );
	// 	if ( $tags_list ) {
	// 		printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'tanx_v1' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	// 	}
	// }
	// if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	// 	echo '<span class="comments-link">';
	// 	/* translators: %s: post title */
	// 	comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'tanx_v1' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
	// 	echo '</span>';
	// }

	

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date(' Y-m-d') ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'tanx_v1' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'tanx_v1' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on"><i class=" uk-icon-clock-o"></i>' . $posted_on . '</span><span class="byline"><i class="uk-icon-user"></i> ' . $byline . '</span>'; 
	// edit_post_link('Edit',
	// 	'<span class="edit-link"><i class="uk-icon-edit"></i>',
	// 	'</span>'
	// );
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="uk-icon-comment"></i>';
		comments_popup_link('0', '1', '%', 'comments-link', 'Comments are off for this post');
		echo '</span>';
		//echo '<button class="more-link uk-float-right "><a class="uk-button" href="' . esc_url( get_permalink() ) . '">阅读全文&raquo;</a></button>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tanx_v1_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tanx_v1_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tanx_v1_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tanx_v1_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tanx_v1_categorized_blog should return false.
		return false;
	}
}


function tanx_v1_post_navigation() {
	echo '<nav class="navigation post-navigation">';
	echo '<span class="pre uk-h3">'.get_previous_post_link( '&laquo; %link', '%title', false, '', 'category' ).'</span>';
	echo '<span class="next uk-float-right uk-h3">'.get_next_post_link( '%link &raquo;', '%title', false, '', 'category' ).'</span>';
	echo '</nav>';
}
/**
 * Flush out the transients used in tanx_v1_categorized_blog.
 */
function tanx_v1_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'tanx_v1_categories' );
}
add_action( 'edit_category', 'tanx_v1_category_transient_flusher' );
add_action( 'save_post',     'tanx_v1_category_transient_flusher' );
