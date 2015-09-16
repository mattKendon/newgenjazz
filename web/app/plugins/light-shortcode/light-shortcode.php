<?php
/*
Plugin Name: Light Shortcode
Plugin URI: http://progressionstudios.com/light-shortcode
Description: Kick-ass tinyMCE WordPress shortcodes: Button, Icon, Box, Highlight, Divider, Toggle, Google Map, Accordion, Pricing Table, Tabs, and Grid.
Author: Progression Studios + Kharis Sulistiyono
Version: 1.1
Author URI: http://progressionstudios.com/
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Add a button for shortcodes to the WP editor.
 *
 * @access public
 * @return void
 */
function ls_add_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;
	if ( get_user_option('rich_editing') == 'true') :
		add_filter('mce_external_plugins', 'ls_add_shortcode_tinymce_plugin');
		add_filter('mce_buttons', 'ls_register_shortcode_button');
	endif;
	
	// Admin style
	
	if(is_admin()) {
		wp_enqueue_style( 'light-shortcodes-admin', plugin_dir_url( __FILE__ ) . 'includes/admin/light-shortcodes-admin.css' );
		 //wp_enqueue_script( 'light-shortcodes-admin-js',  plugin_dir_url( __FILE__ ) . 'includes/admin/editor_plugin.js', false, '', false );
	}
		
}

add_action( 'init', 'ls_add_shortcode_button' );



/**
 * ls_add_tinymce_lang function.
 *
 * @access public
 * @param mixed $arr
 * @return void
 */
function ls_add_tinymce_lang( $arr ) {
    $arr['LightShortcodes'] = plugin_dir_path( __FILE__ ) . 'editor_plugin_lang.php';
    return $arr;
}

add_filter( 'mce_external_languages', 'ls_add_tinymce_lang', 10, 1 );





/**
 * Register the shortcode button.
 *
 * @access public
 * @param mixed $buttons
 * @return array
 */
function ls_register_shortcode_button($buttons) {
	array_push($buttons, "|", "ls_shortcodes_button");
	return $buttons;
}





/**
 * Add the shortcode button to TinyMCE
 *
 * @access public
 * @param mixed $plugin_array
 * @return array
 */
function ls_add_shortcode_tinymce_plugin($plugin_array) {
	$plugin_array['LightShortcodes'] = plugin_dir_url( __FILE__ ) . 'includes/admin/editor_plugin.js';
	return $plugin_array;
}




/**
 * Force TinyMCE to refresh.
 *
 * @access public
 * @param mixed $ver
 * @return int
 */
function ls_refresh_mce( $ver ) {
	$ver += 3;
	return $ver;
}

add_filter( 'tiny_mce_version', 'ls_refresh_mce' );



/**
 * Shortcodes
 *
 * @access public
 * @param mixed $ver
 * @return int
 */



include('shortcodes.php'); 
 

?>