<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'price'    => array(
				'label' => esc_html__( 'Price', 'limme' ),
				'type'  => 'text',
			),		
		),
	),
);

