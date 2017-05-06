<?php 
if ( ! defined( 'ABSPATH' ) ) exit; ?>
	</div>
</main>
	<?php 
	$footer_disable = n2mu_get_post_meta('page-disable-footer');
	if(is_404()) {
		$footer_disable = '1';
	}
	if($footer_disable != '1') {
	?>
	<footer id="footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
	<?php
		get_template_part( 'templates/footer', 'top' );
		get_template_part( 'templates/footer', 'bottom' );
	?>

		<a href="#" class="gotoplink fa fa-angle-up"></a>
	</footer>
	<?php } 
  wp_footer(); ?>
</body>
</html>