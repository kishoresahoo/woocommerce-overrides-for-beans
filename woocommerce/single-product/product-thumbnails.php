<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) :
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

	echo beans_open_markup( 'woo_single_thumbnails_wrap', 'div', array( 'class' => 'thumbnails columns-' . $columns ) );

		foreach ( $attachment_ids as $attachment_id ) :

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image_title = esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
				'title'	=> $image_title,
				'alt' => $image_title
			) );

			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( beans_open_markup( 'woo_single_gallery_image_link', 'a', array(
				'href' => '%s',
				'itemprop' => 'image',
				'class' => 'woocommerce-main-image zoom',
				'title' => '%s',
				'data-rel' => 'prettyPhoto[product-gallery]'
			) ) . '%s' . beans_close_markup( 'woo_single_gallery_image_link', 'a' ), $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;

		endforeach;

	echo beans_close_markup( 'woo_single_thumbnails_wrap', 'div' );

endif;
