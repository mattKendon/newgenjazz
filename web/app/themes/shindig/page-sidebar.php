<?php
// Template Name: Page w/ Sidebar
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

		<div id="content-left-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- close #content-left-container -->
		
		<?php get_sidebar(); ?>
		
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php get_footer(); ?>