<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Configuration and Custom CSS initializtion
 */

/**
 * Global theme config for header/footer/sections/colors/fonts
 */
if ( !function_exists('limme_theme_config') ) {

	add_filter( 'lte_get_theme_config', 'limme_theme_config', 10, 1 );
	function limme_theme_config() {

	    return array(
	    	/**
	    	 * Format of navbar
	    	 * layout-navbar-class-color
	    	 * color represents the text/links/icons color (black/white)
	    	 */
	    	'navbar'	=>	array(
				'default-black'  						=> esc_html__( 'Classic Light', 'limme' ),
				'default-white'  						=> esc_html__( 'Classic Dark', 'limme' ),
				'transparent-black'  					=> esc_html__( 'Classic Semi-Transparent on Light', 'limme' ),
				'transparent-white'  					=> esc_html__( 'Classic Semi-Transparent on Dark', 'limme' ),
				'transparent-full-black'  				=> esc_html__( 'Classic Transparent on Light', 'limme' ),
				'transparent-full-white'  				=> esc_html__( 'Classic Transparent on Dark', 'limme' ),
			),
			'navbar-default' => 'default-black',

			'footer' => array(
				'default'  => esc_html__( 'Default', 'limme' ),		
				'copyright'  => esc_html__( 'Copyright Only', 'limme' ),
				'copyright-transparent'  => esc_html__( 'Copyright Transparent', 'limme' ),						
			),
			'footer-default' => 'default',

			'color_main'	=>	'#D7B65D',
			'color_second'	=>	'#D7B65D',
			'color_gray'	=>	'#F5F5F5',
			'color_black'	=>	'#192026',
			'color_white'	=>	'#FFFFFF',
			'color_red'		=>	'#E65338',
			'color_green'	=>	'#82B452',
			'color_yellow'	=>	'#F7B614',

			
			'color_main_header'	=>	esc_html__( 'Yellow', 'limme' ),

			'logo_height'		=>	50,
			'navbar_dark'		=>	'rgba(0,0,0,0.75)',

			'font_main'					=>	'Mulish',
			'font_main_var'				=>	'regular',
			'font_main_weights'			=>	'400,400i,700,700i',
			'font_headers'				=>	'Taviraj',
			'font_headers_var'			=>	'600',
			'font_headers_weights'		=>	'300,300i,400,500,500i',
			'font_subheaders'			=>	'Taviraj',
			'font_subheaders_var'		=>	'600',
			'font_subheaders_weights'	=>	'',
		);
	}
}

/**
 *  Editor Settings
 */
