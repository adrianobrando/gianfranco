<?php

//--------- n2mu Specific Methods ------------//

// Include Theme framework
require( get_template_directory() . '/framework/framework.php' );

// Default RSS feed links
add_theme_support('automatic-feed-links');


// Post Formats - DEV NOTE: Add support for post types
// add_theme_support( 'post-formats',  array( 'gallery','video' ));
// add_post_type_support( 'post', 'post-formats' );
// add_post_type_support( 'portfolio', 'post-formats' );

// Sets up the content width value based on the theme's design and stylesheet (Required by Theme Check)
if (!isset($content_width)){
	$content_width = 1200;
}

// Add title tag generation: required by theme check
function n2mu_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'n2mu_theme_slug_setup' );



//	n2mu required plugins
require( get_template_directory() . '/includes/ext/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'n2mu_theme_register_required_plugins' );


//	Global theme specific JS params array : $n2mu_js_params
$n2mu_js_params = array();
$n2mu_js_params['n2mu_is_mobile_device'] 	= wp_is_mobile();
$n2mu_js_params['n2mu_theme_url'] 		= get_template_directory_uri();


// Make theme available for translation
load_theme_textdomain( 'magnat', get_template_directory() . '/languages' );


// Images
add_theme_support('post-thumbnails');
//set_post_thumbnail_size(600, 380, true); //size of thumbs

add_image_size('n2mu_thumb', 150, 150, true);
add_image_size('n2mu_client_logo', 300, 300, true);
add_image_size('n2mu_medium', 600, 600, true);
add_image_size('n2mu_cropped_big', 1200, 600, true);

// Replace the 'read more' with empty string - Read more tag is added always in post listing
function n2mu_excerpt_more($more) {
	global $post;
	return ' [...]';
}
add_filter('excerpt_more', 'n2mu_excerpt_more');

function n2mu_the_more_tag_link() {
	return '';
}
add_filter( 'the_content_more_link', 'n2mu_the_more_tag_link' );

// Change default length of Excerpt
function n2mu_excerpt_length() {
	return 60;
}
add_filter('excerpt_length', 'n2mu_excerpt_length');

/**
 * add a default-gravatar to options
 */
if ( !function_exists('n2mu_fb_addgravatar') ) {
	function n2mu_fb_addgravatar( $avatar_defaults ) {
		$myavatar = get_template_directory_uri() . '/img/comment_avatar.png';
		$avatar_defaults[$myavatar] = 'people';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'n2mu_fb_addgravatar' );
}