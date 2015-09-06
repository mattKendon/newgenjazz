<?php if ( is_attachment() ) : ?>
	<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("header").backstretch([ "<?php header_image(); ?>" ],{ fade: 750, centeredY:true, }); }); </script>
<?php else: ?>
<?php
	$page_for_posts2 = get_option( 'page_for_posts' );
	if(wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts2))):
?>
	<?php $page_for_posts2 = get_option( 'page_for_posts' ); $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts2), 'progression-header-bg'); ?>	
	<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("header").backstretch([ "<?php echo esc_attr($image[0]);?>" ],{ fade: 750, centeredY:true, }); }); </script>
<?php else: ?>
	<?php if (get_header_image() != '') {?>
		<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("header").backstretch([ "<?php header_image(); ?>" ],{ fade: 750, centeredY:true, }); }); </script>
	<?php } ?>
<?php endif; ?>

<?php endif; ?>