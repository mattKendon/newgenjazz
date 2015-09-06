<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 1140; /* pixels */

if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */

	
function progression_setup() {

	// Post Thumbnails
	add_theme_support('post-thumbnails');
	
	add_image_size('progression-header-bg', 1400, 550, true); // Masonry Gallery Image Size
	add_image_size('progression-blog', 800, 450, true); // Blog Index
	add_image_size('progression-blog-single', 1150, 550, true); // Blog Index
	add_image_size('progression-gallery', 800, 600, true ); // Gallery (cropped)
	
	
	// Custom Gallery Functions
	add_filter('image_size_names_choose', 'progression_image_sizes');
	function progression_image_sizes($sizes) {
		$addsizes = array(
			"progression-gallery" => __( 'Custom Gallery', 'progression')
	);
	$newsizes = array_merge($sizes, $addsizes);
		return $newsizes;
	}
	
	add_theme_support( 'title-tag' );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
	) );
	
	
	
	
}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );


/* WooCommerce */
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Display 24 products per page. Goes in functions.php
add_filter('loop_shop_per_page', create_function('$cols', 'return get_theme_mod( "shop_pagination_pro" );;'));
/* WooCommerce Related Products */
function woo_related_products_limit() {
  global $product;
	$col_count_progression = get_theme_mod('shop_col_progression', '3'); 
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> $col_count_progression,
		'ignore_sticky_posts' 	=> 1,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );






/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'description'   => 'Default Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'progression' ),
		'id' => 'sidebar-shop',
		'description'   => 'WooCommerce Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Widgets', 'progression' ),
		'id' => 'homepage-widgets',
		'description'   => 'Display Home: widgets on the homepage page template',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home: Widgets on all Pages', 'progression' ),
		'id' => 'homepage-all-widgets',
		'description'   => 'Display Home: widgets on all pages above footer',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'description' => __( 'Footer widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-container-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'progression_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'progression-style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'progression-style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic|Khula:400,300,600|Hind:500,600,700', array( 'progression-style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );


add_action( 'wp_print_styles', 'progression_deregister_styles', 100 );
function progression_deregister_styles() {
	wp_deregister_style( 'wpba_front_end_styles' );
}

function pro_mobile_menu_insert()
{
    ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		'use strict';
		$('.sf-menu').mobileMenu({ defaultText: '<?php _e( "Navigate to...", "progression" ); ?>', className: 'select-menu', subMenuDash: '&ndash;&ndash;' });
		<?php if (get_theme_mod( 'footer_bg_upload', get_template_directory_uri() . '/images/footer-bg.jpg' )) : ?>
		$("footer").backstretch([ "<?php echo get_theme_mod( 'footer_bg_upload', get_template_directory_uri() . '/images/footer-bg.jpg' ); ?>" ],{ fade: 750, centeredY:true, });
		<?php endif; ?>
		<?php if (is_post_type_archive('schedule')) : ?>
			$('#schedule-content-progression').children('li:not(.<?php $member_group_terms = get_terms( 'schedule_day' ); ?><?php $count = 1; $count_2 = 1; foreach ( $member_group_terms as $member_group_term ) { $member_group_query = new WP_Query( array( 'post_type' => 'schedule','posts_per_page' => '1','tax_query' => array(  array( 'taxonomy' => 'schedule_day', 'field' => 'slug', 'terms' => array( $member_group_term->slug ), 'operator' => 'IN' ) ) )  ); ?><?php if($count == 1): ?><?php echo $member_group_term->slug; ?><?php endif; ?><?php $count ++; $count_2++; $member_group_query = null; wp_reset_postdata(); } ?>)').hide();
		<?php endif; ?>
	}); 
	</script>
    <?php
}
add_action('wp_footer', 'pro_mobile_menu_insert');

/*
	MetaBox Options from Dev7studios
*/
require get_template_directory() . '/inc/dev7_meta_box_framework.php';
require get_template_directory() . '/inc/custom-fields.php';

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
 * Load Plugin Activiation
 */
require get_template_directory() . '/tgm-plugin-activation/plugin-activation.php';
