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
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">

            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'golfio'); ?></a>     

            <header id="masthead" class="site-header" role="banner">
                <div class="top-bar container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6 top-mobile">
                                <span class="glyphicon glyphicon-earphone"></span><?php the_field('telefon', 'option'); ?>
                            </div>
                            <div class="col-xs-6 top-email">
                                <span class="glyphicon glyphicon-envelope"></span><?php the_field('e-mail', 'option'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-branding container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-sm-push-4 top-logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php the_field('loga', 'option'); ?>"></a>
                            <p class="site-description"><?php bloginfo('description'); ?></p>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-sm-pull-4 top-account pull-down">
                            <?php if (is_user_logged_in()) { ?>
                                <span class="glyphicon glyphicon-user top-user"></span>
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'woothemes'); ?>"><?php _e('My Account', 'woothemes'); ?></a>
                            <?php } else {
                                ?>
                                <span class="glyphicon glyphicon-user top-user"></span>
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Login / Register', 'woothemes'); ?>"><?php _e('Login / Register', 'woothemes'); ?></a>
                            <?php } ?>
                        </div>
                        <div class="col-xs-6 col-sm-4 top-cart pull-down">
                            <span class="glyphicon glyphicon-shopping-cart top-shop"></span>
                            <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart'); ?>"><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count), WC()->cart->cart_contents_count); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
                        </div>
                    </div>
                </div><!-- .site-branding -->

                <nav class="navbar navbar-default container" role="navigation" id="top-nav">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><?php bloginfo('name'); ?></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <?php
                            wp_nav_menu(array(
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
                </nav>	


            </header><!-- #masthead -->

            <div id="content" class="site-content container">
                <div class="row">
