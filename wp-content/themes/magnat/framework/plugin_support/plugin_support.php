<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once( get_template_directory() . '/framework/plugin_support/woocommerce.php' );


//--------- Visual Composer ------------//

// Initialize Visual Composer as part of the theme
if(function_exists('vc_set_as_theme')){

	vc_set_as_theme(true);

	// Disabling redirect to VC welcome page
	remove_action( 'init', 'vc_page_welcome_redirect' );

	// Set VC by default for Page & Portfolio post types
	vc_set_default_editor_post_types(array('page', 'post', 'n2mu_portfolio'));	
	
}

//--------- Ultimate Addons ------------//
// Disabling after-activation redirect to Ultimate Addons Dashboard
if ( get_option( 'ultimate_vc_addons_redirect' ) == TRUE ) {
	update_option( 'ultimate_vc_addons_redirect', FALSE );
}

add_action( 'admin_init', 'n2mu_ultimate_addons_for_vc_integration' );
function n2mu_ultimate_addons_for_vc_integration() {
	if ( get_option( 'ultimate_updater' ) != 'disabled' ) {
		update_option( 'ultimate_updater', 'disabled' );
	}
}

//--------- TGMPA ------------//
if( ! function_exists( 'n2mu_theme_register_required_plugins' ) ) {
	function n2mu_theme_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'					=> 'WPBakery Visual Composer', // The plugin name
				'slug'					=> 'js_composer', // The plugin slug (typically the folder name)
				'source'				=> get_template_directory() . '/plugins/js_composer.zip', // The plugin source
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'					=> 'Revolution Slider', // The plugin name
				'slug'					=> 'revslider', // The plugin slug (typically the folder name)
				'source'				=> get_template_directory() . '/plugins/revslider.zip', // The plugin source
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'					=> 'Ultimate Addons for Visual Composer', // The plugin name
				'slug'					=> 'Ultimate_VC_Addons', // The plugin slug (typically the folder name)
				'source'				=> get_template_directory() . '/plugins/Ultimate_VC_Addons.zip', // The plugin source
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'					=> 'Redux Framework', // The plugin name
				'slug'					=> 'redux-framework', // The plugin slug (typically the folder name)
				'source'				=> get_template_directory() . '/plugins/redux-framework.zip', // The plugin source
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'					=> 'Magnat core', // The plugin name
				'slug'					=> 'magnat_core', // The plugin slug (typically the folder name)
				'source'				=> get_template_directory() . '/plugins/magnat_core.zip', // The plugin source
				'required'				=> true, // If false, the plugin is only 'recommended' instead of required
				'version'          		=> '1.0.0',
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),
			array(
				'name' 		=> 'WooCommerce',
				'slug' 		=> 'woocommerce',
				'required' 	=> false,
			),		

		);

		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'magnat';

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_slug' 		=> 'themes.php', 				// Default parent menu slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
		);

		tgmpa( $plugins, $config );
	}
}


//--------- Revolution Slider ------------//

if ( class_exists( 'RevSliderFront' ) ) {

	if ( function_exists( 'set_revslider_as_theme' ) ) {
		if ( ! defined( 'REV_SLIDER_AS_THEME' ) ) {
			define( 'REV_SLIDER_AS_THEME', TRUE );
		}
	set_revslider_as_theme();
	}

	if ( get_option( 'revslider-valid-notice', 'true' ) != 'false' ) {
		update_option( 'revslider-valid-notice', 'false' );
	}
	if ( get_option( 'revslider-notices', array() ) != array() ) {
		update_option( 'revslider-notices', array() );
	}
}



?>