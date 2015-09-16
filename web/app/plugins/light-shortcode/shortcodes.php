<?php

/**
* Plugin constants
*/
function ls_shortcodes_init() {
	define ( 'LS_SHORTCODES_PLUGIN_URL',WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'' );
	define ( 'LS_SHORTCODES_PLUGIN_DIR',WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)).'' );
}
add_action( 'init', 'ls_shortcodes_init' );

/**
* Add the stylesheet
*/
function ls_shortcodes_stylesheet() {
    $gpp_shortcodes_style = LS_SHORTCODES_PLUGIN_URL . '/includes/frontend/ls-shortcodes.css';
    $gpp_shortcodes_file = LS_SHORTCODES_PLUGIN_DIR . '/includes/frontend/ls-shortcodes.css';
    if ( file_exists($gpp_shortcodes_file) ) {
        wp_register_style( 'gpp_shortcodes', $gpp_shortcodes_style );
        wp_enqueue_style( 'gpp_shortcodes');
   }

	// Register scripts
	wp_register_script( 'ls_sc_scripts', plugin_dir_url( __FILE__ ) . 'includes/frontend/ls_sc_scripts.js', array ( 'jquery', 'jquery-ui-accordion'), '1.0.3', true );
	wp_register_script( 'gpp_sc_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), '1.0.3', true );

	// Enque scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'ls_sc_scripts' );
	wp_enqueue_script( 'gpp_sc_googlemap_api' );
}
add_action( 'wp_enqueue_scripts', 'ls_shortcodes_stylesheet' );


/**
* Don't auto-p wrap shortcodes that stand alone
*/
function ls_base_unautop() {
	add_filter( 'the_content', 'shortcode_unautop' );
}
add_action( 'init', 'ls_base_unautop' );


function copter_remove_crappy_markup( $string )
{
    $patterns = array(
        '#^\s*</p>#',
        '#<p>\s*$#'
    );

    return preg_replace($patterns, '', $string);
}



/**
* Add the shortcodes
*/
function ls_shortcodes() {

	add_filter( 'the_content', 'shortcode_unautop' );
	
	add_shortcode( 'one_third_first', 'ls_base_grid_4_first' );
	add_shortcode( 'one_third', 'ls_base_grid_4' );
	add_shortcode( 'one_third_last', 'ls_base_grid_4_last' );

	add_shortcode( 'two_thirds_first', 'ls_base_grid_8_first' );
	add_shortcode( 'two_thirds', 'ls_base_grid_8' );
	add_shortcode( 'two_thirds_last', 'ls_base_grid_8_last' );

	add_shortcode( 'one_half_first', 'ls_base_grid_6_first' );
	add_shortcode( 'one_half', 'ls_base_grid_6' );
	add_shortcode( 'one_half_last', 'ls_base_grid_6_last' );

	add_shortcode( 'one_fourth_first', 'ls_base_grid_3_first' );
	add_shortcode( 'one_fourth', 'ls_base_grid_3' );
	add_shortcode( 'one_fourth_last', 'ls_base_grid_3_last' );

	add_shortcode( 'three_fourths_first', 'ls_base_grid_9_first' );
	add_shortcode( 'three_fourths', 'ls_base_grid_9' );
	add_shortcode( 'three_fourths_last', 'ls_base_grid_9_last' );

	add_shortcode( 'one_sixth_first', 'ls_base_grid_2_first' );
	add_shortcode( 'one_sixth', 'ls_base_grid_2' );
	add_shortcode( 'one_sixth_last', 'ls_base_grid_2_last' );

	add_shortcode( 'five_sixth_first', 'ls_base_grid_10_first' );
	add_shortcode( 'five_sixth', 'ls_base_grid_10' );
	add_shortcode( 'five_sixth_last', 'ls_base_grid_10_last' );
	
	add_shortcode( 'ls_button', 'ls_button_shortcode');
	add_shortcode( 'ls_icon', 'ls_icon_shortcode' );
	add_shortcode( 'ls_box', 'ls_box_shortcode' );
	add_shortcode( 'ls_highlight', 'ls_highlight_shortcode' );
	add_shortcode( 'ls_divider', 'ls_divider_shortcode' );
	add_shortcode( 'ls_toggle', 'ls_toggle_shortcode' );
	add_shortcode( 'ls_googlemap', 'ls_shortcode_googlemaps' );
	add_shortcode( 'ls_accordion', 'ls_accordion_main_shortcode' );
	add_shortcode( 'ls_accordion_section', 'ls_accordion_section_shortcode' );
	add_shortcode( 'ls_pricing', 'ls_pricing_shortcode' );
	add_shortcode( 'ls_tabgroup', 'ls_tabgroup_shortcode' );
	add_shortcode( 'ls_tab', 'ls_tab_shortcode' );

	// Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
	@ini_set( 'pcre.backtrack_limit', 500000 );
}
add_action( 'wp_head', 'ls_shortcodes' );


/**
 * Columns Shortcodes
 */

function ls_base_grid_4_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_4 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_4( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_4">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_4_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_4 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_8_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_8 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_8( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_8">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_8_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_8 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_6_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_6 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_6( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_6">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_6_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_6 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_3_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_3 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_3( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_3">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_3_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_3 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_9_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_9 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_9( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_9">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_9_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_9 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_2_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_2 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_2( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_2">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_2_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_2 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

function ls_base_grid_10_first( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_10 alpha">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_10( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_10">' . do_shortcode($clean) . '</div>';
}

function ls_base_grid_10_last( $atts, $content = null ) {
	$clean = copter_remove_crappy_markup($content);
   return '<div class="ls-sc-grid_10 omega">' . do_shortcode($clean) . '</div><div class="clear"></div>';
}

/**
 * Buttons
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_button_shortcode' ) ) {
	function ls_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => 'blue',
			'url' => '#',
			'title' => '',
			'target' => '_self',
			'rel' => '',
			'class' => '',
			'icon_left' => '',
			'icon_right' => '',
			'size' => '',
			'display' => ''
		), $atts ) );

		$rel = ( $rel ) ? 'rel="' . $rel . '"' : NULL;

		$button = NULL;
		$button .= '<a href="' . $url . '" class="ls-sc-button ' . $color . ' ' . $class . ' ' . $size . ' ' . $display . '" target="' . $target . '" title="' . $title . '" rel="' . $rel . '">';
			$button .= '<span class="ls-sc-button-inner">';
				if ( $icon_left ) $button .= '<i class="ls-sc-button-icon-left fa '. $icon_left .'"></i>';
				$button .= $content;
				if ( $icon_right ) $button .= '<i class="ls-sc-button-icon-right fa '. $icon_right .'"></i>';
			$button .= '</span>';
		$button .= '</a>';
		return $button;
	}
}

/**
 * Icons
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_icon_shortcode' ) ) {
	function ls_icon_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => 'twitter',
			"size"   => '32px',
			"color"  => ''
	   ), $atts));

		return '<i class="fa ' . $type . '" style="color:' . $color . ';font-size:' . $size . ';"></i>';

	}
}

/**
 * Alert Boxes
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_box_shortcode' ) ) {
	function ls_box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => 'black',
			'float' => 'left',
			'text_align' => 'center',
			'width' => '100%',
			'margin_top' => '',
			'margin_bottom' => '',
			'class' => '',
		  ), $atts ) );

			$style_attr = '';
			if ( $margin_bottom ) {
				$style_attr .= 'margin-bottom: '. $margin_bottom .';';
			}
			if ( $margin_top ) {
				$style_attr .= 'margin-top: '. $margin_top .';';
			}

		  $alert_content = '';
		  $alert_content .= '<div class="ls-sc-box ' . $color . ' align' . $float . ' ' . $class . '" style="text-align:' . $text_align . '; width:' . $width . ';' . $style_attr . '">';
		  $alert_content .= ' '. do_shortcode($content) .'</div>';
		  return $alert_content;
	}
}

/**
 * Highlights
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_highlight_shortcode' ) ) {
	function ls_highlight_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color'	=> 'yellow',
			'class'	=> '',
		  ),
		  $atts ) );
		  return '<span class="ls-sc-highlight ' . $color . ' ' . $class . '">' . do_shortcode( $content ) . '</span>';

	}
}

/**
 * Divider
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_divider_shortcode' ) ) {
	function ls_divider_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'type' => 'solid',
			'color' => 'gray',
			'margin_top' => '20px',
			'margin_bottom' => '20px',
			'class' => '',
		),
		  $atts ) );
		$style_attr = '';
		if ( $margin_top && $margin_bottom ) {
			$style_attr = 'style="margin-top: ' . $margin_top . ';margin-bottom: ' . $margin_bottom . ';"';
		} elseif ( $margin_bottom ) {
			$style_attr = 'style="margin-bottom: ' . $margin_bottom . ';"';
		} elseif ( $margin_top ) {
			$style_attr = 'style="margin-top: ' . $margin_top . ';"';
		} else {
			$style_attr = NULL;
		}
	 return '<hr class="ls-sc-divider ' . $type . ' ' . $color . ' ' . $class . '" ' . $style_attr . ' />';
	}
}

/**
 * Toggle
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_toggle_shortcode' ) ) {
	function ls_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => 'Toggle Title',
			'class' => '',
		), $atts ) );

		return '<div class="ls-sc-toggle ' . $class . '"><h3 class="ls-sc-toggle-trigger">' . $title . '</h3><div class="ls-sc-toggle-container">' . do_shortcode($content) . '</div></div>';
	}

}

/**
 * Accordion
 * @since 1.1
 *
 */

// Main
if ( !function_exists( 'ls_accordion_main_shortcode' ) ) {
	function ls_accordion_main_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'class'	=> ''
		), $atts ) );

		// Display the accordion
		return '<div class="ls-sc-accordion ' . $class . '">' . do_shortcode($content) . '</div>';
	}
}

