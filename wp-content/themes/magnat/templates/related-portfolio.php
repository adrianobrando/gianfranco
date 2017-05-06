<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

// Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['related'] = $n2mu_qt ? n2mu_get_option('qt-single-portfolio-related') : esc_html__('Related Portfolio Items', 'magnat');


// Related Projects
if(n2mu_get_option('portfolio-related')){ 

$projects = n2mu_get_related_portfolio_items($post->ID); 
	
if($projects) {
	if($projects->have_posts()){ ?>

	<h3 class="n2mu_heading center"><span><?php echo esc_html($translation['related']) ?></span></h3>
		<div id="portfolio_carousel" class="owl-carousel owl-theme">
		<?php
			while($projects->have_posts()) {
			$projects->the_post(); 
				if(has_post_thumbnail()) {
				
					$taxonomy = 'n2mu_portfolio_category';
					$terms = get_the_terms( $post->ID , $taxonomy );
					$cats = array();
					
					if (! empty( $terms ) ) {
						foreach ( $terms as $term ) {
							
							$link = get_term_link( $term, $taxonomy );
							if ( !is_wp_error( $link ) ) {
								$cats[] = esc_html($term->name);
							}
						}
					} ?>
					<div class="portfolio-item hover-overlay">
							<a href="<?php echo esc_url(get_permalink()) ?>" title="" class="portfolio-item-link">
								<?php echo get_the_post_thumbnail($projects->post->ID, 'n2mu_medium') ?>
								<div class="portfolio-item-desc">
									<div class="portfolio-item-meta">
										<h4 class="portfolio-meta-title"><?php echo esc_html(get_the_title()) ?></h4>
										<p class="portfolio-meta-cat"><?php echo esc_html(implode(' / ', $cats)) ?></p>
									</div>
								</div>
							</a>
						</div>
					<?php
					}
				} ?>
		</div>
	<?php 
	}
}
}  ?>