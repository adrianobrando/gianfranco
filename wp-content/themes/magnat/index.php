<?php 
/**
 * The Default template file.
 * 
 * @package WordPress
 */


get_header(); ?>

<div class="row posts-listing-wrapper">
<?php 
// Check Sidebar Layout
$sidebar_layout = n2mu_get_option('layout', NULL, 'layout-custom');

// IF Sidebar Left
if($sidebar_layout == '2' OR $sidebar_layout == '3'){
	get_sidebar( 'left' );
}

	if($sidebar_layout != '0' AND $sidebar_layout != '3'){
		echo '<div class="col-md-9 col-sm-9 col-xs-12">';
	} elseif($sidebar_layout == '3') {
		echo '<div class="col-md-6 col-sm-6 col-xs-12">';
	} else {
		echo '<div class="col-md-12 col-sm-12 col-xs-12">';
	}
	?>

	<?php get_template_part( 'templates/blog', 'listing' ); ?>

	</div>
	<?php
	// IF Sidebar Right
	if($sidebar_layout == '1' OR $sidebar_layout == '3'){
		get_sidebar( 'right' );
	}
	?>
</div>

<?php get_footer(); ?>	