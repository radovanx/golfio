<?php
/**
 * The template for displaying Frontpage.
 *
 * @package Golfio
 */
get_header();
?>

<div id="primary" class="content-area col-xs-12 col-md-8 col-md-push-4">
    <main id="main" class="site-main" role="main">

        This is a homepage

        <section id="featured">

            <h1>Featured</h1>

            <div class="row">

                <?php
                $args = array(
                    'post_type' => 'product',
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',
                    'posts_per_page' => 4
                );

                $featured_query = new WP_Query($args);

                if ($featured_query->have_posts()) :

                    while ($featured_query->have_posts()) :

                        $featured_query->the_post();

                        $product = get_product($featured_query->post->ID);
                        ?>

                        <div class="col-xs-6 cols-sm-4 col-md-3">    

                            <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                                <?php
                                if (has_post_thumbnail($featured_query->post->ID))
                                    echo get_the_post_thumbnail($featured_query->post->ID, 'shop_catalog');
                                else
                                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="65px" height="115px" />';
                                ?>

                                <h3><?php the_title(); ?></h3>

                                <span class="price"><?php echo $product->get_price_html(); ?></span>

                            </a>

                            <?php woocommerce_template_loop_add_to_cart($featured_query->post, $product); ?>
                        </div><!-- col-xs-3 --> 

                        <?php
                    endwhile;

                endif;

                wp_reset_query(); // Remember to reset  
                ?>
            </div>

        </section>

        <section id="recent">

            <h1>Recently Added</h1>

            <div class="row">

                <?php
                $args = array('post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC');
                $loop = new WP_Query($args);
                while ($loop->have_posts()) : $loop->the_post();
                    global $product;
                    ?>

                    <div class="col-xs-6 cols-sm-4 col-md-3">    

                        <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                            <?php
                            if (has_post_thumbnail($loop->post->ID))
                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                            else
                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="65px" height="115px" />';
                            ?>

                            <h3><?php the_title(); ?></h3>

                            <span class="price"><?php echo $product->get_price_html(); ?></span>

                        </a>

                        <?php woocommerce_template_loop_add_to_cart($loop->post, $product); ?>
                    </div><!-- col-xs-3 -->
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>

            </div><!-- /row-fluid -->
        </section><!-- /recent -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>