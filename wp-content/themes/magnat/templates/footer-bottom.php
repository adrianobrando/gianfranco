<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

$footer_bottom = n2mu_get_option('footer-bottom-enabled');

if ($footer_bottom != '0') { ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <div class="row">
                    <div id="powered" class="col-md-6 col sm-6 col-xs-12"><?php echo n2mu_get_option('copyrights');?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>