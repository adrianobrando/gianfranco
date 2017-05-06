<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

// Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['404'] 			= $n2mu_qt ? n2mu_get_option('qt-404') : esc_html__('404', 'magnat');
$translation['404-title'] 		= $n2mu_qt ? n2mu_get_option('qt-404-title') : esc_html__('Ooops...', 'magnat');
$translation['404-subtitle'] 	= $n2mu_qt ? n2mu_get_option('qt-404-subtitle') : esc_html__('We are sorry, but the page you are looking for does not exist.', 'magnat');
$translation['404-desc'] 		= $n2mu_qt ? n2mu_get_option('qt-404-desc') : esc_html__('Please check entered address and try again or back to', 'magnat');
$translation['404-button'] 		= $n2mu_qt ? n2mu_get_option('qt-404-button') : esc_html__('Homepage', 'magnat');


get_header(); ?>
	<div class="container">
		<div class="page-404">
			<div class="page-404-wrapper">
				<div class="main-404"><?php echo esc_html($translation['404']); ?></div>
				<div class="title-404"><?php echo esc_html($translation['404-title']); ?></div>
				<div class="desc-404"><?php echo esc_html($translation['404-subtitle']); ?></div>
				<div class="wrap-404">
					<div class="rem-404"><?php echo esc_html($translation['404-desc']); ?></div>

					<a href="<?php echo esc_url(home_url('/')); ?>" class="n-btn btn-404 n-btn-medium n-btn-normal n-btn-primary-color n-radius-small n-icon-right n-icon-appear">
					<i class="fa fa-angle-right"></i><span class="n-btn-text"><?php echo esc_html($translation['404-button']); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>	
<?php get_footer(); ?>