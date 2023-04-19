<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$limme_choices =  array();
$limme_choices['default'] = esc_html__( 'Default', 'limme' );

$limme_color_schemes = fw_get_db_settings_option( 'items' );
if ( !empty($limme_color_schemes) ) {

	foreach ($limme_color_schemes as $v) {

		$limme_choices[$v['slug']] = esc_html( $v['name'] );
	}
}

$limme_theme_config = limme_theme_config();
$limme_sections_list = limme_get_sections();


$options = array(
	'general' => array(
		'title'   => esc_html__( 'Page settings', 'limme' ),
		'type'    => 'box',
		'options' => array(		
			'general-box' => array(
				'title'   => __( 'General Settings', 'limme' ),
				'type'    => 'tab',
				'options' => array(

					'margin-layout'    => array(
						'label' => esc_html__( 'Content Margin', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Margins control for content', 'limme' ),
						'choices' => array(
							'default'  => esc_html__( 'Top And Bottom', 'limme' ),
							'top'  => esc_html__( 'Top Only', 'limme' ),
							'bottom'  => esc_html__( 'Bottom Only', 'limme' ),
							'disabled' => esc_html__( 'Margin Removed', 'limme' ),
						),
						'value' => 'default',
					),			
					'topbar-layout'    => array(
						'label' => esc_html__( 'Topbar section', 'limme' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'limme' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('hidden' => 'Hidden') + $limme_sections_list['top_bar'],						
						'value'	=> 'default',
					),						
					'navbar-layout'    => array(
						'label' => esc_html__( 'Navbar', 'limme' ),
						'type'    => 'select',
						'choices' => array( 'default'  	=> esc_html__( 'Default', 'limme' ) ) + $limme_theme_config['navbar'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'limme' ) ),
						'value' => $limme_theme_config['navbar-default'],
					),								
					'header-layout'    => array(
						'label' => esc_html__( 'Page Header', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'limme' ),
							'disabled' => esc_html__( 'Hidden', 'limme' ),
						),
						'value' => 'default',
					),						
					'subscribe-layout'    => array(
						'label' => esc_html__( 'Subscribe Block', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Subscribe block before footer. Can be edited from Sections Menu.', 'limme' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'limme' ),
							'disabled' => esc_html__( 'Hidden', 'limme' ),
						),
						'value' => 'default',
					),		
					'before-footer-layout'    => array(
						'label' => esc_html__( 'Before Footer', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Before footer sections. Edited in Sections menu.', 'limme' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'limme' ),
							'disabled' => esc_html__( 'Hidden', 'limme' ),
						),
						'value' => 'default',
					),	
					'footer-layout'    => array(
						'label' => esc_html__( 'Footer', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before footer. Edited in Widgets menu.', 'limme' ),
						'choices' => $limme_theme_config['footer'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'limme' ) ),
						'value' => $limme_theme_config['footer-default'],
					),	
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block parallax effect.', 'limme' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'limme' ),
							'disabled' => esc_html__( 'Disabled', 'limme' ),
						),
						'value' => 'default',
					),																			
					'color-scheme'    => array(
						'label' => esc_html__( 'Color Scheme', 'limme' ),
						'type'    => 'select',
						'choices' => $limme_choices,
						'value' => 'default',
					),		
					'body-bg'    => array(
						'label' => esc_html__( 'Background Scheme', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default'  	=> esc_html__( 'Default', 'limme' ),
							'white'  	=> esc_html__( 'White', 'limme' ),
							'black'  	=> esc_html__( 'Black', 'limme' ),
						),
						'value' => 'default',
					),														
					'background-image'    => array(
						'label' => esc_html__( 'Full Page Background Image', 'limme' ),
						'type'  => 'upload',
						'desc'   => esc_html__( 'Will be used to fill whole page', 'limme' ),
					),	
					'direction'    => array(
						'label' => esc_html__( 'Direction', 'limme' ),
						'desc'   => esc_html__( 'Used to create certain page with unique text direction', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default'  	=> esc_html__( 'Default', 'limme' ),
							'ltr'  		=> esc_html__( 'LTR', 'limme' ),
							'rtl'  		=> esc_html__( 'RTL', 'limme' ),
						),
						'value' => 'default',
					),																	
				),											
			),	
			'cpt' => array(
				'title'   => esc_html__( 'Blog / Gallery', 'limme' ),
				'type'    => 'tab',
				'options' => array(				
					'sidebar-layout'    => array(
						'label' => esc_html__( 'Blog Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'limme' ),
							'left'  => esc_html__( 'Sidebar Left', 'limme' ),
							'right'  => esc_html__( 'Sidebar Right', 'limme' ),
						),
						'value' => 'hidden',
					),						
					'blog-layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'limme' ),
						'description'   => esc_html__( 'Used only for blog pages.', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'limme' ),
							'classic'  => esc_html__( 'One Column', 'limme' ),
							'two-cols' => esc_html__( 'Two Columns', 'limme' ),
							'three-cols' => esc_html__( 'Three Columns', 'limme' ),
						),
						'value' => 'default',
					),
					'gallery-layout'    => array(
						'label' => esc_html__( 'Gallery Layout', 'limme' ),
						'description'   => esc_html__( 'Used only for gallery pages.', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'limme' ),
							'col-2' => esc_html__( 'Two Columns', 'limme' ),
							'col-3' => esc_html__( 'Three Columns', 'limme' ),
							'col-4' => esc_html__( 'Four Columns', 'limme' ),
						),
						'value' => 'default',
					),					
				)
			)	
		)
	),
);

unset($options['general']['options']['general-box']['options']['footer-parallax']);
unset($options['general']['options']['general-box']['options']['before-footer-layout']);
unset($options['general']['options']['general-box']['options']['body-bg']);

