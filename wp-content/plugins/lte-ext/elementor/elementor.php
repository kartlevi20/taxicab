<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Elementor Widgets Extension
 */

/**
 * Adding new widgets
 */
if ( !function_exists('lte_elementor_widgets_init') ) {

	
	function lte_elementor_widgets_init() {

		if ( function_exists('FW') ) {

			$shortcodes_array = array(

					'blog'					=>	true,
					'button'				=>	true,
					'countup'				=>	true,
					'cf7'					=>	true,
					'icons'					=>	true,			
					'instagram'				=>	true,
					'effects'				=>	true,
					'gallery'				=>	true,
					'googlemaps'			=>	true,
					'header'				=>	true,
//					'menu'					=>	true,
					'navmenu'				=>	true,
					'partners'				=>	true,
					'products'				=>	true,				
					'product-categories'	=>	true,				
					'rental'				=>	true,
					'rental-search'			=>	true,
					'services'				=>	true,
					'slide-background'		=>	true,
					'slider-full'			=>	true,
					'tariff'				=>	true,
					'team'					=>	true,
					'testimonials'			=>	true,
					'video'					=>	true,		
					'zoomslider'			=>	true,		
			);


			foreach ($shortcodes_array as $item => $enabled) {

				$include = lteGetLocalPath( '/elementor/shortcodes/' . $item . '/' . $item . '.php' );
				if ( $enabled AND file_exists( $include ) ) {

					include_once $include;

					$classname = 'LTE_'.ucwords(str_replace('-', '_', $item)).'_Widget';
					\Elementor\Plugin::instance()->widgets_manager->register( new $classname() );					
				}
			}
		}
	}
}
add_action( 'elementor/widgets/register', 'lte_elementor_widgets_init', 100 );


/**
 * Elementor Global Scripts Init
 */
if ( !function_exists('lte_elementor_scripts') ) {

	function lte_elementor_scripts() {

		wp_enqueue_script('jquery-paroller', lteGetPluginUrl('assets/js/jquery.paroller.min.js'), array('jquery'), '1.4.6' );
	}
}
add_action('wp_enqueue_scripts', 'lte_elementor_scripts', 20 );


/**
 * Adding new controls
 */
if ( !function_exists('lte_elementor_controls_init') ) {

	function lte_elementor_controls_init() {

		$shortcodes_array = array(

			'section'			=>	true,
			'image'			=>	true,
		);

		foreach ($shortcodes_array as $item => $enabled) {

			$include = lteGetLocalPath( '/elementor/controls/control-' . $item . '.php' );
			if ( $enabled AND file_exists( $include ) ) {

				include_once $include;
			}
		}
	}
}
add_action( 'elementor/controls/controls_registered', 'lte_elementor_controls_init', 100 );


function lte_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'lte_register_elementor_locations' );


/**
 * Adding custom categories
 */
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager = \Elementor\Plugin::instance()->elements_manager;

	$category_prefix = 'lte';

	$elements_manager->add_category(

		'lte-category',
		[
			'title' => esc_html__( 'Like Themes', 'lte-ext' ),
			'icon' => 'fa fa-plug',
		]
	);

    $reorder_cats = function() use( $category_prefix ) {

        uksort( $this->categories, function( $keyOne, $keyTwo ) use ( $category_prefix ){

            if ( substr($keyOne, 0, 3) == $category_prefix ) {

                return -1;
            }

            if ( substr($keyTwo, 0, 3) == $category_prefix ) {

                return 1;
            }

            return 0;
        });

    };
    $reorder_cats->call($elements_manager);	

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


/**
 * Displays shortcode entry
 * Every shortcode carefully checks the output and generates the secure and escaped content
 */
if ( !function_exists( 'lte_sc_output' ) ) {

	function lte_sc_output( $sc, $args ) {	

		$path = lteGetLocalPath('/elementor/shortcodes/'.$sc.'/view.php');
		ob_start();
		if (file_exists($path)) {

			include $path;
		}
		$out_escaped = ob_get_contents();
		ob_end_clean();

		echo $out_escaped;
	}
}

require_once LTE_PLUGIN_DIR . 'elementor/fontello/fontello.php';

function lte_add_cpt_support() {
    
	$cpt_support = get_option( 'elementor_cpt_support' );
	
	if( ! $cpt_support ) {
	    $cpt_support = [ 'page', 'post' ];
	    update_option( 'elementor_cpt_support', $cpt_support );
	}	

	if ( !in_array( 'sliders', $cpt_support ) ) {
	    $cpt_support[] = 'sliders';
	    update_option( 'elementor_cpt_support', $cpt_support );
	}

	if ( !in_array( 'sections', $cpt_support ) ) {
	    $cpt_support[] = 'sections';
	    update_option( 'elementor_cpt_support', $cpt_support );
	}

	if ( !in_array( 'team', $cpt_support ) ) {
	    $cpt_support[] = 'team';
	    update_option( 'elementor_cpt_support', $cpt_support );
	}	
}
add_action( 'init', 'lte_add_cpt_support' );

