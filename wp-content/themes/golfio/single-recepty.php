<?php
/**
 * The template for displaying all single posts.
 *
 * @package Golfio
 */
get_header();
?>
<?php while (have_posts()) : the_post(); ?>

    <div class="col-xs-12 col-sm-8 col-sm-push-4 recepie-content">
        <?php the_title('<h2 class="rece-title">', '</h2>'); ?>
        <?php the_content(); ?>
        <?php if (have_rows('slozky')): ?>

            <table class="table table-striped recepie-details table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Složka</th>
                        <th>Množství</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $count = 1;
                    while (have_rows('slozky')): the_row();
                        ?>

                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php the_sub_field('slozka'); ?></td>
                            <td><?php the_sub_field('mnozstvi'); ?></td>
                        </tr>

                        <?php
                        $count++;
                    endwhile;
                    ?>
                </tbody>
            </table>

    <?php endif; ?>

    </div><!-- .entry-content -->

    <div class="recepie-image col-xs-12 col-sm-4 col-sm-pull-8">
        <?php
        if (has_post_thumbnail($post->ID))
            echo get_the_post_thumbnail($post->ID, 'shop_single');
        ?>

        <div class="timing">
            <div class="col-xs-6">Čas na přípravu</div>
            <div class="col-xs-6">Doba vaření</div>

            <div class="col-xs-6 time"><?php the_field('cas_na_pripravu'); ?> min</div>
            <div class="col-xs-6 time"><?php the_field('doba_vareni'); ?> min</div>
        </div>

    <?php echo do_shortcode('[ssba]'); ?>

    </div>

    <div class="clearfix"></div>

    <div class="post-navigation">
        <div class="col-xs-6"><?php previous_post('<span class="glyphicon glyphicon-chevron-left"></span> %', '', 'yes'); ?></div>
        <div class="col-xs-6"><?php next_post('% <span class="glyphicon glyphicon-chevron-right"></span> ', '', 'yes'); ?></div>
    </div>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>

<?php endwhile; // End of the loop.   ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
