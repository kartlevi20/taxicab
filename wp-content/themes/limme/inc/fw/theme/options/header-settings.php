<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$limme_theme_config = limme_theme_config();
$limme_sections_list = limme_get_sections();

$navbar_custom_assign = array();

if ( !empty( $limme_theme_config['navbar'] ) AND is_array($limme_theme_config['navbar']) AND sizeof( $limme_theme_config['navbar']) > 1 ) {

	$menus = get_terms('nav_menu');
	if ( !empty($menus) ) {

		$list = array();
		foreach ( $menus as $item ) {

			$list[$item->term_id] = $item->name;
		}

		foreach ( $limme_theme_config['navbar'] as $key => $val) {

			$navbar_custom_assign['navbar-'.$key.'-assign'] = array(
				'label' => sprintf( esc_html__( 'Navbar %s Assign', 'limme' ), ucwords($key) ),
				'type'    => 'select',
				'desc' => esc_html__( 'You can assign additional menus for inner navbar.', 'limme' ),
				'value' => 'default',
				'choices' => array('default' => esc_html__( 'Default', 'limme' )) + $list,
			);
		}

		$navbar_custom_assign = array();
	}
}

$options = array(
	'header' => array(
		'title'   => esc_html__( 'Header', 'limme' ),
		'type'    => 'tab',
		'options' => array(
			'header-box-2' => array(
				'title'   => esc_html__( 'Navbar', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'navbar-default'    => array(
						'label' => esc_html__( 'Navbar Default', 'limme' ),
						'type'    => 'select',
						'value' => $limme_theme_config['navbar-default'],
						'choices' => $limme_theme_config['navbar'],
					),	
					'navbar-default-force'    => array(
						'label' => esc_html__( 'Navbar Default Override', 'limme' ),
						'desc'   => esc_html__( 'By default every page can have unqiue navbar setting. You can override them here.', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled. Every page uses its own settings', 'limme' ),
							'force'  => esc_html__( 'Enabled. Override all site pages and use Navbar Default', 'limme' ),
						),
						'value' => 'disabled',
					),						
					'navbar-affix'    => array(
						'label' => esc_html__( 'Navbar Sticked', 'limme' ),
						'desc'   => esc_html__( 'May not work with all navbar types', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'' => esc_html__( 'Allways Static', 'limme' ),
							'affix'  => esc_html__( 'Sticked', 'limme' ),
						),
						'value' => '',
					),
					'navbar-breakpoint'    => array(
						'label' => esc_html__( 'Navbar Mobile Breakpoint, px', 'limme' ),
						'desc'   => esc_html__( 'Mobile menu will be displayed in viewports below this value', 'limme' ),
						'type'    => 'text',
						'value' => '1198',
					),												
					$navbar_custom_assign,
				)
			),
			'header-box-topbar' => array(
				'title'   => esc_html__( 'Topbar', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'topbar-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'You can edit topbar in Sections menu of dashboard (on the left)', 'limme' ),
					),					
					'topbar'    => array(
						'label' => esc_html__( 'Topbar visibility', 'limme' ),
						'desc'   => esc_html__( 'You can edit topbar layout in Sections menu', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always Visible', 'limme' ),
							'desktop'  => esc_html__( 'Desktop Visible', 'limme' ),
							'desktop-tablet'  => esc_html__( 'Desktop and Tablet Visible', 'limme' ),
							'mobile'  => esc_html__( 'Mobile only Visible', 'limme' ),
							'hidden' => esc_html__( 'Hidden', 'limme' ),
						),
						'value' => 'hidden',
					),					
					'topbar-section'    => array(
						'label' => esc_html__( 'Topbar section', 'limme' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'limme' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $limme_sections_list['top_bar'],						
						'value'	=> '',
					),										
				)
			),			
			'header-box-icons' => array(
				'title'   => esc_html__( 'Icons and Elements', 'limme' ),
				'type'    => 'tab',
				'options' => array(		
					'icons-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'Icons can be displayed in topbar using shortcode: [lte-navbar-icons]', 'limme' ),
					),																
					'navbar-icons' => array(
		                'label' => esc_html__( 'Navbar Icons', 'limme' ),
		                'desc' => esc_html__( 'Displayed on right side of navbars', 'limme' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'picker'       => array(
									'type_radio' => array(
										'label'   => esc_html__( 'Type', 'limme' ),
										'type'    => 'radio',
										'choices' => array(
											'search' => esc_html__( 'Search', 'limme' ),
											'basket'  => esc_html__( 'WooCommerce Cart', 'limme' ),
											'profile'  => esc_html__( 'User Profile', 'limme' ),
											'social'  => esc_html__( 'Social Icon', 'limme' ),
											'button'  => esc_html__( 'Button', 'limme' ),
										),
									)
								),
								'choices'      => array(
									'basket'  => array(
										'count'    => array(
											'label' => esc_html__( 'Count Label', 'limme' ),
											'type'    => 'select',
											'choices' => array(
												'show' => esc_html__( 'Always show', 'limme' ),
												'show-full' => esc_html__( 'Show for non-empty cart', 'limme' ),
												'hide'  => esc_html__( 'Hide', 'limme' ),
											),
											'value' => 'show',
										),											
									),
									'search'  => array(
										'source'    => array(
											'label' => esc_html__( 'Source', 'limme' ),
											'type'    => 'select',
											'choices' => array(
												'default' => esc_html__( 'All Pages', 'limme' ),
												'woocommerce'  => esc_html__( 'WooCommerce Products', 'limme' ),
											),
											'value' => 'default',
										),												
									),
									'social'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'limme' ),
					                        'type' => 'text',
					                    ),				                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'limme' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),		
									'button'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'limme' ),
					                        'type' => 'text',
					                    ),				                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'limme' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),										
								),
								'show_borders' => false,
							),	  														                	
							'icon-type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'value'        => array(
									'icon_radio' => 'default',
								),
								'picker'       => array(
									'icon_radio' => array(
										'label'   => esc_html__( 'Icon', 'limme' ),
										'type'    => 'radio',
										'choices' => array(
											'default'  => esc_html__( 'Default', 'limme' ),
											'fa' => esc_html__( 'Custom', 'limme' )
										),
										'desc'    => esc_html__( 'For social icons you need to use FontAwesome in any case.',
											'limme' ),
									)
								),
								'choices'      => array(
									'default'  => array(
									),
									'fa' => array(
										'icon_v2'  => array(
											'type'  => 'icon-v2',
											'label' => esc_html__( 'Select Icon', 'limme' ),
										),										
									),
								),
								'show_borders' => false,
							),
							'icon-header'        => array(
								'label'   => esc_html__( 'Show Header', 'limme' ),
								'type'    => 'switch',
							),								
		                ),
                		'template' => '{{- type.type_radio }}',		                
                    ),
					'navbar-add-icons' => array(
		                'label' => esc_html__( 'Navbar Additional Icons', 'limme' ),
		                'desc' => esc_html__( 'Displayed additionaly to icons in inner navbars', 'limme' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type' => array(
								'label'   => esc_html__( 'Type', 'limme' ),
								'type'    => 'radio',
								'value'	=>	'social',
								'choices' => array(
									'social'  => esc_html__( 'Social Icon', 'limme' ),
									'button'  => esc_html__( 'Button', 'limme' ),
								),
							),
				            'text' => array(
		                        'label' => esc_html__( 'Header', 'limme' ),
		                        'type' => 'text',
		                    ),				                    
		                    'href' => array(
		                        'label' => esc_html__( 'External Link', 'limme' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),
							'icon'  => array(
								'type'  => 'icon-v2',
								'label' => esc_html__( 'Select Icon', 'limme' ),
							),
							'inner-only'  => array(
								'type'  => 'switch',
								'label' => esc_html__( 'Display only in inner pages', 'limme' ),
							),												
		                ),
                		'template' => '{{- type }}',		                
                    ),
					'tagline'    => array(
						'label' => esc_html__( 'Header Tagline', 'limme' ),
						'desc'  => esc_html__( 'Visible on left side of homepage slider', 'limme' ),
						'type'  => 'text',
					),
					'tagline-short'    => array(
						'label' => esc_html__( 'Header Short Tagline', 'limme' ),
						'desc'  => esc_html__( 'Visible on left side of inner page header', 'limme' ),
						'type'  => 'text',
					),							
				),
			),
			'header-box-1' => array(
				'title'   => esc_html__( 'Page Header H1', 'limme' ),
				'type'    => 'tab',
				'options' => array(
					'breadcrubms'    => array(
						'label' => esc_html__( 'Breadcrumbs', 'limme' ),
						'html' => esc_html__( 'To hide breadcrubms you can disable Breadcrumbs plugin from plugins menu.', 'limme' ),
						'type'  => 'html',
					),						
					'pageheader-display'    => array(
						'label' => esc_html__( 'Page Header Visibility', 'limme' ),
						'desc'   => esc_html__( 'Status of Page Header with H1 and Breadcrumbs', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'limme' ),
							'disabled'  => esc_html__( 'Force Hidden on all Pages', 'limme' ),
						),
						'value' => 'fixed',
					),		
					'pageheader-overlay'    => array(
						'label' => esc_html__( 'Page Header Overlay', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'enabled' => esc_html__( 'Enabled', 'limme' ),
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
						),
						'value' => 'enabled',
					),	
					'header_fixed'    => array(
						'label' => esc_html__( 'Background parallax', 'limme' ),
						'desc'   => esc_html__( 'Parallax effect requires large images', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'limme' ),
							'fixed'  => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'fixed',
					),														
					'header-social'    => array(
						'label' => esc_html__( 'Social icons in page header', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'limme' ),
							'enabled' => esc_html__( 'Enabled', 'limme' ),
						),
						'value' => 'enabled',
					),	
					'header-bg' => array(
						'title'   => esc_html__( 'Header Background', 'limme' ),
						'type'    => 'box',
						'options' => array(			
							'header_bg'    => array(
								'label' => esc_html__( 'Page Header Default Background', 'limme' ),
								'desc'  => esc_html__( 'Default Page Header for all pages, can be overriden by the settings above', 'limme' ),
								'type'  => 'upload',
							),  							
							'featured'    => array(
								'label' => esc_html__( 'Featured Images as Background', 'limme' ),
								'type'    => 'checkboxes',						
								'choices' => array(
									'pages'  => esc_html__( 'Pages', 'limme' ),
									'posts'  => esc_html__( 'Blog Posts', 'limme' ),
									'services'  => esc_html__( 'Services', 'limme' ),
									'woocommerce'  => esc_html__( 'WooCommerce Products', 'limme' ),
									'woocommerce-cat'  => esc_html__( 'WooCommerce Categories / Tags', 'limme' ),
								),
							    'value' => array(
							        'pages' => true,
							    ),								
							),										
							'wc-bg'    => array(
								'label' => '',
								'html' => esc_html__( 'To set separate default background for WooCommerce pages assign it to the Pages -> Shop as Featured Image', 'limme' ),
								'type'  => 'html',
							),												
							'wc-bg-2'    => array(
								'label' => '',
								'html' => esc_html__( 'Note: WooCommerce Products and Categories have additional "Page Header Background" field, which may override header background', 'limme' ),
								'type'  => 'html',
							),								
						)
					),
				),
			),
		),
	),	
);

unset($options['header']['options']['header-box-icons']['options']['tagline']);


