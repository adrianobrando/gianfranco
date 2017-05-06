<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
	Portfolio Grid
**/

// Register Shortcode
if( ! function_exists( 'shortcode_magnat_portfolio' ) ) {
	function shortcode_magnat_portfolio($atts, $content = null) {
		
		$atts = vc_map_get_attributes('magnat_portfolio', $atts );
		extract( $atts );
		global $post;
		$str = '';

		if ($columns == '2') {
			$portfolio_col = 'col-md-6 col-sm-6 col-xs-12';
		}

		if ($columns == '3') {
			$portfolio_col = 'col-md-4 col-sm-6 col-xs-12';
		}

		if ($columns == '4') {
			$portfolio_col = 'col-md-3 col-sm-6 col-xs-12';
		}
		
		$portfolio_items_per_page = $limit;
	 	$portfolio_order = $order;
	 	$portfolio_orderby = $order_by;
	 	if(!empty($category_name)){
		 	$portfolio_categories = explode(",", $category_name);
		}
		

		if(!empty($category_name)) {
	 	$args = array( 'post_type' => 'n2mu_portfolio',
		 		'posts_per_page' => $portfolio_items_per_page,
				'order' => $portfolio_order,
				'orderby' => $portfolio_orderby,
				'tax_query' => array(
						array(
							'taxonomy' => 'n2mu_portfolio_category',
							'field'    => 'slug',
							'terms'    => $portfolio_categories
						),
					),
				);
		 } else {
		 $args = array( 'post_type' => 'n2mu_portfolio',
		 		'posts_per_page' => $portfolio_items_per_page,
				'order' => $portfolio_order,
				'orderby' => $portfolio_orderby
				);
		 }

	    $loop = new WP_Query( $args );

		$str .= '<div id="portfolio-page">';
 		if( $filter_links == 'yes') {

		if(!$filter_all) {
			$filter_all = __( 'All', 'magnat-core' );
		}
	    $str .= '<ul id="filters">';
	    $str .= '<li><a href="#" data-filter="*" class="selected">'. $filter_all .'</a></li>';
			
				$terms = get_terms("n2mu_portfolio_category"); 
				$count = count($terms); 
				if ( $count > 0 ){ 
					foreach ( $terms as $term ) {  
						$str .= '<li><a href="#" data-filter=".'.$term->slug.'">' . $term->name . '</a></li>';
					}
				} 
			
		$str .= '</ul>';
		}


		$str .= '<div id="isotope-list">';
	 	
	    while ( $loop->have_posts() ) : $loop->the_post(); 
	    
			$termsArray = get_the_terms( $post->ID, "n2mu_portfolio_category" );
			$termsString = "";
			$termsCats = "";
			if(!empty($termsArray)) {
				foreach ( $termsArray as $term ) {
					$termsString .= $term->slug.' ';
					$termsCats .= $term->slug; 
					if($term !== end($termsArray)) {
					$termsCats .= ', ';
					}
				}
			}
			 
			$str .= '<div class="'. $termsString .'portfolio-item '.$portfolio_col.' '.$spacing.' '.$hover_effect.'">';
			$str .= '<a class="portfolio-item-link" href="'. get_the_permalink() .'">';
			$str .=		'<div class="portfolio-item-overlay">';
			$str .=			'<div class="portfolio-item-overlay-in"></div>';
			$str .=		'</div>';

					if ( has_post_thumbnail($post->ID) ) { 
			        $str .=	get_the_post_thumbnail( $post->ID ,'magnat_medium');
			        }

			$str .=	'<div class="portfolio-item-desc">';
			$str .=		'<div class="portfolio-item-meta">';
			$str .=			'<h3 class="portfolio-meta-title">'.get_the_title() .'</h3>';
			$str .=			'<p class="portfolio-meta-cat">'. $termsCats .'</p>';
			$str .=	 	'</div>';
			$str .=	 '</div>';
			$str .=	'</a>';
			$str .= '</div>';
	    endwhile;
		wp_reset_postdata();
	    	$str .= '</div>';
 
  			$str .= '</div>';
  			
		
		return $str;

	}
	
	add_shortcode('magnat_portfolio', 'shortcode_magnat_portfolio');
}



