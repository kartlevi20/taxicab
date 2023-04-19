<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * LT-Ext Plugin Functions
 */

include LTE_PLUGIN_DIR . 'inc/dashboard.php';
include LTE_PLUGIN_DIR . 'inc/post-cats.php';
include LTE_PLUGIN_DIR . 'inc/font-awesome-5.php';
include LTE_PLUGIN_DIR . 'inc/shortcodes.php';
include LTE_PLUGIN_DIR . 'inc/update.php';


// Get Local Path of include file
function lteGetLocalPath($file) {

	global $lte_cfg;

	return $lte_cfg['path'].$lte_cfg['base'].$file;
}

// Get Plugin Url
function lteGetPluginUrl($file) {

	global $lte_cfg;

	return $lte_cfg['url'].$file;
}

// Get Visual Composer plugin status
if ( !function_exists( 'lte_vc_inited' ) ) {

	function lte_vc_inited() {
		
		return class_exists('Vc_Manager');
	}
}

// Get Elementor plugin status
if ( !function_exists( 'lte_elementor_inited' ) ) {
	
	function lte_elementor_inited() {

		return class_exists('Elementor\Plugin');
	}
}


// Generate img url
if (!function_exists('lte_get_attachment_img_url')) {
	function lte_get_attachment_img_url( $img, $size = 'full' ) {

		if ($img > 0) {

			return wp_get_attachment_image_src($img, $size);
		}
	}
}

if ( !function_exists( 'lte_is_wc' ) ) {
	/**
	 * Return true|false is woocommerce conditions.
	 *
	 * @param string $tag
	 * @param string|array $attr
	 *
	 * @return bool
	 */
	function lte_is_wc($tag, $attr='') {
		if( !class_exists( 'woocommerce' ) ) return false;
		switch ($tag) {
			case 'wc_active':
		        return true;
			
		    case 'woocommerce':
		        if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) return true;
				break;
		    case 'shop':
		        if( function_exists( 'is_shop' ) && is_shop() ) return true;
				break;
			case 'product_category':
		        if( function_exists( 'is_product_category' ) && is_product_category($attr) ) return true;
				break;
		    case 'product_tag':
		        if( function_exists( 'is_product_tag' ) && is_product_tag($attr) ) return true;
				break;
		    case 'product':
		    	if( function_exists( 'is_product' ) && is_product() ) return true;
				break;
		    case 'cart':
		        if( function_exists( 'is_cart' ) && is_cart() ) return true;
				break;
		    case 'checkout':
		        if( function_exists( 'is_checkout' ) && is_checkout() ) return true;
				break;
		    case 'account_page':
		        if( function_exists( 'is_account_page' ) && is_account_page() ) return true;
				break;
		    case 'wc_endpoint_url':
		        if( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url($attr) ) return true;
				break;
		    case 'ajax':
		        if( function_exists( 'is_ajax' ) && is_ajax() ) return true;
				break;
		}

		return false;
	}
}

/**
 * Return allowabale or default metric
 */
function lte_vc_get_metric($item) {

	$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
	// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
	$regexr = preg_match( $pattern, $item, $matches );
	$value = isset( $matches[1] ) ? (float) $matches[1] : (float) $item;
	$unit = isset( $matches[2] ) ? $matches[2] : 'px';

	return $value . $unit;
}

/**
 * Fix for widgets without header
 */
add_filter( 'dynamic_sidebar_params', 'lte_check_sidebar_params' );
function lte_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	// Exclude for widget with default title
	if ( in_array( $params[0]['widget_name'], array( 'Categories', 'Archives', 'Meta', 'Pages', 'Recent Comments', 'Recent Posts' ) ) ) {

		return $params;
	}

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0]['after_widget'] === '</div></aside>' && isset( $settings['title'] ) && empty( $settings['title'] ) ) {

		$params[0]['before_widget'] .= '<div class="content">';
	}

	return $params;
}

if (!function_exists('lte_string_parse')) {

	function lte_string_parse($item) {

		$item = str_replace(array('{{', '}}'), array('<span>', '</span>'), $item);
		$item = str_replace(array('{+}'), array('<span class="ul-yes fa fa-check"></span>'), $item);
		$item = str_replace(array('{-}'), array('<span class="ul-no fa fa-close"></span>'), $item);

		return $item;
	}
}



