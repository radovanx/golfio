<?php
/**
 * The template for displaying archive pages.
 *
 * @package Golfio
 */
get_header();
?>

<div id="primary" class="content-area col-xs-12">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : ?>

            <h1 class="page-title">Recepty</h1>
        
            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

            <div class="col-xs-12 col-sm-4">    
            <article id="recepie-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title(sprintf('<h2 class="recept-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                    </header><!-- .entry-header -->
                    
                    <?php if (has_post_thumbnail($post->ID))
                        echo '<a href="'.esc_url( get_permalink($post->ID) ).'" class="recep-link">';
                        echo get_the_post_thumbnail($post->ID, 'shop_catalog');
                        echo '</a>';
                    ?>
                    <div class="timing">
                        <div class="col-xs-6">Čas na přípravu</div>
                        <div class="col-xs-6">Doba vaření</div>

                        <div class="col-xs-6 time"><?php the_field('cas_na_pripravu'); ?> min</div>
                        <div class="col-xs-6 time"><?php the_field('doba_vareni'); ?> min</div>
                    </div>
                    <div class="entry-content">
                        <?php echo wp_trim_words( get_the_content($post->ID), 20 ); ?><br/>
                        <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" class="btn btn-success recepie-more">Čtěte více</a>

                    </div><!-- .entry-content -->

                </article><!-- #post-## -->
            </div>

            <?php endwhile; ?>

            <?php the_posts_navigation(); ?>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
