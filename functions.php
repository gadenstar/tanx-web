<?php
/**
 * TanX V1 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TanX_V1
 */

define('inc', get_template_directory_uri() . '/inc');

define('UIKIT_CSS', inc . '/uikit/css');
define('UIKIT_JS', inc . '/uikit/js');

/**
 * Enqueue scripts and styles.
 */
function tanx_v1_scripts() {
	wp_enqueue_style( 'uikit', UIKIT_CSS . '/uikit.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'accordion', get_template_directory_uri() . '/uikit/css/components/accordion.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'sticky', get_template_directory_uri() . '/uikit/css/components/sticky.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'slidenav', get_template_directory_uri() . '/uikit/css/components/slidenav.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'dotnav', get_template_directory_uri() . '/uikit/css/components/dotnav.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'slideshow', get_template_directory_uri() . '/uikit/css/components/slideshow.min.css', array(),'2.18.0' );
// 	wp_enqueue_style( 'lazyload', get_template_directory_uri() . '/inc/css/bttrlazyloading.min.css', array(),'2.18.0' );
// 	//wp_enqueue_style( 'tooltip', get_template_directory_uri() . '/uikit/css/components/tooltip.min.css', array(),'2.18.0' );
 	wp_enqueue_style( 'tanx_v1-style', get_stylesheet_uri() );

// 	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ),'2.18.0' );
 	wp_enqueue_script( 'uikit', UIKIT_JS . '/uikit.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'uk-accordion', get_template_directory_uri() . '/uikit/js/components/accordion.min.js', array( 'jquery' ), '20120206');
// 	wp_enqueue_script( 'uikit-grid', get_template_directory_uri() . '/uikit/js/components/grid.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/uikit/js/components/sticky.min.js', array(), '20120206',true);
// 	wp_enqueue_script( 'slideset', get_template_directory_uri() . '/uikit/js/components/slideset.min.js', array(), '20120206',true);
// 	wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/uikit/js/components/slideshow.min.js', array(), '20120206',true);
// 	wp_enqueue_script( 'uikit-scrollspy', get_template_directory_uri() . '/uikit/js/core/scrollspy.min.js', array( 'jquery' ),'2.18.0' );
// 	 wp_enqueue_script( 'uikit-parallax', get_template_directory_uri() . '/uikit/js/components/parallax.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/uikit/js/core/smooth-scroll.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'modal', get_template_directory_uri() . '/uikit/js/core/modal.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/jquery.bttrlazyloading.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/uikit/js/components/lightbox.min.js', array( 'jquery' ),'2.18.0' );
// 	//wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/uikit/js/components/tooltip.min.js', array( 'jquery' ),'2.18.0' );
// 	wp_enqueue_script( 'base', get_template_directory_uri() . '/js/base.js', array(), '20120206' , true);
// 	if (vp_option('vpt_option.loading_tg')=='1'){
// 	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ),'2.18.0',true );
// 	wp_enqueue_script( 'pathLoader', get_template_directory_uri() . '/js/pathLoader.js', array(), '20120206',true );
// 	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '20120206',true );
// 	}
// 	wp_enqueue_script( 'nii_framework-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tanx_v1_scripts' );


//调用ssl 头像链接
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

if ( ! function_exists( 'tanx_v1_setup' ) ) :
function tanx_v1_setup() {
	load_theme_textdomain( 'tanx_v1', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 250, 250, true );
	add_image_size( '680', 680, 460, true );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'tanx_v1' ),
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'custom-background', apply_filters( 'tanx_v1_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'tanx_v1_setup' );



/**
 * 添加输出菜单描述的 Walker 类
 * https://www.wpdaxue.com/wp_nav_menu-output-description.html
 */
class description_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$prepend = '<span>';
		$append = '</span>';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
 
		if($depth != 0)
		{
			$description = $append = $prepend = "";
		}
 
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tanx_v1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tanx_v1_content_width', 640 );
}
add_action( 'after_setup_theme', 'tanx_v1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tanx_v1_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tanx_v1' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tanx_v1' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tanx_v1_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
