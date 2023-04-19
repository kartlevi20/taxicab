<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'limme' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'limme' ),
				'type'  => 'text',
			),		
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'limme' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'limme' ),
				'type'  => 'text',
			),				
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'limme' ),
				'type'  => 'textarea',
			),								
			'link'    => array(
				'label' => esc_html__( 'External Link', 'limme' ),
				'desc' => esc_html__( 'Replaces default service link', 'limme' ),				
				'type'  => 'text',
			),			
		),
	),
);

