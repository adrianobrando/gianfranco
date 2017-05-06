<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'n2mu_create_post_types', 8 );
function n2mu_create_post_types() {
	// Portfolio post type
	register_post_type( 'n2mu_portfolio', array(
		'labels' => array(
			'name' => __( 'Portfolio', 'magnat-core' ),
			'singular_name' => __( 'Portfolio Item', 'magnat-core' ),
			'add_new' => __( 'Add Portfolio Item', 'magnat-core' ),
		),
		'public' => TRUE,
		'rewrite' => array( 'slug' => __( 'portfolio-item', 'magnat-core' ) ),
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
		'can_export' => TRUE,
		'capability_type' => 'n2mu_portfolio',
		'map_meta_cap' => TRUE,
		'menu_icon' => 'dashicons-images-alt',
	) );

	// Portfolio categories
	register_taxonomy( 'n2mu_portfolio_category', array( 'n2mu_portfolio' ), array(
		'hierarchical' => TRUE,
		'label' => __( 'Portfolio Categories', 'magnat-core' ),
		'singular_label' => __( 'Portfolio Category', 'magnat-core' ),
		'rewrite' => array( 'slug' => __( 'portfolio_category', 'magnat-core' ) ),
	) );



	// Portfolio slug may have changed, so we need to keep WP's rewrite rules fresh
	if ( get_transient( 'magnat_flush_rules' ) ) {
		flush_rewrite_rules();
		delete_transient( 'magnat_flush_rules' );
	}

	// Testimonials
	register_post_type( 'n2mu_testimonial', array(
		'labels' => array(
			'name' => __( 'Testimonials', 'magnat-core' ),
			'singular_name' => __( 'Testimonial', 'magnat-core' ),
			'add_new' => __( 'Add Testimonial', 'magnat-core' ),
		),
		'public' => TRUE,
		'rewrite' => array( 'slug' => 'testimonial' ),
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'can_export' => TRUE,
		'publicly_queryable'  => FALSE,
		'map_meta_cap' => TRUE,
		'menu_icon' => 'dashicons-images-alt',
		'exclude_from_search' => TRUE,
	) );
}



add_filter( 'manage_n2mu_portfolio_posts_columns', 'n2mu_manage_portfolio_columns' );
function n2mu_manage_portfolio_columns( $columns ) {
	$columns['n2mu_portfolio_category']  = __( 'Categories', 'magnat-core' );
	if (isset($columns['comments'])) {
		$title = $columns['comments'];
		unset($columns['comments']);
		$columns['comments'] = $title;
	}
	if (isset($columns['date'])) {
		$title = $columns['date'];
		unset($columns['date']);
		$columns['date'] = $title;
	}

	return $columns;
}

add_action( 'manage_n2mu_portfolio_posts_custom_column', 'n2mu_manage_portfolio_custom_column', 10, 2 );
function n2mu_manage_portfolio_custom_column( $column_name, $post_id ) {
	if ($column_name == 'n2mu_portfolio_category') {
		if ( ! $terms = get_the_terms( $post_id, $column_name ) ) {
			echo '<span class="na">&ndash;</span>';
		} else {
			$termlist = array();
			foreach ( $terms as $term ) {
				$termlist[] = '<a href="' . admin_url( 'edit.php?' . $column_name . '=' . $term->slug . '&post_type=n2mu_portfolio' ) . ' ">' . $term->name . '</a>';
			}

			echo implode( ', ', $termlist );
		}
	}
}


add_action( 'admin_init', 'n2mu_add_theme_caps' );
function n2mu_add_theme_caps() {
	global $wp_post_types;
	$role = get_role( 'administrator' );
	$force_refresh = FALSE;
	$custom_post_types = array( 'n2mu_portfolio' );
	foreach ( $custom_post_types as $post_type ) {
		if ( ! isset( $wp_post_types[ $post_type ] ) ) {
			continue;
		}
		foreach ( $wp_post_types[ $post_type ]->cap as $cap ) {
			if ( ! $role->has_cap( $cap ) ) {
				$role->add_cap( $cap );
				$force_refresh = TRUE;
			}
		}
	}
	if ( $force_refresh AND current_user_can( 'manage_options' ) AND ! isset( $_COOKIE['n2mu_cap_page_refreshed'] ) ) {
		// To prevent infinite refreshes when the DB is not writable
		setcookie( 'n2mu_cap_page_refreshed' );
		header( 'Refresh: 0' );
	}
}