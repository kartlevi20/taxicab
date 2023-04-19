<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

/**
 * Shortcodes Init
 * https://codex.wordpress.org/Shortcode_API 
 */

/**
 * Shortcode to display site logo
 */
function lte_sc_logo( ) {

	if ( function_exists('limme_get_the_logo')) {

		return limme_get_the_logo('white');
	}
}
add_shortcode( 'lte-logo', 'lte_sc_logo' );

/**
 * Page header social icons
 */
function lte_nav_social_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'color' => 'second',
			'type' => '',
			'text' => '',
			'text-before' => '',
		), $atts, 'limme-social'
	);

	if ( function_exists( 'fw' ) ) {

		$limme_social_icons = fw_get_db_settings_option( 'social-icons' );
		$limme_social_target = fw_get_db_settings_option( 'target-social' );

		if ( $limme_social_target == 'self') {

			$target = "_self";
		}
			else {

			$target = "_blank";
		}

		$html = '';
		if ( !empty($limme_social_icons) ) {

			$html .= '<div class="lte-social lte-nav-'.esc_attr($atts['color']).' lte-type-'.esc_attr($atts['type']).'">';

			if ( !empty($atts['text-before']) ) {

				$html .= '<span class="lte-header"><span>'.esc_html($atts['text-before']).'</span></span>';
			}

			$html .= '<ul>';
				foreach ($limme_social_icons as $item ) {

					if ( !empty($atts['type']) AND $atts['type'] == 'titles') {

						$html .= '<li><a href="'. esc_url( $item['href'] ) .'" target="'.esc_attr( $target ).'">'. esc_html( $item['text'] ) .'</a></li>';
					}
						else 
					if ( !empty($item['icon_v2']['icon-class']) ) {

						$html .= '<li><a href="'. esc_url( $item['href'] ) .'" target="'.esc_attr( $target ).'"><span class="'. esc_attr( $item['icon_v2']['icon-class'] ) .'"></span></a></li>';						
					}
						else
					if ( !empty($item['icon_v2']['url']) ){

						$html .= '<li><a href="'. esc_url( $item['href'] ) .'" target="'.esc_attr( $target ).'"><img src="'.esc_url($item['icon_v2']['url']).'" style="max-width: 20px; height: auto;"></a></li>';	
					}
				}
			$html .= '</ul>';

			if ( !empty($atts['text']) ) {

				$html .= '<span class="header"><span>'.esc_html($atts['text']).'</span></span>';
			}

			$html .= '</div>';
		}

		return $html;
	}
}
add_shortcode( 'lte-social', 'lte_nav_social_shortcode' );
add_shortcode( 'lte-navbar-icons', 'limme_get_the_navbar_icons' );


/**
 * Sharing buttons
 */
if ( !function_exists( 'lte_share_buttons_conf' ) ) {

	function lte_share_buttons_conf() {

		$links = array(

			'facebook'	=>	array(
				'header' => 'Facebook',
				'link' => 'http://www.facebook.com/sharer.php?u={link}',
				'icon' => 'fa-facebook',
				'active'	=>	1,
			),
			'twitter'	=>	array(
				'header' => 'Twitter',
				'link' => 'https://twitter.com/intent/tweet?link={link}&text={title}',
				'icon' => 'fa-twitter',
				'active'	=>	1,
			),
			'gplus'	=>	array(
				'header' => 'Google+',
				'link' => 'https://plus.google.com/share?url={link}',
				'icon' => 'fa-google-plus',
				'active'	=>	1,
			),
			'linkedin'	=>	array(
				'header' => 'Linkedin',
				'link' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url={link}',
				'icon' => 'fa-linkedin',
				'active'	=>	1,
			),
			'email'	=>	array(
				'header' => 'E-mail',
				'link' => 'mailto:?subject={title}&body={link}',
				'icon' => 'fa-envelope',
				'active'	=>	0,
			),						
		);

		if ( function_exists('FW') ) {

			foreach ( $links as $key => &$item ){

				$state = fw_get_db_settings_option( 'share_icon_' . $key );

				if ( !is_null($state) ) {

					if ( $state === true ) {

						$item['active'] = 1;
					}
						else {

						$item['active'] = 0;
					}
				}			
			}
		}

		return $links;
	}

	function lte_the_share_buttons( $args ) {

		if ( function_exists('FW') ) {

			$hide = fw_get_db_settings_option( 'share_icons_hide' );
			$custom = fw_get_db_settings_option( 'share-add' );

			if ( !empty($hide) ) {

				return false;
			}
		}

		$links = lte_share_buttons_conf();
		$html = '';

		if ( !empty($args['header']) ) {

			$html .= '<span class="lte-sharing-header"><span class="fa fa-share-alt"></span> <span class="header">' . esc_html($args['header']) .'</span></span>';
		}	
		
		$html .= '<ul class="lte-sharing">';

		if ( !empty($links) ) {

			foreach ( $links as $header => $item ) {

				if ( $item['active'] == 1 ) {

					$link = str_replace(
						array('{title}', '{link}'),
						array(get_the_title(), get_permalink()),
						$item['link']
					);

					$html .= '<li><a href="'.esc_url($link).'"><span class="lte-social-color fa '.esc_attr($item['icon']).'"></span></a></li>';
				}
			}
		}

		if ( !empty($custom) ) {

			foreach ( $custom as $item ) {

				$link = str_replace(
					array('{title}', '{link}'),
					array(get_the_title(), get_permalink()),
					$item['link']
				);

				$color_style = '';
				if ( !empty($item['color']) ) {

					$color_style = ' style="background-color: '.esc_attr($item['color']).'" ';
				}	

				$html .= '<li><a href="'.esc_url($link).'"><span class="lte-social-color '.esc_attr($item['icon']['icon-class']).'"'.$color_style.'></span></a></li>';
			}

		}

		$html .= '</ul>';

		return $html;
	
	}	


	add_shortcode( 'lte-share-icons', 'lte_the_share_buttons' );	
}

