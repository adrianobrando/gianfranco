<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WooCommerce' ) ) {

add_action( 'after_setup_theme', 'n2mu_woocommerce_support' );
function n2mu_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'n2mu_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'n2mu_woocommerce_wrapper_end', 10);

function n2mu_woocommerce_wrapper_start() {
    // Check Sidebar Layout
    if(is_single()){
        $sidebar_layout = n2mu_get_option('layout-shop', NULL, 'layout-shop-custom');
    } else {
        $sidebar_layout = n2mu_get_option('layout', NULL, 'layout-custom');
    }
    // IF Sidebar Left
    if($sidebar_layout AND ($sidebar_layout == '2' OR $sidebar_layout == '3')){
        get_sidebar( 'left' );
    }

    if($sidebar_layout != '0' AND $sidebar_layout != '3'){
        echo "<div class='woo-content col-md-9 col-sm-9 col-xs-12 clearfix'>";
    } elseif($sidebar_layout == '3') {
        echo "<div class='woo-content col-md-6 col-sm-6 col-xs-12 clearfix'>";
    } else {
        echo "<div class='woo-content clearfix'>";
    }
}

function n2mu_woocommerce_wrapper_end() {
    echo '</div>';
    // Check Sidebar Layout
    if(is_single()){
        $sidebar_layout = n2mu_get_option('layout-shop', NULL, 'layout-shop-custom');
    } else {
        $sidebar_layout = n2mu_get_option('layout', NULL, 'layout-custom');
    }

    // IF Sidebar Right
    if($sidebar_layout == '1' OR $sidebar_layout == '3'){
        get_sidebar( 'right' );
    }
}

// Remove default woo breadcrumbs
add_action( 'init', 'n2mu_remove_wc_breadcrumbs' );
function n2mu_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// Remove default page title on Woo pages

add_filter( 'woocommerce_show_page_title' , 'n2mu_wc_hide_page_title' );
function n2mu_wc_hide_page_title() {
	
	return false;
	
}

// ajax cart
function n2mu_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
    $count = WC()->cart->cart_contents_count;
	?>
	<a class="fa fa-shopping-bag n-cart-header" href="<?php echo esc_url(wc_get_cart_url()); ?>"><span class="cart-number"><?php echo esc_html($count); ?></span></a>
	
    <?php $fragments['a.n-cart-header'] = ob_get_clean();
	
	return $fragments;
	
}

// catalog mode
$n2mu_woocommerce_catalog_mode = n2mu_get_option('woo-catalog-mode');

if($n2mu_woocommerce_catalog_mode) {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}

}