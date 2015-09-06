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
			<?php
			$member_group_terms = get_terms( 'schedule_day' );
			?>
			<div id="taxonomy_navigation_pro">
			<ul id="filterOptions-pro">
			<?php
			$count = 1;
			$count_2 = 1;
			foreach ( $member_group_terms as $member_group_term ) {
			    $member_group_query = new WP_Query( array(
			        'post_type' => 'schedule',
					'posts_per_page' => '65',
			        'tax_query' => array(
			            array(
			                'taxonomy' => 'schedule_day',
			                'field' => 'slug',
			                'terms' => array( $member_group_term->slug ),
			                'operator' => 'IN'
			            )
			        )
			    ) 
			);
			 ?>
			   <li<?php if($count == 1): ?> class="current-cat"<?php endif; ?>><a href="#" class="<?php echo $member_group_term->slug; ?>"><?php echo $member_group_term->name; ?></a></li>
			    <?php
				$count ++; $count_2++;
			    // Reset things, for good measure
			    $member_group_query = null;
			    wp_reset_postdata();
			}
			?>
				</ul>
				<div class="clearfix"></div>
			</div><!-- c lose #taxonomy_navigation_pro -->

				<ul id="schedule-content-progression">
					<?php 
					while ( have_posts() ) : the_post();
						$col_count_progression = get_theme_mod('schedule_col_pro', '3');
					?>
					<li class="schedule<?php echo get_theme_mod('schedule_col_pro', '3'); ?>column-pro item-pro-schedule <?php $terms = get_the_terms( $post->ID , 'schedule_day' ); 
		        foreach ( $terms as $term ) {
		            $term_link = get_term_link( $term, 'schedule_day' );
		            if( is_wp_error( $term_link ) )
		            continue;
		        	echo '' . $term->slug . ' ';
		        } 
		    ?>">
						<?php get_template_part( 'content', 'schedule' ); ?>
					</li>
					<?php endwhile; ?>
					
				</ul>
				
				<div class="clearfix"></div>
			</div><!-- close #schedule-container-pro -->
			
			
			
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
	
<?php get_footer(); ?>