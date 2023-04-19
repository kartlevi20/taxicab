<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Config
 */

$lte_cfg = array(

	'path'	=> plugin_dir_path(__DIR__),
	'base' 	=> plugin_basename(__DIR__),
	'url'	=> plugin_dir_url(__FILE__),

	'lte_sections'	=> array(),
);


add_action( 'after_setup_theme', 'lte_elementor_config', 4 );
if ( !function_exists('lte_elementor_config')) {

	function lte_elementor_config() {

		global $lte_cfg;

	    $value = array();
	    $value = apply_filters( 'lte_elementor_config', $value );

	    if ( empty($lte_cfg) ) $lte_cfg = [];

	    $lte_cfg = array_merge($lte_cfg, $value);

	    return $value;
	}
}

add_action( 'plugins_loaded', 'lte_load_plugin_textdomain' );
if ( !function_exists('lte_load_plugin_textdomain')) {
	function lte_load_plugin_textdomain() {

		apply_filters ('lte_filter_custom_css', array());

		load_plugin_textdomain( 'lte-ext', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}


add_action( 'widgets_init', 'lte_action_widgets_init' );
if ( !function_exists('lte_action_widgets_init')) {

	function lte_action_widgets_init() {

		$paths = array();

		/**
		 * Widgets list
		 */
		$parent_widgets = array(
			'icons',
			'blogposts',
			'gallery',
			'navmenu',
			'banner',
		);
		$parent_path = LTE_PLUGIN_DIR . 'widgets' ;

		/**
		 * Generating widgets include array
		 */
		$items = array();
		if ( !empty( $parent_widgets ) ) {

			foreach ( $parent_widgets as $item ) {

				$items[] = array( 'path' => $parent_path . '/' . $item , 'name' => $item );
			}
		}

		$included_widgets = array();
		if ( !empty( $items ) ) {

			foreach ( $items as $item ) {

				if ( isset( $included_widgets[ $item['name'] ] ) ) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[ $item['name'] ] = true;
				}

				include_once ( $item['path'] . '/class-widget-' . $item['name'] . '.php' );

				$widget_class = 'lte_Widget_' . lte_widget_classname( $item['name'] );
				if ( class_exists( $widget_class ) ) {

					register_widget( $widget_class );
				}
			}
		}
	}

	function lte_widget_classname( $widget_name ) {
		
		$class_name = explode( '-', $widget_name );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}	
}

add_action('wp_enqueue_scripts', 'lte_init_static', 1 );
if ( !function_exists('lte_init_static')) {

	function lte_init_static() {

		wp_register_script('swiper', lteGetPluginUrl('assets/js/swiper.min.js'), array( 'jquery' ), '5.3.8', true );
		wp_register_script('lte-frontend', lteGetPluginUrl('assets/js/frontend.js'), array( 'jquery', 'swiper' ), LTE_PLUGIN_VER, true );
	}
}

