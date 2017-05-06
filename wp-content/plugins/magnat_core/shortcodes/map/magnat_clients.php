<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
	Testimonial Slider
**/

// Register Shortcodes
if( ! function_exists( 'shortcode_magnat_clients' ) ) {
	function shortcode_magnat_clients($atts, $content = null) {
		
		$atts = vc_map_get_attributes('magnat_clients', $atts );
		extract( $atts );	

		$styles = '';
		$str = '';
		$nav_arrow = '';
		$nav_dots = '';

		if($navigation == 'none') {
			$nav_arrow = 'false';
			$nav_dots = 'false';
		} elseif($navigation == 'arrows') {
			$nav_arrow = 'true';
			$nav_dots = 'false';
		} elseif($navigation == 'dots') {
			$nav_arrow = 'false';
			$nav_dots = 'true';
		} elseif($navigation == 'both') {
			$nav_arrow = 'true';
			$nav_dots = 'true';
		}

		if($autoplay == 'yes' AND $autoplayspeed == '') {
			$autoplay = 'true';
		} elseif ($autoplay == 'yes' AND $autoplayspeed != '') {
			$autoplay = $autoplayspeed;
		} else {
			$autoplay = 'false';
		}

		if($autoheight == 'yes') {
			$autoheight = 'true';
		} else {
			$autoheight = 'false';
		}

		if($slidespeed == '') {
			$slidespeed = '600';
		}

		if($color_version == 'dark') {
			$color_version = 'clients-dark';
		} else {
			$color_version = 'clients-white';
		}

		$carousel_id = rand(0,10000000);
		
		$str='';        
		$str .= '<div id="n2mu_clients_'.$carousel_id.'" class="n2mu-clients-carousel owl-carousel owl-theme ' .esc_attr($color_version). ' '.esc_attr($css_classes).'">';

		$str .= do_shortcode($content);
		
		$str .= '</div>';

		$str .= '<script type="text/javascript">
				jQuery(document).ready(function($) {
				$("#n2mu_clients_'.$carousel_id.'").owlCarousel({
					items: 				4,
					responsive : {
						0 : {
							items: 		1,
						},
						480 : {
							items: 		1,
						},
						768 : {
							items: 		2,
						},
						1000 : {
							items: 		4,
						}
					},
					nav: 		'.$nav_arrow.',
					dots:			'.$nav_dots.',
					autoHeight: 		'.$autoheight.',
					navText:			["<span class=\'owl-nav-button fa fa-angle-left\'></span>","<span class=\'owl-nav-button fa fa-angle-right\'></span>"],
					slideBy: 			1,
					slideSpeed: '.$slidespeed.',';

					if($animation != 'slide') {
					$str .= 'transitionStyle : "'.$animation.'",';
					}

		$str .=		'autoplay: '.$autoplay.',
					loop: true,
					margin:30,
					});
					});</script>';			 
				 

		return $str;
	}
	
	add_shortcode('magnat_clients', 'shortcode_magnat_clients');
}

// Single Client
if( ! function_exists( 'shortcode_magnat_client' ) ) {
	function shortcode_magnat_client($atts, $content = null) {
		
		$atts = vc_map_get_attributes('magnat_client', $atts );
		extract( $atts );
		
		if ($link_target == 'yes' ) {
			$link_target = 'target="_blank"';
		}
		if ($link_title) {
			$link_title = 'title="' . esc_attr( $link_title ) . '"';
		}
		
		// Adding a check for VC picture added
		$img = '';
		if($atts['picture_url']){
			$vc_image = wp_get_attachment_image($atts['picture_url'],'magnat_client_logo');
			// If not passed via VC, we get the URL
			if($vc_image){
				$img = $vc_image;
			}
		}else {
			$img = '<img class="empty_user_testimonial_image" src="'.get_template_directory_uri().'/images/user.png" />';
		}
		
		$str = '';
		$str .= '	<div class="n2mu-single-client">';
		if($link == 'yes' AND $link_url) {
			$str .= '<a href="'.esc_url($link_url).'" '.$link_title.' '.$link_target.'>';
		}
		$str .=			$img;
		if($link == 'yes' AND $link_url) {
			$str .= '</a>';
		}
		$str .=		'</div>';

		return $str;
	}
	
	add_shortcode('magnat_client', 'shortcode_magnat_client');
}

