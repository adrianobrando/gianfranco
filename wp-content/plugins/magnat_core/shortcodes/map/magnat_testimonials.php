<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
	magnat Testimonials carousel
**/


// Register Shortcode
if( ! function_exists( 'shortcode_magnat_testimonials' ) ) {
	function shortcode_magnat_testimonials( $atts, $content = null ) {


		$atts = vc_map_get_attributes('magnat_testimonials', $atts );
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
			$color_version = 'testimonials-dark';
		} else {
			$color_version = 'testimonials-white';
		}
        
	 	$args = array( 'post_type' => 'n2mu_testimonial',
		 		'posts_per_page' => 12,
				'order' => 'ASC',
				'orderby' => 'id',
				);

	    $loop = new WP_Query( $args );

        $carousel_id = rand(0,100000000);

		$str .= '<div id="testimonial_carousel_'.esc_attr($carousel_id).'" class="n2mu-testimonials owl-carousel owl-theme ' .esc_attr($color_version). ' ' .esc_attr($css_classes) .'">';
        while ( $loop->have_posts() ) : $loop->the_post();
        $post_id = get_the_ID();
        
        $testimonial_link =  get_post_meta($post_id, "n2mu-testimonial-url", true);
        $testimonial_client = get_post_meta($post_id, "n2mu-testimonial-client", true);
        $testimonial_position = get_post_meta($post_id, "n2mu-testimonial-position", true);
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
        $thumb_url = $thumb_url_array[0];

		$str  .= '<div class="n2mu-testimonial-item">';
        $str  .= '<div class="n2mu-testimonial-decor fa fa-quote-left"></div>';
        $str  .= '<div class="n2mu-testimonial-content">'.esc_html(get_the_content()).'</div>';
        if (has_post_thumbnail()) {
			if ($testimonial_link != '') {
				$str  .= '<a href="' .esc_url($testimonial_link). '" title="' .$testimonial_client. '">';
			}
        $str  .= '<div class="n2mu-testimonial-client-img"><img class="img-circle" src="'.$thumb_url.'" alt="'.$testimonial_client.'"/></div>';
			if ($testimonial_link != '') {
				$str  .= '</a>';
			}
        }
        $str  .= '<div class="n2mu-testimonial-client">';
        if ($testimonial_link != '') {
            $str  .= '<a href="' .esc_url($testimonial_link). '" title="' .$testimonial_client. '">'.$testimonial_client.'</a>';
        } else {
        $str  .= $testimonial_client;
        }
        $str  .= '</div>';
        $str  .= '<div class="n2mu-testimonial-position">'.$testimonial_position.'</div>';
		$str .= '</div>';	
        endwhile;
		wp_reset_postdata();
        $str .= '</div>';	


		$str .= '<script type="text/javascript">
					jQuery(document).ready(function($) {
					$("#testimonial_carousel_'.$carousel_id.'").owlCarousel({
						items: 				1,
						singleItem : true,
						nav: 		'.$nav_arrow.',
						dots:			'.$nav_dots.',
						autoHeight: 		'.$autoheight.',
						navText:			["<span class=\'owl-nav-button fa fa-angle-left\'></span>","<span class=\'owl-nav-button fa fa-angle-right\'></span>"],
						slideBy: 			1,
						slideSpeed: '.$slidespeed.',';

						if($animation != 'slide') {
						$str .= 'transitionStyle : "'.$animation.'",';
						}

		$str .=			'autoplay: '.$autoplay.',
						loop: true,
						margin:30,
					});
					});</script>';	
			
		return $str;
    }
}

add_shortcode('magnat_testimonials', 'shortcode_magnat_testimonials');

// Map Shortcode in Visual Composer
vc_map( array(
	"name" => __("Testimonials carousel", 'magnat-core'),
	"base" =>  "magnat_testimonials",
	"category" => "magnat Shortcodes",
	"icon" 		=> "magnat_testimonials",
	"weight"	=> '',
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
			"heading"	=> __("Testimonial color version", 'magnat-core'),
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
	)
));