<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-header';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
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
				'subheader',
				[
					'label' => esc_html__( 'Subheader', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( "Subheader", 'lte-ext'),
					'label_block'	=>	true,
					'condition' => [
						'style' => ['header-subheader', 'year'],
					],						
				]
			);

			$this->add_control(
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXTAREA,
					'description' => esc_html__( "Use braces {{ to insert inline subheader }}", 'lte-ext'),
					'default' => esc_html__( "Header", 'lte-ext'),
					'label_block'	=>	true,
				]
			);

			$this->add_control(
				'watermark',
				[
					'label' => esc_html__( 'Watermark', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
					'condition' => [
						'style' => 'header-subheader',
					],					
				]
			);

			$this->add_control(
				'href',
				[
					'label' => esc_html__( 'Href', 'lte-ext' ),
					'type' => Controls_Manager::URL,
				]
			);

			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'header-subheader',
					'options' => [
						'default'			=>	esc_html__( 'Simple', 'lte-ext' ),
						'header-subheader'	=>	esc_html__( 'With Subheader Above', 'lte-ext' ),
						'italic'			=>	esc_html__( 'Italic', 'lte-ext' ),
//						'year'				=>	esc_html__( 'Year', 'lte-ext' ),
//						'discount'			=>	esc_html__( 'Discount Price', 'lte-ext' ),
//						'price'				=>	esc_html__( 'Price/Per', 'lte-ext' ),
//						'circle-dashed'		=>	esc_html__( 'Circle Dashed', 'lte-ext' ),
					],
					'prefix_class' => 'lte-heading-style-',
				]
			);

			$this->add_control(
				'style_add',
				[
					'label' => esc_html__( 'Additonal', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''			=>	esc_html__( '--', 'lte-ext' ),
						'underline'	=>	esc_html__( 'Underline', 'lte-ext' ),
					],
				]
			);

			$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Tag', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'h3',
					'options' => [
						'h1' => esc_html__('Heading 1', 'lte-ext'),
						'h2' => esc_html__('Heading 2', 'lte-ext'),
						'h3' => esc_html__('Heading 3', 'lte-ext'),
						'h4' => esc_html__('Heading 4', 'lte-ext'),
						'h5' => esc_html__('Heading 5', 'lte-ext'),
						'h6' => esc_html__('Heading 6', 'lte-ext'),
					],
				]
			);

			$this->add_control(
				'subtype',
				[
					'label' => esc_html__( 'Sub Tag', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'h6',
					'options' => [
						'h3' => esc_html__('Heading 3', 'lte-ext'),
						'h4' => esc_html__('Heading 4', 'lte-ext'),
						'h5' => esc_html__('Heading 5', 'lte-ext'),
						'h6' => esc_html__('Heading 6', 'lte-ext'),
					],
				]
			);

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => esc_html__('Default tag', 'lte-ext'),
						'huge' => esc_html__('Huge', 'lte-ext'),
						'xl' => esc_html__('Extra Large', 'lte-ext'),
						'lg' => esc_html__('Large', 'lte-ext'),
						'bg' => esc_html__('Big', 'lte-ext'),
						'md' => esc_html__('Medium', 'lte-ext'),
						'sm' => esc_html__('Small', 'lte-ext'),
					],
				]
			);

			$this->add_control(
				'color',
				[
					'label' => esc_html__( 'Header Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'	=> esc_html__('Default', 'lte-ext'),
						'black'		=> esc_html__('Black', 'lte-ext'),
						'main'		=> esc_html__('Main Color', 'lte-ext'),
						'second'	=> esc_html__('Second Color', 'lte-ext'),
						'white'		=> esc_html__('White', 'lte-ext'),
						'outline'	=> esc_html__('Outline', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'subcolor',
				[
					'label' => esc_html__( 'Subheader Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'main',
					'options' => [
						'default'	=> esc_html__('Inherit from Header', 'lte-ext'),
						'black'		=> esc_html__('Black', 'lte-ext'),
						'main'		=> esc_html__('Main Color', 'lte-ext'),
						'second'	=> esc_html__('Second Color', 'lte-ext'),
						'white'		=> esc_html__('White', 'lte-ext'),
						'outline'	=> esc_html__('Outline', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'margin',
				[
					'label' => esc_html__( 'Default Margin', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'no',
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

			$this->add_control(
				'icon-size',
				[
					'label' => esc_html__( 'Icon Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'lg',
					'options' => [
						'sm'		=> esc_html__('Small', 'lte-ext'),
						'lg'		=> esc_html__('Large', 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'icon-shadow',
				[
					'label' => esc_html__( 'Icon Shadow', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);				

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('header', $settings);
	}
}


