<?php
/*
Plugin Name: Magnat core
Plugin URI: http://magnat.n2mu.studio
Description: Core plugin for Magnat theme
Version: 1.0.0
Author: N2mu
Author URI: http://n2mu.studio
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function magnat_core_load_textdomain() {
  load_plugin_textdomain( 'magnat-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'magnat_core_load_textdomain' );

function magnat_core_loader() {
    $magnat_core_dir = dirname( __FILE__ );
    require ( $magnat_core_dir . '/functions/post_types.php');
	// require ( $magnat_core_dir . '/importer/magnat_importer.php');
	require ( $magnat_core_dir . '/extensions/loader.php');
    magnat_core_vc();
}

function magnat_core_vc() {
    if(function_exists('vc_set_as_theme')){
        // Extend VC
        magnat_extend_VC_shortcodes();
    }
}

// Enqueue css for vc shortcodes
function magnat_core_enqueue_admin($hook) {
    $magnat_core_dir_url = plugin_dir_url( __FILE__ );
    if ( 'post.php' == $hook) {
        wp_enqueue_style( 'magnat-core', $magnat_core_dir_url .'/shortcodes/assets/magnat-core.css' );
    }

}
add_action( 'admin_enqueue_scripts', 'magnat_core_enqueue_admin' );

// magnat shortcode initializations for Visual Composer
if ( !function_exists( 'magnat_extend_VC_shortcodes' )) {
	function magnat_extend_VC_shortcodes() {

		$magnat_core_dir = dirname( __FILE__ );

		require( $magnat_core_dir . '/shortcodes/map/magnat_portfolio.php');	
		require( $magnat_core_dir . '/shortcodes/map/magnat_testimonials.php');
		require( $magnat_core_dir . '/shortcodes/map/magnat_clients.php');		
		
	}
}

magnat_core_loader();
