<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
//
// Page functions
//

/*
Page title
****************************************/
if ( ! function_exists( 'n2mu_page_title' ) ) {
	function n2mu_page_title() {

        $title = '';
        if ( class_exists( 'WooCommerce' ) ) {
                if (is_home() && is_front_page()) {
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        $title = bloginfo('name'); 
                    }  
                } elseif(is_home()){
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        if ( $n2mu_page_heading_title = n2mu_get_post_meta('page-heading-title') ) {
                            $title = esc_html( $n2mu_page_heading_title );
                        } else {
                            $title = single_post_title('');;
                        }
                    }
                } elseif(is_404()){
                    $title = esc_html__('404 - Page Not Found', 'magnat');
                    
                } elseif(is_shop()) {
                    if ( $n2mu_page_heading_title = n2mu_get_post_meta('page-heading-title') ) {
                        $title = esc_html( $n2mu_page_heading_title );
                    } else {
                        $title = esc_html(get_the_title(n2mu_post_id()));
                    }
                } elseif(is_archive()){
                    if(is_year()){ $title = esc_html(get_the_time('Y')); }
                    elseif(is_month()){ $title = esc_html(get_the_time('F Y')); }
                    elseif(is_day()){ $title = esc_html(get_the_time('F jS, Y')); }
                    elseif(is_author()) { 	$title = esc_html(get_the_author()); }
                    elseif(is_tag()) { 	$title = esc_html__("Tag", 'magnat').": ". esc_html(single_tag_title('',false)); }
                    else{ 
                        $title = esc_html(single_cat_title());
                    }
                } elseif(is_search()){
                    $title = esc_html__('Search results for:', 'magnat').' '. esc_html(get_search_query());									
                } elseif(is_singular()){
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        if ( $n2mu_page_heading_title = n2mu_get_post_meta('page-heading-title') ) {
                            $title = esc_html( $n2mu_page_heading_title );
                        } else {
                            $title = esc_html(the_title(''));
                        }
                    }
                } elseif(is_tax()){
                    $title = esc_html(single_cat_title());
                } else {
                    $title = esc_html(the_title(''));
                }
        } else {
                if (is_home() && is_front_page()) {
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        $title = bloginfo('name'); 
                    }  
                } elseif(is_home()){
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        if ( $n2mu_page_heading_title = n2mu_get_post_meta('page-heading-title') ) {
                            $title = esc_html( $n2mu_page_heading_title );
                        } else {
                            $title = single_post_title('');;
                        }
                    }
                } elseif(is_404()){
                    $title = esc_html__('404 - Page Not Found', 'magnat');
                    
                }  elseif(is_archive()){
                    if(is_year()){ $title = esc_html(get_the_time('Y')); }
                    elseif(is_month()){ $title = esc_html(get_the_time('F Y')); }
                    elseif(is_day()){ $title = esc_html(get_the_time('F jS, Y')); }
                    elseif(is_author()) { 	$title = esc_html(get_the_author()); }
                    elseif(is_tag()) { 	$title = esc_html__("Tag", 'magnat').": ". esc_html(single_tag_title('',false)); }
                    else{ 
                        $title = esc_html(single_cat_title());
                    }
                } elseif(is_search()){
                    $title = esc_html__('Search results for:', 'magnat').' '. esc_html(get_search_query());									
                } elseif(is_singular()){
                    if(n2mu_get_post_meta('page-heading-title-option') != '1') {
                        if ( $n2mu_page_heading_title = n2mu_get_post_meta('page-heading-title') ) {
                            $title = esc_html( $n2mu_page_heading_title );
                        } else {
                            $title = esc_html(the_title(''));
                        }
                    }
                } elseif(is_tax()){
                    $title = esc_html(single_cat_title());
                } else {
                    $title = esc_html(the_title(''));
                }
        }

        return $title;
    }
}

/**
	Return preloader true or false
**/
if( ! function_exists( 'n2mu_preloader_enable' ) ) { 
	function n2mu_preloader_enable() {

		$n2mu_preloader_enable_option = n2mu_get_option('page-preloader');
		

		if($n2mu_preloader_enable_option == 'on') {
			$n2mu_preloader_enable = true;
		} else {
			$n2mu_preloader_enable = false;
		}

		return $n2mu_preloader_enable;
	}
}


