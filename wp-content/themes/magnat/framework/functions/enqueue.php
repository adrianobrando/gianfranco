<?php
if ( ! defined( 'ABSPATH' ) ) exit;
//	Enqueue n2mu Styles
add_action( 'wp_enqueue_scripts', 'n2mu_styles' );
function n2mu_styles() {
    
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style( 'n2mu-global', get_template_directory_uri().'/framework/css/n2mu-base.css');
	wp_enqueue_style( 'n2mu-custom', get_template_directory_uri().'/css/style.css');

	// Load Main CSS
	wp_enqueue_style( 'n2mu-main-styles', get_bloginfo( 'stylesheet_url' ), array('js_composer_front') );

	// Attach Custom CSS to the last CSS file so one can override all CSS files
	$inline_css = n2mu_get_inline_CSS();
	wp_add_inline_style( 'n2mu-custom', $inline_css );
	
}

function n2mu_enqueue_admin($hook) {

    if ( 'appearance_page_ot-theme-options' == $hook || 'post.php' == $hook || 'appearance_page_n2mu_import_page' == $hook ) {
        wp_enqueue_style( 'n2mu-admin-css', get_template_directory_uri().'/includes/framework/css/n2mu-admin.css' );
    }

}
add_action( 'admin_enqueue_scripts', 'n2mu_enqueue_admin' );

// Register Default Google Fonts
function n2mu_fonts_url() {
    $font_url = '';
    $font_url = add_query_arg( 'family', urlencode( 'Raleway:400,700,400italic,700italic|Source Sans Pro:300,400,700,400italic' ), "//fonts.googleapis.com/css" );
    return $font_url;
}

// Enqueue Default Google Fonts
function n2mu_add_default_fonts() {
    wp_enqueue_style( 'n2mu-fonts', n2mu_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'n2mu_add_default_fonts' );




// Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'n2mu_scripts' );	
function n2mu_scripts() {
	global $n2mu_js_params;

	wp_enqueue_script('n2mu-main', get_template_directory_uri().'/js/main.js', array('jquery'), '1.0.0', true);
	wp_localize_script('n2mu-main', 'n2muJSParams', $n2mu_js_params );
	wp_enqueue_script('n2mu-libs', get_template_directory_uri().'/js/libs.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js');
	wp_enqueue_script( 'waypoints' );

	// Load WP Comment Reply JS script
	if(is_singular()){
		wp_enqueue_script( 'comment-reply' );
	}
	
}