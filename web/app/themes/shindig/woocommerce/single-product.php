<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>


<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
<div id="page-title">
	<div class="width-container">
	<h1><?php woocommerce_page_title(); ?></h1>
	</div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
<?php endif; ?>
</header>

<?php get_template_part( 'background', 'shop' ); ?>

<div id="main">
<div class="width-container">
	
	<?php if (is_active_sidebar( 'sidebar-shop')) : ?><div id="content-left-container"><?php endif; ?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	
	<?php if (is_active_sidebar( 'sidebar-shop')) : ?></div>
	<?php do_action( 'woocommerce_sidebar' ); ?><?php endif; ?>
	
<div class="clearfix"></div>

</div><!-- close .width-container -->
</div><!-- close #main -->

<?php get_footer( 'shop' ); ?>
