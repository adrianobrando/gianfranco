<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/* n2mu framework
 *
 * The following file defines the some Core Theme functionality methods
 *
 * @author n2mu
 * @link http://www.n2mu.studio
 */


/** 
	Include framework files and functions
**/

// Include default config
require( get_template_directory() . '/framework/config/config.php' );

// Include widgets
require( get_template_directory() . '/framework/functions/widgets.php' );

// Include theme options
require_once( get_template_directory() . '/framework/theme_options/theme_options_metaboxes.php' );

// Include theme options
require_once( get_template_directory() . '/framework/theme_options/theme_options_config.php' );

// Include helpers functions
require( get_template_directory() . '/framework/functions/helpers.php' );

// Include theme options output
require( get_template_directory() . '/framework/functions/theme_options_output.php' );

// Include header functions
require( get_template_directory() . '/framework/functions/header.php' );

// Include page functions
require( get_template_directory() . '/framework/functions/page.php' );

// Include page functions
require( get_template_directory() . '/framework/functions/blog.php' );

// Include plugin support
require( get_template_directory() . '/framework/plugin_support/plugin_support.php' );

// Include styles and scripts loader
require( get_template_directory() . '/framework/functions/enqueue.php' );

/**
	Initialization n2mu
**/

// Main n2mu Startup
add_action('init', 'n2mu_init');

function n2mu_init(){
	n2mu_register_menus();
}
	 
// Register Menus
function n2mu_register_menus(){
	register_nav_menus( array(
			'main_menu' 	=> 'Main Menu',
			'left_menu' 	=> 'Left Menu',
			'right_menu' 	=> 'Right Menu',
			'mobile_menu' 	=> 'Mobile menu',
			'top_menu' 		=> 'Top menu',
			'bottom_menu' 	=> 'Bottom menu',
	));
}

add_action('widgets_init', 'n2mu_register_widgets');

// Register Widgets
function n2mu_register_widgets(){

	if(function_exists('register_sidebar')) {
		// Register widgetized locations
		register_sidebar(array(
			'name' => 'Default Sidebar',
			'id'   => 'n2mu_default_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Header Top Left',
			'id'   => 'n2mu_header_top_left_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Header Top Right',
			'id'   => 'n2mu_header_top_right_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 1',
			'id'   => 'n2mu_footer_widget1',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 2',
			'id'   => 'n2mu_footer_widget2',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 3',
			'id'   => 'n2mu_footer_widget3',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 4',
			'id'   => 'n2mu_footer_widget4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="n2mu-w-heading">',
			'after_title' => '</h3>',
		));

		// Register Dynamic Widgets
		if ($dynamic_sidebars = n2mu_get_option('n2mu-sidebars')){
			foreach ($dynamic_sidebars as $dynamic_sidebar) {
				register_sidebar(array(
					'name' => $dynamic_sidebar,
					'id' => $dynamic_sidebar,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="n2mu-w-heading">',
					'after_title' => '</h4>',
					));
			}
		}
		
	}	
	
}

