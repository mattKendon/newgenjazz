<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php if (is_tax('timeline_day')) {
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$tax_term_breadcrumb_taxonomy_slug = $term->taxonomy;
					echo '' . $term->name . '';
				}
				?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'timeline' ); ?>

<div id="main">
			
			<div id="timeline-container-pro">
				
				<ul class="timeline-archive-pro">
				<?php echo category_description(); ?> 
				<?php 
				while ( have_posts() ) : the_post();
				?>
					<?php get_template_part( 'content', 'timeline' ); ?>
				<?php endwhile; ?>
				</ul><!-- close .timeline-archive-pro -->
				<div class="clearfix"></div>
				<?php show_pagination_links( ); ?>
				<div class="clearfix"></div>
			</div><!-- close #timeline-container-pro -->
				
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div><!-- close #main -->
	
<?php get_footer(); ?>