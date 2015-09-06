<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 */

get_header(); ?>
<?php if ( have_posts() ) : ?>

<div id="page-title">
	<div class="width-container">
	<h1><?php
			if ( is_category() ) :
				single_cat_title();

			elseif ( is_tag() ) :
				single_tag_title();

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( __( 'Author: %s', 'progression' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				printf( __( 'Day: %s', 'progression' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Month: %s', 'progression' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Year: %s', 'progression' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				_e( 'Asides', 'progression' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				_e( 'Images', 'progression');

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				_e( 'Videos', 'progression' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				_e( 'Quotes', 'progression' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				_e( 'Links', 'progression' );

			else :
				_e( 'Archives', 'progression' );

			endif;
		?></h1>
	</div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<?php get_template_part( 'background', 'blog' ); ?>

<div id="main">			
	<div class="width-container">
		
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?><div id="content-left-container"><?php endif; ?>
		
		<div id="blog-container-pro">
			<?php
			/* Start the Loop */
			$count = 1;
			$count_2 = 1;
			?>
			<?php 
			while ( have_posts() ) : the_post();
				$col_count_progression = get_theme_mod('category_col_pro', '1');
				if($count >= 1+$col_count_progression) { $count = 1; }
			?>
				<div class="grid<?php echo get_theme_mod('category_col_pro', '1'); ?>column-progression <?php if($count == get_theme_mod('category_col_pro', '1')): echo ' lastcolumn-progression'; endif; ?>">
					<?php get_template_part( 'content', get_post_format() ); ?>
				</div>
				<?php if($count == get_theme_mod('category_col_pro', '1')): ?><div class="clearfix"></div><?php endif; ?>
				<?php $count ++; $count_2++; endwhile; ?>
				<div class="clearfix"></div>
				<?php show_pagination_links( ); ?>
				<div class="clearfix"></div>
		</div><!-- close #blog-container-pro -->		
	
		<?php if (get_theme_mod( 'blog_sidebar_pro', '1')) : ?></div><!-- close #content-left-container -->
		<?php get_sidebar(); ?>
		<?php endif; ?>
	
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php else : ?>
	<?php get_template_part( 'no-results', 'archive' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
