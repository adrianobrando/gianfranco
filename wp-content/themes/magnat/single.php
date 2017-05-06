<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
get_header(); ?>

<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();
?>

<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
	<?php 
	// Check Sidebar Layout
	global $post;
	$sidebar_layout = n2mu_get_option('layout-post', NULL, 'layout-post-custom');
	?>
	<div class="container">
		<div class="row">	
			<?php

			// IF Sidebar Left
			if($sidebar_layout == '2' OR $sidebar_layout == '3'){
				get_sidebar( 'left' );
			}

			if($sidebar_layout != '0' AND $sidebar_layout != '3'){
				echo "<div class='post_content col-md-9 col-sm-9 col-xs-12'>";
			} elseif($sidebar_layout == '3') {
				echo "<div class='post_content col-md-6 col-sm-6 col-xs-12'>";
			} else {
				echo "<div class='post_content col-md-12'>";
			}
			?>

			<?php get_template_part( 'templates/blog', 'single' ); ?>
						
			<?php 
			// Close "post_content"
			echo "</div>";


			// IF Sidebar Right
			if($sidebar_layout == '1' OR $sidebar_layout == '3'){
				get_sidebar( 'right' );
			}
			?>
		</div>
	</div>
</div>
<?php
endwhile; // End of the loop.
?>

	
<?php get_footer(); ?>	