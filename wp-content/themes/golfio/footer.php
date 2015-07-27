<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Golfio
 */
?>

</div>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">

        <div class="row">

            <?php dynamic_sidebar('footer-1'); ?>

            <?php dynamic_sidebar('footer-2'); ?>

            <div class="col-xs-12 col-sm-3 footer-widget">
                <h3 class="footer-title">Kde sídlíme</h3>
                <?php if (have_rows('adresa', 'option')): ?>

                    <ul class="address-footer">

                        <?php while (have_rows('adresa', 'option')): the_row(); ?>

                            <li><?php the_sub_field('linka'); ?></li>

                        <?php endwhile; ?>

                    </ul>

                <?php endif; ?>
                <br/><a href="/kontakty/">Zobrazit na mapě</a>
            </div>

            <div class="col-xs-12 col-sm-3 footer-widget">
                <h3 class="footer-title">Konaktujte nás</h3>
                <div class="icons-cont"><span class="glyphicon glyphicon-earphone"></span><?php the_field('telefon', 'option'); ?></div>
                <div class="icons-cont"><span class="glyphicon glyphicon-envelope"></span><?php the_field('e-mail', 'option'); ?></div>
            </div>

        </div>

        <div class="site-info">
            <span class="copytext">© 2015 elgofio.cz - Všechny práva vyhrazena</span>
            <span class="sep"> | </span>
            <?php printf(esc_html__('Developed: %1$s by %2$s', 'golfio'), 'golfio', '<a href="http://www.web-4-all.cz" rel="designer">Web4all</a>'); ?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
