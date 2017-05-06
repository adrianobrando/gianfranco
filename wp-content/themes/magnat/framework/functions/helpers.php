<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
	n2mu Get theme option
**/
if( ! function_exists( 'n2mu_get_option' ) ) { 
	function n2mu_get_option( $option, $option2 = NULL, $controller = NULL) {
        if ( class_exists( 'Redux' ) ) {
            Redux::init('magnat_options');
        } else {
            return n2mu_default_config( $option );
        }
        global $magnat_options;
        $option_selected = '';

        if($controller != NULL AND n2mu_get_post_meta($controller) ) {
            if ($option2 == NULL) {
                $option_selected = n2mu_get_post_meta($option);
            } else {
                $option_selected = n2mu_get_post_meta($option, $option2);
            }
        } else {
            if(array_key_exists($option.'-default', $magnat_options)) {
                if ($option2 == NULL) {
                    $option_selected = $magnat_options[$option.'-default'];
                } else {
                    $temp_opt = $magnat_options[$option.'-default'];
                    if(is_array($temp_opt) AND array_key_exists($option2, $temp_opt)) {
                        $option_selected = $magnat_options[$option.'-default'][$option2];
                    } else {
                        $option_selected = '';
                    } 
                }
            } elseif(array_key_exists($option, $magnat_options))  {
                if ($option2 == NULL) {
                    $option_selected = $magnat_options[$option];
                } else {
                    $temp_opt = $magnat_options[$option];
                    if(is_array($temp_opt) AND array_key_exists($option2, $temp_opt)) {
                        $option_selected = $magnat_options[$option][$option2];
                    } else {
                        $option_selected = '';
                    }   
                }
            } else {
                $option_selected = '';
            }
        }

        return $option_selected;
    }
}

if( ! function_exists( 'n2mu_get_post_meta' ) ) { 
	function n2mu_get_post_meta( $meta_name1, $meta_name2 = NULL ) {

        $post_id = n2mu_post_id();

        $meta = '';
        if ($meta_name2 == NULL) {
            $meta = get_post_meta($post_id, $meta_name1, TRUE);
        } else {
            $meta = get_post_meta($post_id, $meta_name1, TRUE);
            $meta = $meta[$meta_name2];
        }
        if ($meta == '') {
            return false;
        } else {
            return $meta;
        }
    }
}

if( ! function_exists( 'n2mu_post_id' ) ) { 
	function n2mu_post_id() {

        if ( class_exists( 'WooCommerce' ) ) {
            if(is_shop()) {
                $post_id = wc_get_page_id( 'shop' );
            } elseif(is_cart()) {
                $post_id = get_option( 'woocommerce_cart_page_id' );
            } elseif(is_checkout()) {
                $post_id = get_option( 'woocommerce_checkout_page_id' );
            } elseif(is_account_page()) {
                $post_id = get_option( 'woocommerce_myaccount_page_id' );
            } elseif  ( is_front_page() && is_home() ) {
                $post_id = get_option( 'page_for_posts' );
            } elseif ( is_front_page() ) {
                $post_id = get_the_ID();
            } elseif ( is_home() ) {
                $post_id = get_option( 'page_for_posts' );
            } elseif(is_archive() || is_search() || is_tax() || is_404()){
                $post_id = 0;
            } else {
                $post_id = get_the_ID();
            }
        } else {
           if ( is_front_page() && is_home() ) {
                $post_id = get_option( 'page_for_posts' );
            } elseif ( is_front_page() ) {
                $post_id = get_the_ID();
            } elseif ( is_home() ) {
                $post_id = get_option( 'page_for_posts' );
            } elseif(is_archive() || is_search() || is_tax() || is_404()){
                $post_id = 0;
            } else {
                $post_id = get_the_ID();
            }
        }

        if ($post_id == '') {
            return false;
        } else {
            return $post_id;
        }
    }
}