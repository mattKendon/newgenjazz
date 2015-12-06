<?php
/**
 * @author Matthew Kendon <matt@outlandish.com>
 */

/**
 * Enqueue the theme styles
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [$parent_style]
    );
}

require( get_stylesheet_directory() . '/widgets/widgets.php' );