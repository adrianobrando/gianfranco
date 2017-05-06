<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' ); ?>
<?php
/**	
	Page Heading
**/
$n2mu_show_heading = n2mu_get_option('page-heading-on', NULL, 'page-heading-custom');

if($n2mu_show_heading) {

    $n2mu_page_heading_style = n2mu_get_option('page-heading-style', NULL, 'page-heading-custom');

    if(is_archive() || is_search() || is_home() || is_404() || is_page() || is_tax() || is_single()) { 
    
        $extra_style = "";
        
    ?>
    <?php if (get_the_title() OR is_search()) { ?>
    <div class="page-section page-heading <?php echo esc_attr($n2mu_page_heading_style); ?>">
        <div class="page-section-i clearfix">
            <h1 class="page-heading-title"><?php echo esc_html(n2mu_page_title());?></h1>
            <?php if ( $n2mu_page_heading_subtitle = n2mu_get_post_meta('page-heading-subtitle') ) { ?>
                <h3 class="page-heading-subtitle"> <?php echo esc_html( $n2mu_page_heading_subtitle ); ?></h3>
            <?php }	?>
                
        </div>
    </div>
    <?php } ?>
    <?php			
    }

}