<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php _e( 'Sponsors', 'progression' ); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>


<?php get_template_part( 'background', 'sponsors' ); ?>



<div id="main">
	<div class="width-container">
		
			<div id="sponsor-container-pro">
				<?php
				/* Start the Loop */
				$count = 1;
				$count_2 = 1;
				?>
				<?php 
				while ( have_posts() ) : the_post();
					$col_count_progression = get_theme_mod('sponsor_col_pro', '3');
					if($count >= 1+$col_count_progression) { $count = 1; }
				?>
				<div class="grid<?php echo get_theme_mod('sponsor_col_pro', '3'); ?>column-progression <?php if($count == get_theme_mod('sponsor_col_pro', '3')): echo ' lastcolumn-progression'; endif; ?>">
					<?php get_template_part( 'content', 'sponsor' ); ?>
				</div>
				<?php if($count == get_theme_mod('sponsor_col_pro', '3')): ?><div class="clearfix"></div><?php endif; ?>
				<?php $count ++; $count_2++; endwhile; ?>
				<div class="clearfix"></div>
				<?php show_pagination_links( ); ?>
				<div class="clearfix"></div>
			</div><!-- close #blog-container-pro -->
				
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
	
<?php get_footer(); ?>