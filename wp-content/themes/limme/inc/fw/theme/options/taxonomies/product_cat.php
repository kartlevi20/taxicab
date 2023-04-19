<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'header'    => array(
		'label' => esc_html__( 'Alternative Header', 'limme' ),
		'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'limme' ),
		'type'  => 'text',
	),		
	'bg-color' => array(
		'label'   => esc_html__( 'Background Style', 'limme' ),
		'type'    => 'select',
		'choices' => array(
			'default'	=> esc_html__( 'Light', 'limme' ),
			'dark'  	=> esc_html__( 'Dark', 'limme' ),
		),
		'value' => 'default',
	),
	'background-image'    => array(
		'label' => esc_html__( 'Page Header Background', 'limme' ),
		'desc' => esc_html__( 'Will replace default header image', 'limme' ),
		'type'  => 'upload',
	),				
);

