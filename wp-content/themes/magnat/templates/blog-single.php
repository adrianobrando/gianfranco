<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
global $post;

?>
<article class="post-item clearfix">
	<?php
	if(has_post_thumbnail()) {
		$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'n2mu_cropped_big'); ?>
			<div class="single-post-img">
				<a href="<?php echo esc_url($attachment_image[0]);?>" class="image-popup-link" title="<?php echo esc_attr($post->post_title); ?>">
					<img src="<?php echo esc_url($attachment_image[0]); ?>" alt=" "/><div class="img_overlay"><span class="icon_zoom"></span></div>
				</a>
			</div>
	<?php } 
	
	$n2mu_show_heading = n2mu_get_option('page-heading-on', NULL, 'page-heading-custom');

	if(get_the_title()!=''){ 
		if (!$n2mu_show_heading) { ?>
			<h2 class="post-title"><?php esc_html(the_title()); ?></h2>
	<?php }
	}

	// Post meta
	get_template_part( 'templates/blog', 'single-meta' ); ?>

	<div class="post-description">
		<?php the_content(); ?>
	</div>
</article>

<?php 
$link_pages_defaults = array(
		'before'           => '<div class="n2mu-link-pages">',
		'after'            => '</div>',
		'link_before'      => '<span>',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'pagelink'         => '%',
		'echo'             => 1
	);

wp_link_pages( $link_pages_defaults ); ?>

<?php // Tags
	get_template_part( 'templates/blog', 'single-meta-tags' ); ?>

<?php comments_template('', true); ?>
