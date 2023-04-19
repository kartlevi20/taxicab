<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'ord'    => array(
		'label' => esc_html__( 'Order', 'limme' ),
		'type'  => 'text',
	),		
	'exclude-search'        => array(
		'label'   => esc_html__( 'Exclude from Search', 'limme' ),
		'type'    => 'switch',
	),			
);

