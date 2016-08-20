<?php
if(!function_exists('freesiaempire_get_option_defaults_values')):
	/******************** FREESIAEMPIRE DEFAULT OPTION VALUES ******************************************/
	function freesiaempire_get_option_defaults_values() {
		global $freesiaempire_default_values;
		$freesiaempire_default_values = array(
			'freesiaempire_responsive'	=> 'on',
			'freesiaempire_animate_css'	=> 'on',
			'freesiaempire_design_layout' => 'wide-layout',
			'freesiaempire_sidebar_layout_options' => 'right',
			'freesiaempire_blog_layout_temp' => 'large_image_display',
			'freesiaempire_enable_slider' => 'frontpage',
			'freesiaempire_transition_effect' => 'fade',
			'freesiaempire_transition_delay' => '4',
			'freesiaempire_transition_duration' => '1',
			'freesiaempire_search_custom_header' => 0,
			'freesiaempire-img-upload-header-logo'	=> '',
			'freesiaempire_header_display'=> 'header_text',
			'freesiaempire_categories'	=> array(),
			'freesiaempire_custom_css'	=> '',
			'freesiaempire_scroll'	=> 0,
			'freesiaempire_custom_header_options' => 'homepage',
			'freesiaempire_slider_link' =>0,
			'freesiaempire_tag_text' => 'Read More',
			'freesiaempire_excerpt_length'	=> '65',
			'freesiaempire_single_post_image' => 'off',
			'freesiaempire_reset_all' => 0,
			'freesiaempire_stick_menu'	=>0,
			'freesiaempire_blog_post_image' => 'on',
			'freesiaempire_entry_format_blog' => 'excerptblog_display',
			'freesiaempire_search_text' => 'Search ...',
			'freesiaempire_slider_type' => 'default_slider',
			'freesiaempire_slider_textposition' => 'middle',
			'freesiaempire_slider_no' => '4',
			'freesiaempire_slider_button' => 0,
			'freesiaempire_total_features' => '3',
			'freesiaempire_features_title' => '',
			'freesiaempire_features_description' => '',
			'freesiaempire_disable_features' => 0,
			'freesiaempire_display_header_image' => 'top',
			'freesiaempire_disable_features_alterpage' => 0,
			'freesiaempire_footer_column_section' =>'4',
			'freesiaempire_entry_format_blog' => 'show',
			'freesiaempire_entry_meta_blog' => 'show-meta',
			'freesiaempire_slider_content'	=> 'on',
			'freesiaempire_top_social_icons' =>0,
			'freesiaempire_buttom_social_icons'	=>0,
			'freesiaempire_menu_position'	=>'middle',
			'freesiaempire_logo_display'	=>'left',
			'freesiaempire_blog_content_layout'	=> '',
			'freesiaempire_blog_header_display'	=> 'show'
			);
		return apply_filters( 'freesiaempire_get_option_defaults_values', $freesiaempire_default_values );
	}
endif;
?>