<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) :

	$woocommerce_loop['loop'] = 0;

endif;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) :

	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

endif;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) :

	return;

endif;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) :

	$classes[] = 'first';

endif;

if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) :

	$classes[] = 'last';

endif;

echo beans_open_markup( 'woo_product_item_wrap', 'li', array( 'class' => implode(' ', get_post_class( $classes ) ) ) );

	do_action( 'woocommerce_before_shop_loop_item' );

	echo beans_open_markup( 'woo_product_item_link', 'a', array( 'href' => get_permalink() ) );

			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * woocommerce_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

	echo beans_close_markup( 'woo_product_item_link', 'a' );

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

	echo beans_close_markup( 'woo_product_item_wrap', 'li' );