/**
 * Clearing old elementor css cache files
 */
if ( !function_exists('lte_clear_elementor_cache') ) {
	
	function lte_clear_elementor_cache() {

		if ( class_exists("\\Elementor\\Plugin") ) {

			delete_post_meta_by_key( '_elementor_css' );
			delete_option( '_elementor_global_css' );
			delete_option( 'elementor-custom-breakpoints-files' );

			$dir = wp_get_upload_dir();
			$dir = $dir['basedir'];				
			$path = $dir . '/elementor/css/' . '*';

			if ( !empty(glob( $path )) ) {

				foreach ( glob( $path ) as $file_path ) {
					unlink( $file_path );
				}		
			}			
		}
		
	}
}

add_action('fw:ext:backups:tasks:before_process', 'lte_clear_elementor_cache');



add_filter( 'elementor/divider/styles/additional_styles', function( $additional_styles ) {
/*
				'slashes' => [
					'label' => _x( 'Slashes', 'shapes', 'elementor' ),
					'shape' => '<g transform="translate(-12.000000, 0)"><path d="M28,0L10,18"/><path d="M18,0L0,18"/><path d="M48,0L30,18"/><path d="M38,0L20,18"/></g>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'view_box' => '0 0 20 16',
					'group' => 'line',
				],


				'arrows'   => [
					'label' => _x( 'Arrows', 'shapes', 'elementor' ),
					'shape' => '<path d="M14.2,4c0.3,0,0.5,0.1,0.7,0.3l7.9,7.2c0.2,0.2,0.3,0.4,0.3,0.7s-0.1,0.5-0.3,0.7l-7.9,7.2c-0.2,0.2-0.4,0.3-0.7,0.3s-0.5-0.1-0.7-0.3s-0.3-0.4-0.3-0.7l0-2.9l-11.5,0c-0.4,0-0.7-0.3-0.7-0.7V9.4C1,9,1.3,8.7,1.7,8.7l11.5,0l0-3.6c0-0.3,0.1-0.5,0.3-0.7S13.9,4,14.2,4z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => true,
					'round' => true,
					'group' => 'pattern',
				],
*/

	$additional_styles['lte_wave'] = [
					'label' => _x( 'Wavy Alt', 'shapes', 'elementor' ),
					'shape' => '<path d="M496,256.2c-11.8-0.1-17.6-3.6-23.8-7.4c-6.2-3.8-12.5-7.7-25.1-7.7s-19,3.9-25.1,7.7c-6.2,3.8-12.1,7.4-24.1,7.4c-12,0-17.9-3.6-24.1-7.4c-6.2-3.8-12.5-7.7-25.1-7.7c-12.6,0-19,3.9-25.1,7.7c-6.2,3.8-12.1,7.4-24.1,7.4c-12,0-17.9-3.6-24.1-7.4c-6.2-3.8-12.5-7.7-25.1-7.7s-19,3.9-25.1,7.7c-6.2,3.8-12.1,7.4-24.1,7.4c-12.1,0-17.9-3.6-24.1-7.4c-6.2-3.8-12.6-7.7-25.1-7.7s-19,3.9-25.1,7.7c-6.2,3.8-12.1,7.4-24.1,7.4s-17.9-3.6-24.1-7.4c-6.2-3.8-12.6-7.7-25.1-7.7s-19,3.9-25.1,7.7c-6.2,3.8-12.1,7.4-24.1,7.4v1.9c12.6,0,19-3.9,25.1-7.7c6.2-3.8,12.1-7.4,24.1-7.4s17.9,3.6,24.1,7.4c6.2,3.8,12.6,7.7,25.1,7.7s19-3.9,25.1-7.7c6.2-3.8,12.1-7.4,24.1-7.4s17.9,3.6,24.1,7.4c6.2,3.8,12.6,7.7,25.1,7.7s19-3.9,25.1-7.7c6.2-3.8,12.1-7.4,24.1-7.4c12.1,0,17.9,3.6,24.1,7.4c6.2,3.8,12.5,7.7,25.1,7.7c12.6,0,19-3.9,25.1-7.7c6.2-3.8,12.1-7.4,24.1-7.4c12,0,17.9,3.6,24.1,7.4c6.2,3.8,12.5,7.7,25.1,7.7c12.6,0,19-3.9,25.1-7.7c6.2-3.8,12.1-7.4,24.1-7.4c12,0,17.9,3.6,24.1,7.4c6.1,3.8,12.4,7.7,24.8,7.7L496,256.2L496,256.2z"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				];

	return $additional_styles;
});

