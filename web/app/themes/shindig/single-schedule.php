<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php the_title(); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>


<?php while ( have_posts() ) : the_post(); ?>
<div id="main">
	<div class="width-container">
		
			<div id="schedule-container-pro">
			<?php get_template_part( 'content', 'single-schedule' ); ?>		
			</div>
			
		
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>