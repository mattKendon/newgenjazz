<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

	<?php if(get_post_meta($post->ID, 'progression_slider', true)): ?>
			<div id="pro-home-slider"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_slider', true)); ?></div>
		</header>
	<?php else: ?>
		</header>
		<div id="page-title"><div class="width-container"><h1><?php the_title(); ?></h1></div></div><!-- close #page-title -->
	<?php endif; ?>
	

<div class="clearfix"></div>

	<?php while(have_posts()): the_post(); ?>
	<?php if($post->post_content=="") : ?><?php else : ?>
	<div id="main">
		<div id="homepage-content-container">
		<div class="width-container">
			<?php the_content(); ?>
			<div class='clearfix'></div>
		</div><!-- close  .width-container -->
		</div>
	</div><!-- close  #main -->
	<?php endif; ?>
	<?php endwhile; ?>

<?php get_footer(); ?>