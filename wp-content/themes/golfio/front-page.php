<?php
/**
 * The template for displaying Frontpage.
 *
 * @package Golfio
 */
get_header();
?>

<!-- Carousel -->

<?php if (have_rows('slides', 'option')): ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $count = 0;
            while (have_rows('slides', 'option')): the_row();

                // vars
                $image = get_sub_field('slide');
                $title = get_sub_field('title');
                ?>
                <div class="item <?php if ($count == 0) echo 'active'; ?>">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <h2><?php echo $title; ?></h2>
                    </div><!-- /header-text -->
                </div>

                <?php
                $count++;
            endwhile;
            ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>

<?php endif; ?>

<!-- /carousel -->

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-push-2 front-content">
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; // End of the loop.   ?>

        <?php
        $link = get_field("button_link");
        $text = get_field("button_text");

        if ($link) {
            echo '<a type="button" class="call-to-action btn btn-warning" href="'.$link.'">'.$text.'</a>';
        } 
        ?>       

    </div>
</div>

<section id="featured" class="row">

        <?php
        $args = array(
            'post_type' => 'product',
            'meta_key' => '_featured',
            'meta_value' => 'yes',
            'posts_per_page' => 3
        );

        $featured_query = new WP_Query($args);

        if ($featured_query->have_posts()) :

            while ($featured_query->have_posts()) :

                $featured_query->the_post();

                $product = get_product($featured_query->post->ID);
                ?>

                <div class="col-xs-6 col-sm-4">    

                    <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                        <?php
                        if (has_post_thumbnail($featured_query->post->ID))
                            echo get_the_post_thumbnail($featured_query->post->ID, 'shop_catalog');
                        else
                            echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="65px" height="115px" />';
                        ?>

                        <h4 class="frontpage-title"><?php the_title(); ?></h4>

                        <span class="front-price"><?php echo $product->get_price_html(); ?></span>

                    </a>

                </div><!-- col-xs-3 --> 

                <?php
            endwhile;

        endif;

        wp_reset_query(); // Remember to reset  
        ?>

</section>

<?php get_footer(); ?>