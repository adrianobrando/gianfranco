<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
// Check for backward compatibility for site icon or check if icon is set via customizer. If not try to load favicon via theme options if it set
if ( ! ( function_exists( 'wp_site_icon' )) OR !has_site_icon() ) { 
	if (n2mu_get_option('favicon-img', 'url')) {?>
	<link rel="icon" type="image/x-icon" href="<?php echo esc_url(n2mu_get_option('favicon-img', 'url'));?>">		
<?php }}

wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

	<?php if(n2mu_get_option('page-preloader')){	// Preloader	
		get_template_part( 'templates/page', 'preloader' );
	} ?>

	<?php
	do_action('n2mu_before_header');

	get_template_part( 'templates/header', 'normal' );

	do_action('n2mu_after_header');
	?>

  <main id="body-container">
	<?php get_template_part( 'templates/page', 'heading' ); ?>
	<div class="body-content <?php echo (!is_page_template( 'page-full-width.php' )) ?  'container' : '' ?>">