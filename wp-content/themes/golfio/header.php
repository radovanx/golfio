<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Golfio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'golfio' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
                        </div>
                    </div>
		</div><!-- .site-branding -->
                
                <nav class="navbar navbar-default" role="navigation">
		<div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
		    <a class="navbar-brand" href="#"><?php bloginfo( 'name' ); ?></a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    
		    <div class="collapse navbar-collapse navbar-ex1-collapse">
		        <?php
		        wp_nav_menu( array(
		            'theme_location' => 'primary',
		            'depth' => 2,
		            'container' => false,
		            'menu_class' => 'nav navbar-nav',
		            'fallback_cb' => 'wp_page_menu',
		            //Process nav menu using our custom nav walker
		            'walker' => new wp_bootstrap_navwalker())
		        );
		        ?>
		    </div><!-- /.navbar-collapse --> 
		</div>
		</nav>	
                
                
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
            <div class="row">
