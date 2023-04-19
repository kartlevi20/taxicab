<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * TGM Plugin Activation
 */

require_once get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';

if ( !function_exists('limme_action_theme_register_required_plugins') ) {

	function limme_action_theme_register_required_plugins() {

		$config = array(

			'id'           => 'limme',
			'menu'         => 'limme-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => false,
		);

		tgmpa( array(

			array(
				'name'      => esc_html__('Unyson', 'limme'),
				'slug'      => 'unyson',
				'source'   	=> 'http://updates.like-themes.com/plugins/unyson/unyson-fork.zip',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Elementor', 'limme'),
				'slug'      => 'elementor',
				'required'  => true,
			),			
			array(
				'name'      => esc_html__('LTE Extension', 'limme'),
				'slug'      => 'lte-ext',
				'source'   	=> get_template_directory() . '/inc/plugins/lte-ext.zip',
				'version'   => '1.3.8',
				'required'  => true,
			),									
			array(
				'name'      => esc_html__('Envato Market', 'limme'),
				'slug'      => 'envato-market',
				'source'   	=> get_template_directory() . '/inc/plugins/envato-market.zip',
				'required'  => false,
			),													
			array(
				'name'      => esc_html__('Breadcrumb-navxt', 'limme'),
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'limme'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'       => esc_html__('MailChimp for WordPress', 'limme'),
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
			),		
			array(
				'name'       => esc_html__('WooCommerce', 'limme'),
				'slug'       => 'woocommerce',
				'required'   => false,
			),
			array(
				'name'      => esc_html__('Post-views-counter', 'limme'),
				'slug'      => 'post-views-counter',
				'required'  => false,
			),
/*			
			array(
				'name'      => esc_html__('Booking Calendar', 'limme'),
				'slug'      => 'booking',
				'required'  => false,
			),			
*/			
		), $config);
	}
}

add_action( 'tgmpa_register', 'limme_action_theme_register_required_plugins' );