/**	
	BreadCrumbs method 
**/
if( ! function_exists( 'n2mu_breadcrumbs' ) ) { 
	function n2mu_breadcrumbs() {
			global $post;
			
			echo '<div class="breadcrumb">';
			
			if ( !is_front_page() ) {
				echo '<a class="first_bc" href="';
				echo esc_url(home_url('/'));
				echo '"><span>'.esc_html__('Home','magnat');
				echo "</span></a>";
			}
			
			if (is_category() && !is_singular('n2mu_portfolio')) {
				$current_cat = get_category(get_query_var('cat'),false);
				$parents_links = get_category_parents($current_cat->cat_ID, TRUE, '', FALSE );

				//Attach <span> to links      
				$parents_links = preg_replace("/(<a\s*href[^>]+>)/", "$1".'<span>', $parents_links);
				$parents_links = n2mu_str_lreplace("<a href","<a class='last_bc' href", $parents_links);
				$parents_links = str_replace("</a>", "</span></a>", $parents_links);
				
				echo esc_html($parents_links);
			}        
			
			// Taxonomy
			if (is_tax()) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				echo '<a class="last_bc" href="' . esc_url(get_term_link($term)) . '" title="' . esc_attr($term->name) . '"><span>' . esc_html($term->name) . '</span></a>';
			}


			// Portfolio Breadcrumbs
			if(is_singular('n2mu_portfolio')) {
		
				$taxonomy = 'n2mu_portfolio_category';
				$terms = get_the_terms( $post->ID , $taxonomy );

				if (! empty( $terms ) ) :
					foreach ( $terms as $term ) {
						
						$link = get_term_link( $term, $taxonomy );
						if ( !is_wp_error( $link ) )
							echo '<a href="' . esc_url($link) . '"><span>' . esc_html($term->name) . '</span></a>';
					}
				endif;
			}

			if(is_home()) {
				echo '<a class="last_bc" href="#" title="' . esc_attr(single_post_title('', false )) . '"><span>' . esc_html(single_post_title('',false)) . '</span></a>';
			}
			
			if(is_page() && !is_front_page()) {
				$parents = array();
				$parent_id = $post->post_parent;
				while ( $parent_id ) :
					$page = get_page( $parent_id );
					$parents[]  = '<a href="' . esc_url(get_permalink( $page->ID )) . '" title="' . esc_attr(get_the_title( $page->ID )) . '"><span>' . esc_html(get_the_title( $page->ID )) . '</span></a>';
					$parent_id  = $page->post_parent;
				endwhile;
				$parents = array_reverse( $parents );
				echo join( ' ', $parents );
				echo '<a class="last_bc" href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '"><span>' . esc_html(get_the_title()). '</span></a>';
			}
			
			if(is_single()) {
				$args=array('orderby' => 'none');
				$terms = wp_get_post_terms( $post->ID , 'category', $args);
				foreach($terms as $term) {
				  echo '<a href="' . esc_url(get_term_link($term, 'category')) . '" title="' . esc_attr(get_the_title()) . '" ' . '><span>' . esc_html($term->name) .'</span></a> ';
				}

				echo '<a class="last_bc" href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '"><span>' . esc_html(get_the_title()). '</span></a>';
			}
			
			if(is_tag()){ echo '<a class="last_bc" href="#"><span>'.esc_html__("Tag", 'magnat').": ".esc_html(single_tag_title('', false)).'</span></a>'; }
			if(is_404()){ echo '<a class="last_bc" href="#"><span>'.esc_html__("404 - Page not Found", 'magnat').'</span></a>'; }
			if(is_search()){ echo '<a class="last_bc" href="#"><span>'.esc_html__("Search", 'magnat').'</span></a>'; }
			if(is_year()){ echo '<a class="last_bc" href="#"><span>'.esc_html(get_the_time('Y')).'</span></a>'; }
			if(is_month()){ echo '<a class="last_bc" href="#"><span>'.esc_html(get_the_time('F Y')).'</span></a>'; }
			if(is_day()){ echo '<a class="last_bc" href="#"><span>'.esc_html(get_the_time('F jS, Y')).'</span></a>'; }
			if(is_author()) { 	echo '<a class="last_bc" href="#"><span>'.esc_html(get_the_author()).'</span></a>'; }

			echo "</div>";
	}
}

/**
	Replace last occurrence
**/
if( ! function_exists( 'n2mu_str_lreplace' ) ) {
	function n2mu_str_lreplace($search, $replace, $subject)
	{
		return preg_replace('~(.*)' . preg_quote($search, '~') . '(.*?)~', '$1' . $replace . '$2', $subject, 1);
	}
}

