<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php the_title(); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'blog' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
<div id="main">
	<div class="width-container">
		
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?><div id="content-left-container"><?php endif; ?>
			<div id="blog-container-pro">
			<?php get_template_part( 'content', 'single' ); ?>		
			</div>
			
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?></div><!-- close #content-left-container -->
		<?php get_sidebar(); ?>
		<?php endif; ?>
		
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>