<?php
/**
 * @package progression
 */
?>
		<?php if(has_post_thumbnail()): ?>
			<div class="widget-sponsor-progression">
			<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php the_post_thumbnail('large'); ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?>
			</div><!-- close .featured-blog-progression -->
		<?php endif; ?> 