/**
 * Display current team image for single page
 */
if ( !function_exists( 'lte_team_image' ) ) {

	function lte_team_image() {

		global $wp_query;

		return '<div class="lte-team-full">'.wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full', false  ).'</div>';
	}
}
add_shortcode( 'lte-team-image', 'lte_team_image' );

/**
 * Team Shortcodes
 */
if ( !function_exists( 'lte_team_header' ) ) {

	function lte_team_header() {

		global $wp_query;

		return '<h5 class="lte-team-name">'.get_the_title().'</h5>';
	}
}
add_shortcode( 'lte-team-header', 'lte_team_header' );

if ( !function_exists( 'lte_team_subheader' ) ) {

	function lte_team_subheader() {

		global $wp_query;

		$item_cats = wp_get_post_terms( get_the_ID(), 'team-category' );

		$cats = '';
		if ( !empty($item_cats) ) {

			foreach ($item_cats as $cat) {

				$cats = $cat->name;
				break;
			}
		}


		return '<h6 class="lte-team-cat">'.esc_html($cats).'</h6>';
	}
}
add_shortcode( 'lte-team-subheader', 'lte_team_subheader' );

/**
 * Display header tagline
 */
if ( !function_exists( 'lte_header_tagline' ) ) {

	function lte_header_tagline( $args ) {

		if ( function_exists( 'FW' ) ) {
			
			$type = '';
			if ( !empty($args['type']) AND $args['type'] == 'short' ) {

				$tagline = fw_get_db_settings_option( 'tagline-short' );
			}				
				else {

				$tagline = fw_get_db_settings_option( 'tagline' );
			}
			if ( !empty($tagline) ) {

				return '<span class="lte-tagline"><span>'.esc_html($tagline).'</span></span>';
			}
		}
	}
}
add_shortcode( 'lte-header-tagline', 'lte_header_tagline' );

/**
 * Display overlay
 */
if ( !function_exists( 'lte_overlay_lines' ) ) {

	function lte_overlay_lines() {

		return '<span class="lte-overlay-lines"></span>';
	}
}
add_shortcode( 'lte-overlay-lines', 'lte_overlay_lines' );

/**
 * Display overlay
 */
if ( !function_exists( 'lte_overlay_border' ) ) {

	function lte_overlay_border() {

		return '<span class="lte-overlay-border"><span class="lte-border-top"></span><span class="lte-border-bottom"></span></span>';
	}
}
add_shortcode( 'lte-overlay-border', 'lte_overlay_border' );



/**
 * Swiper slider container generation
 */
