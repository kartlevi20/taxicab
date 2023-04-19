<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(

	'layout' => array(
		'title'   => esc_html__( 'Post Types', 'limme' ),
		'type'    => 'tab',
		'options' => array(

			'layout-box-1' => array(
				'title'   => esc_html__( 'Blog Posts', 'limme' ),
				'type'    => 'tab',
				'options' => array(

					'blog_layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'limme' ),
						'desc'   => esc_html__( 'Default blog page layout.', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'limme' ),
							'two-cols' => esc_html__( 'Two Columns', 'limme' ),
							'three-cols' => esc_html__( 'Three Columns', 'limme' ),
						),
						'value' => 'classic',
					),				
					'blog_list_sidebar'    => array(
						'label' => esc_html__( 'Blog List Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'right',
					),				
					'blog_post_sidebar'    => array(
						'label' => esc_html__( 'Blog Post Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'right',
					),																				
					'excerpt_auto'    => array(
						'label' => esc_html__( 'Excerpt Classic Blog Size', 'limme' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'limme' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),
					'excerpt_masonry_auto'    => array(
						'label' => esc_html__( 'Excerpt Masonry Blog Size', 'limme' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'limme' ),
						'value'	=> 30,
						'type'  => 'short-text',
					),		
					'blog_gallery_autoplay'    => array(
						'label' => esc_html__( 'Gallery post type autoplay, ms', 'limme' ),
						'desc'  => esc_html__( 'Set 0 to disable autoplay', 'limme' ),
						'type'  => 'text',
						'value' => '4000',
					),						
				)
			),
			'layout-box-2' => array(
				'title'   => esc_html__( 'Services', 'limme' ),
				'type'    => 'tab',
				'options' => array(	
					'services_header'    => array(
						'label' => esc_html__( 'Services Header', 'limme' ),
						'desc'  => esc_html__( 'Can be used in breadcrumbs and etc.', 'limme' ),
						'type'  => 'text',
						'value' => esc_html__( 'Services', 'limme' ),
					),						
					'services_slug'    => array(
						'label' => esc_html__( 'Services slug', 'limme' ),
						'desc'  => esc_html__( 'After slug change you need to go to the Settings -> Permalinks and click Save Changes.', 'limme' ),
						'type'  => 'text',
						'value' => 'services',
					),									
					'services_list_sidebar'    => array(
						'label' => esc_html__( 'Services List Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'hidden',
					),				
					'services_post_sidebar'    => array(
						'label' => esc_html__( 'Services Post Sidebar', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'limme' ),
							'left' => esc_html__( 'Left', 'limme' ),
							'right' => esc_html__( 'Right', 'limme' ),
						),
						'value' => 'hidden',
					),					
				)
			),
			'layout-box-4' => array(
				'title'   => esc_html__( 'Gallery', 'limme' ),
				'type'    => 'tab',
				'options' => array(													
					'gallery_layout'    => array(
						'label' => esc_html__( 'Default Gallery Layout', 'limme' ),
						'desc'   => esc_html__( 'Default galley page layout.', 'limme' ),
						'type'    => 'select',
						'choices' => array(
							'col-2' => esc_html__( 'Two Columns', 'limme' ),
							'col-3' => esc_html__( 'Three Columns', 'limme' ),
							'col-4' => esc_html__( 'Four Columns', 'limme' ),
						),
						'value' => 'col-2',
					),						
				)
			)	
		)
	),

);
