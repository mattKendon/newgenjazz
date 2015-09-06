<?php
add_action('widgets_init', 'pyre_homepage_map_feat_load_widgets');

function pyre_homepage_map_feat_load_widgets()
{
	register_widget('Pyre_Latest_Map_Featured_Media_Widget');
}

class Pyre_Latest_Map_Featured_Media_Widget extends WP_Widget {
	
	function Pyre_Latest_Map_Featured_Media_Widget()
	{
		$widget_ops = array('classname' => 'pyre_homepage_media-map-feat', 'description' => 'Map Highlight Widget');

		$control_ops = array('id_base' => 'pyre_homepage_media-widget-map-feat');
		
        add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
		
		
		parent::__construct('pyre_homepage_media-widget-map-feat', 'Home: Map Widget', $widget_ops, $control_ops);
	}
	
    function my_custom_load() {    
           wp_enqueue_style( 'wp-color-picker' );        
           wp_enqueue_script( 'wp-color-picker' );    
		   if(function_exists( 'wp_enqueue_media' )){
		       wp_enqueue_media();
		   }else{
		       wp_enqueue_style('thickbox');
		       wp_enqueue_script('media-upload');
		       wp_enqueue_script('thickbox');
		   }
       }
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$summary_text = $instance['summary_text'];
		$map_text = $instance['map_text'];
		
		
		$link_text = $instance['link_text'];
		$link_link = $instance['link_link'];
		$link_icon = $instance['link_icon'];
		
		$secondary_link_text = $instance['secondary_link_text'];
		$secondary_link_link = $instance['secondary_link_link'];
		$secondary_link_icon = $instance['secondary_link_icon'];
		
		$widget_bg = $instance['widget_bg'];
		$widget_bg_img = $instance['widget_bg_img'];
		$checkbox_pro = $instance['checkbox_pro'];
		
		echo $before_widget;
		
		 ?>
		
		<div class="footer-map-home <?php echo esc_attr(  $args['widget_id'] ); ?><?php if($checkbox_pro): ?> light-fonts-pro<?php endif; ?>" <?php if($widget_bg): ?>style="background-color:<?php echo esc_attr( $widget_bg ); ?>;"<?php endif; ?>>
			<div id="map-embed-pro"><?php if($map_text): ?><?php echo do_shortcode( $map_text ); ?><?php endif; ?></div>
			<div id="map-text-pro">
				<?php if($title): ?><h1 class="home-widget"><?php echo esc_attr( $title ); ?></h1><?php endif; ?>
				<?php if($summary_text): ?><?php echo do_shortcode( $summary_text ); ?><?php endif; ?>
				<?php if($link_text): ?><div class="button-map-pro"><a href="<?php echo esc_attr( $link_link ); ?>" class="progression-button" target="_blank"><?php if($link_icon): ?><i class="ls-sc-button-icon-left fa <?php echo esc_attr( $link_icon ); ?>"></i><?php endif; ?><?php echo esc_attr(  $link_text ); ?></a></div><?php endif; ?>
			</div><!-- close #map-text-pro -->
			<div class="clearfix"></div>
		</div><!-- close .footer-map-home -->
		
		<?php if($widget_bg_img): ?>
			<script type='text/javascript'>jQuery(document).ready(function($) {   $(".<?php echo esc_attr(  $args['widget_id'] ); ?>").backstretch([ "<?php echo esc_url( $widget_bg_img ); ?>" ],{ fade: 750, }); }); </script>
		<?php endif; ?>
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		
		$instance['link_text'] = $new_instance['link_text'];
		$instance['link_link'] = $new_instance['link_link'];
		$instance['link_icon'] = $new_instance['link_icon'];
		
		
		
		$instance['map_text'] = $new_instance['map_text'];
		
		$instance['summary_text'] = $new_instance['summary_text'];
		
		$instance['secondary_link_text'] = $new_instance['secondary_link_text'];
		$instance['secondary_link_link'] = $new_instance['secondary_link_link'];
		$instance['secondary_link_icon'] = $new_instance['secondary_link_icon'];
		
