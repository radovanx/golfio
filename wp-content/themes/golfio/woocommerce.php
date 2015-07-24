<?php
/**
 * The template for displaying Woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Golfio
 */
get_header();
?>

<div id="primary" class="content-area col-xs-12 col-md-8 col-md-push-4">
    <main id="main" class="site-main" role="main">

        <?php woocommerce_content(); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<div id="secondary" class="widget-area col-xs-12 col-md-4 col-md-pull-8" role="complementary">
    <?php dynamic_sidebar( 'sidebar-shop' ); ?>
</div>

<?php get_footer(); ?>
