<?php
/**
 * Golfio functions and definitions
 *
 * @package Golfio
 */

if ( ! function_exists( 'golfio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function golfio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Golfio, use a find and replace
	 * to change 'golfio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'golfio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'golfio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'golfio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // golfio_setup
add_action( 'after_setup_theme', 'golfio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function golfio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'golfio_content_width', 640 );
}
add_action( 'after_setup_theme', 'golfio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function golfio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'golfio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar(array(
		'name'=> esc_html__( 'Shop Sidebar', 'golfio' ),
		'id' => 'sidebar-shop',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="offscreen">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'golfio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function golfio_scripts() {
	wp_enqueue_style( 'golfio-style', get_stylesheet_uri() );
        
        wp_enqueue_script('jquery');
        
        wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '', true );
        
        // ADD MODERNIZER
        
        wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), false, true);    
        wp_enqueue_script('modernizr');
        
        // REGISTER THEME FUNCTIONS
        
        wp_enqueue_script( 'golfio-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '', true );
        
        // ADD FONT AWESOME
        
        wp_register_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', array(), null, 'all');
        wp_enqueue_style('font-awesome');
        
        // ADD FLEXISLIDER
        
        wp_register_style('flexi-css', get_template_directory_uri() .'/css/flexslider.css', array(), null, 'all');
	wp_enqueue_style('flexi-css');
        wp_enqueue_script( 'jquery-flexi', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '', true );

	wp_enqueue_script( 'golfio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'golfio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'golfio_scripts' );

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


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Remove woocommerce wrapper

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Add custom woocommerce wrapper

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

// Woocommerce social share buttons 

add_action('woocommerce_share','wooshare');
function wooshare(){
echo'
<div class="fb-like" data-href="'.get_permalink().'" data-layout="box_count" data-send="false" data-width="100" data-show-faces="true" style="display:inline"></div>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="bryanheadrick">Tweet</a>
<g:plusone size="tall"></g:plusone>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<a href="http://pinterest.com/pin/create/button/?url='. urlencode(get_permalink()).'&media='.urlencode(wp_get_attachment_url( get_post_thumbnail_id() )).'&description='.apply_filters( 'woocommerce_short_description', $post->post_excerpt ).'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';?>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=281787978603249";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
}

remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
remove_action('wp_head', 'start_post_rel_link'); // Removes the random post link
remove_action('wp_head', 'index_rel_link'); // Removes the index page link
remove_action('wp_head', 'adjacent_posts_rel_link'); // Removes the next and previous post links


// Change number of thumbnails per row in product galleries

add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
 function xx_thumb_cols() {
     return 4; // .last class applied to every 4th thumbnail
 }

// Change number of upsells output

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
	    woocommerce_upsell_display( 4,4 ); // Display 4 products in rows of 4
	}
}

// Customize Woocommerce Related Products Output

if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
    function woocommerce_output_related_products() {
        woocommerce_related_products(4,4);   // Display 4 products in 4 columns
    }
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}


// ADD TAXONOMY IMAGES

require_once("Tax-meta-class/Tax-meta-class.php");
 
$config = array(
   'id' => 'demo_meta_box',                         // meta box id, unique per meta box
   'title' => 'Demo Meta Box',                      // meta box title
   'pages' => array('categories'),                  // taxonomy name, accept categories, post_tag and custom taxonomies
   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
   'fields' => array(),                             // list of meta fields (can be added by field arrays)
   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
   'use_with_theme' => true                         //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
 
$my_meta = new Tax_Meta_Class($config); 
 
$my_meta->addImage('image_field_id',array('name'=> 'Term Image '));

$my_meta->Finish();
