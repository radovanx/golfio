<?php
/**
 * Golfio functions and definitions
 *
 * @package Golfio
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Gofio',
		'menu_slug' 	=> 'gofio-general-settings',
		'redirect'		=> false
	));
}

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
         register_sidebar(array(
		'name'=> esc_html__( 'Footer 1', 'golfio' ),
		'id' => 'footer-1',
		'before_widget' => '<div class="col-xs-12 col-sm-3 footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-title">',
		'after_title' => '</h3>',
	));
          register_sidebar(array(
		'name'=> esc_html__( 'Footer 2', 'golfio' ),
		'id' => 'footer-2',
		'before_widget' => '<div class="col-xs-12 col-sm-3 footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-title">',
		'after_title' => '</h3>',
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



// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

add_action( 'woocommerce_share', 'woocommerce_social_share_icons', 10 );
function woocommerce_social_share_icons() {
        echo do_shortcode('[ssba]');
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
 
 // Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Change number of upsells output

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
	    woocommerce_upsell_display( 3,3 ); // Display 4 products in rows of 4
	}
}

// Customize Woocommerce Related Products Output

if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
    function woocommerce_output_related_products() {
        woocommerce_related_products(3,3);   // Display 4 products in 4 columns
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


// ADD RECEPTY

// Register Custom Post Type
function recepty_post_type() {

	$labels = array(
		'name'                => _x( 'Recepty', 'Post Type General Name', 'golfio' ),
		'singular_name'       => _x( 'Recept', 'Post Type Singular Name', 'golfio' ),
		'menu_name'           => __( 'Recepty', 'golfio' ),
		'name_admin_bar'      => __( 'Recepty', 'golfio' ),
		'parent_item_colon'   => __( 'Parent Item:', 'golfio' ),
		'all_items'           => __( 'All Items', 'golfio' ),
		'add_new_item'        => __( 'Add New Item', 'golfio' ),
		'add_new'             => __( 'Add New', 'golfio' ),
		'new_item'            => __( 'New Item', 'golfio' ),
		'edit_item'           => __( 'Edit Item', 'golfio' ),
		'update_item'         => __( 'Update Item', 'golfio' ),
		'view_item'           => __( 'View Item', 'golfio' ),
		'search_items'        => __( 'Search Item', 'golfio' ),
		'not_found'           => __( 'Not found', 'golfio' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'golfio' ),
	);
	$args = array(
		'label'               => __( 'recepty', 'golfio' ),
		'description'         => __( 'Recepty', 'golfio' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
                'menu_icon'           => 'dashicons-book',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'recepty', $args );

}

// Hook into the 'init' action
add_action( 'init', 'recepty_post_type', 0 );

if(!get_option("medium_crop"))
    add_option("medium_crop", "1");
else
    update_option("medium_crop", "1");

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 2);

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

/*
 * wc_remove_related_products
 * 
 * Clear the query arguments for related products so none show
 */
function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

function remove_loop_button(){
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');

add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );

function addBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}


// Hook in
add_filter( 'woocommerce_billing_fields', 'custom_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields', 'custom_override_billing_fields' );

// Our hooked in function – $fields is passed via the filter!
function custom_override_billing_fields( $fields ) {
    foreach ($fields as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    return $fields;
}