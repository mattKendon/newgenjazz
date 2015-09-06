<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 */
?>
<div id="page-title">
	<div class="width-container"><h1><?php _e( 'Nothing Found', 'progression' ); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'blog' ); ?>

<div id="main">			
	<div class="width-container">
		
		<?php if (get_theme_mod( 'blog_sidebar_pro')) : ?><div id="content-left-container"><?php endif; ?>
		
		<div id="blog-container-pro">
			<br>
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'progression' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'progression' ); ?></p>

			<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'progression' ); ?></p>

			<?php endif; ?>
			<br><br>
			
		
			<div class="clearfix"></div>
			<?php show_pagination_links( ); ?>
			<div class="clearfix"></div>
		</div><!-- close #blog-container-pro -->		
	
		<?php if (get_theme_mod( 'blog_sidebar_pro')) : ?></div><!-- close #content-left-container -->
		<?php get_sidebar(); ?>
		<?php endif; ?>
	
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
