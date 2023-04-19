<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Parses fontello css file and generates array with icons names
 */
if ( !function_exists( 'limme_get_fontello_icons' ) ) {

	function limme_get_fontello_icons( $css_uri ) {

		static $list = false;

		if ( !is_array($list) ) {

			$list = array();

			if ( is_admin() )  {

				$fontello = $css_uri;
				$file = limme_get_contents_array( $fontello );

				if ( empty($file) ) return $list;


				foreach ($file as $row) {

					if ( substr($row, 0, 1 ) == '.') {

						$i = explode(':', $row);

						if ( !empty($i[0]) ) {

							$list[] = substr($i[0], 1);
						}
					}
				}				
			}
		}

		return $list;
	}
}

/**
 * Getting file contents as array
 * https://codex.wordpress.org/Filesystem_API
 */
function limme_get_contents_array( $file ) {

    return explode( "\n", file_get_contents( $file ) );
}



/**
 * Get Fontello packs path
 */
if ( !function_exists('limme_get_fontello_path') ) {

	function limme_get_fontello_path() {

		if ( is_child_theme() AND file_exists(get_stylesheet_directory() . '/assets/fontello/') ) {

			$fontello['css']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme-codes.css';
			$fontello['eot']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme.eot';
			$fontello['ttf']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme.ttf';
			$fontello['woff']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme.woff';
			$fontello['woff2']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme.woff2';
			$fontello['svg']['url'] = get_stylesheet_directory_uri() . '/assets/fontello/lte-limme.svg';
		}

		if ( empty($fontello) AND file_exists(get_template_directory() . '/assets/fontello/') ) {

			$fontello['css']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme-codes.css';
			$fontello['eot']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme.eot';
			$fontello['ttf']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme.ttf';
			$fontello['woff']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme.woff';
			$fontello['woff2']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme.woff2';
			$fontello['svg']['url'] = get_template_directory_uri() . '/assets/fontello/lte-limme.svg';
		}

		return $fontello;	
	}
}

/**
 * Get Fontello CSS file
 */
if ( !function_exists('limme_get_fontello_css') ) {

	function limme_get_fontello_css() {

		if ( !function_exists('FW')) {

			return false;
		}

		$fontello_local = fw_get_db_settings_option( 'fontello-local' );

		if ( is_child_theme() AND file_exists(get_stylesheet_directory() . '/assets/fontello/lte-limme-codes.css') ) {

			$file = get_stylesheet_directory() . '/assets/fontello/lte-limme-codes.css';
		}
			else
		if ( file_exists(get_template_directory() . '/assets/fontello/') ) {

			$file = get_template_directory() . '/assets/fontello/lte-limme-codes.css';
		}
		
		if ( !empty($file) AND file_exists($file) ) {

			return $file;	
		}
			else {

			return false;
		}
	}
}

/**
 * Generating Fontello inline style and FontAwesome 5
 */
if ( !function_exists('limme_get_fontello_generate') ) {

	function limme_get_fontello_generate($admin_style = false) {
	
		$fontello = limme_get_fontello_path();	

		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style(  'font-awesome',  get_template_directory_uri().'/assets/fonts/font-awesome/css/all.min.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style(  'font-awesome-shims',  get_template_directory_uri().'/assets/fonts/font-awesome/css/v4-shims.min.css', array(), wp_get_theme()->get('Version') );

		if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

			wp_enqueue_style(  'limme-fontello',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );

			$randomver = wp_get_theme()->get('Version');
			$css_content = "@font-face {
			font-family: 'limme-fontello';
			  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."');
			  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."#iefix') format('embedded-opentype'),
			       url('". esc_url ( $fontello['woff2']['url']. "?" . $randomver )."') format('woff2'),
			       url('". esc_url ( $fontello['woff']['url']. "?" . $randomver )."') format('woff'),
			       url('". esc_url ( $fontello['ttf']['url']. "?" . $randomver )."') format('truetype'),
			       url('". esc_url ( $fontello['svg']['url']. "?" . $randomver )."#" . pathinfo(wp_basename( $fontello['svg']['url'] ), PATHINFO_FILENAME)  . "') format('svg');
			  font-weight: normal;
			  font-style: normal;
			}";

			if ( $admin_style )  {

				wp_add_inline_style( 'limme-fontello', $css_content );

			}
				else {

				wp_add_inline_style( 'limme-theme-style', $css_content );
			}

		}
	}
}

