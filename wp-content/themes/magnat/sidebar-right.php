<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 */
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<aside id="sidebar-right" class="col-md-3 col-sm-3 col-xs-12">
	<?php 
		$sidebar_right = n2mu_get_option('sidebar-right');
		if ($sidebar_right) {
			dynamic_sidebar($sidebar_right);
		} else {
			dynamic_sidebar('n2mu_default_sidebar');
		}
	?>
</aside>
