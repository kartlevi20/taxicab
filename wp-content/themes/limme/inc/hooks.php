<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */

/**
 * Enqueue Admin Styles
*/
if ( !function_exists( 'limme_action_theme_admin_styles' ) ) {

	function limme_action_theme_admin_styles() {

		wp_enqueue_style( 'limme-theme-admin-font', limme_font_url(), array(), '1.0' );
		wp_enqueue_style( 'limme-admin', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'limme_action_theme_admin_styles' );


/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 * @internal
 */
if ( !function_exists( 'limme_theme_setup' ) ) {

	function limme_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'limme', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', limme_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1150, 770, true );

		add_image_size( 'limme-blog', 790, 505, true );	
		add_image_size( 'limme-blog-featured', 755, 470, true );	
		add_image_size( 'limme-blog-small', 530, 414, true );	
		add_image_size( 'limme-services', 530, 530, true );
		add_image_size( 'limme-wc-cat', 500, 340, true );
		add_image_size( 'limme-client', 480, 630, true );	
		add_image_size( 'limme-blog-full', 1120, 720, true );	
		add_image_size( 'limme-partners', 140, 140, true );	
		add_image_size( 'limme-tiny-square', 110, 110, true );	
		add_image_size( 'limme-tiny', 110, 80, true );	
		add_image_size( 'limme-pages', 100, 120, true );	
		add_image_size( 'limme-gallery-grid', 360, 360, true );	
		add_image_size( 'limme-gallery-big', 800, 800 );	
		add_image_size( 'limme-gallery', 755, 500, true );	

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'widget_text', 'do_shortcode' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		$GLOBALS['content_width'] = apply_filters( 'limme_content_width', 1140 );

		/**
		 * WooCommerce Support
		 */
	    add_theme_support( 'woocommerce' );

	    if ( function_exists( 'FW' ) ) {

	    	$wc_zoom = fw_get_db_settings_option( 'wc_zoom' );
			if ( !empty($wc_zoom) AND $wc_zoom == 'enabled') {

				add_theme_support( 'wc-product-gallery-zoom' );
			}
	    }

		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );   
		add_theme_support( 'woocommerce', array( 'thumbnail_image_width' => 480 ) );	
	}
}
add_action( 'after_setup_theme', 'limme_theme_setup' );

if ( !function_exists( 'limme_theme_init' ) ) {
	
	function limme_theme_init() {

	    if ( function_exists( 'FW' ) ) {

			$widgets_block = fw_get_db_settings_option( 'widgets_block' );
			if (!empty($widgets_block) ) {

				add_theme_support( 'widgets-block-editor' );
			}
		}
	}
}
add_action( 'init', 'limme_theme_init', 50 );

/**
 * Load Gutenberg stylesheet.
 */
if ( !function_exists( 'limme_block_assets' ) ) {

	function limme_block_assets() {

		wp_enqueue_style( 'limme-block-assets', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false );
	}
}
add_action( 'enqueue_block_editor_assets', 'limme_block_assets' );

/**
 * Extend the default WordPress body classes.
 */
