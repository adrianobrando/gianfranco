<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

$search_enabled = n2mu_get_option('header-tools-search');
$cart_enabled = n2mu_get_option('header-tools-cart');

if($search_enabled) { ?>
    <div class="header-search-icon"><a class="fa fa-search" href="javascript:void(0)"></a></div>
    <?php add_action('wp_footer', 'n2mu_add_search_footer');?>
<?php } ?>

<?php if($cart_enabled AND class_exists( 'WooCommerce' )) { ?>
    <div class="header-cart-icon">
        <a class="fa fa-shopping-bag n-cart-header" href="<?php echo esc_url(wc_get_cart_url()); ?>"><span class="cart-number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span></a>
        
    </div>
<?php } ?>