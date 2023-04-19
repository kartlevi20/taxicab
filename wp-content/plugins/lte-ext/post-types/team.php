<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Team
*/ 
$labels = array(
	'name'               => esc_html__( 'Team', 'lte-ext' ),
	'singular_name'      => esc_html__( 'Team', 'lte-ext' ),
	'menu_name'          => esc_html__( 'Team', 'lte-ext' ),
	'name_admin_bar'     => esc_html__( 'Team', 'lte-ext' ),
	'add_new'            => esc_html__( 'Add New', 'lte-ext' ),
	'add_new_item'       => esc_html__( 'Add New Team', 'lte-ext' ),
	'new_item'           => esc_html__( 'New Team', 'lte-ext' ),
	'edit_item'          => esc_html__( 'Edit Team', 'lte-ext' ),
	'view_item'          => esc_html__( 'View Team', 'lte-ext' ),
	'all_items'          => esc_html__( 'All Team', 'lte-ext' ),
	'search_items'       => esc_html__( 'Search Team', 'lte-ext' ),
	'parent_item_colon'  => esc_html__( 'Parent Team:', 'lte-ext' ),
	'not_found'          => esc_html__( 'No items found.', 'lte-ext' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'lte-ext' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-admin-users',	
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'team' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail')
);

register_post_type( 'team', $args );	

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
	'query_var'         => true,
//		'rewrite'           => array( 'slug' => 'Category' ),
);

register_taxonomy( 'team-category', array( 'team' ), $args );	

