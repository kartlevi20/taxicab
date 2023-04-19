<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
Plugin Name: LTE-Ext
Description: Requied plugin for Limme Elementor WordPress Theme
Version: 1.3.8
Author: Like-Themes
Email: support@like-themes.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/


define( 'LTE_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
define( 'LTE_PLUGIN_URL', plugins_url( "", __FILE__ ) . '/' );

$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$plugin_version = $plugin_data['Version'];
define( 'LTE_PLUGIN_VER', $plugin_version );

register_activation_hook( __FILE__, 'lte_plugin_activated' );

require_once LTE_PLUGIN_DIR . 'config.php';

require_once LTE_PLUGIN_DIR . 'inc/functions.php';

if ( did_action( 'elementor/loaded' ) ) {

	require_once LTE_PLUGIN_DIR . 'elementor/init.php';
}

require_once LTE_PLUGIN_DIR . 'post-types/post-types.php';


