<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-blog">
		
		<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?>
		<div class="featured-blog-progression">
		<div class="featured-video-progression">
			<?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?>
		</div>
		</div>
		<?php else: ?>
			<?php if( has_post_format( 'gallery' ) ): ?>
				<div class="featured-blog-progression">
				<div class="flexslider gallery-progression">
		      	<ul class="slides">
					<?php
					$args = array(
					    'post_type' => 'attachment',
					    'numberposts' => '-1',
					    'post_status' => null,
					    'post_parent' => $post->ID,
						 'post_mime_type' => 'image', // <----- this one is added by me
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$attachments = get_posts($args);
					?>
					<?php 
					if($attachments):
					    foreach($attachments as $attachment):
					?>
					<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog-single'); ?>
					<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
					<li><a href="<?php echo esc_attr($image[0]);?>" rel="prettyPhoto[gallery]"><img src="<?php echo esc_attr($thumbnail[0]);?>" alt="<?php echo esc_attr( $attachment->post_title );?>" /></a></li>
					<?php endforeach; endif; ?>
				</ul>
				</div>
				</div><!-- close #journal-image-pro -->
			<?php else: ?>
				<?php if(has_post_thumbnail()): ?>
					<div class="featured-blog-progression">
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
					<a href="<?php echo esc_attr($image[0]);?>" rel="prettyPhoto">
						<?php the_post_thumbnail('progression-blog-single'); ?>
					</a>
					</div><!-- close #journal-image-pro -->
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<div class="container-text-pro">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links-pro">' . __( 'Pages:', 'progression' ),
					'after'  => '</div>',
				) );
			?>
			<div class="clearfix"></div>
			
			<?php the_tags( '<div class="tags-pro">' . __( '<span>Tags:</span>', 'progression' ), '', '</div>' ); ?> 	
			
			
		</div><!-- .entry-content -->
		
		
			

			
			<div class="clearfix"></div>
	
	</div><!-- close .container-blog -->
</article>

<?php progression_content_nav( 'nav-below' ); ?>


<?php if ( comments_open() || '0' != get_comments_number() ) comments_template(); ?>