// Section
if ( !function_exists( 'ls_accordion_section_shortcode' ) ) {
	function ls_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'title'	=> 'Title',
			'class'	=> '',
		), $atts ) );

	   return '<h3 class="ls-sc-accordion-trigger ' . $class . '"><a href="#">' . $title . '</a></h3><div>' . do_shortcode($content) . '</div>';
	}

}

/**
 * Tabs
 * @since 1.1
 *
 */
if ( !function_exists( 'ls_tabgroup_shortcode' ) ) {
	function ls_tabgroup_shortcode( $atts, $content = null ) {

		// Display Tabs
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
		    $output .= '<div id="ls-sc-tab-'. rand(1, 100) .'" class="ls-sc-tabs">';
			$output .= '<ul class="ui-tabs-nav ls-sc-clearfix">';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#ls-sc-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}
}
if ( !function_exists( 'ls_tab_shortcode' ) ) {
	function ls_tab_shortcode( $atts, $content = null ) {
		$defaults = array(
			'title'	=> 'Tab Title',
			'class'	=> ''
		);
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="ls-sc-tab-' . sanitize_title( $title ) . '" class="tab-content ' . $class . '">' . do_shortcode( $content ) .'</div>';
	}

}


/**
 * Google Maps
 * @since 1.1
 */

if ( ! function_exists( 'ls_shortcode_googlemaps' ) ) {
	function ls_shortcode_googlemaps( $atts, $content = null ) {

		extract(shortcode_atts(array(
				'title'		=> '',
				'location'	=> '',
				'width'		=> '',
				'height'	=> '300',
				'zoom'		=> 8,
				'align'		=> '',
				'class'		=> ''
		), $atts));


		$output = '<div class="google-maps-expand"><div id="map_canvas_' . rand(1, 100) . '" class="googlemap ' . $class . '" style="height:' . $height . 'px;width:100%">';
			$output .= ( !empty($title) ) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
			$output .= '<input class="location" type="hidden" value="' . $location . '" />';
			$output .= '<input class="zoom" type="hidden" value="' . $zoom . '" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div></div>';

		return $output;

	}
}

/**
 * Pricing Table
 * @since 1.1
 *
 */

if ( !function_exists( 'ls_pricing_shortcode' ) ) {
	function ls_pricing_shortcode( $atts, $content = null  ) {

		extract( shortcode_atts( array(
			'color' => 'black',
			'position' => '',
			'featured' => 'no',
			'plan' => 'Basic',
			'cost' => '$20',
			'per' => 'month',
			'button_url' => '',
			'button_text' => 'Sign up',
			'button_color' => 'green',
			'button_target' => 'self',
			'button_rel' => 'nofollow',
			'class' => '',
		), $atts ) );

		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;

		//start content
		$pricing_content ='';
		$pricing_content .= '<div class="ls-sc-pricing-table ' . $class . '">';
		$pricing_content .= '<div class="ls-sc-pricing ' . $featured_pricing . ' gpp-sc-column-' . $position . ' ' . $class . '">';
			$pricing_content .= '<div class="ls-sc-pricing-header '. $color .'">';
				$pricing_content .= '<h5>' . $plan . '</h5>';
				$pricing_content .= '<div class="ls-sc-pricing-cost">' . $cost . '</div><div class="ls-sc-pricing-per">' . $per . '</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="ls-sc-pricing-content">';
				$pricing_content .= '' . $content . '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="ls-sc-pricing-button"><a href="' . $button_url . '" class="ls-sc-button ' . $button_color . '" target="_' . $button_target . '" rel="' . $button_rel . '"><span class="ls-sc-button-inner">' . $button_text . '</span></a></div>';
			}
		$pricing_content .= '</div>';
		$pricing_content .= '</div><div class="ls-sc-clear-floats"></div>';
		return $pricing_content;
	}

}
?>