<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Golfio
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function golfio_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'golfio_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function golfio_jetpack_setup
add_action( 'after_setup_theme', 'golfio_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function golfio_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function golfio_infinite_scroll_render
