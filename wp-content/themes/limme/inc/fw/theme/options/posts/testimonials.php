<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'limme' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'type'    => 'select',
				'label' => esc_html__( 'Rate', 'limme' ),				
				'description'   => esc_html__( 'Null for hidden', 'limme' ),
				'choices' => array(
					0,1,2,3,4,5
				),
			),						
			'short'    => array(
				'type'    => 'checkbox',
				'label' => esc_html__( 'Short Testimonial', 'limme' ),				
				'description'   => esc_html__( 'Image will be hiddem and layout inverted', 'limme' ),
			),				
		),
	),		
);

unset($options['main']['options']['subheader']);

