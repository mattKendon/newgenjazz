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
	<div class="width-container"><h1><?php _e( 'Schedule', 'progression' ); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'schedule' ); ?>

<div id="main">
	<div class="width-container">
			
			
			<div id="schedule-container-pro">
				
				<?php echo category_description(); ?> 
				
				<?php
				$terms = get_terms( 'schedule_day' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ): 
				//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)

				$taxonomy     = 'schedule_day';
				$orderby      = 'name';
				$show_count   = 0;      // 1 for yes, 0 for no
				$pad_counts   = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no
				$title        = '';
				$empty        = 0;

				$args = array(
				  'taxonomy'     => $taxonomy,
				  'orderby'      => $orderby,
				  'show_count'   => $show_count,
				  'pad_counts'   => $pad_counts,
				  'hierarchical' => $hierarchical,
				  'title_li'     => $title,
				  'hide_empty'   => $empty
				);
				?>
				<div id="taxonomy_navigation_pro">
					<ul>
						<?php wp_list_categories( $args ); ?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>
				
				<?php
				/* Start the Loop */
				$count = 1;
				$count_2 = 1;
				?>
				<?php 
				while ( have_posts() ) : the_post();
					$col_count_progression = get_theme_mod('schedule_col_pro', '3');
					if($count >= 1+$col_count_progression) { $count = 1; }
				?>
				<div class="grid<?php echo get_theme_mod('schedule_col_pro', '3'); ?>column-progression <?php if($count == get_theme_mod('schedule_col_pro', '3')): echo ' lastcolumn-progression'; endif; ?>">
					<?php get_template_part( 'content', 'schedule' ); ?>
				</div>
				<?php if($count == get_theme_mod('schedule_col_pro', '3')): ?><div class="clearfix"></div><?php endif; ?>
				<?php $count ++; $count_2++; endwhile; ?>
				<div class="clearfix"></div>
				<?php show_pagination_links( ); ?>
				<div class="clearfix"></div>
			</div><!-- close #schedule-container-pro -->
				
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
	
<?php get_footer(); ?>