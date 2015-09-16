<?php
/*
Plugin Name: Progression Custom Taxonomy
Plugin URI: http://progressionstudios.com
Description: This plugin registers the beer custom post type for Progression Studios
Version: 1.0
Author: Progression Studios
Author URI: http://progressionstudios.com/
Author Email: contact@progressionstudios.com
License: GNU General Public License v3.0
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * Registering Custom Post Type
 */
add_action('init', 'progression_portfolio_init');
function progression_portfolio_init() {	
	
	register_post_type(
		'sponsor',
		array(
			'labels' => array(
				'name' => 'Sponsors',
				'singular_name' => 'Sponsor'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'sponsors'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_taxonomy('sponsor_type', 'sponsor', array('hierarchical' => true, 'label' => 'Sponsor Categories', 'query_var' => true, 'rewrite' => true));
	
	
	register_post_type(
		'schedule',
		array(
			'labels' => array(
				'name' => 'Schedule',
				'singular_name' => 'Schedule'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'schedule'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_taxonomy('schedule_day', 'schedule', array('hierarchical' => true, 'label' => 'Schedule Days', 'query_var' => true, 'rewrite' => true));
	
	
	register_post_type(
		'timeline',
		array(
			'labels' => array(
				'name' => 'Timeline',
				'singular_name' => 'Timeline'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'timeline'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_taxonomy('timeline_day', 'timeline', array('hierarchical' => true, 'label' => 'Timeline Days', 'query_var' => true, 'rewrite' => true));

}


/* custom portfolio posts per page */
function progression_my_post_queries( $query ) {

	
	$sponsor_count = get_theme_mod('sponsor_pagination_pro');
	
	if ($query->is_main_query()){
	
	if(is_tax( 'sponsor_type' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $sponsor_count);
    }
	
	}
	
	if(is_post_type_archive( 'sponsor' )){
      $query->set('posts_per_page', $sponsor_count);
	}
	
	
	
	if ($query->is_main_query()){
	
	if(is_tax( 'schedule_day' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 75);
    }
	
	}
	
	if(is_post_type_archive( 'schedule' )){
      $query->set('posts_per_page', 75);
	}
	
	
	
	if ($query->is_main_query()){
	
	if(is_tax( 'timeline_day' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 75);
    }
	
	}
	
	if(is_post_type_archive( 'timeline' )){
      $query->set('posts_per_page', 75);
	}

	
}
add_action( 'pre_get_posts', 'progression_my_post_queries' );



?>