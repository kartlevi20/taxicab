<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Button_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-button';
	}

	public function get_title() {
		return esc_html__( 'Button', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-button';
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
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__('Read More', 'lte-ext'),
					'label_block'	=>	true,
				]
			);

			$this->add_control(
				'href',
				[
					'label' => __( 'Href', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::URL,
					'label_block' => true,
				]
			);

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'lg' 		=> esc_html__('Large', 'lte-ext'),
						'default'	=> esc_html__('Default', 'lte-ext'),
						'xs'		=> esc_html__('Small', 'lte-ext')
					],
				]
			);

			$this->add_control(
				'color',
				[
					'label' => esc_html__( 'Background Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'main'			=> esc_html__('Main Color', 'lte-ext'),
						'second'		=> esc_html__('Second Color', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
						'white'			=> esc_html__('White', 'lte-ext'),
						'transparent'	=> esc_html__('Transparent', 'lte-ext'),
					],
					'label_block'	=>	true,
				]
			);	

			$this->add_control(
				'hover_color',
				[
					'label' => esc_html__( 'Hover Background Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'	=> esc_html__('Default Color', 'lte-ext'),
						'main'		=> esc_html__('Main Color', 'lte-ext'),
						'second'	=> esc_html__('Second Color', 'lte-ext'),
						'black'		=> esc_html__('Black', 'lte-ext'),
						'white'		=> esc_html__('White', 'lte-ext'),
						'gray'		=> esc_html__('Gray', 'lte-ext'),
					],
					'label_block'	=>	true,
				]
			);	

			$this->add_control(
				'inline',
				[
					'label' => esc_html__( 'Position', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'	=>	esc_html__('One in row', 'lte-ext'),
						'inline'	=>	esc_html__('Inline buttons', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Target', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'self',
					'options' => [
						'self'	=>	esc_html__('Current window', 'lte-ext'),
//						'popup'	=>	esc_html__('Popup', 'lte-ext'),
						'blank'	=>	esc_html__('New window', 'lte-ext')
					],
				]
			);	

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Align', 'lte-ext' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'lte-ext' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'lte-ext' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'lte-ext' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'lte-ext' ),
			]
		);			

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'label_block' => true,
				]
			);
		$this->end_controls_section();		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('button', $settings);
	}
}


