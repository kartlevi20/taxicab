<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(
	'social' => array(
		'title'   => esc_html__( 'Social', 'limme' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'target-social'    => array(
						'label' => esc_html__( 'Open social links in', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'self'  => esc_html__( 'Same window', 'limme' ),
							'blank' => esc_html__( 'New window', 'limme' ),
						),
						'value' => 'self',
					),		
					'social-header' => array(
                        'label' => esc_html__( 'Social Header', 'limme' ),
                        'type' => 'text',
                        'value' => 'Follow us',
                    ),		  
		            'social-icons' => array(
		                'label' => esc_html__( 'Social Icons', 'limme' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'desc' => esc_html__( 'Visible in inner page header', 'limme' ),
		                'box-options' => array(
		                    'icon_v2' => array(
		                        'label' => esc_html__( 'Icon', 'limme' ),
		                        'type'  => 'icon-v2',
		                    ),
		                    'text' => array(
		                        'label' => esc_html__( 'Text', 'limme' ),
		                        'desc' => esc_html__( 'If needed', 'limme' ),
		                        'type' => 'text',
		                    ),
		                    'href' => array(
		                        'label' => esc_html__( 'Link', 'limme' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),		                    
		                ),
                		'template' => '{{- text }}',		                
                    ),								
				),
			),
		),
	),	

);

if ( function_exists('lte_share_buttons_conf') ) {

	$share_links = lte_share_buttons_conf();

	$share_links_options = array();
	if ( !empty($share_links) ) {

		$share_links_options = array(

			'share_icons_hide' => array(
                'label' => esc_html__( 'Hide all share icons block', 'limme' ),
                'type'  => 'checkbox',
                'value'	=>	false,
            ),
		);
		foreach ( $share_links as $key => $item ) {

			$state = fw_get_db_settings_option( 'share_icon_' . $key );

			$value = false;
			if ( is_null($state) AND $item['active'] == 1 ) {

				$value = true;
			}

			$share_links_options[] =
			array(
				'share_icon_'.$key => array(
	                'label' => $item['header'],
	                'type'  => 'checkbox',
	                'value'	=>	$value,
	            ),
			);
		}
	}

	$share_links_options['share-add'] = array(

        'label' => esc_html__( 'Custom Share Buttons', 'limme' ),
        'type' => 'addable-box',
        'value' => array(),
        'desc' => esc_html__( 'You can use {link} and {title} variables to set url. E.g. "http://www.facebook.com/sharer.php?u={link}"', 'limme' ),
        'box-options' => array(
            'icon' => array(
                'label' => esc_html__( 'Icon', 'limme' ),
                'type'  => 'icon-v2',
            ),
            'header' => array(
                'label' => esc_html__( 'Header', 'limme' ),
                'type' => 'text',
            ),
            'link' => array(
                'label' => esc_html__( 'Link', 'limme' ),
                'type' => 'text',
                'value' => '',
            ),		  
            'color' => array(
                'label' => esc_html__( 'Color', 'limme' ),
                'type' => 'color-picker',
                'value' => '',
            ),		              
        ),
		'template' => '{{- header }}',		                
    );

	$options['social']['options']['share-box'] = array(
		'title'   => esc_html__( 'Share Buttons', 'limme' ),
		'type'    => 'tab',
		'options' => $share_links_options,
	);
}

