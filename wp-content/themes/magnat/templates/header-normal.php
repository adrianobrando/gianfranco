<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

// Disable header if option is set in post meta
if ( n2mu_get_post_meta('page-disable-header') ) {
	return;
}

// Standard header
$layout = n2mu_get_header_layout();
$classes = n2mu_get_header_classes();

echo '<header class="n-header ';
echo '" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
echo '<div class="n-header-desktop '.esc_attr($classes). '">';
foreach ( array( 'top', 'middle', 'bottom' ) as $valign ) {
	echo '<div class="n-subheader at-' . $valign . '">';
	echo '<div class="n-subheader-inner';
	if ( isset( $layout[ $valign . '-fullwidth' ] ) AND $layout[ $valign . '-fullwidth' ] ) {
		echo ' container-fluid';
	} else {
		echo ' container';
	}
	echo '">';
	foreach ( array( 'left', 'center', 'right' ) as $halign ) {
		echo '<div class="n-subheader-cell at-' . $halign . '">';
		if ( isset( $layout[ $valign . '-' . $halign ] ) ) {
			n2mu_get_header_elem( $layout[$valign . '-' . $halign] );
		}
		echo '</div>';
	}
	echo '</div></div>';
}
echo '</div>';

// Mobile header
echo '<div class="n-header-mobile container">';
	echo '<div class="n-subheader at-middle">';
		echo '<div class="n-subheader-inner">';
			echo '<div class="n-subheader-cell at-left">';
				n2mu_get_header_elem('logo');
			echo '</div>';
			echo '<div class="n-subheader-cell at-right">';
				n2mu_get_header_elem('tools');
				n2mu_get_header_elem('menu_holder');
			echo '</div>';
		echo '</div>';
	echo '</div>';
	n2mu_get_nav_menu('mobile_menu');
echo '</div>';

echo '</header>';
