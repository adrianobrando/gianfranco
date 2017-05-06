<?php 

get_header(); ?>

<div class="container">
	<div class="wrapper">
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
			
	<ul class="search-res">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<li>
			<div class="search-item">
					<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<span> <?php echo esc_html(get_the_date()); ?> </span>
					</h5>
			</div>
		</li>
	<?php endwhile; ?>
	
	<?php n2mu_pagination($pages = '', $range = 2); ?>
	
	</ul>
	
	<?php else: ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.','magnat'); ?></p>
	<?php endif; // Loop End  ?>

<?php 

echo "</div>";

	// IF Sidebar Right
	if($sidebar_layout == '1' OR $sidebar_layout == '3'){
		get_sidebar( 'right' );
	}
	?>
	</div>	
</div>

<?php get_footer(); ?>	