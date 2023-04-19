<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$schemes =  array();
$schemes['default'] = esc_html__( 'Default', 'limme' );

$schemes_ = fw_get_db_settings_option( 'items' );
if ( !empty($schemes_) ) {

	foreach ($schemes_ as $v) {

		$schemes[$v['slug']] = esc_html( $v['name'] );
	}
}


$options = array(
	'main' => array(
		'title'   => 'Additonal',
		'type'    => 'box',
		'options' => array(
			'color-scheme'    => array(
				'label' => esc_html__( 'Color Scheme (only for preview)', 'limme' ),
				'type'    => 'select',
				'choices' => $schemes,
				'value' => 'default',
			),				
		),
	),
);

