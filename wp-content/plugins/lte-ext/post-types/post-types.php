<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

/**
  * Custom post types
  */
if ( !function_exists('lte_add_custom_post_types')) {

	function lte_add_custom_post_types() {

		$cpt = array(

			'gallery' 		=> true,
			'rental' 		=> true,
			'sections' 		=> true,
			'services' 		=> true,
			'sliders' 		=> true,
			'team' 			=> true,
			'testimonials' 	=> true,
		);

		foreach ($cpt as $item => $enabled) {

			$cpt_include = lteGetLocalPath( '/post-types/' . $item . '.php' );
			if ( $enabled AND file_exists( $cpt_include ) ) {

				include_once $cpt_include;
			}
		}	
	}
}
add_action( 'init', 'lte_add_custom_post_types' );


if ( !function_exists('lte_rewrite_flush')) {

	function lte_rewrite_flush() {

	    lte_add_custom_post_types();
	    flush_rewrite_rules();
	}
}
add_action( 'after_switch_theme', 'lte_rewrite_flush' );

