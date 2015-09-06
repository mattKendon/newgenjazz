<?php
/**
 * @package progression
 */
?>
<div id="post-<?php the_ID(); ?>">
	<div class="container-schedule">
		
		<?php if(has_post_thumbnail()): ?>
			<div class="featured-schedule-progression">
			<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php if($post->post_content=="") : ?><?php else : ?><a href="<?php the_permalink(); ?>"><?php endif; ?><?php the_post_thumbnail('progression-gallery'); ?><?php if($post->post_content=="") : ?><?php else : ?></a><?php endif; ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?>
			</div><!-- close .featured-blog-progression -->
		<?php endif; ?> 
		
		
		<div class="schedule-position-pro">
			<div class="schedule-text-pro">
				<h2 class="schedule-title-pro"><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php if($post->post_content=="") : ?><?php else : ?><a href="<?php the_permalink(); ?>"><?php endif; ?><?php the_title(); ?><?php if($post->post_content=="") : ?><?php else : ?></a><?php endif; ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?></h2>
				<div class="schedule-summary-pro">	
					<?php if(get_post_meta($post->ID, 'progression_schedule', true)): ?><?php echo esc_html( get_post_meta($post->ID, 'progression_schedule', true) );?><?php endif; ?>
				</div><!-- .schedule-summary-pr -->
			</div><!-- close .schedule-text-pro -->
		</div><!-- close .schedule-position-pro -->
		
		<div class="clearfix"></div>
	</div><!-- close .container-schedule -->
</div>