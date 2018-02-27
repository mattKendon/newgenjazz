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
                <div class="timeline-day-archive-container homepage-widget-blog">
                    <h1 class="home-widget">COMING UP!</h1>
                </div>
			<?php
			$member_group_terms = get_terms( 'schedule_day' );
			$member_group_terms = array_map(function ($member_group_term) {
			    try {
                    $date = Carbon\Carbon::createFromFormat('Ymd', get_field('schedule_date', 'schedule_day_' . $member_group_term->term_id));
                } catch (InvalidArgumentException $e) {
			        return null;
                }

                return (object) [
                    'date' => $date,
                    'term' => $member_group_term
                ];
            }, $member_group_terms);

			$member_group_terms = array_filter($member_group_terms);

			usort($member_group_terms, function ($a, $b) {
			    if ($a->date === $b->date) return 0;
			    return ($a->date > $b->date) ? 1 : -1;
            });

			$member_group_terms = array_reverse($member_group_terms);
            $currentDate = \Carbon\Carbon::now()->subDay();
            $future_member_group_terms = array_filter($member_group_terms, function ($object) use ($currentDate) {
                return $object->date > $currentDate;
            });

            $past_member_group_terms = array_filter($member_group_terms, function ($object) use ($currentDate) {
               return $object->date < $currentDate;
            });

            $future_member_group_terms = array_reverse($future_member_group_terms);
			?>
			
			<?php
			foreach ( $future_member_group_terms as $member_group_term ) {
			    $member_group_query = new WP_Query( array(
			        'post_type' => 'schedule',
					'posts_per_page' => '65',
			        'tax_query' => array(
			            array(
			                'taxonomy' => 'schedule_day',
			                'field' => 'slug',
			                'terms' => array( $member_group_term->term->slug ),
			                'operator' => 'IN'
			            )
			        )
			    ) );

                $title = $member_group_term->date->format('jS M Y');

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

                <div class="timeline-day-archive-container homepage-widget-blog">
                    <h1 class="home-widget">WHAT YOU'VE MISSED</h1>
                </div>
                <?php
                foreach ( $past_member_group_terms as $member_group_term ) {
                    $member_group_query = new WP_Query( array(
                        'post_type' => 'schedule',
                        'posts_per_page' => '65',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'schedule_day',
                                'field' => 'slug',
                                'terms' => array( $member_group_term->term->slug ),
                                'operator' => 'IN'
                            )
                        )
                    ) );

                    $title = $member_group_term->date->format('jS M Y');

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
			</div><!-- close #timeline-container-pro -->
				
</div><!-- close #main -->
	
<?php get_footer(); ?>