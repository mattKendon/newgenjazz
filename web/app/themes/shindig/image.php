<?php
/**
 * The template for displaying image attachments.
 *
 * @package progression
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php the_title(); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
</header>

<?php get_template_part( 'background', 'blog' ); ?>

<div id="main">
	<div class="width-container">
		
		<div class="attachment-pro-image aligncenter">
			<?php progression_the_attached_image(); ?>
		</div><!-- .attachment -->
			
			<div id="content-container-pro">
				<div class="attachment-content-pro">

						<?php if ( has_excerpt() ) : ?>
						<h5 class="aligncenter">
							<?php the_excerpt(); ?>
						</h5><!-- .entry-caption -->
						<?php endif; ?>
						
						<?php
							the_content();
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
								'after'  => '</div>',
							) );
						?>
						
				<div class="clearfix"></div>	
				</div><!-- close .attachment-content-pro -->
			</div><!-- close #content-container-pro -->
			
			
			<div class="image-navigation">
				<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'progression' ) ); ?></div>
				<div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'progression' ) ); ?></div>
				<div class="clearfix"></div>
			</div><!-- #image-navigation -->
			
			
	</div><!-- close .page-container -->
</div><!-- close #main -->


<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
