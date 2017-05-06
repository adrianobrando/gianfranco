<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if Footer top is disabled
$footer_columns = '3';
	
// Get footer Options
$footer_columns = n2mu_get_option('footer-columns');

if($footer_columns AND $footer_columns > '0' ) {
    // Handle Column count
    if($footer_columns AND (is_active_sidebar( 'n2mu_footer_widget1' ) OR is_active_sidebar( 'n2mu_footer_widget2' )
    OR is_active_sidebar( 'n2mu_footer_widget3' ) OR is_active_sidebar( 'n2mu_footer_widget4' )) ) { ?>
        
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <?php 
                    // Loop Columns
                    for($i = 1; $i <= $footer_columns; $i++){ 
                        if ($footer_columns == 4){
                            $footer_col = 3;
                        } elseif($footer_columns == 3) {
                            $footer_col = 4;
                        } elseif($footer_columns == 2) {
                            $footer_col = 6;
                        } elseif($footer_columns == 1) {
                            $footer_col = 12;
                        }
                        ?>
                        <div class="col-md-<?php echo esc_attr($footer_col); ?> col-sm-6 col-xs-12">
                            <?php if (is_active_sidebar( 'n2mu_footer_widget'.$i )) { ?>
                                <div class="n2mu-footer-column">
                                    <?php dynamic_sidebar('n2mu_footer_widget'.$i);	?>
                                </div>			
                            <?php } // end widget area ?>	
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?> 
<?php }