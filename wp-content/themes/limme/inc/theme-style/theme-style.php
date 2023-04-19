<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Generating inline css styles for customization
 */

if ( !function_exists('limme_generate_css') ) {

	function limme_generate_css() {

		global $wp_query;

		include get_template_directory() . '/inc/theme-style/google-fonts.php';		

		// List of attributes
		$css = array(
			'main_color' 			=> true,
			'second_color' 			=> true,			
			'gray_color' 			=> true,
			'white_color' 			=> true,
			'black_color' 			=> true,			
			'red_color' 			=> true,			
			'green_color' 			=> true,			
			'yellow_color' 			=> true,			

			'nav_bg' 				=> true,
			'nav_opacity_top' 		=> true,
			'nav_opacity_scroll'	=> true,

			'border_radius' 		=> true,
		);

		// Escaping all the attributes
		$css_rgb = array();
		foreach ($css as $key => $item) {

			$css[$key] = esc_attr(fw_get_db_customizer_option($key));
			$css_rgb[$key] = sscanf(esc_attr(fw_get_db_customizer_option($key)), "#%02x%02x%02x");
		}

		// Setting different color scheme for page
		if ( function_exists( 'FW' ) ) {

			$limme_color_schemes = array();
			$limme_color_schemes_ = fw_get_db_settings_option( 'items' );

			if ( !empty($limme_color_schemes_) ) {
				
				foreach ($limme_color_schemes_ as $v) {

					$limme_color_schemes[$v['slug']] = $v;
				}			
			}
		}

		$limme_current_scheme =  apply_filters('limme_current_scheme', array());	
		if ($limme_current_scheme == 'default' OR empty($limme_current_scheme)) $limme_current_scheme = 1;

		if ( function_exists( 'FW' ) AND !empty($limme_current_scheme) ) {

			foreach (array(
					'main_color' => 'main-color',
					'second_color' => 'second-color',
					'gray_color' => 'gray-color',
					'black_color' => 'black-color') as $k => $v) {

				if ( !empty($limme_color_schemes[$limme_current_scheme][$v]) ) {

					$css[$k] = esc_attr($limme_color_schemes[$limme_current_scheme][$v]);
					$css_rgb[$k] = sscanf(esc_attr($limme_color_schemes[$limme_current_scheme][$v]), "#%02x%02x%02x");
				}
			}
		}


		$css['black_darker_color'] = limme_adjust_brightness($css['black_color'], -50);
		$css['main_darker_color'] = limme_adjust_brightness($css['main_color'], -30);
		$css['main_lighter_color'] = limme_adjust_brightness($css['main_color'], 30);

		$css = limme_get_google_fonts($css);		

		$theme_style = "";

		$theme_style .= "
			:root {
			  --main:   {$css['main_color']} !important;
			  --second:   {$css['second_color']} !important;
			  --gray:   {$css['gray_color']} !important;
			  --black:  {$css['black_color']} !important;
			  --white:  {$css['white_color']} !important;
			  --red:   {$css['red_color']} !important;
			  --yellow:   {$css['yellow_color']} !important;
			  --green:   {$css['green_color']} !important;";

			  foreach ( array('font-main', 'font-headers', 'font-subheaders') as $font ) {

			  	if ( !empty($css[$font]) ) {  		

					if ( $font == 'font-subheaders' ) {

				  		$theme_style .= "--font-addheaders: '{$css[$font]}' !important;";
					}
						else {

				  		$theme_style .= "--".$font.": '{$css[$font]}' !important;";
					}
					
			  		$letter_spacing = fw_get_db_settings_option( $font . '-letterspacing' );
			  		if ( !empty($letter_spacing) ) {

			  			$theme_style .= "--".$font."-letterspacing: ".esc_attr($letter_spacing).";";
			  		}
			  	}
			  }

		$theme_style .= "			  
			}		
		";


		/**
		 * Theme Specific inline styles
		 */
		if ( function_exists( 'FW' ) ) {

			// Default Header
			$header_bg = fw_get_db_settings_option( 'header_bg' );

			if ( !empty($header_bg) ) {

				$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $header_bg['url'] ) . ') !important; } ';
			}

			$current_background = get_the_post_thumbnail_url( $wp_query->get_queried_object_id(), 'full');
			$featured = fw_get_db_settings_option( 'featured' );

			if ( limme_is_wc('woocommerce') ) {

				$wc_background = get_the_post_thumbnail_url( wc_get_page_id( 'shop' ), 'full' );

				if ( !empty($wc_background) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_background ) . ') !important; } ';;
				}
			}	

			if ( !empty($featured) ) {

				foreach ( $featured as $item => $val ) {

					if ( ( $item == 'posts' AND get_post_type() == 'post' AND !empty( $current_background ) ) OR
						 ( $item == 'pages' AND get_post_type() == 'page' AND !empty( $current_background ) ) OR
						 ( $item == 'services' AND get_post_type() == 'services' AND !empty( $current_background ) )
					   ) {

						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $current_background ) . ') !important; } ';
					}
		
					if ( $item == 'woocommerce' AND limme_is_wc('product') AND !empty( $current_background ) ) {

						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $current_background ) . ') !important; } ';
					}							
		
					if ( $item == 'woocommerce-cat' AND (limme_is_wc('product_category') OR limme_is_wc('product_tag')) ) {

						$cat = $wp_query->get_queried_object();
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id , 'full' );
						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $image ) . ') !important; } ';
					}								
				}
			}

			if ( limme_is_wc('product_category') ) {

				$wc_alt_bg = fw_get_db_term_option( $wp_query->get_queried_object_id(), 'product_cat', 'background-image' );
				if ( !empty($wc_alt_bg) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_alt_bg['url'] ) . ') !important; } ';
				}
			}

			if ( limme_is_wc('product') ) {

				$wc_alt_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'header-background-image' );
				if ( !empty($wc_alt_bg) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_alt_bg['url'] ) . ') !important; } ';
				}
			}

			if ( get_post_type() == 'rental' ) {

				$alt = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'header-background-image' );
				if ( !empty($alt) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $alt['url'] ) . ') !important; } ';
				}
			}

			if ( is_singular( 'sliders' ) ) {

				$theme_style .= '.lte-slider-preview .elementor-section-wrap:first-child { background-image: url(' . esc_url( get_the_post_thumbnail_url( $wp_query->get_queried_object_id(), 'full') ) . ') !important; } ';
			}

			$body_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'background-image' );
			if (! empty( $body_bg ) ) {

				$theme_style .= '.lte-content-wrapper { background-image: url(' . esc_url( $body_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}

			$footer_bg = fw_get_db_settings_option( 'footer_bg' );
			if (! empty( $footer_bg ) ) {

				$theme_style .= '.lte-footer-wrapper:before { background-image: url(' . esc_url( $footer_bg['url'] ) . ') !important; } ';
			}

			$widgets_bg = fw_get_db_settings_option( 'widgets_bg' );
			if (! empty( $widgets_bg ) ) {

				$theme_style .= '#content-sidebar .widget_search, #content-sidebar .widget_product_search { background-image: url(' . esc_url( $widgets_bg['url'] ) . ') !important; } ';
			}

			$theme_icon = fw_get_db_settings_option( 'theme-icon-image' );
			if (! empty( $theme_icon ) ) {

				$theme_style .= '#content-sidebar .lte-sidebar-header .widget-icon { background-image: url(' . esc_url( $theme_icon['url'] ) . ') !important; } ';
			}

			$go_top_img = fw_get_db_settings_option( 'go_top_img' );
			if (! empty( $go_top_img ) ) {

				$theme_style .= '.go-top:before { background-image: url(' . esc_url( $go_top_img['url'] ) . ') !important; } ';
			}

			$nav_color = fw_get_db_customizer_option('navbar_dark_color');
			if ( isset($nav_color) ) {

				$theme_style .= '#nav-wrapper.lte-layout-transparent .lte-navbar.dark.affix { background-color: '.esc_attr($nav_color).' !important; } ';
			}

			$logo_height = fw_get_db_settings_option('logo_height');
			if ( !empty($logo_height) ) {

				$theme_style .= '.lte-logo img { max-height: '.esc_attr($logo_height).'px !important; } ';
			}

			$logo_big_height = fw_get_db_settings_option('logo_big_height');
			if ( !empty($logo_big_height) ) {

				$theme_style .= '.lte-layout-desktop-center-transparent .lte-navbar .lte-logo img { max-height: '.esc_attr($logo_big_height).'px !important; } ';
			}			

			$body_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'background-image' );
			if (! empty( $body_bg ) ) {

				$theme_style .= '.lte-content-wrapper { background-image: url(' . esc_url( $body_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}

			$pace = fw_get_db_settings_option( 'page-loader' );
			if ( !empty($pace) AND !empty($pace['image']) AND !empty($pace['image']['loader_img'])) {

				wp_add_inline_style( 'limme-theme-style', '.paceloader-image .pace-image { background-image: url(' . esc_attr( $pace['image']['loader_img']['url'] ) . ') !important; } ' );
			}

			$inline_style = limme_get_inline_style();
			if ( !empty($inline_style) ) {

				wp_add_inline_style( 'limme-theme-style', $inline_style );
			}

			limme_fa_init();
		}

		$theme_style = str_replace( array( "\n", "\r" ), '', $theme_style );

		return $theme_style;
	}
}




