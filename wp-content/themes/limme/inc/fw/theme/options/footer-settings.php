<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$limme_theme_config = limme_theme_config();
$limme_sections_list = limme_get_sections();

$options = array(
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'limme' ),
		'type'    => 'tab',
		'options' => array(

			'footer-box-1' => array(
				'title'   => esc_html__( 'Widgets', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'footer-layout-default'    => array(
						'label' => esc_html__( 'Footer Default Style', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before copyright. Edited in Widgets menu.', 'limme' ),
						'choices' => $limme_theme_config['footer'],
						'value' => $limme_theme_config['footer-default'],
					),						
					'footer_widgets'    => array(
						'label' => esc_html__( 'Enable Footer Widgets', 'limme' ),
						'desc'   => esc_html__( 'Widgets controled in Appearance -> Widgets. Column will be hidden, when no active widgets exist', 'limme' ),	
						'type'  => 'checkbox',
						'value'	=> 'true',
					),					
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'limme' ),
						'type'    => 'select',							
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),						
					'footer_bg'    => array(
						'label' => esc_html__( 'Footer Background', 'limme' ),
						'type'  => 'upload',
					),		
					'footer-box-1-1' => array(
						'title'   => esc_html__( 'Desktop widgets visibility', 'limme' ),
						'type'    => 'box',
						'options' => array(

							'footer_1_hide'    => array(
								'label' => esc_html__( 'Footer 1', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),						
							),
							'footer_2_hide'    => array(
								'label' => esc_html__( 'Footer 2', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
							'footer_3_hide'    => array(
								'label' => esc_html__( 'Footer 3', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
							'footer_4_hide'    => array(
								'label' => esc_html__( 'Footer 4', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
						)
					),
					'footer-box-1-2' => array(
						'title'   => esc_html__( 'Notebook widgets visibility', 'limme' ),
						'type'    => 'box',
						'options' => array(

							'footer_1__hide_md'    => array(
								'label' => esc_html__( 'Footer 1', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),						
							),
							'footer_2_hide_md'    => array(
								'label' => esc_html__( 'Footer 2', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
							'footer_3_hide_md'    => array(
								'label' => esc_html__( 'Footer 3', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
							'footer_4_hide_md'    => array(
								'label' => esc_html__( 'Footer 4', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),	
							),
						)
					),					
					'footer-box-1-3' => array(
						'title'   => esc_html__( 'Mobile widgets visibility', 'limme' ),
						'type'    => 'box',
						'options' => array(
							'footer_1_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 1', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),
							),
							'footer_2_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 2', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),
							),
							'footer_3_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 3', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),
							),
							'footer_4_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 4', 'limme' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'limme'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'limme'),
								),
							),														
						)
					)
				),
			),
			'footer-box-subscribe' => array(
				'title'   => esc_html__( 'Subscribe', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'limme' ),
						'type'  => 'html',
					),							
					'subscribe-section'    => array(
						'label' => esc_html__( 'Subscribe block', 'limme' ),
						'desc' => esc_html__( 'Section displayed before widgets on every page. You can hide in on certain page in page settings.', 'limme' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $limme_sections_list['subscribe'],						
						'value'	=> '',
					),
			
				),
			),	
			'footer-box-2' => array(
				'title'   => esc_html__( 'Go Top', 'limme' ),
				'type'    => 'tab',
				'options' => array(															
					'go_top_visibility'    => array(
						'label' => esc_html__( 'Go Top Visibility', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always visible', 'limme' ),
							'desktop' => esc_html__( 'Desktop Only', 'limme' ),
							'mobile' => esc_html__( 'Mobile Only', 'limme' ),
							'hidden' => esc_html__( 'Hidden', 'limme' ),
						),						
						'value'	=> 'visible',
					),		
					'go_top_pos'    => array(
						'label' => esc_html__( 'Go Top Position', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'floating'  => esc_html__( 'Floating', 'limme' ),
							'static' => esc_html__( 'Static at the footer', 'limme' ),
						),						
						'value'	=> 'floating',
					),		
					'go_top_img'    => array(
						'label' => esc_html__( 'Go Top Image', 'limme' ),
						'type'  => 'upload',
					),		
					'go_top_icon'    => array(
						'label' => esc_html__( 'Go Top Icon', 'limme' ),
						'type'  => 'icon-v2',
					),					
					'go_top_text'    => array(
						'label' => esc_html__( 'Go Top Text', 'limme' ),
						'type'  => 'text',
					),														
				),
			),
			'footer-box-3' => array(
				'title'   => esc_html__( 'Copyrights', 'limme' ),
				'type'    => 'tab',
				'options' => array(																							
					'copyrights'    => array(
						'label' => esc_html__( 'Copyrights', 'limme' ),
						'type'  => 'wp-editor',
					),									
				),
			),					
		),
	),	
);


