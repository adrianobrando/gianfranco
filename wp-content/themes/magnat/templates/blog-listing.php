<div class="<?php echo esc_html(n2mu_blog_listing_classes_isotope()) ?>">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

//Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['read-more'] = $n2mu_qt ? n2mu_get_option('qt-blog-listing-button') : esc_html__('Read more', 'magnat');
$translation['no-post'] = $n2mu_qt ? n2mu_get_option('qt-blog-listing-no-post') : esc_html__('Sorry, no posts matched your criteria.', 'magnat');
$translation['no-comment'] = $n2mu_qt ? n2mu_get_option('qt-blog-no-comment') : esc_html__('No comments yet', 'magnat');
$translation['one-comment'] = $n2mu_qt ? n2mu_get_option('qt-blog-one-comment') : esc_html__('1 comment', 'magnat');
$translation['comments'] = $n2mu_qt ? n2mu_get_option('qt-blog-comments') : esc_html__('comments', 'magnat');
$translation['comments-off'] = $n2mu_qt ? n2mu_get_option('qt-blog-comments-off') : esc_html__('Comments are Off', 'magnat');
$translation['comment-password'] = $n2mu_qt ? n2mu_get_option('qt-blog-comment-password') : esc_html__('Enter your password to view comments.', 'magnat');
$translation['tags'] = $n2mu_qt ? n2mu_get_option('qt-blog-tags') : esc_html__('Tags:', 'magnat');

$post_classes ='post-item '. n2mu_blog_listing_classes();
?>
					
	<article <?php post_class( $post_classes ); ?>>
		<div class="post-item-body">		
		<?php

			$img_height = n2mu_blog_listing_img_size();
			if(has_post_thumbnail()) { 
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $img_height);
				$att_img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
			?>			
				<div class="post-listing-img">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($post->post_title); ?>">
						<img src="<?php echo esc_url($attachment_image[0]); ?>" alt="<?php echo esc_attr($att_img_alt);?>"/>
						<div class="img-overlay"><span class="hover-icon icon_plus"></span></div>
					</a>
				</div>
			<?php }

				// Post meta
			?>				
				<div class="post-item-meta">
				<?php if(get_the_title()!=''){ ?>
						<h3 class="post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute('echo=0'); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php } ?>
					<?php if(n2mu_get_option('blog-listing-meta') != false) { ?>
					<div class="blog-post-meta">
						<?php if(n2mu_get_option('blog-listing-meta-date') != false) { ?>
							<span class="date">
								<i class="post-icon fa fa-calendar"></i>
								<?php echo get_the_date();?>
							</span>
						<?php } ?>
						<?php if(n2mu_get_option('blog-listing-meta-author') != false) { ?>
							<span class="author">
								<i class="post-icon fa fa-user"></i>
								<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID' ))); ?>">
									<?php esc_html(the_author_meta('display_name')); ?>
								</a>
							</span>
						<?php } ?>
						<?php if(n2mu_get_option('blog-listing-meta-categories') != false) { ?>
							<span class="category">
								<i class="post-icon fa fa-folder-o"></i>
								<?php
									$categories = get_the_terms( $post->ID, 'category' );
									
									$len_cats = count($categories);
									foreach ($categories as $id_cats => $category) { 
										$cat_id =  $category->term_id; ?>
										<a href="<?php echo esc_url(get_category_link( $cat_id )); ?>" title="<?php echo esc_attr($category->name);?>" >
											<?php echo esc_attr($category->name);
											if ($id_cats != $len_cats - 1) {
												echo ",";
											} ?>
										</a>
									<?php } ?>
							</span>
						<?php } ?>
						<?php if(n2mu_get_option('blog-listing-meta-comments') != false) { ?>
							<span class="comments">
								<i class="post-icon fa fa-commenting-o"></i>
								<?php comments_popup_link( $translation['no-comment'], $translation['one-comment'], '% ' . $translation['comments'] , 'comments-link', $translation['comments-off']);?>
							</span>
						<?php } ?>
					</div>
					<?php } ?>

				<?php	// Show Content/Excerpt
						if(n2mu_get_option('n2mu-blog-full-post-content')){
							the_content();
						}else {
							the_excerpt();
						}
				?>
				<?php if(n2mu_get_option('blog-listing-meta') != false) { ?>
					<?php if(n2mu_get_option('blog-listing-meta-tags') != false) { ?>
						<?php if(get_the_tags()) { ?>
							<div class="tags">
								<span class="tags-before"><?php echo esc_html($translation['tags']);?></span>
								<?php
								esc_attr(the_tags('',', ')); ?>
							</div> 
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<a class="n2mu-more-link" href="<?php echo esc_url(get_permalink($post->ID)) ?>"><?php echo esc_html($translation['read-more']) ?></a>
				</div>
		</div>					
	</article>			
						
						
	<?php endwhile; ?>
<?php else: ?>

	<p><?php echo esc_html($translation['no-post']); ?></p>

<?php endif; 
?>
</div>

<?php n2mu_pagination($pages = '', $range = 2); ?>

<div style="display: none;">
<?php
	echo esc_html(get_the_posts_pagination());
?>					
</div>