<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

$logo_option = n2mu_get_option('logo-option', NULL, 'logo-custom');
$logo_default_img_url = n2mu_get_option('logo-img','url', 'logo-custom');
$logo_sticky_img_url = n2mu_get_option('logo-img-sticky','url', 'logo-custom');
$logo_mobile_img_url = n2mu_get_option('logo-img-mobile','url', 'logo-custom');
$logo_text = n2mu_get_option('logo-text', NULL, 'logo-custom');

if($logo_option == '3') {
    return;
}
?>
<div class="logo">
    <?php
    if($logo_option == '1' AND $logo_default_img_url) { ?>
        <a class="logo-img" href="<?php echo esc_url(site_url()); ?>">
            <img class="logo-default" alt="<?php esc_html(bloginfo( 'name' )); ?>" src="<?php echo esc_url($logo_default_img_url); ?>"/>
            <?php    
            if ($logo_sticky_img_url) { ?>
                <img class="logo-sticky" alt="<?php esc_html(bloginfo( 'name' )); ?>" src="<?php echo esc_url($logo_sticky_img_url); ?>"/>
            <?php }
            if ($logo_mobile_img_url) { ?>
                <img class="logo-mobile" alt="<?php esc_html(bloginfo( 'name' )); ?>" src="<?php echo esc_url($logo_mobile_img_url); ?>"/>
            <?php } ?> 
        </a>
    <?php 
    } elseif ($logo_option == '2') { 
    ?>
        <a class="logo-text" href="<?php echo esc_url(site_url()); ?>"><?php echo esc_html($logo_text); ?></a>
    <?php 
    } else { ?>
        <a class="logo-img" href="<?php echo esc_url(site_url()); ?>">
            <img class="logo-default" alt="<?php esc_html(bloginfo( 'name' )); ?>" src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>"/>
        </a>
    <?php 
    } ?>
</div>
