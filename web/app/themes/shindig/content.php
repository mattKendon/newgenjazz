<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-blog">
		
		<?php if(has_post_thumbnail()): ?>
			<div class="featured-blog-progression">
			<?php if( has_post_format( 'link' ) ): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>"><?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?><?php the_post_thumbnail('progression-blog'); ?></a>
			</div><!-- close .featured-blog-progression -->
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
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
						<li><?php if( has_post_format( 'link' ) ): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>"><?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?><img src="<?php echo esc_attr($thumbnail[0]);?>" alt="<?php echo esc_attr( $attachment->post_title );?>" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
					</div>
			
			</div><!-- close .featured-blog-progression -->
			<?php else: ?>
				<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?>
					<div class="featured-blog-progression">
					<div class="featured-video-progression">
						<?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?>
					</div>
					</div><!-- close .featured-blog-progression -->
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?> 
		
		
		<div class="container-text-pro">
			
			<?php if ( 'post' == get_post_type() ) : ?><?php the_category(''); ?><div class="clearfix"></div><?php endif; ?>
			
			<h2 class="blog-title-pro"><?php if( has_post_format( 'link' ) ): ?><a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_external_link', true) );?>"><?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?><?php the_title(); ?></a></h2>
				
			
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="pro-meta-blog">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="meta-pro-thumbnail"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '70'); ?></a>	
				<span class="first-pro"><?php _e( 'By', 'progression' ); ?></span><?php the_author_posts_link(); ?><span><?php _e( 'on', 'progression' ); ?></span><?php progression_posted_on(); ?><span><?php _e( 'with', 'progression' ); ?></span><?php comments_popup_link( '' . __( 'No Comments', 'progression' ) . '', _x( '1 Comment', 'comments number', 'progression' ), _x( '% Comments', 'comments number', 'progression' ) ); ?>
				<div class="clearfix"></div>
				</div>
			<?php endif; ?>
			
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary-pro">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-summary-pro">	
				<?php the_content( __( 'Read More', 'progression' ) ); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links-pro">' . __( 'Pages:', 'progression' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php endif; ?>
		</div><!-- close .container-text-pro -->
		
		
		
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<div class="sticky-post-pro">%s</div>', __( 'Featured', 'progression' ) );
		}
		?>
		
		<div class="clearfix"></div>
	</div><!-- close .container-blog -->
</article>