		$instance['widget_bg'] = $new_instance['widget_bg'];
		$instance['widget_bg_img'] = $new_instance['widget_bg_img'];
		
		$instance['checkbox_pro'] = $new_instance['checkbox_pro'];
		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'LOCATION & INFORMATION', 'summary_text' => '<h4>Where Can I Park?</h4>
When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown.

[ls_divider type="dotted" color="grey"]
<h4>Box Office Hours</h4>
When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown.', 'map_text' => '[ls_googlemap location="1351 Arata Lane Windsor, CA 95492" zoom="16" title="Listing Location" height="500"]', 'link_text' => '', 'link_link' => '', 'widget_bg' => '#ffffff', 'widget_image_left_pro' => '', 'link_icon' => '', 'widget_bg_img' => '', 'checkbox_pro' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<script type='text/javascript'>
		            jQuery(document).ready(function($) {
		                $('.my-color-picker-footer').wpColorPicker();
		            });
		    </script>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('map_text'); ?>"><?php _e( 'Map Shortcode', 'progression' ); ?>:</label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('map_text'); ?>" name="<?php echo $this->get_field_name('map_text'); ?>"><?php echo $instance['map_text']; ?></textarea>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id('summary_text'); ?>"><?php _e( 'Summary Text', 'progression' ); ?>:</label>
	
			
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('summary_text'); ?>" name="<?php echo $this->get_field_name('summary_text'); ?>"><?php echo $instance['summary_text']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e( 'Button Text', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" value="<?php echo $instance['link_text']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link_link'); ?>"><?php _e( 'Button Link', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link_link'); ?>" name="<?php echo $this->get_field_name('link_link'); ?>" value="<?php echo $instance['link_link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link_icon'); ?>"><?php _e( 'Button Icon', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link_icon'); ?>" name="<?php echo $this->get_field_name('link_icon'); ?>" value="<?php echo $instance['link_icon']; ?>" />
		</p>
		
		
		
		<p>
			<label for="<?php echo $this->get_field_id('widget_bg'); ?>"><?php _e( 'Widget Background Color', 'progression' ); ?>:</label>
			<br>
			<input class="my-color-picker-footer" id="<?php echo $this->get_field_id('widget_bg'); ?>" name="<?php echo $this->get_field_name('widget_bg'); ?>" value="<?php echo $instance['widget_bg']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('widget_bg_img'); ?>"><?php _e( 'Widget Background Image', 'progression' ); ?>:</label>
			<br>
			<!-- Image Thumbnail -->
			<img class="custom_media_image" src="<?php echo $instance['widget_bg_img']; ?>" style="max-width:100px; float:left; margin: 0px     10px 0px 0px; display:inline-block;" />
			<!-- Upload button and text field -->
			<input class="custom_media_url" id="" type="text" name="<?php echo $this->get_field_name('widget_bg_img'); ?>" value="<?php echo $instance['widget_bg_img']; ?>" style="margin-bottom:10px; clear:right;">
			<a href="#" class="button widget_bg_img"><?php _e( 'Add Image', 'progression' ); ?></a>
			<script type="text/javascript">
			jQuery(document).ready(function($){
			$('.widget_bg_img').click(function() {
			        var send_attachment_bkp = wp.media.editor.send.attachment;
			        var button = $(this);
			        wp.media.editor.send.attachment = function(props, attachment) {
			            $(button).prev().prev().attr('src', attachment.url);
			            $(button).prev().val(attachment.url);
			            wp.media.editor.send.attachment = send_attachment_bkp;
			        }
			        wp.media.editor.open(button);
			        return false;       
			    });
			});
			</script>
			<div style=" clear:both;"></div>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('checkbox_pro'); ?>"><?php _e( 'Check box for light text', 'progression' ); ?>:</label>
			<input class="checkbox" type="checkbox" <?php checked($instance['checkbox_pro'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_pro'); ?>" name="<?php echo $this->get_field_name('checkbox_pro'); ?>" /> 
			
		</p>
		
	
		
	<?php }
}
?>