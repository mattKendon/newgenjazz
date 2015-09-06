<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 */

get_header(); ?>
<?php if ( have_posts() ) : ?>
<div id="page-title">
	<div class="width-container"><h1><?php printf( __( 'Search Results for: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>	

<?php get_template_part( 'background', 'blog' ); ?>
	
<div id="main">			
	<div class="width-container">
		
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?><div id="content-left-container"><?php endif; ?>
		
		<div id="blog-container-pro">
			<?php
			/* Start the Loop */
			$count = 1;
			$count_2 = 1;
			?>
			<?php 
			while ( have_posts() ) : the_post();
				$col_count_progression = get_theme_mod('category_col_pro', '1');
				if($count >= 1+$col_count_progression) { $count = 1; }
			?>
				<div class="grid<?php echo get_theme_mod('category_col_pro', '1'); ?>column-progression <?php if($count == get_theme_mod('category_col_pro', '1')): echo ' lastcolumn-progression'; endif; ?>">
					<?php get_template_part( 'content', get_post_format() ); ?>
				</div>
				<?php if($count == get_theme_mod('category_col_pro', '1')): ?><div class="clearfix"></div><?php endif; ?>
				<?php $count ++; $count_2++; endwhile; ?>
				<div class="clearfix"></div>
				<?php show_pagination_links( ); ?>
				<div class="clearfix"></div>
		</div><!-- close #blog-container-pro -->
	
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?></div><!-- close #content-left-container -->
		<?php get_sidebar(); ?>
		<?php endif; ?>
	
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

<?php endif; ?>

<?php get_footer(); ?>