<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => 'Additional',
		'type'    => 'box',
		'options' => array(
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'limme' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'limme' ),
				'type'  => 'text',
			),					
			'button-header'    => array(
				'label' => esc_html__( 'Button Header', 'limme' ),
				'type'  => 'text',
			),
			'button-link'    => array(
				'label' => esc_html__( 'Button Link', 'limme' ),
				'type'  => 'text',
			),
			'price'    => array(
				'label' => esc_html__( 'Price', 'limme' ),
				'desc' => esc_html__( 'Use {{ brackets }} for floating.', 'limme' ),
				'type'  => 'text',
			),			
		),
	),
);

