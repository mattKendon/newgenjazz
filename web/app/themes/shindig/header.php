<?php
/**
 * The Header for our theme.
 *
 * @package progression
 * @since progression 1.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php get_template_part( 'social', 'sharing' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<header>
	<?php if (get_theme_mod( 'fixed_nav_pro', '1' )) : ?><div id="fixed-nav-pro"><?php endif; ?>
	<?php if (get_theme_mod( 'nav_reposition_pro' )) : ?>
		<div id="left-logo-pro">
		<nav>
			<div class="width-container">
			<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'logo_upload', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo get_theme_mod( 'logo_width', '180' ); ?>" /></a></h1>
			<?php wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?><?php if ( has_nav_menu( 'primary' ) ):  ?><?php else: ?><span class="nav-pro-span"><?php _e( 'Insert Navigation under Appearance > Menus', 'progression' ); ?></span><?php endif; ?><div class="clearfix"></div>
			</div><!-- close .width-container -->
		</nav>
		</div><!-- close #left-logo-pro -->
		<?php if (get_theme_mod( 'fixed_nav_pro', '1' )) : ?></div><!-- close #fixed-nav-pro --><?php endif; ?>
		<div id="gradient-header-pro"></div>
	<?php else: ?>
	<nav>
		<div id="center-navigation-pro"><?php wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?><?php if ( has_nav_menu( 'primary' ) ):  ?><?php else: ?><span class="nav-pro-span"><?php _e( 'Insert Navigation under Appearance > Menus', 'progression' ); ?></span><?php endif; ?></div><!-- close #center-navigation-pro --><div class="clearfix"></div>
	</nav>
	<?php if (get_theme_mod( 'fixed_nav_pro', '1' )) : ?></div><!-- close #fixed-nav-pro --><?php endif; ?>
	<div id="gradient-header-pro"></div>
	<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'logo_upload', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo get_theme_mod( 'logo_width', '180' ); ?>" /></a></h1>
	<?php endif; ?>
	<div id="gradient-mobile-pro"></div>
	<div class="share-progression"><?php get_template_part( 'social', 'icons' ); ?></div><!-- close .share-progression -->