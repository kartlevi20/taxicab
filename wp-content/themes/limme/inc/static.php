<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Include static files
 * Some theme-specific frontend styles are also included in theme-config.php
 */

if ( is_admin() ) {

	return;
}

/**
 * Importing icon packs
 */
if ( function_exists( 'FW' ) ) {

	fw()->backend->option_type( 'icon-v2' )->packs_loader->enqueue_frontend_css();
}
	else {
	
	wp_enqueue_style(  'font-awesome', get_template_directory_uri().'/assets/fonts/font-awesome/css/all.min.css', array(), wp_get_theme()->get('Version') );
	wp_enqueue_style(  'font-awesome-shims', get_template_directory_uri().'/assets/fonts/font-awesome/css/v4-shims.min.css', array(), wp_get_theme()->get('Version') );	
}

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

	wp_enqueue_script( 'comment-reply' );
}



/**
 * Loading javascript plugins and custom limme js scripts
 */
wp_enqueue_script('jquery-masonry');

wp_enqueue_script('matchheight', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array( 'jquery' ), '', true );
wp_enqueue_script('nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.js', array( 'jquery' ), '3.7.6.0', true );
wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );
wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.js', array( 'jquery' ), '3.3.4', true );
wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2.min.js', array( 'jquery' ), '2.6.2', false );
wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/waypoint.js', array( 'jquery' ), '1.6.2', true );
wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/parallax.min.js', array(), '1.1.3', true );

wp_enqueue_script('limme-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );

wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', array( 'jquery' ), '1.1.0', true );
wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.1.0' );


/**
 * Loading Pace Page Loader if enabled
 */
if ( function_exists( 'FW' ) ) {

	$limme_pace = fw_get_db_settings_option( 'page-loader' );
	if ( !empty($limme_pace) AND ((!empty($limme_pace['loader']) AND $limme_pace['loader'] != 'disabled') OR 
	( !empty($limme_pace) AND $limme_pace['loader'] != 'disabled') ) ) {

		wp_enqueue_script('pace', get_template_directory_uri() . '/assets/js/pace.js', array( 'jquery' ), '', true );
	}

}

/**
 * Font Awesome Init
 */
if ( !function_exists('limme_fa_init')) {

	function limme_fa_init() {

		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style(  'font-awesome',  get_template_directory_uri().'/assets/fonts/font-awesome/css/all.min.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style(  'font-awesome-shims',  get_template_directory_uri().'/assets/fonts/font-awesome/css/v4-shims.min.css', array(), wp_get_theme()->get('Version') );

		limme_get_fontello_generate();
	}
}

/**
 * Customization
 */
if ( function_exists( 'FW' ) ) {

	require_once get_template_directory() . '/inc/theme-style/theme-style.php';
	wp_add_inline_style( 'limme-theme-style', limme_generate_css() );
}
	else {

	wp_enqueue_style( 'limme-google-fonts', limme_font_url(), array(), null );
}



