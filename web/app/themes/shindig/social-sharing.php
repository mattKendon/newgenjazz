<?php if(is_page() || is_single() ): ?>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
	<?php if (get_theme_mod( 'social_description_pro', 'Easily customize your share description with the Shindig theme!')) : ?>
	<meta property="og:description" content="<?php echo get_theme_mod('social_description_pro', 'Easily customize your share description with the Shindig theme! '); ?>" />
<?php endif; ?>
	<?php if (get_theme_mod( 'share_main_image', get_template_directory_uri() . '/images/page-title.jpg'  )) : ?>
	<meta name="twitter:image" content="<?php echo get_theme_mod( 'share_main_image', get_template_directory_uri() . '/images/page-title.jpg' ); ?>" />
	<meta property="og:image" content="<?php echo get_theme_mod( 'share_main_image', get_template_directory_uri() . '/images/page-title.jpg' ); ?>" />
	<meta property="og:image:secure_url" content="<?php echo get_theme_mod( 'share_main_image', get_template_directory_uri() . '/images/page-title.jpg' ); ?>" />
	<?php endif; ?>
<?php endif; ?>