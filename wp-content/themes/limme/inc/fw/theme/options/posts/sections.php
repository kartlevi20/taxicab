<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'theme_block' => array(
		'title'   => esc_html__( 'Theme Block', 'limme' ),
		'label'   => esc_html__( 'Theme Block', 'limme' ),
		'type'    => 'select',
		'choices' => array(
			'none'  => esc_html__( 'Not Assigned', 'limme' ),
			'before_footer'  => esc_html__( 'Before Footer', 'limme' ),
			'subscribe'  => esc_html__( 'Subscribe', 'limme' ),
			'top_bar'  => esc_html__( 'Top Bar', 'limme' ),
		),
		'value' => 'none',
	)
);


