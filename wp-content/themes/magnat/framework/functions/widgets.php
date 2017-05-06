<?php
        
function n2mu_load_widgets() {

    register_widget('n2mu_latest_widget');
    register_widget('n2mu_contact_info_widget');

}   
add_action( 'widgets_init', 'n2mu_load_widgets' );


/**
 * Latest Posts Widget
 */
class n2mu_latest_widget extends WP_Widget {

        function n2mu_latest_widget() {
            $widget_ops = array('description' => 'magnat Latest Posts');
            $this->__construct('n2mu_latest', 'magnat Latest Posts', $widget_ops);
        }

        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? '&nbsp;' : '<span>'.apply_filters('widget_title', wp_kses_post($instance['title'])).'</span>';
            $count = wp_kses_post($instance['count']);

            echo $before_title . $title . $after_title;
            wp_reset_postdata();

            $recent_posts = new WP_Query(
                array(
                    'posts_per_page' => $count,
                    'post_status' => 'publish',
                    'nopaging' => 0,
                    'post__not_in' => get_option('sticky_posts')
                    )
                );

            // Cycle through Posts    
            if ($recent_posts->have_posts()) :while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>

            <div class="n2mu-latest-posts-single">
                <a href="<?php the_permalink() ?>" class="n2mu-latest-post-link"><?php the_post_thumbnail('n2mu_thumb', array( 'title' => get_the_title() )); ?></a>
                <p class="n2mu-latest-posts-single-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                <p class="date"><?php echo get_the_date();?></p>
            </div>
                <?php
                endwhile;
                endif;
                wp_reset_postdata();

                echo $after_widget;
            }

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);

                $instance['count'] = $new_instance['count'];

                return $instance;
            }

            function form($instance) {
                $instance = wp_parse_args((array) $instance, array('title' => '', 'count' => ''));
                $title = strip_tags($instance['title']);

                $count = $instance['count'];
                ?>


                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Widget Title', 'magnat' ) ?>:
                        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                    </label>
                </p>

                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'How many posts? (Number)', 'magnat' ) ?>:
                        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
                    </label>
                </p>

                <?php
            }

}


/**
 * Contact Info Widget
 */
class n2mu_contact_info_widget extends WP_Widget {
	
	function n2mu_contact_info_widget()
	{
		$widget_ops = array('classname' => 'contact_info', 'description' => '');
		$this->__construct('contact_info-widget', 'magnat: Contact Info', $widget_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.esc_html($title).$after_title;
		}
		?>
        <?php if($instance['address']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-location-arrow"></i> <?php echo wp_kses_post($instance['address']); ?></div>
		<?php endif; ?>

		<?php if($instance['phone']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-phone"></i> <?php echo wp_kses_post($instance['phone']); ?></div>
		<?php endif; ?>

        <?php if($instance['phone2']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-tablet"></i> <?php echo wp_kses_post($instance['phone2']); ?></div>
		<?php endif; ?>

        <?php if($instance['fax']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-print"></i> <?php echo wp_kses_post($instance['fax']); ?></div>
		<?php endif; ?>

		<?php if($instance['email']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo antispambot(esc_html($instance['email'])); ?>"><?php echo antispambot(esc_html($instance['email'])); ?></a></div>
		<?php endif; ?>

        <?php if($instance['web']): ?>
		<div class="n2mu-contact-widget-single"><i class="fa fa-globe"></i> <?php echo wp_kses_post($instance['web']); ?></div>
		<?php endif; ?>
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
        $instance['phone2'] = $new_instance['phone2'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['web'] = $new_instance['web'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Contact Info', 'phone' => '', 'phone2' => '', 'fax' => '', 'email' => '', 'address' => '', 'web' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo wp_kses_post($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html($this->get_field_id('address')); ?>"><?php esc_html_e( 'Address', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" value="<?php echo wp_kses_post($instance['address']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html($this->get_field_id('phone')); ?>"><?php esc_html_e( 'Phone', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" value="<?php echo wp_kses_post($instance['phone']); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_html($this->get_field_id('phone2')); ?>"><?php esc_html_e( 'Mobile phone', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone2')); ?>" name="<?php echo esc_attr($this->get_field_name('phone2')); ?>" value="<?php echo wp_kses_post($instance['phone2']); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_html($this->get_field_id('fax')); ?>"><?php esc_html_e( 'Fax', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" value="<?php echo wp_kses_post($instance['fax']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html($this->get_field_id('email')); ?>"><?php esc_html_e( 'Email', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" value="<?php echo wp_kses_post($instance['email']); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_html($this->get_field_id('web')); ?>"><?php esc_html_e( 'Web', 'magnat' ) ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('web')); ?>" name="<?php echo esc_attr($this->get_field_name('web')); ?>" value="<?php echo wp_kses_post($instance['web']); ?>" />
		</p>
	<?php
	}
} 