/**
 * Cuts text by the number of characters
 */
if ( !function_exists( 'lte_cut_text' ) ) {

	function lte_cut_text( $text, $cut = 300, $aft = ' ...' ) {
		if ( empty( $text ) ) {
			return null;
		}

		if ( empty($cut) AND function_exists( 'fw' ) ) {
			$cut = (int) fw_get_db_settings_option( 'excerpt_wc_auto' );
		}

		$text = wp_strip_all_tags( $text, true );
		$text = strip_tags( $text );
		$text = preg_replace( "/<p>|<\/p>|<br>|(( *&nbsp; *)|(\s{2,}))|\\r|\\n/", ' ', $text );
		if ( mb_strlen( $text ) > $cut ) {
			$text = mb_substr( $text, 0, $cut, 'UTF-8' );
			return mb_substr( $text, 0, mb_strripos( $text, ' ', 0, 'UTF-8' ), 'UTF-8' ) . $aft;
		} else {
			return $text;
		}
	}
}


if ( !function_exists('lte_enable_extended_upload') ) {

    function lte_enable_extended_upload ( $mime_types =array() ) {

	    $mime_types['ttf']  = 'application/x-font-ttf';
	    $mime_types['woff']  = 'application/x-font-woff';
	    $mime_types['woff2'] = 'application/x-font-woff2';
	    $mime_types['svg'] = 'image/svg+xml';
	    $mime_types['eot'] = 'application/vnd.ms-fontobject';
	    $mime_types['css'] = 'text/plain';

	    return $mime_types;
    }

    if ( is_admin() )  {

	    add_filter('upload_mimes', 'lte_enable_extended_upload');
    }
}

/**
 * Initialazing WP Filesystem
 * https://codex.wordpress.org/Filesystem_API
 */
if ( !function_exists('lte_wp_filesystem') ) {

	function lte_wp_filesystem() {

        if( !function_exists('WP_Filesystem') ) {

            require_once( ABSPATH .'/wp-admin/includes/file.php' );
        }

		if (is_admin()) {

			$creds = false;
			if ( function_exists('request_filesystem_credentials') ) {

				$url = wp_nonce_url('themes.php?page=example','example-theme-options');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {

					return; // stop processing here
				}
			}
	
			if ( !WP_Filesystem( $creds ) ) {

				if ( function_exists('request_filesystem_credentials') ) {

					request_filesystem_credentials( $url, '', true, false );
				}

				return false;
			}
			
			return true; // Filesystem object successfully initiated.
		}
			else {

            WP_Filesystem();
		}

		return true;
	}

	add_action( 'after_setup_theme', 'lte_wp_filesystem', 0);
}


/**
 * Enqueue file with latest version from filemtime
 */
if ( !function_exists('lte_wp_enqueue')) {

	function lte_wp_enqueue($type = null, $handle = null, $src = null, $deps = array()) {

		if ( empty($type) OR empty($handle) OR empty($src) ) {

			return false;
		}

		if ( $type == 'script' ) {

			wp_enqueue_script( $handle, lteGetPluginUrl($src), $deps, filemtime(lteGetLocalPath('/'.$src)), true );

		}
			else
		if ( $type == 'style' ) {

			wp_enqueue_style( $handle, lteGetPluginUrl($src), $deps, filemtime(lteGetLocalPath('/'.$src)) );
		}
	}
}

/**
 * Checking active status of plugin
 */
if ( !function_exists( 'lte_plugin_is_active' ) ) {
	
	function lte_plugin_is_active( $plugin_var, $plugin_dir = null ) {

		if ( empty( $plugin_dir ) ) {

			$plugin_dir = $plugin_var;
		}

		return in_array( $plugin_dir . '/' . $plugin_var . '.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}
}

/**
 * Decodes multistring array
 */
if (!function_exists('lte_html_decode')) {
	
	function lte_html_decode($string) {
		if ( is_array($string) && count($string) > 0 ) {
			foreach ($string as $key => &$value) {
				if (is_string($value)) {

					$value = htmlspecialchars_decode($value, ENT_QUOTES);
				}
			}
		}
		return $string;
	}
}

if ( !function_exists('lte_elementor_clear_cache') ) {


}

add_filter( 'big_image_size_threshold', '__return_false' );



