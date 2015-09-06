<?php
/**
 * The template for displaying event content within loops.
 *
 * Override this template by copying it to yourtheme/content-event.php
 *
 * @author 	Digital Factory
 * @package Events Maker/Templates
 * @since 	1.1.0
 */
 
if (!defined('ABSPATH')) exit; // exit if accessed directly

global $post;

// if in a shortcode, extract args
if (isset($args) && is_array($args)) {
	extract($args);
	
	// get events args and post object sent via em_get_template()
	$post = apply_filters('em_loop_event_post', $args[0]); // event post object
}

// extra event classes
$classes = apply_filters('em_loop_event_classes', array('hcalendar'));

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<div class="events-container-index">
			<div class="events-thumbnail-pro">
				<?php if(has_post_thumbnail()): ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('progression-staff'); ?></a>
				<?php endif; ?>
			</div><!-- close  .events-thumbnail-pro -->
			
		    <div class="events-archive-content">
			    <div class="entry-header">
					<h3 class="events-entry-title"><a href="<?php the_permalink(); ?>" class="url" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<?php do_action ('em_after_loop_event_title'); ?>
			    </div>
			    <?php do_action('em_loop_event_content'); ?>
				
				<a href="<?php the_permalink(); ?>" class="progression-button"><?php _e( 'View More', 'progression' ); ?></a>
		    </div><!-- close .events-archive-content -->
			
			<div class="clearfix"></div>
	   </div><!-- close .events-container-index -->
	</article>