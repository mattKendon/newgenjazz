<?php
/**
 * @package progression
 */
?>
<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="width-container">	
		<div class="timeline-left-container">
			<?php if(get_post_meta($post->ID, 'progression_timeline_title', true)): ?><?php echo esc_html( get_post_meta($post->ID, 'progression_timeline_title', true) );?><?php endif; ?>
		</div>
		<div class="timeline-right-container">
			<?php if(has_post_thumbnail()): ?>
				<div class="featured-timeline-image">
					<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php the_post_thumbnail('progression-blog'); ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?>
				</div><!-- close .featured-blog-progression -->
			<?php endif; ?>
			<h2><a href="<?php echo esc_url( get_permalink($post->ID) );?>" target="_blank"><?php the_title(); ?></a></h2>
			<div class="timeline-desecription-pro"><?php the_excerpt(); ?></div>
			<div class="clearfix"></div>	
		</div>
		<div class="clearfix"></div>	
	</div>
</li>