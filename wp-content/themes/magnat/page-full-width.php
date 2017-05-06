<?php 

/*
Template Name: Full-width
*/

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); 
// Check Sidebar Layout
$sidebar_layout = n2mu_get_option('layout', NULL, 'layout-custom');

// IF Sidebar Left
if($sidebar_layout == '2' OR $sidebar_layout == '3'){
	get_sidebar( 'left' );
}

if($sidebar_layout != '0' AND $sidebar_layout != '3' AND $sidebar_layout){
	echo "<div class='page-content col-md-9 col-sm-9 col-xs-12 clearfix'>";
} elseif($sidebar_layout == '3') {
	echo "<div class='page-content col-md-6 col-sm-6 col-xs-12 clearfix'>";
} else {
	echo "<div class='page-content clearfix'>";
}
?>

<?php while (have_posts()) : the_post(); ?>
<?php the_content() ?>
<?php wp_link_pages(array(
	'before' => "<div class='pagination'><div class='links'>",
	'after' => "</div></div>",
	)); ?>
<?php endwhile; ?>

<?php
$show_page_comments	= n2mu_get_option('page-comments');
if($show_page_comments) { ?>
		<div class="page-comment-section clearfix clear">
			<?php comments_template('', true); ?>
		</div>
<?php } 

echo "</div>";

// IF Sidebar Right
if($sidebar_layout == '1' OR $sidebar_layout == '3'){
	get_sidebar( 'right' );
}



get_footer(); ?>	