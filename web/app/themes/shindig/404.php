<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title">
	<div class="width-container"><h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h1></div>
</div><!-- close #page-title -->
</header>

<?php get_template_part( 'background', 'page' ); ?>

<div id="main">			
	<div class="width-container">
		<br>
		<p><?php _e( 'It looks like nothing was found at this location. ', 'progression' ); ?></p>
		<br>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php get_footer(); ?>