<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(	
			'booking_enabled'    => array(
				'label' => esc_html__( 'Booking Form', 'limme' ),
				'type'  => 'switch',
				'value'	=> 'yes',
			),		
			'booking_id'    => array(
				'label' => esc_html__( 'Booking ID', 'limme' ),
				'desc' => esc_html__( 'Can be used in booking plugin', 'limme' ),	
				'type'  => 'text',
			),					
			'link'    => array(
				'label' => esc_html__( 'External Link', 'limme' ),
				'desc' => esc_html__( 'Replaces default link', 'limme' ),				
				'type'  => 'text',
			),				
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'limme' ),
				'type'  => 'text',
			),			
			'price'    => array(
				'label' => esc_html__( 'Price rental', 'limme' ),
				'type'  => 'text',
			),
			'price_postfix'    => array(
				'label' => esc_html__( 'Price Postfix', 'limme' ),
				'type'  => 'text',
			),			
			'price_full'    => array(
				'label' => esc_html__( 'Price Full', 'limme' ),
				'type'  => 'text',
			),			
			'mileage'    => array(
				'label' => esc_html__( 'Mileage', 'limme' ),
				'type'  => 'text',
			),				
			'icons' => array(
				'label' => esc_html__( 'Icons', 'limme' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'limme' ),
						'type'  => 'icon-v2',
					),
					'val' => array(
						'label' => esc_html__( 'Value', 'limme' ),
						'type'  => 'text',
					),					
				),
				'template' => '{{- val }}',
			),					
			'list' => array(
				'label' => esc_html__( 'List', 'limme' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'val' => array(
						'label' => esc_html__( 'Item', 'limme' ),
						'type'  => 'text',
					),					
				),
				'template' => '{{- val }}',
			),
			'cut'    => array(
				'label' => esc_html__( 'Excerpt', 'limme' ),
				'type'  => 'textarea',
			),	
			'ratio'    => array(
				'label' => esc_html__( 'Ratio', 'limme' ),
				'type'    => 'select',
				'choices' => array( 0, 1, 2, 3, 4, 5 ),
			),		
			'header-background-image'    => array(
				'label' => esc_html__( 'Page Header Background', 'limme' ),
				'desc' => esc_html__( 'Will replace default header image', 'limme' ),
				'type'  => 'upload',
			),	
		),
	),
);

