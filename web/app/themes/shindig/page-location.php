<?php
// Template Name: Location Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php the_title(); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'page' ); ?>

<div id="main">
	<div class="width-container">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<div id="map-left-location">
				
					<div id="map-progression"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_map', true)); ?></div>
				


			<div id="map-right-location">
				<div id="content-container-pro">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links-pro">' . __( 'Pages:', 'progression' ),
							'after'  => '</div>',
						) );
					?>
					<?php edit_post_link( __( 'Edit', 'progression' ), '<p class="edit-link">', '</p>' ); ?>
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>
					<div class="clearfix"></div>
				</div><!-- close #content-container-pro -->
			</div><!-- close #map-right-location -->
			
						</div><!-- close #map-left-location -->
			
			<div class="clearfix"></div>
			
		<?php endwhile; // end of the loop. ?>
				
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php get_footer(); ?>