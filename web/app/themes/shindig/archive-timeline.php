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
	<div class="width-container"><h1><?php _e( 'Timeline', 'progression' ); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'timeline' ); ?>

<div id="main">
			
			<div id="timeline-container-pro">
			<?php
			$member_group_terms = get_terms( 'timeline_day' );
			?>
			
			<?php
			foreach ( $member_group_terms as $member_group_term ) {
			    $member_group_query = new WP_Query( array(
			        'post_type' => 'timeline',
					'posts_per_page' => '65',
			        'tax_query' => array(
			            array(
			                'taxonomy' => 'timeline_day',
			                'field' => 'slug',
			                'terms' => array( $member_group_term->slug ),
			                'operator' => 'IN'
			            )
			        )
			    ) );
			    ?>
				
			    	<div class="timeline-day-archive-container"><h1 class="timeline-day-archive"><?php echo $member_group_term->name; ?></h1></div>
					<ul class="timeline-archive-pro">
					<?php
					if ( $member_group_query->have_posts() ) : while ( $member_group_query->have_posts() ) : $member_group_query->the_post(); 
					?>
						<?php get_template_part( 'content', 'timeline' ); ?>
				    <?php endwhile; ?>
					</ul><!-- close .timeline-archive-pro -->
				<div class="clearfix"></div>
				<?php endif; ?>
			    <?php
			    // Reset things, for good measure
			    $member_group_query = null;
			    wp_reset_postdata();
			}
			?>
				<div class="clearfix"></div>
			</div><!-- close #timeline-container-pro -->
				
</div><!-- close #main -->
	
<?php get_footer(); ?>