<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(
	'colors' => array(
		'title'   => esc_html__( 'Colors Schemes', 'limme' ),
		'type'    => 'tab',
		'options' => array(			
			'schemes-box' => array(
				'title'   => esc_html__( 'Additional Color Schemes Settings', 'limme' ),
				'type'    => 'box',
				'options' => array(
					'advice'    => array(
						'label'	=>	'',
						'html' => esc_html__( 'You also need to change the global settings in Appearance -> Customize -> Limme settings', 'limme' ),
						'type'  => 'html',
					),	
					'items' => array(
						'label' => esc_html__( 'Theme Color Schemes', 'limme' ),
						'type' => 'addable-box',
						'value' => array(),
						'desc' => esc_html__( 'Can be selected in page settings', 'limme' ),
						'box-options' => array(
							'slug' => array(
								'label' => esc_html__( 'Scheme ID', 'limme' ),
								'type' => 'text',
								'desc' => esc_html__( 'Required Field', 'limme' ),
								'value' => '',
							),							
							'name' => array(
								'label' => esc_html__( 'Scheme Name', 'limme' ),
								'desc' => esc_html__( 'Required Field', 'limme' ),
								'type' => 'text',
								'value' => '',
							),
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'limme' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'limme' ),
								'type'  => 'upload',
							),
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'limme' ),
								'type'  => 'upload',
							),		
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'limme' ),
								'type'  => 'upload',
							),		
							'main-color'  => array(
								'label' => esc_html__( 'Main Color', 'limme' ),
								'type'  => 'color-picker',
							),
							'second-color' => array(
								'label' => esc_html__( 'Second Color', 'limme' ),
								'type'  => 'color-picker',
							),
							'gray-color' => array(
								'label' => esc_html__( 'Gray Color', 'limme' ),
								'type'  => 'color-picker',
							),								
							'black-color' => array(
								'label' => esc_html__( 'Black Color', 'limme' ),
								'type'  => 'color-picker',
							),	
							'white-color' => array(
								'label' => esc_html__( 'White Color', 'limme' ),
								'type'  => 'color-picker',
							),
							'invert-button' => array(
								'label' => esc_html__( 'Invert Buttons Text Color', 'limme' ),
								'type'  => 'switch',
							),														
						),
						'template' => '{{- name }}',
					),
				),
			),
		),
	),	

);


