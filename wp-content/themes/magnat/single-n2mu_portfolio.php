<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Template Name Posts: Portfolio List
 */
 
get_header(); 

// Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['details-title'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-details-title') : esc_html__('Project details', 'magnat');
$translation['details-client'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-details-client') : esc_html__('Client:', 'magnat');
$translation['details-url'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-details-url') : esc_html__('Site URL:', 'magnat');
$translation['details-date'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-details-date') : esc_html__('Date:', 'magnat');
$translation['button-prev'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-button-prev') : esc_html__('PREV', 'magnat');
$translation['button-next'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-button-next') : esc_html__('NEXT', 'magnat');

?>

<div class="portfolio_page">

<?php 
	while(have_posts()): the_post(); 
	?>
		<?php 
		$id = $post->ID;
		$portfolio_single_image_enabled = get_post_meta( $id, 'n2mu-portfolio-single-image-enabled', true);
		$portfolio_details_enabled = get_post_meta( $id, 'n2mu-portfolio-details-enabled', true);
		if( $portfolio_details_enabled != '0' ) {
		?>
			<div class="wrapper row">
				<div class="single-portfolio-meta col-md-4 col-sm-12">
					<h3 class="project-detail"><?php echo esc_html($translation['details-title']); ?></h3>
					<h5><?php echo esc_html($translation['details-client']); ?> <?php echo esc_html(get_post_meta( $id, 'n2mu-portfolio-client', true)) ?></h5>
					<h5><?php echo esc_html($translation['details-url']); ?> <a href='<?php echo esc_url(get_post_meta( $id, 'n2mu-portfolio-url', true)) ?>'><?php echo esc_url(get_post_meta( $id, 'n2mu-portfolio-url', true)) ?></a></h5>
					<h5><?php echo esc_html($translation['details-date'])?> <?php echo esc_html(get_post_meta( $id, 'n2mu-portfolio-date', true)) ?></h5>
				</div>

				<div class="post_content col-md-8 col-sm-12">
					<div class="portfolio-desc">
						<?php echo esc_html(get_post_meta( $id, 'n2mu-portfolio-desc', true)) ?>		
					</div>
				</div>
			</div>
		<?php } ?>

		
			<?php
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => '20',
				'post_status' => null,
				'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'exclude' => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			
			
			if(($attachments || has_post_thumbnail()) && ($portfolio_single_image_enabled != '0')){

				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'n2mu_cropped_big'); ?>

				<div class="single-portfolio-img">
					<a href="<?php echo esc_url($attachment_image[0]); ?>" class="image-popup-link" title="">
						<img src="<?php echo esc_url($attachment_image[0]); ?>" alt=" "/><div class="img_overlay"><span class="icon_zoom"></span></div>	  		
					</a>
				</div>
						
			<?php } ?>

		<div class="wrapper">
				<?php the_content(); ?>
		</div>
		


		<div class="wrapper portfolio-navigation">
			<hr>
			<div class="col-md-5 col-xs-5 portfolio-navigation-left">
				<?php previous_post_link('%link', '<i class="portolio-nav-arrow fa fa-angle-left"></i>'.esc_html($translation['button-prev']).'', FALSE); ?> 
			</div>
			<?php
			$portfolio_page_link = n2mu_get_option('portfolio-page-slug');
			?>

			<div class="col-md-2 col-xs-2 portfolio-navigation-center">
				<a href='<?php echo (esc_url(home_url('/') . $portfolio_page_link)) ?>'><i class="portolio-nav-arrow fa fa-table"></i></a>
			</div>
			<div class="col-md-5 col-xs-5 portfolio-navigation-right">
				<?php next_post_link('%link', ''.esc_html($translation['button-next']).'<i class="portolio-nav-arrow fa fa-angle-right"></i>', FALSE); ?> 
			</div>
		</div>

		<?php
		endwhile; // END LOOP ?>

</div>
		
	<?php get_template_part('templates/related-portfolio'); ?>

<?php get_footer(); ?>