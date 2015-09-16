<?php
/*
Plugin Name: Progression One Click Import
Plugin URI: http://progressionstudios.com
Description: Importing Live Preview data
Author: Progression Studios & Franklin Gitonga
Version: 1.1
Author URI: http://progressionstudios.com
*/

/**
 * Version 0.0.3
 *
 * This file is just an example you can copy it to your theme and modify it to fit your own needs.
 * Watch the paths though.
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'Radium_Theme_Demo_Data_Importer' ) ) {

	require_once( dirname( __FILE__ ) . '/importer/radium-importer.php' ); //load admin theme data importer

	class Radium_Theme_Demo_Data_Importer extends Radium_Theme_Importer {

		/**
		 * Holds a copy of the object for easy reference.
		 *
		 * @since 0.0.1
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Set name of the widgets json file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widgets_file_name       = 'widgets.json';

		/**
		 * Set name of the content file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $content_demo_file_name  = 'content.xml';
		
		/**
		 * Set name of the content file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $slider_file_name  = 'slider.zip';

		/**
		 * Holds a copy of the widget settings
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widget_import_results;

		/**
		 * Constructor. Hooks all interactions to initialize the class.
		 *
		 * @since 0.0.1
		 */
		public function __construct() {

			$this->demo_files_path = dirname(__FILE__) . '/demo-files/'; //can

			self::$instance = $this;
			parent::__construct();

		}

		/**
		 * Add menus - the menus listed here largely depend on the ones registered in the theme
		 *
		 * @since 0.0.1
		
		public function set_demo_menus(){

			// Menus to Import and assign - you can remove or add as many as you want
			$main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
					'Primary Menu' => $main_menu->term_id,
				)
			);

			$this->flag_as_imported['menus'] = true;

		} */

	}

	new Radium_Theme_Demo_Data_Importer;

}