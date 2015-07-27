<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_content ) {
	return;
}

?>
<div itemprop="description" class="col-xs-12 col-sm-7 nopadd">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_content ) ?>    
</div>
