<?php
add_action('widgets_init', 'child_pyre_home_schedule_load_widgets');

function child_pyre_home_schedule_load_widgets()
{
	register_widget('Child_Pyre_schedule_Blog_Media_Widget');
}

class Child_Pyre_schedule_Blog_Media_Widget extends WP_Widget {
	
	function Child_Pyre_schedule_Blog_Media_Widget()
	{
		$widget_ops = array('classname' => 'pyre_homepage_testimonails', 'description' => 'Import Schedule Page');

		$control_ops = array('id_base' => 'child_pyre_homepage_schedule-widget');
		
		add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
		
		
		parent::__construct('child_pyre_homepage_schedule-widget', 'Home: Date Schedule/Line-up Widget', $widget_ops, $control_ops);
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
		$posts = $instance['posts'];
		$columns = $instance['columns'];
		$link_icon = $instance['link_icon'];
		$link_text = $instance['link_text'];
		$link_link = $instance['link_link'];
		$summary_text = $instance['summary_text'];
		
		$widget_bg = $instance['widget_bg'];
		
		$portfolioslug = $instance['portfolioslug'];
		
		$widget_bg_img = $instance['widget_bg_img'];
		$checkbox_pro = $instance['checkbox_pro'];
				
		
		echo $before_widget;
	 ?>
		
		
		
	 
		<?php if($widget_bg_img): ?>
			<script type='text/javascript'>jQuery(document).ready(function($) {   $(".<?php echo esc_attr(  $args['widget_id'] ); ?>").backstretch([ "<?php echo esc_url( $widget_bg_img ); ?>" ],{ fade: 750, }); }); </script>
		<?php endif; ?>
		

		<div class="<?php echo esc_attr(  $args['widget_id'] ); ?> <?php if($checkbox_pro): ?>light-fonts-pro<?php endif; ?> homepage-widget-blog" <?php if($widget_bg): ?>style="background-color:<?php echo esc_attr( $widget_bg ); ?>;"<?php endif; ?>>
			<div class="width-container">
				<?php if($summary_text): ?>
						<div class="summary-text-pro"><?php echo esc_attr( $summary_text ); ?></div>
				<?php endif; ?>
				
				<?php if($title): ?>
					<h1 class="home-widget"><?php echo esc_attr( $title ); ?></h1>
				<?php endif; ?>
				
				<div id="schedule-container-pro">
					
				<?php
				$today = date('Ymd');
				$member_group_terms = array_filter(get_terms( 'schedule_day' ), function($term) use ($today) {
					$date = get_field('schedule_date', "{$term->taxonomy}_{$term->term_id}");
					return $today <= $date;
				});
				?>
				<div id="taxonomy_navigation_pro">
				<ul id="filterOptions-pro">
				<?php
				$count = 1;
				$count_2 = 1;
				foreach ( array_slice($member_group_terms, 0, 3) as $member_group_term ) {
				    $member_group_query = new WP_Query( array(
				        'post_type' => 'schedule',
						'posts_per_page' => '65',
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'schedule_day',
				                'field' => 'slug',
				                'terms' => array( $member_group_term->slug ),
				                'operator' => 'IN'
				            )
				        )
				    ) 
				);
				 ?>
				   <li<?php if($count == 1): ?> class="current-cat"<?php endif; ?>><a href="#" class="<?php echo $member_group_term->slug; ?>"><?php echo $member_group_term->name; ?></a></li>
				    <?php
					$count ++; $count_2++;
				    // Reset things, for good measure
				    $member_group_query = null;
				    wp_reset_postdata();
				}
				?>
					</ul>
					<div class="clearfix"></div>
				</div><!-- c lose #taxonomy_navigation_pro -->

					<ul id="schedule-content-progression">
						<?php

							
							$args = array(
										'posts_per_page' => 65,
										'post_type' => 'schedule' );
								
						$featured_posts = query_posts($args);  //was get_posts before i thought of pagination
									//print_r($featured_posts);
									//print_r($wp_query);
									//echo '<br /> -- '.$wp_query->max_num_pages.' <br />';
									if($featured_posts):
										foreach($featured_posts as $post):
							$col_count_progression = get_theme_mod('schedule_col_pro', '3');
						?>
						
						<li class="schedule<?php echo get_theme_mod('schedule_col_pro', '3'); ?>column-pro item-pro-schedule <?php $terms = get_the_terms( $post->ID , 'schedule_day' ); 
			        foreach ( $terms as $term ) {
			            $term_link = get_term_link( $term, 'schedule_day' );
			            if( is_wp_error( $term_link ) )
			            continue;
			        	echo '' . $term->slug . ' ';
			        } 
			    ?>">
							<?php get_template_part( 'content', 'schedule' ); ?>
						</li>
						<?php	 	endforeach; endif; ?>
					
					</ul>
				
					<div class="clearfix"></div>
				</div><!-- close #schedule-container-pro -->

				<?php wp_reset_query(); ?>

				<div class="clearfix"></div>
				<?php if($link_text): ?><div class="aligncenter"><a href="<?php echo esc_attr( $link_link ); ?>" class="progression-button progression-button-portfolio progression-blog"><?php echo esc_attr(  $link_text ); ?><?php if($link_icon): ?><i class="ls-sc-button-icon-right fa <?php echo esc_attr(  $link_icon ); ?>"></i><?php endif; ?></a></div><?php endif; ?>
				<div class="clearfix"></div>
			</div><!-- close .width-container -->
		</div><!-- close #homepage-widget -->
		
		
		<script type='text/javascript'>jQuery(document).ready(function($) {
		$('#schedule-content-progression').children('li:not(.<?php $member_group_terms = get_terms( 'schedule_day' ); ?><?php $count = 1; $count_2 = 1; foreach ( $member_group_terms as $member_group_term ) { $member_group_query = new WP_Query( array( 'post_type' => 'schedule','posts_per_page' => '1','tax_query' => array(  array( 'taxonomy' => 'schedule_day', 'field' => 'slug', 'terms' => array( $member_group_term->slug ), 'operator' => 'IN' ) ) )  ); ?><?php if($count == 1): ?><?php echo $member_group_term->slug; ?><?php endif; ?><?php $count ++; $count_2++; $member_group_query = null; wp_reset_postdata(); } ?>)').hide();
		}); </script>
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['posts'] = $new_instance['posts'];
		$instance['columns'] = $new_instance['columns'];
		$instance['link_icon'] = $new_instance['link_icon'];
		$instance['link_text'] = $new_instance['link_text'];
		$instance['link_link'] = $new_instance['link_link'];
		$instance['widget_bg'] = $new_instance['widget_bg'];
		$instance['summary_text'] = $new_instance['summary_text'];
		
		$instance['portfolioslug'] = $new_instance['portfolioslug'];
		
		$instance['widget_bg_img'] = $new_instance['widget_bg_img'];
		
		$instance['checkbox_pro'] = $new_instance['checkbox_pro'];
		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'THE LINEUP', 'summary_text' => 'OFFICIAL', 'link_text' => '', 'link_link' => '', 'widget_bg' => '#061d3d', 'link_icon' => '', 'widget_bg_img' => '', 'checkbox_pro' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<script type='text/javascript'>
		            jQuery(document).ready(function($) {
		                $('.my-color-picker-blog').wpColorPicker();
		            });
		        </script>
		
		
		
		<p>
			<label for="<?php echo $this->get_field_id('summary_text'); ?>"><?php _e( 'Sub-headline Text', 'progression' ); ?>:</label>			
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('summary_text'); ?>" name="<?php echo $this->get_field_name('summary_text'); ?>" value="<?php echo $instance['summary_text']; ?>" />
			
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'progression' ); ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
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
			<input class="my-color-picker-blog" id="<?php echo $this->get_field_id('widget_bg'); ?>" name="<?php echo $this->get_field_name('widget_bg'); ?>" value="<?php echo $instance['widget_bg']; ?>" />
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