// Comments
if( ! function_exists( 'n2mu_comment' ) ) { 
	function n2mu_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<?php $add_below = ''; ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		
			<div class="single_comment">
				<div class="comment_avatar">
					<div class="avatar">
						<?php echo get_avatar($comment, 50); ?>
					</div>
					<?php edit_comment_link(esc_html__('Edit','magnat'),'  ','') ?>
				</div>
				<div class="comment_content">
				
					<div class="comment-author meta">
						<div class="comment_name">
							<?php
								$author_link = wp_kses_post(get_comment_author_link());
								$reply_link = get_comment_reply_link(array_merge($args, array('reply_text' => 'Reply', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));
							?>
							<?php echo ((is_rtl()) ? $reply_link : $author_link); ?><span>-</span><?php echo ((is_rtl()) ? $author_link : $reply_link); ?>
						</div>
						<div class="comment_desc"><?php printf(esc_html__('%1$s at %2$s', 'magnat'), esc_html(get_comment_date()),  esc_html(get_comment_time())) ?></div>
						
					</div>
				
					<div class="comment_text">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php esc_html_e('Your comment is awaiting moderation.', 'magnat') ?></em>
						<br />
						<?php endif; ?>
						<?php esc_html(comment_text()) ?>
					</div>
				
				</div>
				
			</div>

	<?php } 
}

/**
	n2mu Pagination
**/
if( ! function_exists( 'n2mu_pagination' ) ) { 
	function n2mu_pagination($pages = '', $range = 2)
	{  
		 $showitems = ($range * 2)+1;  

		 global $paged;

		 if(empty($paged)) $paged = 1;

		 if($pages == '')
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages)
			 {
				 $pages = 1;
			 }
		 }   

		 if(1 != $pages)
		 {
		 	 echo "<div class='pagination-wrapper'>";
			 echo "<ul class='pagination'>";
			 
			 if($paged > 1){
				echo "<li><a class='pagination-prev' href='".esc_url(get_pagenum_link($paged - 1))."'><span class='page-prev'></span>".esc_html__('Previous', 'magnat')."</a></li>";
			 }
			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 echo ($paged == $i)? "<li class='active'><a href='javascript:void(0)'>".esc_html($i)."</a></li>":"<li><a href='".esc_url(get_pagenum_link($i))."'>".esc_html($i)."</a></li>";
				 }
			 }

			 if ($paged < $pages) echo "<li><a class='pagination-next' href='".esc_url(get_pagenum_link($paged + 1))."'>".esc_html__('Next', 'magnat')."<span class='page-next'></span></a></li>";  
			 echo "</ul></div>\n";
		 }
	}
}



/**
	n2mu Related Portfolio Items
**/
if( ! function_exists( 'n2mu_get_related_portfolio_items' ) ) { 
	function n2mu_get_related_portfolio_items($post_id) {
		
		$item_cats = get_the_terms($post_id, 'n2mu_portfolio_category');
		if($item_cats) {
		foreach($item_cats as $item_cat) {
			$item_array[] = $item_cat->term_id;
		}
		}
		if(isset($item_array)) {
			$args = array(
				'post__not_in' => array($post_id),
				'ignore_sticky_posts' => 0,
				'post_type' => 'n2mu_portfolio',
				'posts_per_page'	=> 100,
				'tax_query' => array(
					array(
						'taxonomy' => 'n2mu_portfolio_category',
						'field' => 'term_id',
						'terms' => $item_array
					)
				)
			);
			
		$query = new WP_Query($args);
		
		wp_reset_postdata();

		return $query;

		} else {

		return false;
		
		}
	}
}



/**
	Expanded allowed params for wp_kses
**/
function n2mu_expand_allowed_tags() {
	$allowed = wp_kses_allowed_html( 'post' );
	// iframe
	$allowed['iframe'] = array(
		'src'             => array(),
		'height'          => array(),
		'width'           => array(),
		'frameborder'     => array(),
		'allowfullscreen' => array(),
	); 
	return $allowed;
}