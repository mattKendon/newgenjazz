<?php
/**
 * progression Theme Customizer
 *
 * @package progression
 */


$header_default = array(
	'width'         => 1400,
	'height'        => 550,
	'header-text'    => false,
	'default-image' => get_template_directory_uri() . '/images/page-title.jpg'
);
add_theme_support( 'custom-header', $header_default );


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function progression_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'progression_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function progression_customize_preview_js() {
	wp_enqueue_script( 'progression_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'progression_customize_preview_js' );



/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function progression_customizer( $wp_customize ) {
	
	// Adds abaillity to add text area
	if ( class_exists( 'WP_Customize_Control' ) ) { 
		# Adds textarea support to the theme customizer 
		class ProgressionTextAreaControl extends WP_Customize_Control { 
			public $type = 'textarea'; 
			public function __construct( $manager, $id, $args = array() ) { 
				$this->statuses = array( '' => __( 'Default', 'progression' ) ); 
				parent::__construct( $manager, $id, $args ); 
			}   
			
			public function render_content() { 
				echo '<label> 
				<span class="customize-control-title">' . esc_html( $this->label ) . '</span> 
				<textarea rows="5" style="width:100%;" '; $this->link(); echo '>' . esc_textarea( $this->value() ) . '</textarea> 
				</label>'; } 
			}   
		}
		
//Add Section Page of Theme Settings
    $wp_customize->add_section(
        'options_panel_progression',
        array(
            'title' => __('Theme Settings', 'progression'),
            'description' => __('Main Theme Settings', 'progression'),
            'priority' => 65,
        )
    );
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'logo_upload' ,
		array(
	        'default' => get_template_directory_uri().'/images/logo.png',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'logo_upload',
	        array(
	            'label' => __('Theme Logo', 'progression'), 
	            'section' => 'options_panel_progression',
	            'settings' => 'logo_upload',
					'priority'   => 5,
	        )
	    )
	);
	
	//Logo Width
	$wp_customize->add_setting( 
		'logo_width' ,
		array(
	        'default' => '206',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'logo_width',
   	array(
	   	'label' => __('Logo Width', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'logo_width',
			'type' => 'text',
			'priority'   => 7,
	    )
	);
	
	
	
	
	//Header Padding
	$wp_customize->add_setting( 
		'header_padding' ,
		array(
	        'default' => '26',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'header_padding',
   	array(
	   	'label' => __('Navigation Padding Top/Bottom', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'header_padding',
			'type' => 'text',
			'priority'   => 9,
	    )
	);
	
	
	//Comment Options
	$wp_customize->add_setting( 
		'fixed_nav_pro',
		array (
		'default' => '1',
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'fixed_nav_pro',
   	array(
	   	'label' => __('Set sticky/fixed navigation?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'fixed_nav_pro',
			'type' => 'checkbox',
			'priority'   => 26,
	    )
	);
	
	//Comment Options
	$wp_customize->add_setting( 
		'nav_reposition_pro',
		array (
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'nav_reposition_pro',
   	array(
	   	'label' => __('Display logo inside navigation bar?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'nav_reposition_pro',
			'type' => 'checkbox',
			'priority'   => 32,
	    )
	);

	
	//Comment Options
	$wp_customize->add_setting( 
		'comment_progression',
		array (
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'comment_progression',
   	array(
	   	'label' => __('Display comments for pages?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'comment_progression',
			'type' => 'checkbox',
			'priority'   => 34,
	    )
	);
	
	
	//Comment Options
	$wp_customize->add_setting( 
		'blog_sidebar_pro',
		array (
		'default' => '1',
		'sanitize_callback' => 'progression_sanitize_text',
		)
	);
	$wp_customize->add_control(
   'blog_sidebar_pro',
   	array(
	   	'label' => __('Display sidebar on blog?', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'blog_sidebar_pro',
			'type' => 'checkbox',
			'priority'   => 40,
	    )
	);
	




//Add Section Page of Theme Settings
    $wp_customize->add_section(
        'footer_panel_progression',
        array(
            'title' => __('Footer Settings', 'progression'),
            'description' => __('Main Theme Settings', 'progression'),
            'priority' => 68,
        )
    );
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'footer_logo_upload' ,
		array(
	        'default' => get_template_directory_uri().'/images/logo.png',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'footer_logo_upload',
	        array(
	            'label' => __('Footer Logo', 'progression'), 
	            'section' => 'footer_panel_progression',
	            'settings' => 'footer_logo_upload',
					'priority'   => 5,
	        )
	    )
	);
	
	//Logo Width
	$wp_customize->add_setting( 
		'footer_logo_width' ,
		array(
	        'default' => '206',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'footer_logo_width',
   	array(
	   	'label' => __('Footer Logo Width', 'progression'), 
			'section' => 'footer_panel_progression',
			'settings'   => 'footer_logo_width',
			'type' => 'text',
			'priority'   => 7,
	    )
	);
	
	
	
	
	
	
	// Add Copyright Text
		$wp_customize->add_setting( 
			'copyright_textbox',
			array (
			'default' => '2015 All Rights Reserved. Developed by ProgressionStudios',
			'sanitize_callback' => 'progression_sanitize_text',
			)
		);
	$wp_customize->add_control(
   'copyright_textbox',
   	array(
	   	'label' => __('Copyright Text', 'progression'), 
			'section' => 'footer_panel_progression',
			'settings'   => 'copyright_textbox',
			'type' => 'textarea',
			'priority'   => 25,
	    )
	);
	

	//Footer Column
	$wp_customize->add_setting( 
		'footer_cols' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'footer_cols',
   	array(
	   	'label' => __('Footer Widget Column Count (1-4)', 'progression'), 
			'section' => 'footer_panel_progression',
			'settings'   => 'footer_cols',
			'type' => 'text',
			'priority'   => 35,
	    )
);



//Logo Uploader
$wp_customize->add_setting( 
	'footer_bg_upload' ,
	array(
        'default' => get_template_directory_uri().'/images/footer-bg.jpg',
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'footer_bg_upload',
        array(
            'label' => __('Footer Background Image', 'progression'), 
            'section' => 'footer_panel_progression',
            'settings' => 'footer_bg_upload',
				'priority'   => 65,
        )
    )
);





//E-mail Icon
$wp_customize->add_setting( 
	'footer_mail_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'footer_mail_link_progression',
	array(
   	'label' => __('E-mail Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 80,
    )
);
//Facebook Icon
$wp_customize->add_setting( 
	'footer_facebook_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'footer_facebook_link_progression',
	array(
   	'label' => __('Facebook Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 81,
    )
);

//Twitter Icon
$wp_customize->add_setting( 
	'footer_twitter_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'footer_twitter_link_progression',
	array(
   	'label' => __('Twitter Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 82,
    )
);

//Google Plus Icon
$wp_customize->add_setting( 
	'footer_google_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'footer_google_link_progression',
	array(
   	'label' => __('Google Plus Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 83,
    )
);

//Linkedin Icon
$wp_customize->add_setting( 
	'linkedin_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'linkedin_link_progression',
	array(
   	'label' => __('LinkedIn Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 84,
    )
);

//Instagram Icon
$wp_customize->add_setting( 
	'instagram_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'instagram_link_progression',
	array(
   	'label' => __('Instagram Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 85,
    )
);

//Pinterest Icon
$wp_customize->add_setting( 
	'footer_pinterest_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'footer_pinterest_link_progression',
	array(
   	'label' => __('Pinterest Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 86,
    )
);

//Tumblr Icon
$wp_customize->add_setting( 
	'tumblr_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'tumblr_link_progression',
	array(
   	'label' => __('Tumblr Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 87,
    )
);


//YouTube Icon
$wp_customize->add_setting( 
	'youtube_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'youtube_link_progression',
	array(
   	'label' => __('YouTube Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 88,
    )
);

//DropBox Icon
$wp_customize->add_setting( 
	'dropbox_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'dropbox_link_progression',
	array(
   	'label' => __('DropBox Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 89,
    )
);

//Flickr Icon
$wp_customize->add_setting( 
	'flickr_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'flickr_link_progression',
	array(
   	'label' => __('Flickr Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 90,
    )
);


//Dribbble Icon
$wp_customize->add_setting( 
	'dribbble_link_progression',
	array(
		'sanitize_callback' => 'progression_sanitize_text',
    )
);
$wp_customize->add_control(
'dribbble_link_progression',
	array(
   	'label' => __('Dribbble Icon Link', 'progression'), 
		'section' => 'footer_panel_progression',
		'type' => 'text',
		'priority'   => 91,
    )
);




	
//Add Section Page of Background Colors
    $wp_customize->add_section(
        'progression_custom_post_types',
        array(
            'title' => __('Post Settings', 'progression'),
            'description' => 'Adjust custom post type settings here!',
            'priority' => 76,
        )
    );
	
	
	
	
	//Category Columns
	$wp_customize->add_setting( 
		'category_col_pro' ,
		array(
	        'default' => '1',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'category_col_pro',
   	array(
	   	'label' => __('Blog posts per column (1-4)', 'progression'), 
			'section' => 'progression_custom_post_types',
			'type' => 'text',
			'priority'   => 5,
	    )
	);
	
	
	//Category Columns
	$wp_customize->add_setting( 
		'schedule_col_pro' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'schedule_col_pro',
   	array(
	   	'label' => __('Schedule posts per column (1-4)', 'progression'), 
			'section' => 'progression_custom_post_types',
			'type' => 'text',
			'priority'   => 15,
	    )
	);

	
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'schedule_bg_pro' ,
		array(
	        'default' => get_template_directory_uri().'/images/page-title.jpg',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'schedule_bg_pro',
	        array(
	            'label' => __('Schedule Page Title Background', 'progression'), 
	            'section' => 'progression_custom_post_types',
	            'settings' => 'schedule_bg_pro',
					'priority'   => 20,
	        )
	    )
	);
	
	
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'timeline_bg_pro' ,
		array(
	        'default' => get_template_directory_uri().'/images/page-title.jpg',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'timeline_bg_pro',
	        array(
	            'label' => __('Timeline Page Title Background', 'progression'), 
	            'section' => 'progression_custom_post_types',
	            'settings' => 'timeline_bg_pro',
					'priority'   => 30,
	        )
	    )
	);
	
	
	
	//Category Columns
	$wp_customize->add_setting( 
		'sponsor_col_pro' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'sponsor_col_pro',
   	array(
	   	'label' => __('Sponsor posts per column (1-4)', 'progression'), 
			'section' => 'progression_custom_post_types',
			'type' => 'text',
			'priority'   => 80,
	    )
	);
	
	
	//Category Columns
	$wp_customize->add_setting( 
		'sponsor_pagination_pro' ,
		array(
	        'default' => '15',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'sponsor_pagination_pro',
   	array(
	   	'label' => __('Sponsor posts per page', 'progression'), 
			'section' => 'progression_custom_post_types',
			'type' => 'text',
			'priority'   => 82,
	    )
	);
	
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'sponsor_bg_pro' ,
		array(
	        'default' => get_template_directory_uri().'/images/page-title.jpg',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'sponsor_bg_pro',
	        array(
	            'label' => __('Sponsor Page Title Background', 'progression'), 
	            'section' => 'progression_custom_post_types',
	            'settings' => 'sponsor_bg_pro',
					'priority'   => 85,
	        )
	    )
	);
	
	
	
	
	//Category Columns
	$wp_customize->add_setting( 
		'shop_col_progression' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'shop_col_progression',
   	array(
	   	'label' => __('Shop/Tickets posts per column (2-4)', 'progression'), 
			'section' => 'progression_custom_post_types',
			'type' => 'text',
			'priority'   => 90,
	    )
	);
	
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'shop_bg_pro' ,
		array(
	        'default' => get_template_directory_uri().'/images/page-title.jpg',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'shop_bg_pro',
	        array(
	            'label' => __('Shop/Tickets Page Title Background', 'progression'), 
	            'section' => 'progression_custom_post_types',
	            'settings' => 'shop_bg_pro',
					'priority'   => 95,
	        )
	    )
	);


	//Add Section Page of Social Settings
	    $wp_customize->add_section(
	        'footer_options_progression',
	        array(
	            'title' => __('Sidebar Sharing Icons', 'progression'),
	            'description' => 'Social Icon Settings here!',
	            'priority' => 72,
	        )
	    );
		
		
		
		
		//Description
		$wp_customize->add_setting( 
			'social_description_pro',
			array (
			'default' => 'Easily customize your share description with the Shindig theme! ',
			'sanitize_callback' => 'progression_sanitize_text',
			)
		);
		$wp_customize->add_control(
	   'social_description_pro',
	   	array(
		   	'label' => __('Social Share Description', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'social_description_pro',
				'type' => 'text',
				'priority'   => 5,
		    )
		);
		
		//Logo Uploader
		$wp_customize->add_setting( 
			'share_main_image' ,
			array(
		        'default' => get_template_directory_uri().'/images/page-title.jpg',
				'sanitize_callback' => 'progression_sanitize_text',
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'share_main_image',
		        array(
		            'label' => __('Social Share Thumbnail', 'progression'), 
		            'section' => 'footer_options_progression',
		            'settings' => 'share_main_image',
						'priority'   => 6,
		        )
		    )
		);
		


		//Map Marker Icon
		$wp_customize->add_setting( 
			'location_link_progression',
			array (
			'sanitize_callback' => 'progression_sanitize_text',
			)
		);
		$wp_customize->add_control(
	   'location_link_progression',
	   	array(
		   	'label' => __('Map Icon Link', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'location_link_progression',
				'type' => 'text',
				'priority'   => 15,
		    )
		);
		//Facebook Icon
		$wp_customize->add_setting( 
			'facebook_link_progression',
			array (
			'default' => '1',
			'sanitize_callback' => 'progression_sanitize_text',
			)
		);
		$wp_customize->add_control(
	   'facebook_link_progression',
	   	array(
		   	'label' => __('Facebook Share Icon', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'facebook_link_progression',
				'type' => 'checkbox',
				'priority'   => 20,
		    )
		);
	
		//Twitter Icon
		$wp_customize->add_setting( 
			'twitter_link_progression',
			array(
				'default' => '1',
				'sanitize_callback' => 'progression_sanitize_text',
			)
		);
		$wp_customize->add_control(
	   'twitter_link_progression',
	   	array(
		   	'label' => __('Twitter Share Icon', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'twitter_link_progression',
				'type' => 'checkbox',
				'priority'   => 21,
		    )
		);
	
		//Google Plus Icon
		$wp_customize->add_setting( 
			'google_link_progression',
			array (
			'default' => '1',
			'sanitize_callback' => 'progression_sanitize_text',)
		);
		$wp_customize->add_control(
	   'google_link_progression',
	   	array(
		   	'label' => __('Google Plus Share Icon', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'google_link_progression',
				'type' => 'checkbox',
				'priority'   => 22,
		    )
		);

		//Pinterest Icon
		$wp_customize->add_setting( 
			'pinterest_link_progression',
			array (
			'sanitize_callback' => 'progression_sanitize_text',)
		);
		$wp_customize->add_control(
	   'pinterest_link_progression',
	   	array(
		   	'label' => __('Pinterest Share Icon', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'pinterest_link_progression',
				'type' => 'checkbox',
				'priority'   => 26,
		    )
		);
	
	
		//E-mail Icon
		$wp_customize->add_setting( 
			'mail_link_progression',
			array(
				'sanitize_callback' => 'progression_sanitize_text',
			)
		);
		$wp_customize->add_control(
	   'mail_link_progression',
	   	array(
		   	'label' => __('E-mail Icon', 'progression'), 
				'section' => 'footer_options_progression',
				'settings'   => 'mail_link_progression',
				'type' => 'checkbox',
				'priority'   => 33,
		    )
		);
	
	
		
	
//Add Section Page of Background Colors
    $wp_customize->add_section(
        'progression_background_colors',
        array(
            'title' => __('Background Colors', 'progression'),
            'description' => 'Adjust background colors for the theme!',
            'priority' => 77,
        )
    );
	
	
	
	$wp_customize->add_setting('header_bg_main', array(
	    'default'     => '#031a3a',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_main', array(
		'label'        => __( 'Header Background (When no background image is set)', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'header_bg_main',
		'priority'   => 4,
	)));
	
	
	
	$wp_customize->add_setting('nav_bg_main', array(
	    'default'     => '#061d3d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_main', array(
		'label'        => __( 'Navigation Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'nav_bg_main',
		'priority'   => 5,
	)));
	
	
	$wp_customize->add_setting('nav_hvr_bg', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_hvr_bg', array(
		'label'        => __( 'Navigation Hover Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'nav_hvr_bg',
		'priority'   => 5,
	)));
	
	
	

	

	

	
	$wp_customize->add_setting('pro_sub_nav_bg', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'pro_sub_nav_bg', array(
		'label'        => __( 'Sub-Navigation Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'pro_sub_nav_bg',
		'priority'   => 9,
	)));

	
	
	
	$wp_customize->add_setting('body_bg_progression', array(
	    'default'     => '#f2f2f4',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg_progression', array(
		'label'        => __( 'Body Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'body_bg_progression',
		'priority'   => 15,
	)));
	
	$wp_customize->add_setting('timeline_bg_color_pro', array(
	    'default'     => '#061d3d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'timeline_bg_color_pro', array(
		'label'        => __( 'Timeline Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'timeline_bg_color_pro',
		'priority'   => 16,
	)));
	
	
	
	$wp_customize->add_setting('sidebar_bg_progression', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sidebar_bg_progression', array(
		'label'        => __( 'Sidebar Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'sidebar_bg_progression',
		'priority'   => 17,
	)));
	
	$wp_customize->add_setting('sidebar_header_border_progression', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sidebar_header_border_progression', array(
		'label'        => __( 'Sidebar Heading Border Bottom', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'sidebar_header_border_progression',
		'priority'   => 17,
	)));
	
	
	$wp_customize->add_setting('container_bg_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'container_bg_pro', array(
		'label'        => __( 'Container Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'container_bg_pro',
		'priority'   => 18,
	)));
	

	
	
	$wp_customize->add_setting('footer_bg_progression', array(
	    'default'     => '#061d3d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_progression', array(
		'label'        => __( 'Footer Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'footer_bg_progression',
		'priority'   => 20,
	)));
	
	



	$wp_customize->add_setting('button_bg_progression', array(
	    'default'     => '#26afd1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg_progression', array(
		'label'        => __( 'Button Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'button_bg_progression',
		'priority'   => 45,
	)));
	


	$wp_customize->add_setting('button_hover_bg_progression', array(
	    'default'     => '#2399b6',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg_progression', array(
		'label'        => __( 'Button Hover Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'button_hover_bg_progression',
		'priority'   => 50,
	)));
	
	
	
	
	
	$wp_customize->add_setting('second_button_bg_progression', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'second_button_bg_progression', array(
		'label'        => __( 'Secondary Button Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'second_button_bg_progression',
		'priority'   => 65,
	)));
	
	
	$wp_customize->add_setting('second_border_bg_progression', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'second_border_bg_progression', array(
		'label'        => __( 'Secondary Button Border Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'second_border_bg_progression',
		'priority'   => 66,
	)));
	
	
	$wp_customize->add_setting('second_hover_bg_progression', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'second_hover_bg_progression', array(
		'label'        => __( 'Secondary Hover Button Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'second_hover_bg_progression',
		'priority'   => 68,
	)));
	
	
	$wp_customize->add_setting('schedule_nav_bg_pro', array(
	    'default'     => '#0d2a53',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'schedule_nav_bg_pro', array(
		'label'        => __( 'Schedule Navigation Button Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'schedule_nav_bg_pro',
		'priority'   => 70,
	)));
	
	
	$wp_customize->add_setting('schedule_nav_hvr_bg_pro', array(
	    'default'     => '#1fa1c9',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'schedule_nav_hvr_bg_pro', array(
		'label'        => __( 'Schedule Navigation Button Hover', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'schedule_nav_hvr_bg_pro',
		'priority'   => 72,
	)));
	
	

//Add Section Page of Background Colors
    $wp_customize->add_section(
        'progression_font_colors',
        array(
            'title' => __('Font Colors', 'progression'),
            'description' => 'Adjust font colors for the theme!',
            'priority' => 79,
        )
    );
	
	

	
	$wp_customize->add_setting('body_font_progression', array(
	    'default'     => '#535353',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_font_progression', array(
		'label'        => __( 'Body Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_font_progression',
		'priority'   => 4,
	)));
	
	
	$wp_customize->add_setting('page_font_progression', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_font_progression', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'page_font_progression',
		'priority'   => 6,
	)));
	

	
	$wp_customize->add_setting('body_link_progression', array(
	    'default'     => '#26afd1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_link_progression', array(
		'label'        => __( 'Main Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_link_progression',
		'priority'   => 8,
	)));
	
	
	$wp_customize->add_setting('body_link_hover_progression', array(
	    'default'     => '#26afd1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_link_hover_progression', array(
		'label'        => __( 'Main Hover Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_link_hover_progression',
		'priority'   => 10,
	)));
	
	$wp_customize->add_setting('navigation_menu_color', array(
	    'default'     => '#e1e4e7',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_menu_color', array(
		'label'        => __( 'Navigation Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'navigation_menu_color',
		'priority'   => 12,
	)));
	
	
	$wp_customize->add_setting('navigation_hvr_menu_color', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_hvr_menu_color', array(
		'label'        => __( 'Navigation Hover Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'navigation_hvr_menu_color',
		'priority'   => 13,
	)));
	

	
	
	$wp_customize->add_setting('sub_font_color', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sub_font_color', array(
		'label'        => __( 'Sub-Navigation Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'sub_font_color',
		'priority'   => 14,
	)));
	
	
	$wp_customize->add_setting('sub_hover_font_color', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sub_hover_font_color', array(
		'label'        => __( 'Sub-Navigation Hover Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'sub_hover_font_color',
		'priority'   => 15,
	)));
	
	
	
	
	$wp_customize->add_setting('heading_font_progression', array(
	    'default'     => '#061d3d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_font_progression', array(
		'label'        => __( 'Heading Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'heading_font_progression',
		'priority'   => 22,
	)));
	
	



	$wp_customize->add_setting('button_font_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_font_pro', array(
		'label'        => __( 'Button Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'button_font_pro',
		'priority'   => 25,
	)));
	
	
	$wp_customize->add_setting('button_hover_font_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_font_pro', array(
		'label'        => __( 'Button Hover Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'button_hover_font_pro',
		'priority'   => 26,
	)));
	
	
	$wp_customize->add_setting('secondary_button_font_pro', array(
	    'default'     => '#29b0d1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_button_font_pro', array(
		'label'        => __( 'Secondary Button Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'secondary_button_font_pro',
		'priority'   => 30,
	)));
	
	$wp_customize->add_setting('secondary_nhvrbutton_font_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_nhvrbutton_font_pro', array(
		'label'        => __( 'Secondary Button Hover Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'secondary_nhvrbutton_font_pro',
		'priority'   => 32,
	)));
	
	$wp_customize->add_setting('footer_font_color_pro', array(
	    'default'     => '#949da8',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_font_color_pro', array(
		'label'        => __( 'Footer Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'footer_font_color_pro',
		'priority'   => 50,
	)));
	
	$wp_customize->add_setting('footer_hovr_font_color_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_hovr_font_color_pro', array(
		'label'        => __( 'Footer Heading Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'footer_hovr_font_color_pro',
		'priority'   => 50,
	)));
	
	
	$wp_customize->add_setting('footer_social_icon_clr', array(
	    'default'     => '#1fa1c9',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_social_icon_clr', array(
		'label'        => __( 'Footer Social Icon Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'footer_social_icon_clr',
		'priority'   => 65,
	)));
	
	
}
add_action( 'customize_register', 'progression_customizer' );


function progression_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function progression_customize_css()
{
    ?>
<style type="text/css">
	body #logo, body #logo img {width:<?php echo get_theme_mod('logo_width', '180'); ?>px;}
	body #logo-footer, body #logo-footer img {width:<?php echo get_theme_mod('footer_logo_width', '180'); ?>px;}
	.sf-menu a { padding-top:<?php echo get_theme_mod('header_padding', '26'); ?>px; padding-bottom:<?php echo get_theme_mod('header_padding', '26'); ?>px; }
	nav { background-color:<?php echo get_theme_mod('nav_bg_main', '#061d3d'); ?>; }
	#gradient-header-pro, #gradient-mobile-pro { background-image: linear-gradient(<?php echo get_theme_mod('nav_bg_main', '#061d3d'); ?>, transparent); }
	header { background-color:<?php echo get_theme_mod('header_bg_main', '#031a3a'); ?>; }
	#main {background:<?php echo get_theme_mod('body_bg_progression', '#f2f2f4'); ?>;}
	.sidebar-item {background:<?php echo get_theme_mod('sidebar_bg_progression', '#ffffff'); ?>;}
	#sidebar h5 { border-bottom:2px solid <?php echo get_theme_mod('sidebar_header_border_progression', '#29b0d1'); ?>; }
	#content-container-pro, .container-blog, #post-nav-progression, body #main .gallery-caption, body .homepage-widget-blog .gallery-caption, .image-navigation. .container-sponsor, .woocommerce-container-pro, .container-single-pro, body #main  .woocommerce-tabs .tabs li, .single-container-reviews-pro { background:<?php echo get_theme_mod('container_bg_pro', '#ffffff'); ?>; }
	.sf-menu ul { background:<?php echo get_theme_mod('pro_sub_nav_bg', '#29b0d1'); ?>; }
	body #taxonomy_navigation_pro a, body #taxonomy_navigation_pro ul { background:<?php echo get_theme_mod('schedule_nav_bg_pro', '#0d2a53'); ?>; }
	body #taxonomy_navigation_pro .current-cat a, body #taxonomy_navigation_pro a:hover { background:<?php echo get_theme_mod('schedule_nav_hvr_bg_pro', '#1fa1c9'); ?>; }
	.sf-menu a {color:<?php echo get_theme_mod('navigation_menu_color', '#e1e4e7'); ?>; }
	.sf-menu li.current-menu-item a { border-top:2px solid <?php echo get_theme_mod('nav_hvr_bg', '#29b0d1'); ?>; }
	.sf-menu li.current-menu-item a:hover,
	.sf-menu a:hover, .sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, 
	.sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited {
		color:<?php echo get_theme_mod('navigation_hvr_menu_color', '#ffffff'); ?>;
		background:<?php echo get_theme_mod('nav_hvr_bg', '#29b0d1'); ?>;
		border-color:<?php echo get_theme_mod('nav_hvr_bg', '#29b0d1'); ?>;
	}
	body, footer {background:<?php echo get_theme_mod('footer_bg_progression', '#061d3d'); ?>;}
	#footer-gradient-header-pro { background-image: linear-gradient(<?php echo get_theme_mod('footer_bg_progression', '#061d3d'); ?>, transparent); }
	body.post-type-archive-timeline #main, body.tax-timeline_day #main { background:<?php echo get_theme_mod('timeline_bg_color_pro', '#061d3d'); ?>; }
	body, .woocommerce-container-pro a, .woocommerce-container-pro a:hover { color:<?php echo get_theme_mod('body_font_progression', '#535353'); ?>; }
	#page-title h1 { color:<?php echo get_theme_mod('page_font_progression', '#ffffff'); ?>; border:2px solid <?php echo get_theme_mod('page_font_progression', '#ffffff'); ?>; }
	a, .comments-pro-blog, body #main ul li.product .amount, body #main .entry-summary .amount, .star-rating, body .main-text-widgetpro ul li.product .amount, body .main-text-widgetpro .entry-summary .amount { color:<?php echo get_theme_mod('body_link_progression', '#26afd1'); ?>; }
	a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover { color:<?php echo get_theme_mod('body_link_hover_progression', '#26afd1'); ?>; }
	.sf-menu li.sfHover li a, .sf-menu li.sfHover li a:visited, .sf-menu li.sfHover li li a, .sf-menu li.sfHover li li a:visited, .sf-menu li.sfHover li li li a, .sf-menu li.sfHover li li li a:visited, .sf-menu li.sfHover li li li li a, .sf-menu li.sfHover li li li li a:visited{ color:<?php echo get_theme_mod('sub_font_color', '#ffffff'); ?>; }
	.sf-menu li li:hover, .sf-menu li li.sfHover, .sf-menu li li a:focus, .sf-menu li li a:hover, .sf-menu li li a:active, .sf-menu li li.sfHover a, .sf-menu li.sfHover li a:visited:hover, .sf-menu li li:hover a:visited,
	.sf-menu li li li:hover, .sf-menu li li li.sfHover, .sf-menu li li li a:focus, .sf-menu li li li a:hover, .sf-menu li li li a:active, .sf-menu li li li.sfHover a, .sf-menu li li.sfHover li a:visited:hover, .sf-menu li li li:hover a:visited,
	.sf-menu li li li li:hover, .sf-menu li li li li.sfHover, .sf-menu li li li li a:focus, .sf-menu li li li li a:hover, .sf-menu li li li li a:active, .sf-menu li li li li.sfHover a, .sf-menu li li li.sfHover li a:visited:hover, .sf-menu li li li li:hover a:visited,
	.sf-menu li li li li li:hover, .sf-menu li li li li li.sfHover, .sf-menu li li li li li a:focus, .sf-menu li li li li li a:hover, .sf-menu li li li li li a:active, .sf-menu li li li li li.sfHover a, .sf-menu li li li li.sfHover li a:visited:hover, .sf-menu li li li li li:hover a:visited  { color:<?php echo get_theme_mod('sub_hover_font_color', '#ffffff'); ?>; }
	h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .gallery-caption, body #main h3.product-title-index-pro a, .summary-text-pro, body .homepage-widget-blog h3.product-title-index-pro a {	color:<?php echo get_theme_mod('heading_font_progression', '#061d3d'); ?>; }
	footer .social-ico a i {color:<?php echo get_theme_mod('footer_social_icon_clr', '#1fa1c9'); ?>; }
	footer { color:<?php echo get_theme_mod('footer_font_color_pro', '#949da8'); ?>; }
	footer h5 { color:<?php echo get_theme_mod('footer_hovr_font_color_pro', '#ffffff'); ?>; }
	/* Default Button */
	body #main input.wpcf7-submit, body a.ls-sc-button.default,
	a.progression-button, a.more-link, body input#submit {
		background:<?php echo get_theme_mod('button_bg_progression', '#26afd1'); ?>;
		color:<?php echo get_theme_mod('button_font_pro', '#ffffff'); ?>;
	}
	body a.ls-sc-button.default span { color:<?php echo get_theme_mod('button_font_pro', '#ffffff'); ?>;  }
	body #main input.wpcf7-submit:hover,   body a.ls-sc-button.default:hover,
	a.progression-button:hover, a.more-link:hover, body input#submit:hover {
		background:<?php echo get_theme_mod('button_hover_bg_progression', '#2399b6'); ?>;
		color:<?php echo get_theme_mod('button_hover_font_pro', '#ffffff'); ?>;
	}
	body a.ls-sc-button.default:hover span { color:<?php echo get_theme_mod('button_hover_font_pro', '#ffffff'); ?>; }
	.pro-button-right a {
		background:<?php echo get_theme_mod('button_bg_progression', '#26afd1'); ?>;
		border:2px solid <?php echo get_theme_mod('button_bg_progression', '#26afd1'); ?>;
		color:<?php echo get_theme_mod('button_hover_font_pro', '#ffffff'); ?>;
	}
	.pro-button-right a:hover {
		border-color:<?php echo get_theme_mod('button_hover_bg_progression', '#2399b6'); ?>;
		background:<?php echo get_theme_mod('button_hover_bg_progression', '#2399b6'); ?>;
		color:<?php echo get_theme_mod('button_hover_font_pro', '#ffffff'); ?>;
	}
	/* Second Button */
	ul.post-categories li a, body .homepage-widget-blog button.single_add_to_cart_button, body .homepage-widget-blog input.button, body.woocommerce-cart .homepage-widget-blog td.actions  input.button.checkout-button, 
	body .homepage-widget-blog button.button, body .homepage-widget-blog a.button, body #single-product-pro button.single_add_to_cart_button,
	input#submit-pro, body #main button.single_add_to_cart_button, body #main input.button, body.woocommerce-cart #main td.actions  input.button.checkout-button, 
	body #main button.button, body #main a.button, body #single-product-pro button.single_add_to_cart_button {
		background:<?php echo get_theme_mod('second_button_bg_progression', '#ffffff'); ?>;
		border:2px solid <?php echo get_theme_mod('second_border_bg_progression', '#29b0d1'); ?>;
		color:<?php echo get_theme_mod('secondary_button_font_pro', '#29b0d1'); ?>;
	}
	ul.post-categories li a:hover, body .homepage-widget-blog button.single_add_to_cart_button:hover, body .homepage-widget-blog input.button:hover, body.woocommerce-cart .homepage-widget-blog td.actions  input.button.checkout-button:hover, 
	body .homepage-widget-blog button.button:hover, body .homepage-widget-blog a.button:hover, body #single-product-pro button.single_add_to_cart_button:hover
	input#submit-pro:hover, body #main button.single_add_to_cart_button:hover, body #main input.button:hover, body.woocommerce-cart #main td.actions  input.button.checkout-button:hover, 
	body #main button.button:hover, body #main a.button:hover, body #single-product-pro button.single_add_to_cart_button:hover {
		background:<?php echo get_theme_mod('second_hover_bg_progression', '#29b0d1'); ?>;
		border-color:<?php echo get_theme_mod('second_hover_bg_progression', '#29b0d1'); ?>;
		color:<?php echo get_theme_mod('secondary_nhvrbutton_font_pro', '#ffffff'); ?>;
	}
	<?php if (get_theme_mod( 'comment_progression')) : ?><?php else: ?>body.page #comments {display:none;}<?php endif ?>
</style>
    <?php
}
add_action('wp_head', 'progression_customize_css');

