<?php
function add_custom_meta_boxes() {
    $meta_box = array(
        'id'         => 'progression_page_settings', // Meta box ID
        'title'      => __('Page Settings', 'progression'), // Meta box title
        'pages'      => array('page'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_slider',
                'name' => __('Homepage Slider: Insert Slider Shortcode', 'progression'),
                'desc' => __('<br>Copy/paste in your slider shortcode.', 'progression'),
                'type' => 'text',
                'std' => ''
			),
            array(
                'id' => 'progression_map',
                'name' => __('Map Shortcode', 'progression'),
                'desc' => __('<br>Add-in your map shortcode to display a large map.', 'progression'),
                'type' => 'text',
                'std' => ''
			)
        )
    );
    dev7_add_meta_box( $meta_box );

	
    $meta_box2 = array(
        'id'         => 'progression_post_settings', // Meta box ID
        'title'      => __('Post Settings', 'progression'), // Meta box title
        'pages'      => array('post'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_media_embed',
                'name' => __('Audio/Video Embed', 'progression'),
                'desc' => __('<br>Paste in your video embed code here', 'progression'),
                'type' => 'textarea',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box2 );
	
	
	
    $meta_box3 = array(
        'id'         => 'progression_schedule_settings', // Meta box ID
        'title'      => __('Schedule Settings', 'progression'), // Meta box title
        'pages'      => array('schedule'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_schedule',
                'name' => __('Schedule Sub-Title', 'progression'),
                'desc' => __('<br>Add-in a sub-title for the schedule (Ex: 3- 3:30pm)', 'progression'),
                'type' => 'text',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box3 );
	
	
    $meta_box4 = array(
        'id'         => 'progression_sponsor_settings', // Meta box ID
        'title'      => __('Sponsor Settings', 'progression'), // Meta box title
        'pages'      => array('sponsor'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box4 );
	
	
	
    $meta_box5 = array(
        'id'         => 'progression_timeline_settings', // Meta box ID
        'title'      => __('Timeline Settings', 'progression'), // Meta box title
        'pages'      => array('timeline'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_timeline_title',
                'name' => __('Timeline Sub-Title', 'progression'),
                'desc' => __('<br>Add-in a sub-title for the schedule (Ex: 3- 3:30pm)', 'progression'),
                'type' => 'text',
                'std' => ''
            ),
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Make your post link to another page', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box5 );
	
    $meta_box6 = array(
        'id'         => 'progression_shop_settings', // Meta box ID
        'title'      => __('Custom Settings', 'progression'), // Meta box title
        'pages'      => array('product'), // Post types this meta box should be shown on
        'context'    => 'normal', // Meta box context
        'priority'   => 'high', // Meta box priority
        'fields' => array(
            array(
                'id' => 'progression_external_link',
                'name' => __('External Link', 'progression'),
                'desc' => __('<br>Link to another website like ticketmaster.', 'progression'),
                'type' => 'text',
                'std' => ''
            )
        )
    );
    dev7_add_meta_box( $meta_box6 );
	
}
add_action( 'dev7_meta_boxes', 'add_custom_meta_boxes' );
?>