if ( !function_exists( 'limme_filter_theme_body_classes' ) ) {

	function limme_filter_theme_body_classes( $classes ) {

		global $wp_query, $wp_locale, $wp_styles;

		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {

			$current_position = fw_ext_sidebars_get_current_position();
			if ( in_array( $current_position, array( 'full', 'left' ) )
			     || empty( $current_position )
			     || is_page_template( 'page-templates/full-width.php' )
			     || is_page_template( 'page-templates/contributors.php' )
			     || is_attachment()
			) {
				$classes[] = 'full-width';
			}
		} else {
			$classes[] = 'full-width';
		}

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}

		$sidebar_layout = 'hidden';
		$limme_pace = 'disabled';
		$body_color = 'white';

		if ( function_exists( 'FW' ) ) {

			$limme_pace = fw_get_db_settings_option( 'page-loader' );
			if ( !empty($limme_pace) AND !empty($limme_pace['loader'])) {

				$limme_pace = $limme_pace['loader'];
			}

			$body_color_ = fw_get_db_settings_option( 'body-bg' );
			$body_color_page_ = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'body-bg' );
			if ( !empty($body_color_page) AND $body_color_page != 'default' ) {

				$body_color = $body_color_page;
			}

			$body_border = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'margin-layout' );
			if ( !empty($body_border) AND $body_border == 'body-border' ) {

				$classes[] = "lte-body-border";
			}

			$sidebar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );

			$limme_footer_cols = limme_get_footer_cols_num();

			$bg_404 = fw_get_db_settings_option( '404_bg' );
			if (! empty( $bg_404 ) ) {		

				$classes[] = 'lte-bg-404';
			}

			$current_scheme = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'color-scheme' );
			if ( !empty( $current_scheme) ) {

				$classes[] = 'lte-color-scheme-'.esc_attr($current_scheme);

				$color_schemes = fw_get_db_settings_option( 'items' );

				if ( !empty($color_schemes) ) {

					foreach ( $color_schemes as $scheme ) {

						if ( $scheme['slug'] == $current_scheme AND !empty($scheme['invert-button']) ) {

							$classes[] = 'lte-invert-color-main';
						}
					}
				}
			}

			if ( limme_is_wc('woocommerce') ) {

				$classes[] = 'lte-product-style-' . esc_attr(fw_get_db_settings_option( 'wc_product_style' ));
			}
		}
			else {
		}

		if ( !empty($body_color) AND $body_color != 'default' ) {

			$classes[] = "lte-background-".esc_attr($body_color);
		}

		if ( empty($limme_footer_cols) ) {

			$classes[] = 'no-footer-widgets';
		}

		$classes[] = 'paceloader-'.esc_attr($limme_pace);


		$sidebar_active = limme_check_active_sidebar();
		if ( $sidebar_active === true ) {

			$sidebar_layout = 'visible';
		}

		if ( empty($sidebar_layout) OR $sidebar_layout == 'hidden' OR is_page_template( 'page-templates/full-width.php' ) OR !function_exists('FW') ) {

			$classes[] = 'full-width';
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'limme_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 */
if ( !function_exists( 'limme_filter_theme_post_classes' ) ) {

	function limme_filter_theme_post_classes( $classes ) {

		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {

			$classes[] = 'has-post-thumbnail';
		}

		return $classes;
	}
}
add_filter( 'post_class', 'limme_filter_theme_post_classes' );

/**
 * Adds wp_kses allowed html tags
 */
if ( !function_exists( 'limme_kses_allowed_html' ) ) {

	function limme_kses_allowed_html($tags, $context) {

		switch($context) {

			case 'header': 
			  $tags = array( 
			    'br' => [],
			    'span' => [],
			    'em' => [],
			    'b' => [],
			    'p' => [],
			    'sup' => [],
			    'a' => array('href' => [], 'target' => []),
			  );
			  return $tags;
			case 'links': 
			  $tags = array( 
			    'span' => array('class' => []),
			    'a' => array('class' => [], 'href' => [], 'target' => []),
			  );
			  return $tags;
			case 'bio': 
			  $tags = array( 
			    'section' => array( 'class' => [] ),
			    'div' => array( 'class' => [] ),
			    'span' => array( 'class' => [] ),
			    'h1' => array( 'class' => [] ),
			    'h2' => array( 'class' => [] ),
			    'h3' => array( 'class' => [] ),
			    'h4' => array( 'class' => [] ),
			    'h5' => array( 'class' => [] ),
			    'h6' => array( 'class' => [] ),
			    'img' => array( 'class' => [], 'src' => [], 'alt' => [], 'width' => [], 'height' => [] ),
			    'b' => [],
			    'p' => array( 'class' => [] ),
			    'sup' => [],
			    'a' => array('class' => [], 'href' => [], 'target' => []),
			  );
			  return $tags;				  
			default: 
			  return $tags;
		}
	}
}
add_filter( 'wp_kses_allowed_html', 'limme_kses_allowed_html', 10, 2);


/**
 * Changes text direction for certain page. In most cases uses only for demo.
 */
if ( !function_exists( 'limme_custom_text_direction' ) ) {

	function limme_custom_text_direction() {

		global $wp_query, $wp_locale, $wp_styles;

		if ( function_exists('FW') ) {

			$direction = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'direction' );

			if ( !empty($direction) AND $direction != 'default' ) {

				if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
					$wp_styles = new WP_Styles();
				}
				if ( $direction == 'rtl') {

					$wp_locale->text_direction = $wp_styles->text_direction = 'rtl';
				}
					else {

					$wp_locale->text_direction = $wp_styles->text_direction = 'ltr';
				}
			}
		}
	}
}
add_action( 'get_header', 'limme_custom_text_direction' );


/**
 * Flush out the transients used in limme_categorized_blog.
 */
if ( !function_exists( 'limme_action_theme_category_transient_flusher' ) ) {

	function limme_action_theme_category_transient_flusher() {

		delete_transient( 'limme_category_count' );
	}
}

add_action( 'edit_category', 'limme_action_theme_category_transient_flusher' );
add_action( 'save_post', 'limme_action_theme_category_transient_flusher' );

/**
 * Changes default Unyson FW path
 */
if ( !function_exists('limme_theme_custom_framework_customizations_dir_rel_path') ) {

	function limme_theme_custom_framework_customizations_dir_rel_path( $rel_path ) {

	    return '/inc/fw';
	}
}
add_filter( 'fw_framework_customizations_dir_rel_path', 'limme_theme_custom_framework_customizations_dir_rel_path' );


/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
if ( !function_exists( 'limme_filter_theme_fw_ext_backups_demos' ) ) {

	function limme_filter_theme_fw_ext_backups_demos( $demos ) {

		$demos_array = array(

			'limme-demo' => array(
				'title' => esc_html__( 'Limme Demo Content', 'limme' ),
				'screenshot' => 'http://updates.like-themes.com/limme/screenshot.png',
				'preview_link' => 'http://limme.like-themes.com/',
			),
		);

		$download_url = 'http://updates.like-themes.com/limme/?riv='.esc_attr(wp_get_theme(get_template())->version);

		foreach ( $demos_array as $id => $data ) {

			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(

				'url' => $download_url,
				'file_id' => $id,
			));

			$demo->set_title( $data['title'] );
			$demo->set_screenshot( $data['screenshot'] );
			$demo->set_preview_link( $data['preview_link'] );

			$demos[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos;
	}
}
add_filter( 'fw:ext:backups-demo:demos', 'limme_filter_theme_fw_ext_backups_demos' );

