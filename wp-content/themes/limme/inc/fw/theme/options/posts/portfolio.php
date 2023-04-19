<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(	
			'subheader'    => array(
				'label' => esc_html__( 'Sub Header', 'limme' ),
				'type'  => 'text',
			),					
		),
	),
);

