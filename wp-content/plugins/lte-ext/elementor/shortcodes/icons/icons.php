<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Icons_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-icons';
	}

	public function get_title() {
		return esc_html__( 'Icons Block', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);

			$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Type', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'top',
					'label_block' => true,
					'options' => [
						'top'		=>	esc_html__( 'Icon Top', 'lte-ext' ),
						'left'		=>	esc_html__( 'Icon Left', 'lte-ext' ),
						'right'	=>	esc_html__( 'Icon Right', 'lte-ext' ),
					],
				]
			);		

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'layout-cols1',
					'label_block' => true,
					'options' => [
						'layout-cols6'	=>	esc_html__( 'Six Columns', 'lte-ext' ),
						'layout-cols5'	=>	esc_html__( 'Five Columns', 'lte-ext' ),
						'layout-cols4'	=>	esc_html__( 'Four Columns', 'lte-ext' ),
						'layout-cols3'	=>	esc_html__( 'Three Columns', 'lte-ext' ),
						'layout-cols2'	=>	esc_html__( 'Two Columns', 'lte-ext' ),
						'layout-cols1'	=>	esc_html__( 'One Column', 'lte-ext' ),
						'layout-inline'	=>	esc_html__( 'Inline', 'lte-ext' ),
					],
				]
			);		

			$this->add_control(
				'space',
				[
					'label' => esc_html__( 'Space Between', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'md',
					'label_block' => true,
					'options' => [
						'sm'	=>	esc_html__( 'Small', 'lte-ext' ),
						'md'	=>	esc_html__( 'Medium', 'lte-ext' ),
						'lg'	=>	esc_html__( 'Large', 'lte-ext' ),
					],
				]
			);	

			$this->add_control(
				'icon-size',
				[
					'label' => esc_html__( 'Icon Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'medium',
					'options' => [
						'xlarge'		=> esc_html__('Extra Large', 'lte-ext'),
						'large'			=> esc_html__('Large', 'lte-ext'),
						'medium'		=> esc_html__('Medium', 'lte-ext'),
						'small'			=> esc_html__('Small', 'lte-ext'),
						'xsmall'		=> esc_html__('Extra Small', 'lte-ext'),
					],
				]
			);		

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'plugin-name' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'plugin-name' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'plugin-name' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'prefix_class' => 'lte-icons-align%s-',
				]
			);				

			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Link Target', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'self',
					'label_block' => true,
					'options' => [
						'self'		=>	esc_html__( 'Self', 'lte-ext' ),
						'blank'		=>	esc_html__( 'New Window', 'lte-ext' ),
//						'swipebox'	=>	esc_html__( 'Swipebox', 'lte-ext' ),
					],
				]
			);	
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'header', [
						'label' => esc_html__( 'Header', 'lte-ext' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'descr', [
						'label' => esc_html__( 'Description', 'lte-ext' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'href',
					[
						'label' => esc_html__( 'Href', 'lte-ext' ),
						'type' => \Elementor\Controls_Manager::URL,
						'label_block' => true,
					]
				);

				$repeater->start_controls_tabs(
							'style_tabs'
						);

					$repeater->start_controls_tab(
						'icon_content_icon',
						[
							'label' => esc_html__( 'Icon', 'lte-ext' ),
						]
					);

						$repeater->add_control(
							'icon',
							[
								'label' => esc_html__( 'Icon', 'lte-ext' ),
								'type' => \Elementor\Controls_Manager::ICONS,
								'label_block' => true,
							]
						);

					$repeater->end_controls_tab();

					$repeater->start_controls_tab(
						'icon_content_text',
						[
							'label' => esc_html__( 'Text', 'lte-ext' ),
						]
					);

						$repeater->add_control(
							'icon-text',
							[
								'label' => esc_html__( 'Icon Text', 'lte-ext' ),
								'type' => \Elementor\Controls_Manager::TEXT,
								'label_block' => true,
							]
						);

					$repeater->end_controls_tab();

				$repeater->end_controls_tabs();

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Items', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ header }}}',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'lte-ext' ),
			]
		);

			$this->add_control(
				'icon-color',
				[
					'label' => esc_html__( 'Icon Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'main',
					'options' => [
						'main'			=> esc_html__('Main', 'lte-ext'),
						'second'		=> esc_html__('Second', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
						'white'			=> esc_html__('White', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'icon-shape',
				[
					'label' => esc_html__( 'Icon Shape', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'		=> esc_html__('Default', 'lte-ext'),
						'circle'		=> esc_html__('Circle', 'lte-ext'),
						'square'		=> esc_html__('Square', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'icon-padding',
				[
					'label' => esc_html__( 'Icon Padding', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'disabled'		=> esc_html__('Disabled', 'lte-ext'),
						'small'		=> esc_html__('Small', 'lte-ext'),
						'large'		=> esc_html__('Large', 'lte-ext'),
					],
					'condition' => [
						'icon-shape' => ['circle', 'square'],
					],					
				]
			);	
			$this->add_control(
				'icon-bg-color',
				[
					'label' => esc_html__( 'Icon Background', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'disabled'		=> esc_html__('None', 'lte-ext'),
						'main'			=> esc_html__('Main', 'lte-ext'),
						'second'		=> esc_html__('Second', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
						'white'			=> esc_html__('White', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'icon-border-color',
				[
					'label' => esc_html__( 'Icon Border', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'disabled'		=> esc_html__('None', 'lte-ext'),
						'main'			=> esc_html__('Main', 'lte-ext'),
						'second'		=> esc_html__('Second', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
						'white'			=> esc_html__('White', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'header-color',
				[
					'label' => esc_html__( 'Header Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'		=> esc_html__('Default', 'lte-ext'),
						'main'			=> esc_html__('Main', 'lte-ext'),
						'second'		=> esc_html__('Second', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
						'white'			=> esc_html__('White', 'lte-ext'),
					],
				]
			);		
	
			$this->add_control(
				'header-tag',
				[
					'label' => esc_html__( 'Header Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'span',
					'options' => [
						'h4'	=> esc_html__('H4', 'lte-ext'),
						'h5'	=> esc_html__('H5', 'lte-ext'),
						'h6'	=> esc_html__('H6', 'lte-ext'),
						'span'	=> esc_html__('Text', 'lte-ext'),
						'small'	=> esc_html__('Small Text', 'lte-ext'),
					],
				]
			);			

			$this->add_control(
				'divider',
				[
					'label' => esc_html__( 'Divider', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'disabled'		=> esc_html__('Disabled', 'lte-ext'),
						'dashed'		=> esc_html__('Dashed', 'lte-ext'),
					],
				]
			);		

			$this->add_control(
				'additional',
				[
					'label' => esc_html__( 'Additional', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'disabled'		=> esc_html__('Disabled', 'lte-ext'),
						'gray-boxes'	=> esc_html__('Gray Boxes', 'lte-ext'),
					],
				]
			);		

			$this->add_control(
				'inner-padding',
				[
					'label' => esc_html__( 'Inner Padding', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'no',
					'condition'	=>	['type' => 'top']
				]
			);	

			$this->add_control(
				'hover-animation',
				[
					'label' => esc_html__( 'Hover Animation', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);		

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('icons', $settings);
	}
}




