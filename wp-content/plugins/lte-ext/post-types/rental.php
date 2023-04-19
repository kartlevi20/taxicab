<?php


// Rentals
$labels = array(
	'name'               => esc_html__( 'Rental', 'lte-ext' ),
	'singular_name'      => esc_html__( 'Rental', 'lte-ext' ),
	'menu_name'          => esc_html__( 'Rental', 'lte-ext' ),
	'name_admin_bar'     => esc_html__( 'Rental', 'lte-ext' ),
	'add_new'            => esc_html__( 'Add New', 'lte-ext' ),
	'add_new_item'       => esc_html__( 'Add New Rental', 'lte-ext' ),
	'new_item'           => esc_html__( 'New Rental', 'lte-ext' ),
	'edit_item'          => esc_html__( 'Edit Rental', 'lte-ext' ),
	'view_item'          => esc_html__( 'View Rental', 'lte-ext' ),
	'all_items'          => esc_html__( 'All Rental', 'lte-ext' ),
	'search_items'       => esc_html__( 'Search Rental', 'lte-ext' ),
	'parent_item_colon'  => esc_html__( 'Parent Rental:', 'lte-ext' ),
	'not_found'          => esc_html__( 'No items found.', 'lte-ext' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'lte-ext' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-post-status',	
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'rentals' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail'),
	'taxonomies' 		 => array('rental-category', 'rental-post_tag', 'rental-brand')
);

register_post_type( 'rental', $args );	


$labels = array(
	'name'              => __( 'Categories', 'lte-ext' ),
	'singular_name'     => __( 'Category', 'lte-ext' ),
	'search_items'      => __( 'Search Categories', 'lte-ext' ),
	'all_items'         => __( 'All Categories', 'lte-ext' ),
	'parent_item'       => __( 'Parent Category', 'lte-ext' ),
	'parent_item_colon' => __( 'Parent Category', 'lte-ext' ) . ':',
	'edit_item'         => __( 'Edit Category', 'lte-ext' ),
	'update_item'       => __( 'Update Category', 'lte-ext' ),
	'add_new_item'      => __( 'Add New Category', 'lte-ext' ),
	'new_item_name'     => __( 'New Category Name', 'lte-ext' ),
	'menu_name'         => __( 'Category', 'lte-ext' ),
);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'show_in_nav_menus'	=> false,
	'public'			=> false,
	'query_var'         => false,
	'has_archive'        => false,
//		'rewrite'           => array( 'slug' => 'Category' ),
);

register_taxonomy( 'rental-category', array( 'rental' ), $args );	


$labels = array(
	'name'              => __( 'Tags', 'lte-ext' ),
	'singular_name'     => __( 'Tag', 'lte-ext' ),
	'search_items'      => __( 'Search Tags', 'lte-ext' ),
	'all_items'         => __( 'All Categories', 'lte-ext' ),
	'parent_item'       => __( 'Parent Tag', 'lte-ext' ),
	'parent_item_colon' => __( 'Parent Tag', 'lte-ext' ) . ':',
	'edit_item'         => __( 'Edit Tag', 'lte-ext' ),
	'update_item'       => __( 'Update Tag', 'lte-ext' ),
	'add_new_item'      => __( 'Add New Tag', 'lte-ext' ),
	'new_item_name'     => __( 'New Tag Name', 'lte-ext' ),
	'menu_name'         => __( 'Tags', 'lte-ext' ),
);

$args = array(
	'hierarchical'      => false,
	'labels'            => $labels,
	'show_ui'           => true,
	'update_count_callback' => '_update_post_term_count',
	'query_var'         => true,
	'rewrite' => array( 'slug' => 'tag' ),
	'show_in_nav_menus'	=> false,
	'public'			=> false,
	'query_var'         => false,
);

register_taxonomy( 'rental-post_tag', array( 'rental' ), $args );	



$labels = array(
	'name'              => __( 'Brands', 'lte-ext' ),
	'singular_name'     => __( 'Brand', 'lte-ext' ),
	'search_items'      => __( 'Search Brands', 'lte-ext' ),
	'all_items'         => __( 'All Brands', 'lte-ext' ),
	'parent_item'       => __( 'Parent Brand', 'lte-ext' ),
	'parent_item_colon' => __( 'Parent Brand', 'lte-ext' ) . ':',
	'edit_item'         => __( 'Edit Brand', 'lte-ext' ),
	'update_item'       => __( 'Update Brand', 'lte-ext' ),
	'add_new_item'      => __( 'Add New Brand', 'lte-ext' ),
	'new_item_name'     => __( 'New Brand Name', 'lte-ext' ),
	'menu_name'         => __( 'Brands', 'lte-ext' ),
	'not_found'         => esc_html__( 'No items found.', 'lte-ext' ),
);

$args = array(
	'hierarchical'      => false,
	'labels'            => $labels,
	'show_ui'           => true,
	'query_var'         => true,
);

register_taxonomy( 'rental-brand', array( 'rental' ), $args );	


