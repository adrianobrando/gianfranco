<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
	Return classes for blog listing page depends on theme options
**/
if( ! function_exists( 'n2mu_blog_listing_classes_isotope' ) ) { 
	function n2mu_blog_listing_classes_isotope() {

		$n2mu_blog_listing_classes_option = n2mu_get_option('blog-listing-style');

		if ($n2mu_blog_listing_classes_option == 'blog-listing-simple') {
			$n2mu_blog_listing_classes = 'blog-listing-simple-listing';
		}

		if ($n2mu_blog_listing_classes_option == 'blog-listing-simple-3col') {
			$n2mu_blog_listing_classes = 'blog-listing-simple-3col-listing';
		}

		if ($n2mu_blog_listing_classes_option == 'blog-listing-card-3col') {
			$n2mu_blog_listing_classes = 'blog-listing-card-3col-listing';
		}

		if (!$n2mu_blog_listing_classes_option) {
			$n2mu_blog_listing_classes = 'blog-listing-simple-listing';
		}

		return $n2mu_blog_listing_classes;
	}
}

/**
	Return classes for blog listing page single post depends on theme options
**/
if( ! function_exists( 'n2mu_blog_listing_classes' ) ) { 
	function n2mu_blog_listing_classes() {

		$n2mu_blog_listing_classes_option = n2mu_get_option('blog-listing-style');

		if ($n2mu_blog_listing_classes_option == 'blog-listing-simple') {
			$n2mu_blog_listing_classes = 'blog-listing-simple';
		}

		if ($n2mu_blog_listing_classes_option == 'blog-listing-simple-3col') {
			$n2mu_blog_listing_classes = 'blog-listing-simple-3col col-md-4 col-sm-6 col-xs-12';
		}

		if ($n2mu_blog_listing_classes_option == 'blog-listing-card-3col') {
			$n2mu_blog_listing_classes = 'blog-listing-card-3col col-md-4 col-sm-6 col-xs-12';
		}

		if (!$n2mu_blog_listing_classes_option) {
			$n2mu_blog_listing_classes = 'blog-listing-simple';
		}

		return $n2mu_blog_listing_classes;
	}
}

/**
	Return image size on blog listing page
**/
if( ! function_exists( 'n2mu_blog_listing_img_size' ) ) { 
	function n2mu_blog_listing_img_size() {

		$n2mu_blog_listing_img_size = n2mu_get_option('blog-listing-img');

		if($n2mu_blog_listing_img_size == 'n2mu-medium') {
			$n2mu_blog_listing_img_size = 'n2mu_medium';
		}

		if($n2mu_blog_listing_img_size == 'full') {
			$n2mu_blog_listing_img_size = 'full';
		}

        if($n2mu_blog_listing_img_size == 'n2mu-cropped-big') {
			$n2mu_blog_listing_img_size = 'n2mu_cropped_big';
		}

		return $n2mu_blog_listing_img_size;
	}
}