<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-sponsor">
		
		<?php if(has_post_thumbnail()): ?>
			<div class="featured-sponsor-progression">
			<?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php the_post_thumbnail('large'); ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?>
			</div><!-- close .featured-blog-progression -->
		<?php endif; ?> 
		
		
		<div class="sponsor-text-pro">
			<div class="aligncenter"><h5 class="sponsor-title-pro"><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>" target="_blank"><?php endif; ?><?php the_title(); ?><?php if(get_post_meta($post->ID, 'progression_external_link', true)): ?></a><?php endif; ?></h5></div>
				
			<div class="sponsor-summary-pro">	
				<?php the_content( __( 'Read More', 'progression' ) ); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links-pro">' . __( 'Pages:', 'progression' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .sponsor-summary-pr -->
		</div><!-- close .sponsor-text-pro -->
		
		<div class="clearfix"></div>
	</div><!-- close .container-sponsor -->
</article>