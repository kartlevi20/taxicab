<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }


$options = array(
	'woocommerce-box' => array(
		'title'   => esc_html__( 'WooCommerce', 'limme' ),
		'type'    => 'tab',
		'options' => array(

			'wc-layout' => array(
				'title'   => esc_html__( 'Layout', 'limme' ),
				'type'    => 'box',
				'options' => array(	

					'wc_product_style'    => array(
						'label' => esc_html__( 'Product Style ', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default'	=>	esc_html__( 'Default', 'limme'),
						),
						'value' => 'default',
					),				
					'shop_list_sidebar'    => array(
						'label' => esc_html__( 'Archive List Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'left',
					),				
					'shop_post_sidebar'    => array(
						'label' => esc_html__( 'Single Product Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'hidden',
					),
					'shop_page_width'    => array(
						'label' => esc_html__( 'Pages Width', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Assigned only to WooCommerce pages without sidebar on large resoltion', 'limme' ),
						'choices' => array(
							'narrow' => esc_html__( 'Narrow', 'limme' ),
							'full'  => esc_html__( 'Full', 'limme' ),
						),
						'value' => 'narrow',
					),						
				),	
			),			
			'wc-products' => array(
				'title'   => esc_html__( 'Products', 'limme' ),
				'type'    => 'box',
				'options' => array(	

					'excerpt_wc_auto'    => array(
						'label' => esc_html__( 'Excerpt WooCommerce Size, words', 'limme' ),
						'desc'  => esc_html__( 'Automaticly cuts description for products', 'limme' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),		
					'wc_zoom'    => array(
						'label' => esc_html__( 'WooCommerce Product Hover Zoom', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Enables mouse hover zoom in single product page', 'limme' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),
					'wc_hover_gallery'    => array(
						'label' => esc_html__( 'Hover Gallery Photo ', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Display first gallery image on product list hover', 'limme' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),					
					'wc_per_page'    => array(
						'label' => esc_html__( 'Products per Page', 'limme' ),
						'type'  => 'text',
						'value' => '6',
					),
					'wc_show_list_excerpt'    => array(
						'label' => esc_html__( 'Display Excerpt in Shop List', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),					
					'wc_show_list_attr'    => array(
						'label' => esc_html__( 'Display Attributes in Shop List', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),
					'wc_show_more'    => array(
						'label' => esc_html__( 'Display Read More', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),					
					'wc_new_days'    => array(
						'label' => esc_html__( 'Number of days to display New label. Set 0 to hide.', 'limme' ),
						'type'  => 'text',
						'value' => '30',
					),							
				),
			),
			'wc-cols' => array(
				'title'   => esc_html__( 'Products per Column', 'limme' ),
				'type'    => 'box',
				'options' => array(	
					'wc_info'    => array(
						'label'	=> '',
						'html' => esc_html__( 'These settings override default WooCommerce settings for Products Archive page. Empty values are using previous value.', 'limme' ),
						'type'  => 'html',
					),		
					'wc_columns_xl'    => array(
						'label' => esc_html__( 'Extra Large Desktop, 1600px', 'limme' ),
						'type'  => 'select',
						'choices' => [1 => 1,2,3,4,5,6],
						'value' => 3,
					),
					'wc_columns_lg'    => array(
						'label' => esc_html__( 'Large Desktop, 1200px', 'limme' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_md'    => array(
						'label' => esc_html__( 'Notebook, 1000px', 'limme' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_sm'    => array(
						'label' => esc_html__( 'Tablet, 768px', 'limme' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => 2,
					),
					'wc_columns_ms'    => array(
						'label' => esc_html__( 'Horizontal Mobile, 480px', 'limme' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_xs'    => array(
						'label' => esc_html__( 'Mobile', 'limme' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => 1,
					),					
				),
			),
			'wc-additional' => array(
				'title'   => esc_html__( 'Additional', 'limme' ),
				'type'    => 'box',
				'options' => array(	
					'wc_related'    => array(
						'label' => esc_html__( 'Related Products Block', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Displayed on Single Product Page', 'limme' ),						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'enabled',
					),
					'wc_related_total'    => array(
						'label' => esc_html__( 'Related Products Total', 'limme' ),
						'type'    => 'text',
						'value' => '3',
					),
					'wc_related_columns'    => array(
						'label' => esc_html__( 'Related Products Columns', 'limme' ),
						'type'    => 'text',
						'value' => '3',
					),										
					'wc_cross_sell'    => array(
						'label' => esc_html__( 'Cross Sell Block', 'limme' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Displayed on Cart Page', 'limme' ),						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'disabled',
					),
					'wc_cross_sells_total'    => array(
						'label' => esc_html__( 'Cross Sell Products Total', 'limme' ),
						'type'    => 'text',
						'value' => '2',
					),					
					
				),
			),			
		)
	),
);