// Map Shortcode in Visual Composer
vc_map( array(
   "name" => __("Portfolio Grid", 'magnat-core'),
   "base" => "magnat_portfolio",
   "category" => "magnat Shortcodes",
   "icon" 	=> "magnat_portfolio",
   "weight"	=> '',
   "params" => array(
		array(
			"type" 			=> "dropdown",
			"heading" 		=> __("Columns", 'magnat-core'),
			"param_name" 	=> "columns",
			"value" 		=> Array(2,3,4),
			"std"			=> "3",
			"description" 	=> __("How many columns you want your items displayed in.", 'magnat-core'),
			"group"			=> "Grid Settings",
		),	   
		array(
			"type"			=> 'checkbox',
			"heading" 		=> __("Enable Filter Links", 'magnat-core'),
			"param_name" 	=> "filter_links",
			"value"			=> Array(__("Yes", 'magnat-core') => 'yes' ),
			"description" 	=> __("Set to Yes if you want Category Filter Links above your grid", 'magnat-core'),
			"group"			=> "Grid Settings",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Label text for ALL", 'magnat-core'),
			"param_name" 	=> "filter_all",
			"description" 	=> __("Type text that be displayed for ALL label. Leave empty for ALL label.", 'magnat-core'),
			"group"			=> "Grid Settings",
			"dependency"	=> Array(
				'element'	=> "filter_links",
				'value'		=> 'yes',
			)
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> __("Item Spacing", 'magnat-core'),
			"param_name" 	=> "spacing",
			"value" 		=> array('Big Spacing'=>'big-spacing','Small Spacing'=>'small-spacing','No Spacing'=>'no-spacing'),
			"std"			=> 'small_spacing',
			"description" 	=> __("Pick a spacing between the items in the grid", 'magnat-core'),
			"group"			=> "Grid Settings",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Extra class name", 'magnat-core'),
			"param_name" 	=> "css_classes",
			"description" 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'magnat-core'),
			"group"			=> "Grid Settings",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Total Items Limit", 'magnat-core'),
			"param_name" 	=> "limit",
			"std"			=> "9",
			"description" 	=> __("How many items you want to limit your grid to", 'magnat-core'),
			"group"			=> "Items",
		),			
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Category Name Filter (slug)", 'magnat-core'),
			"param_name" 	=> "category_name",
			"value" 		=> "",
			"description" 	=> __("Filter only a certain Category from your portfolio (comma-separated ' , ')", 'magnat-core'),
			"group"			=> "Items",
		),				
		array(
			"type" 			=> "dropdown",
			"heading" 		=> __("Order By", 'magnat-core'),
			"param_name" 	=> "order_by",
			"value" 		=> array('none','ID','title','name','date','rand'),
			"std"			=> 'date',
			"description" 	=> __("Order results by a certain field.", 'magnat-core'),
			"group"			=> "Items",
		),
		array(
			"type" 			=> "dropdown",
			"heading" 		=> __("Order", 'magnat-core'),
			"param_name" 	=> "order",
			"value" 		=> array('DESC','ASC'),
			"description" 	=> __("Order results in a Descending or Ascending order.", 'magnat-core'),
			"group"			=> "Items",
		),
		array(
			"type"			=> 'dropdown',
			"heading" 		=> __("Hover Effect", 'magnat-core'),
			"param_name" 	=> "hover_effect",
			"value"			=> Array("None" => 'hover-none',
									"Zoom Out" => 'hover-zoom-out', 
									"Zoom In" => 'hover-zoom-in',
									"Overlay" => 'hover-overlay',),
			"description" 	=> __("Pick a hover Effect", 'magnat-core'),
			"group"			=> "Design",
		),
	

   )
));	
