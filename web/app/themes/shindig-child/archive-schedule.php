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

<div id="main" style="background: transparent;">
			
			<div id="timeline-container-pro">
			<?php
			$member_group_terms = get_terms( 'schedule_day' );
			$member_group_terms = array_reverse($member_group_terms)
			?>
			
			<?php
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
			    ) );

				try {
					$title = Carbon\Carbon::createFromFormat('Ymd', get_field('schedule_date', 'schedule_day_' . $member_group_term->term_id))->format('jS M Y');
				} catch (InvalidArgumentException $e) {
					$title = $member_group_term->name;
				}

			    ?>
				
			    	<div class="timeline-day-archive-container">
						<h1 class="timeline-day-archive"><?php echo $title; ?></h1>
					</div>
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