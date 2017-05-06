<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 */
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<aside id="sidebar" class="col-md-3 col-sm-3 col-xs-12">
	<?php 
	if(isset($post)){
		$sidebar_left = n2mu_get_option('sidebar-left');
		if ($sidebar_left) {
			dynamic_sidebar($sidebar_left);
		} else {
			dynamic_sidebar('n2mu_default_sidebar');
		}
	} ?>
</aside>