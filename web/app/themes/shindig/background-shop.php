<?php if (get_theme_mod( 'shop_bg_pro', get_template_directory_uri() . '/images/page-title.jpg' )) : ?>
<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("header").backstretch([ "<?php echo get_theme_mod( 'shop_bg_pro', get_template_directory_uri() . '/images/page-title.jpg' ); ?>" ],{ fade: 750, centeredY:true, }); }); </script>	
<?php else: ?>
	<?php if (get_header_image() != '') {?>
		<script type='text/javascript'>jQuery(document).ready(function($) {  'use strict';  $("header").backstretch([ "<?php header_image(); ?>" ],{ fade: 750, centeredY:true, }); }); </script>
	<?php } ?>
<?php endif; ?>