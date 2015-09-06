<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package progression
 */
?>

<?php if(get_post_meta($post->ID, 'progression_map', true)): ?>
	<div id="map-progression"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_map', true)); ?></div>
<?php endif; ?>

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