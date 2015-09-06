<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = get_theme_mod('shop_col_progression', '3');

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li class="product column-<?php echo get_theme_mod('shop_col_progression', '3'); ?> <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">

	<div class="woocommerce-container-pro">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?>

			<div class="woocommerce-image-index">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			</div>

			<h3 class="product-title-index-pro"><?php the_title(); ?></h3>
			
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			
			<div class="short-description-pro"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>

		</a>
		
		
		<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?>
		
		<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" rel="nofollow" class="button" target="_blank"><?php _e( 'Purchase Tickets', 'progression' ); ?></a>
		<?php else: ?>
		<?php

			/**
			 * woocommerce_after_shop_loop_item hook
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' ); 

		?>
		<?php endif; ?>
	</div><!-- close .woocommerce-container-pro -->

</li>
