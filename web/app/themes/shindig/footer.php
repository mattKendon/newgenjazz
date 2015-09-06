<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package progression
 * @since progression 1.0
 */
?>

<?php if( is_page_template('homepage.php') ): ?>
	<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-widgets' ); ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'homepage-all-widgets' ) ) : ?>
	<?php dynamic_sidebar( 'homepage-all-widgets' ); ?>
<?php endif; ?>

<div class="clearfix"></div>	
<footer>

	<div id="footer-gradient-header-pro"></div>
	
	<?php if (get_theme_mod( 'footer_logo_upload', get_template_directory_uri() . '/images/logo.png' )) : ?>
	<h1 id="logo-footer"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'footer_logo_upload', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo get_theme_mod( 'footer_logo_width', '180' ); ?>" /></a></h1>
	<?php endif; ?>
	
	<div id="widget-area">
		<div class="width-container footer-<?php echo get_theme_mod('footer_cols', '3'); ?>-column">
			<?php if ( ! dynamic_sidebar( 'Footer Widgets' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<?php get_template_part( 'social', 'icons-footer' ); ?>
	<div class="clearfix"></div>
	
	<?php if (get_theme_mod( 'copyright_textbox', '2015 All Rights Reserved. Developed by ProgressionStudios' )) : ?>
		<div id="copyright">
			<div class="width-container"><?php echo get_theme_mod( 'copyright_textbox', '2015 All Rights Reserved. Developed by ProgressionStudios' ); ?><div class="clearfix"></div></div>
		</div><!-- close #copyright -->
	<?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>