if ( !function_exists( 'lte_swiper_get_the_container' ) ) {

	function lte_swiper_get_the_container($class = '', $atts = array(), $classDefault = '') {

		wp_enqueue_script('lte-frontend');

		$data = array();
		
		$defaults = array(

			'swiper_arrows' 				=> 'sides',
			'swiper_autoplay'				=> 0,
			'swiper_autoplay_interaction'	=> false,
			'swiper_loop'					=> false,
			'swiper_pagination'				=> false,
			'swiper_speed'					=> 1000,
			'swiper_effect'					=> 'slide',
			'swiper_slides_per_group'		=> null,
			'swiper_breakpoint_xl'		=> 1,
			'swiper_breakpoint_lg'		=> null,
			'swiper_breakpoint_md'		=> null,
			'swiper_breakpoint_sm'		=> null,
			'swiper_breakpoint_ms'		=> null,
			'swiper_breakpoint_xs'		=> null,
			'swiper_center_slide'		=> null,
			'space_between'		=> 30,
			'simulate_touch'		=> true,
		);

		foreach ( $defaults as $key => $val ) {

			if ( !isset($atts[$key]) OR ( empty($atts[$key]) AND $atts[$key] !== "0" ) ) {

				$atts[$key] = $val;
			}
		}

		$data[] = 'data-space-between="'.esc_attr($atts['space_between']).'"';
		$data[] = 'data-arrows="'.esc_attr($atts['swiper_arrows']).'"';
		$data[] = 'data-autoplay="'.esc_attr($atts['swiper_autoplay']).'"';
		$data[] = 'data-autoplay-interaction="'.esc_attr($atts['swiper_autoplay_interaction']).'"';
		$data[] = 'data-loop="'.esc_attr($atts['swiper_loop']).'"';
		$data[] = 'data-speed="'.esc_attr($atts['swiper_speed']).'"';
		$data[] = 'data-effect="'.esc_attr($atts['swiper_effect']).'"';
		$data[] = 'data-slides-per-group="'.esc_attr($atts['swiper_slides_per_group']).'"';

		if ( isset($atts['simulate_touch']) AND $atts['simulate_touch'] === 'false' ) {

			$data[] = 'data-simulate-touch="-1"';
		}

 		if ( !empty($atts['swiper-pagination-custom']) ) {

 			$atts['swiper_pagination'] = 'custom';
 			$data[] = ' data-pagination-custom=\''. filter_var( json_encode($atts['swiper-pagination-custom']), FILTER_SANITIZE_SPECIAL_CHARS ) .'\' ';
 		}

		if ( !empty($atts['swiper_pagination']) ) {

			$data[] = 'data-pagination="'.esc_attr($atts['swiper_pagination']).'"';
		}

		if ( !empty($atts['swiper_center_slide']) ) {

			$data[] = 'data-center-slide="'.esc_attr($atts['swiper_center_slide']).'"';
		}

		$data[] = 'data-breakpoints="'.esc_attr(implode(';', array($atts['swiper_breakpoint_xl'], $atts['swiper_breakpoint_lg'], $atts['swiper_breakpoint_md'], $atts['swiper_breakpoint_sm'], $atts['swiper_breakpoint_ms'], $atts['swiper_breakpoint_xs']))).'"';

		if ( !empty($atts['fc'])) $fc = ' lte-fc'; else $fc = '';

		echo '<div class="lte-swiper-slider-wrapper'.esc_attr($fc).'"><div class="lte-swiper-slider swiper-container '.esc_attr(implode(' ', array($class, $classDefault))).'" '.implode(' ', $data).'>';
	}
}

if ( !function_exists( 'lte_button_sc' ) ) {

	function lte_button_sc( $args ) {

		$btn_color = '';
		if ( !empty($args['color']) ) {

			$btn_color .= ' btn-'.$args['color'];
		}

		if ( !empty($args['hover']) ) {

			$btn_color .= ' color-hover-'.$args['hover'];
		}

		if ( !empty($args['size']) ) {

			$btn_color .= ' btn-'.$args['size'];
		}

		$out = '<div class="lte-btn-wrap">
			<a href="'. esc_url($args['href']).'" class="lte-btn '.esc_attr($btn_color).'">';
				$out .= '<span class="lte-btn-inner">';
					$out .= '<span class="lte-btn-before"></span>';
					$out .= esc_html( $args['header'] );
					$out .= '<span class="lte-btn-after"></span>';
				$out .= '</span>';
		$out .= '</a></div>';

		return $out;
	}
}
add_shortcode( 'lte-button', 'lte_button_sc' );


