<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class LTE_Elementor_Init {

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	const MINIMUM_PHP_VERSION = '5.6';

	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {

		if ( wp_get_theme()->get('TextDomain') !== 'limme' ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_theme_missing' ) );
			return;			
		}

		if ( ! did_action( 'elementor/loaded' ) ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		require_once( LTE_PLUGIN_DIR . 'elementor/elementor.php' );
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {

			unset( $_GET['activate'] );
		}
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'lte-ext' ),
			'<strong>' . esc_html__( 'LTE Extension', 'lte-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'lte-ext' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_theme_missing() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" Theme.', 'lte-ext' ),
			'<strong>' . esc_html__( 'LTE Extension', 'lte-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Limme', 'lte-ext' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'lte-ext' ),
			'<strong>' . esc_html__( 'LTE Extension', 'lte-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'lte-ext' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

new LTE_Elementor_Init();

