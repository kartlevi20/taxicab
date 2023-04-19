<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => 'Additional',
		'type'    => 'box',
		'options' => array(
			'image_alt'    => array(
				'label' => esc_html__( 'Alternative Image', 'limme' ),
				'desc' => esc_html__( 'Can be used for some shortcodes', 'limme' ),
				'type'  => 'upload',
			),
			'header-background-image'    => array(
				'label' => esc_html__( 'Page Header Background', 'limme' ),
				'desc' => esc_html__( 'Will replace default header image', 'limme' ),
				'type'  => 'upload',
			),				
		),
	),
);