function limme_editor_settings() {

	$cfg = limme_theme_config();

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main', 'limme' ),
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'limme' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'limme' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),    
        array(
            'name' => esc_html__( 'Pale Pink', 'limme' ),
            'slug' => 'pale-pink',
            'color' => '#f78da7',
        ),                
    ) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => esc_html__( 'small', 'limme' ),
			'shortName' => esc_html__( 'S', 'limme' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => esc_html__( 'regular', 'limme' ),
			'shortName' => esc_html__( 'M', 'limme' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => esc_html__( 'large', 'limme' ),
			'shortName' => esc_html__( 'L', 'limme' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );    
}
add_action( 'after_setup_theme', 'limme_editor_settings', 10 );

/**
 * Get Google default font url
 */
if ( !function_exists('limme_font_url') ) {

	function limme_font_url() {

		$cfg = limme_theme_config();
		$q = array();
		foreach ( array('font_main', 'font_headers', 'font_subheaders') as $item ) {

			if ( !empty($cfg[$item]) ) {

				$w = '';
				if ( !empty($cfg[$item.'_weights']) ) {

					$w .= ':'.$cfg[$item.'_weights'];
				}
				$q[] = $cfg[$item].$w;
			}
		}

		$query_args = array( 'family' => implode('%7C', $q), 'subset' => 'latin' );

		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url( $font_url );
	}
}

/**
 * Config used for lt-ext plugin to set Visual Composer configuration
 */
if ( !function_exists('limme_vc_config') ) {

	add_filter( 'lte_elementor_config', 'limme_elementor_config', 10, 1 );
	function limme_elementor_config( $value ) {

	    return array(
	    	'sections'	=>	array(
			),
			'background' => array(
				"main" 		=>	esc_html__( "Main", 'limme' ),	
				"second"	=>	esc_html__( "Second", 'limme' ),	
				"black"		=>	esc_html__( "Black", 'limme' ),
				"gray"		=>	esc_html__( "Gray", 'limme' ),
				"white"		=>	esc_html__( "White", 'limme' ),
			),
			'overlay'	=> array(
				"main"			=>	esc_html__( "Main Overlay (50%)", 'limme' ),
				"semi-dark"		=>	esc_html__( "Semi-Dark Overlay (50%)", 'limme' ),
				"dark"			=>	esc_html__( "Dark Overlay (75%)", 'limme' ),
				"black"			=>	esc_html__( "Black Overlay (90%)", 'limme' ),
				"light-black"	=>	esc_html__( "Light Black Overlay (25%)", 'limme' ),
				"white"			=>	esc_html__( "White Overlay (50%)", 'limme' ),
			),
		);
	}
}


/*
* Adding additional TinyMCE options
*/
if ( !function_exists('limme_mce_before_init_insert_formats') ) {

	add_filter('mce_buttons_2', 'limme_wpb_mce_buttons_2');
	function limme_wpb_mce_buttons_2( $buttons ) {

	    array_unshift($buttons, 'styleselect');
	    return $buttons;
	}

	add_filter( 'tiny_mce_before_init', 'limme_mce_before_init_insert_formats' );
	function limme_mce_before_init_insert_formats( $init_array ) {  

	    $style_formats = array(

	        array(  
	            'title' => esc_html__('Main Color', 'limme'),
	            'block' => 'span',  
	            'classes' => 'color-main',
	            'wrapper' => true,
	        ),  
	        array(  
	            'title' => esc_html__('White Color', 'limme'),
	            'block' => 'span',  
	            'classes' => 'color-white',
	            'wrapper' => true,   
	        ),
	        array(  
	            'title' => esc_html__('Semi-Transparent', 'limme'),
	            'block' => 'span',  
	            'classes' => 'semi-transparent',
	            'wrapper' => true,   
	        ),		        
	        array(  
	            'title' => esc_html__('Medium Text', 'limme'),
	            'block' => 'span',  
	            'classes' => 'text-sm',
	            'wrapper' => true,   
	        ),	  	        
	        array(  
	            'title' => esc_html__('Checkbox List', 'limme'),
	            'selector' => 'ul',  
	            'classes' => 'check',
	        ),		        
	    );  
	    $init_array['style_formats'] = json_encode( $style_formats );  
	     
	    return $init_array;  
	} 
}


/**
 * Register widget areas.
 *
 */
if ( !function_exists('limme_action_theme_widgets_init') ) {

	add_action( 'widgets_init', 'limme_action_theme_widgets_init' );
	function limme_action_theme_widgets_init() {

		$span_class = 'widget-icon';

		$header_class = $theme_icon = '';
		if ( function_exists('FW') ) {

			$theme_icon = fw_get_db_settings_option( 'theme-icon-main' );
			if ( !empty($theme_icon['icon-class']) ) {

				$header_class = 'hasIcon';
				$span_class .=  ' ' . $theme_icon['icon-class'];
			}
		}
			else {

			$span_class = '';
		}


		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'limme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'limme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="lte-sidebar-header"><h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'limme' ),
			'id'            => 'sidebar-wc',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'limme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="lte-sidebar-header"><h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '</h3></div>',
		) );

		if ( function_exists('FW') ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'limme' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Displayed in the footer section of the site.', 'limme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
				'after_title'   => '</h3>',
			) );			

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'limme' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Displayed in the footer section of the site.', 'limme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
				'after_title'   => '</h3>',
			) );			

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'limme' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Displayed in the footer section of the site.', 'limme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
				'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
			) );			

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 4', 'limme' ),
				'id'            => 'footer-4',
				'description'   => esc_html__( 'Displayed in the footer section of the site.', 'limme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
				'after_title'   => '</h3>',
			) );			
		}
			else {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer', 'limme' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Displayed in the footer section of the site.', 'limme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
				'after_title'   => '</h3>',
			) );
		}
	}
}



/**
 * Additional styles init
 */
if ( !function_exists('limme_css_style') ) {

	add_action( 'wp_enqueue_scripts', 'limme_css_style', 10 );
	function limme_css_style() {

		global $wp_query;

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), '1.0' );

		wp_enqueue_style( 'limme-theme-style', get_stylesheet_uri(), array( 'bootstrap' ), wp_get_theme()->get('Version') );
	}
}



/**
 * Wp-admin styles and scripts
 */
if ( !function_exists('limme_admin_init') ) {

	add_action( 'after_setup_theme', 'limme_admin_init' );
	function limme_admin_init() {

		add_action("admin_enqueue_scripts", 'limme_admin_scripts');
	}

	function limme_admin_scripts() {

		if ( function_exists('fw_get_db_settings_option') ) {

			limme_get_fontello_generate(true);
			
			wp_enqueue_script( 'limme-theme-admin', get_template_directory_uri() . '/assets/js/scripts-admin.js', array( 'jquery' ) );
		}
	}
}



