<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Menus
*/ 
$labels = array(
	'name'               => esc_html__( 'Menus', 'lte-ext' ),
	'singular_name'      => esc_html__( 'Menu', 'lte-ext' ),
	'menu_name'          => esc_html__( 'Menus', 'lte-ext' ),
	'name_admin_bar'     => esc_html__( 'Menus', 'lte-ext' ),
	'add_new'            => esc_html__( 'Add New', 'lte-ext' ),
	'add_new_item'       => esc_html__( 'Add New Menu', 'lte-ext' ),
	'new_item'           => esc_html__( 'New Menu', 'lte-ext' ),
	'edit_item'          => esc_html__( 'Edit Menu', 'lte-ext' ),
	'view_item'          => esc_html__( 'View Menu', 'lte-ext' ),
	'all_items'          => esc_html__( 'All Menus', 'lte-ext' ),
	'search_items'       => esc_html__( 'Search Menus', 'lte-ext' ),
	'parent_item_colon'  => esc_html__( 'Parent Menu:', 'lte-ext' ),
	'not_found'          => esc_html__( 'No items found.', 'lte-ext' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'lte-ext' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'show_in_rest'       => true,
	'menu_icon'			 => 'dashicons-editor-ul',	
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'menu' ),
	'capability_type'    => 'post',
	'has_archive'        => false,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail')
);

register_post_type( 'lte-menu', $args );	


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
	'menu_name'         => __( 'Categories', 'lte-ext' ),
);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
);

register_taxonomy( 'lte-menu-category', array( 'lte-menu' ), $args );	

