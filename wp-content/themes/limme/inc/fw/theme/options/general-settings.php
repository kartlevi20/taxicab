<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$limme_theme_config = limme_theme_config();
$limme_sections_list = limme_get_sections();

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'limme' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'General Settings', 'limme' ),
				'type'    => 'tab',
				'options' => array(						
					'page-loader'    => array(
						'type'    => 'multi-picker',
						'picker'       => array(
							'loader' => array(
								'label'   => esc_html__( 'Page Loader', 'limme' ),
								'type'    => 'select',
								'choices' => array(
									'disabled' => esc_html__( 'Disabled', 'limme' ),
									'image' => esc_html__( 'Image', 'limme' ),
									'spinner' => esc_html__( 'Spinner', 'limme' ),
									'enabled' => esc_html__( 'Theme Loader', 'limme' ),
								),
								'value' => 'enabled'
							)
						),						
						'choices' => array(
							'image' => array(
								'loader_img'    => array(
									'label' => esc_html__( 'Page Loader Image', 'limme' ),
									'type'  => 'upload',
								),
							),
						),
						'value' => 'enabled',
					),	
					'google_api'    => array(
						'label' => esc_html__( 'Google Maps API Key', 'limme' ),
						'desc'  => esc_html__( 'Required for contacts page, also used in widget. In order to use you must generate your own API on Google Maps Platform', 'limme' ),
						'type'  => 'text',
					),
					'widgets_block'    => array(
						'label' => esc_html__( 'Enable Block Widgets', 'limme' ),
						'type'  => 'switch',
					),					
				),
			),
			'logo' => array(
				'title'   => esc_html__( 'Logo and Media', 'limme' ),
				'type'    => 'tab',
				'options' => array(	
					'logo-box' => array(
						'title'   => esc_html__( 'Logo', 'limme' ),
						'type'    => 'box',
						'options' => array(			
							'favicon'    => array(
								'html' => esc_html__( 'To change Favicon go to Appearance -> Customize -> Site Identity', 'limme' ),
								'type'  => 'html',
							),		
							'advice'    => array(
								'label'	=>	'',
								'html' => esc_html__( 'Unique Homepages could have different colors and logos, which can be changed in Color Schemes.', 'limme' ),
								'type'  => 'html',
							),								
				            'logo_big_height' => array(
				                'type'  => 'slider',
				                'value' => $limme_theme_config['logo_height'],
				                'properties' => array(

				                    'min' => 0,
				                    'max' => 200,
				                    'step' => 1,

				                ),
				                'label' => esc_html__('Logo Big Max Height, px', 'limme'),
				            ),  				
				            'logo_height' => array(
				                'type'  => 'slider',
				                'value' => $limme_theme_config['logo_height'],
				                'properties' => array(

				                    'min' => 0,
				                    'max' => 200,
				                    'step' => 1,

				                ),
				                'label' => esc_html__('Logo Max Height, px', 'limme'),
				            ),  					            								
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'limme' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'limme' ),
								'desc'  => esc_html__( 'Used for retina displays. Requires 2x size logo. Can be left empty.', 'limme' ),
								'type'  => 'upload',
							),	
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'limme' ),
								'type'  => 'upload',
							),
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'limme' ),
								'desc'  => esc_html__( 'Used for retina displays.  Requires 2x logo.  Can be left empty.', 'limme' ),
								'type'  => 'upload',
							),		
							'theme-icon-main'    => array(
								'label' => esc_html__( 'Widget Headers icon', 'limme' ),
								'type'  => 'icon-v2',
							),
							'theme-icon-image'    => array(
								'label' => esc_html__( '(or) Widget Header Image', 'limme' ),
								'type'  => 'upload',
							),													
							'widgets_bg'    => array(
								'label' => esc_html__( 'Search Widgets Background', 'limme' ),
								'type'  => 'upload',
							),
							'404-img'    => array(
								'label' => esc_html__( '404 Page Image', 'limme' ),
								'type'  => 'upload',
							),								
						),
					),
				),
			),				
		),
	),
);

unset($options['general']['options']['logo']['options']['logo-box']['options']['404_bg']);
//unset($options['general']['options']['logo']['options']['logo-box']['options']['theme-icon-main']);
unset($options['general']['options']['logo']['options']['logo-box']['options']['theme-icon-image']);

