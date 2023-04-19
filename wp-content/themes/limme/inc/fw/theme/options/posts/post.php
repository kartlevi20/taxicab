<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$options = array(
	'main' => array(
		'title'   => 'LTE Post Format',
		'type'    => 'box',
		'options' => array(
			'gallery'    => array(
				'label' => esc_html__( 'Gallery', 'limme' ),
				'desc' => esc_html__( 'Upload featured images for slider gallery post type', 'limme' ),
				'type'  => 'multi-upload',
			),				
		),
	),
);

