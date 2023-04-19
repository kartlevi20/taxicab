<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Header for theme
 *
 * Displays all of the <head>
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php

	/* WordPress 5.2 compatibility */
	if ( function_exists( 'wp_body_open' ) ) {

	    wp_body_open();
	}
		else {

		do_action( 'wp_body_open' );
	}

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {		
	
		get_template_part( 'tmpl/pageheader' ); 
	}

	do_action( 'limme_wrapper_open' );

?>