// Map Shortcodes in Visual Composer
vc_map( array(
	"name" => __("Clients slider", 'magnat-core'),
	"base" => "magnat_clients",
	"as_parent" => array('only' => 'magnat_client'), 
	"content_element" => true,
	"icon" 		=> "magnat_clients",
	"category" => "magnat Shortcodes",
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"type"		=> "dropdown",
			"heading"	=> __("Slider Navigation", 'magnat-core'),
			"param_name"	=> "navigation",				
			"value"			=> array(
				__("None", 'magnat-core')					=> 'none',
				__("Arrows", 'magnat-core')				=> "arrows",
				__("Dots", 'magnat-core')					=> "dots",
				__("Both", 'magnat-core')				=> "both",
				)
		),
		array(
			"type"		=> "dropdown",
			"heading"	=> __("Animation effect", 'magnat-core'),
			"param_name"	=> "animation",				
			"value"			=> array(
				__("Slide", 'magnat-core')					=> 'slide',
				__("Fade", 'magnat-core')					=> 'fade',
				__("backSlide", 'magnat-core')				=> "backSlide",
				__("goDown", 'magnat-core')				=> 'goDown',
				__("Fade from bottom", 'magnat-core')		=> "fadeUp",)
		),
		array(
			"type"			=> 'checkbox',
			"heading" 		=> __("Autoplay slider?", 'magnat-core'),
			"param_name" 	=> "autoplay",
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			"value"			=> Array(__("Yes", 'magnat-core') => 'yes' ),
		),
		array(
			"type"			=> 'checkbox',
			"heading" 		=> __("Autoheight slider?", 'magnat-core'),
			"param_name" 	=> "autoheight",
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			"value"			=> Array(__("Yes", 'magnat-core') => 'yes' ),
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Autoplay speed", 'magnat-core'),
			"param_name" 	=> "autoplayspeed",
			"std" 			=> "",
			"description"	=> __("Autoplay speed in miliseconds. Default: 5000", 'magnat-core'),
			"dependency"		=> Array(
				'element'	=> "autoplay",
				'value'		=> 'yes',
			),	
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Navigation slide speed", 'magnat-core'),
			"param_name" 	=> "slidespeed",
			"std" 			=> "",
			"description"	=> __("Slide speed in miliseconds. Default: 600", 'magnat-core'),
		),
		array(
			"type"		=> "dropdown",
			"heading"	=> __("Color version", 'magnat-core'),
			"param_name"	=> "color_version",				
			"value"			=> array(
				__("Dark", 'magnat-core')					=> 'dark',
				__("White", 'magnat-core')					=> 'white',)
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Extra class name", 'magnat-core'),
			"param_name" 	=> "css_classes",
			"description" 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'magnat-core'),
		),
		
	),
	"js_view" => 'VcColumnView'
) );

vc_map( array(
	"name" => __("Client", 'magnat-core'),
	"base" => "magnat_client",
	"content_element" => true,
	"as_child" => array('only' => 'magnat_clients'),
	"icon" 	=> "magnat_clients",
	"params" => array(
		array(
			"type" => "attach_image",
			"heading" => __("Client logo", 'magnat-core'),
			"param_name" => "picture_url",
		),
		array(
			"type"			=> 'checkbox',
			"heading" 		=> __("Add link to image?", 'magnat-core'),
			"param_name" 	=> "link",
			"value"			=> Array(__("Yes", 'magnat-core') => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Link url', 'magnat-core' ),
			'param_name' => 'link_url',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Link title', 'magnat-core' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'param_name' => 'link_title',
		),
		array(
			"type"			=> 'checkbox',
			"heading" 		=> __("Open link in new window?", 'magnat-core'),
			"param_name" 		=> "link_target",
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			"value"			=> array(__("Yes", 'magnat-core') => 'yes' ),
		),
	)
));

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_magnat_clients extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_magnat_client extends WPBakeryShortCode {
	}
}