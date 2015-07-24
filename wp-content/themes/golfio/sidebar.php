<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Golfio
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col-xs-12 col-md-4 col-md-pull-8" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
